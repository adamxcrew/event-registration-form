<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrationsExport;

use App\Models\Participant;
use App\Models\User;
use App\Models\Registration;
use App\Models\Event;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->has('filter') ? [$request->filter] : [0,1,2];
        $event = $request->e;

        $participants = Participant::when($event, function ($query, $event) {
            return $query->whereHas('user.registration.events', function ($query) use ($event) {
                $query->where('id', $event);
            });
        })->whereHas('user.registration', function ($query) use ($filter) {
            $query->whereIn('status', $filter);
        })->orderBy('created_at', 'desc')->get();

        $events = Event::all();
        $notpaid = DB::table('registrations')->where('status', 0)->count();
        $waiting = DB::table('registrations')->where('status', 1)->count();
        $paid = DB::table('registrations')->where('status', 2)->count();

        return view('admin.participant.index', compact('participants', 'notpaid', 'waiting', 'paid', 'events', 'request'));
    }

    public function show(Participant $participant)
    {
        $user = $participant->user;
        return view('admin.participant.show', compact('user'));
    }

    public function update(Request $request, Participant $participant)
    {
        $user = $participant->user;
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'company' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:13',
            'information' => 'nullable|string|max:255'
        ]);
        $user->update($request->all());
        $user->participant->update($request->all());
        return redirect()->back()->with('success','Perubahan disimpan.');
    }

    public function destroy(Participant $participant)
    {
        $user = User::destroy($participant->user_id);
        return redirect()->back()->with('success','Data registrasi peserta dihapus.');
    }

    public function export(Request $request)
    {
        $events = $request->events;
        if (!empty($events)) {
            $registration = Registration::whereHas('events', function ($query) use ($events) {
                $query->whereIn('id', $events);
            })->orderBy('created_at', 'desc')->get();
        }

        if (isset($registration) && $registration->count() > 0) {
            $date = date('d-m-Y');
            $filename = 'registrations-' . $date . '.xlsx';
            $export = new RegistrationsExport($registration, $events);
            return Excel::download($export, $filename);
            // $registrations = $registration;
            // return view('exports.registration', compact('registrations', 'events'));
        }
        return redirect()->back()->with('error', 'Tidak ada peserta untuk seminar yang kamu pilih.');
    }
}
