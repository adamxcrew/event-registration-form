<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Participant;
use App\Models\User;
use App\Models\Registration;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $filter = $request->has('filter') ? [$request->filter] : [0,1,2];

        $participants = Participant::when($keyword, function($query, $keyword) {
            return $query->whereHas('user.registration', function ($query) use ($keyword) {
                $query->where('code', $keyword);
            })
            ->orWhere('name', 'like', "%{$keyword}%")
            ->orWhere('profession', 'like', "%{$keyword}%");
        })
        ->whereHas('user.registration', function ($query) use ($filter) {
            $query->whereIn('status', $filter);
        })
        ->orderBy('created_at', 'desc')->paginate(25);

        $notpaid = DB::table('registrations')->where('status', 0)->count();
        $waiting = DB::table('registrations')->where('status', 1)->count();
        $paid = DB::table('registrations')->where('status', 2)->count();

        return view('admin.participant.index', compact('participants', 'notpaid', 'waiting', 'paid'));
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

    public function bill(User $user)
    {
        $bill = [
            'id' => $user->registration->id,
            'date' => $user->registration->created_at->format('d/m/Y'),
            'package' => $user->registration->package->description,
            'category' => $user->registration->category->name,
            'fee' => number_format($user->registration->paybill),
            'status' => $user->registration->status(),
            'paid_at' => $user->registration->receipt ? $user->registration->receipt->paid_at->format('d/m/Y') : null,
            'paid_by' => $user->registration->receipt->name ?? null,
            'paid_bank' => $user->registration->receipt->bank ?? null,
            'paid_struk' => $user->registration->receipt ? asset($user->registration->receipt->file) : null
        ];

        return response()->json($bill);
    }
}
