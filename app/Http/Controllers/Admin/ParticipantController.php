<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrationsExport;

use App\Models\Participant;
use App\Models\User;
use App\Models\Registration;
use App\Models\Event;
use App\Mail\ResendPaybill;
use App\Models\RegistrationFee;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $registrations = Registration::query()
                        ->with('user', 'participant')
                        ->order('created_at', 'desc')
                        ->search()
                        ->filter()
                        ->paginate(request('perPage', 25));

        $events = Event::all();
        $regs = Registration::pluck('status');
        $counter = [
            'notpaid' => $regs->where('status', 1)->count(),
            'waiting' => $regs->where('status', 2)->count(),
            'paid' => $regs->where('status', 3)->count(),
        ];

        return view('admin.participant.index', compact('registrations', 'counter', 'events', 'request'));
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

    public function destroy($id)
    {
        User::destroy($id);
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

    public function resendPaybill(Participant $participant)
    {
        $registration = Registration::where('user_id', $participant->user_id)->first();
        $paybill = RegistrationFee::where('package_id', $registration->package_id)->where('category_id', $registration->category_id)->first()->fee ?? 0;
        $registration->update(['paybill' => $paybill]);
        $registration->touch();

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $password = '';
        for ($i = 0; $i <= 12; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }

        $user = $registration->user;
        $user->update(['password' => bcrypt($password)]);

        Mail::to($user)->send(new ResendPaybill($user, $password));

        return redirect()->back()->with('success', 'Tagihan pembayaran peserta telah diperbarui menjadi tarif normal.');
    }
}
