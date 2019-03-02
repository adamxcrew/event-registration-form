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
            'fee' => number_format($user->registration->paybill),
            'status' => $user->registration->status(),
            'status_code' => $user->registration->status,
            'paid_at' => $user->registration->receipt ? $user->registration->receipt->paid_at->format('d/m/Y') : null,
            'paid_by' => $user->registration->receipt->name ?? null,
            'paid_bank' => $user->registration->receipt->bank ?? null,
            'paid_struk' => $user->registration->receipt ? asset($user->registration->receipt->file) : null,
            'verification' => $user->registration->receipt ? route('bill.verified', $user->id) : ''
        ];

        return response()->json($bill);
    }

    public function verified(User $user)
    {
        $user->registration->update(['status' => 2]);
        Mail::to($user)->queue(new PaymentVerified($user));
        return redirect()->back()->with('success', 'Pembayaran telah diverifikasi.');
    }
}
