<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentVerified;

use App\Models\User;

class BillController extends Controller
{
    public function show(User $user)
    {
        $bill = [
            'id' => $user->registration->id,
            'code' => $user->registration->code,
            'date' => $user->registration->created_at->format('d/m/Y'),
            'package' => $user->registration->package->description,
            'category' => $user->registration->category->name,
            'fee' => $user->registration->paybill,
            'status' => $user->registration->status(),
            'status_code' => $user->registration->status,
            'paid_at' => $user->registration->receipt ? $user->registration->receipt->paid_at->format('d/m/Y') : null,
            'paid_by' => $user->registration->receipt->name ?? null,
            'paid_bank' => $user->registration->receipt->bank ?? null,
            'paid_struk' => $user->registration->receipt ? asset($user->registration->receipt->file) : null,
            'struk_ext' => $user->registration->receipt ? $user->registration->receipt->fileInfo()['extension'] : null,
            'verification' => $user->registration->receipt ? route('bill.verified', $user->id) : ''
        ];

        if ($user->registration->booking) {
            $booking = $user->registration->booking;
            $bill = array_add($bill, 'accommodation', [
                'roomtype' => $booking->accommodation->rate,
                'duration' => $booking->duration,
                'check_in' => date('d.m.Y', strtotime($booking->check_in)),
                'check_out' => date('d.m.Y', strtotime($booking->check_out)),
                'fee' => $booking->fee,
                'total' => number_format(($user->registration->getOriginal('paybill') + $booking->getOriginal('fee')), 0, ',', '.')
            ]);
        }

        return response()->json($bill);
    }

    public function verified(User $user)
    {
        Mail::to($user)->send(new PaymentVerified($user));
        $user->registration->update(['status' => 2]);
        return redirect()->back()->with('success', 'Pembayaran telah diverifikasi.');
    }
}
