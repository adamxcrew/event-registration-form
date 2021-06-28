<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendPaymentVerifiedEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentVerified;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function show($id)
    {
        $registration = Registration::findOrFail($id);
        $bill = [
            'id' => $registration->id,
            'code' => $registration->code,
            'date' => $registration->created_at->format('d/m/Y'),
            'package' => $registration->package->name ?? $registration->package->description,
            'category' => $registration->category->name,
            'fee' => IDR($registration->paybill),
            'status' => $registration->status(),
            'status_code' => $registration->status,
            'paid_at' => $registration->receipt ? $registration->receipt->paid_at->format('d/m/Y') : null,
            'paid_by' => $registration->receipt->name ?? null,
            'paid_bank' => $registration->receipt->bank ?? null,
            'paid_struk' => $registration->receipt ? asset($registration->receipt->file) : null,
            'struk_ext' => $registration->receipt ? $registration->receipt->fileInfo()['extension'] : null,
            'verification' => $registration->receipt ? route('bill.verified', $registration->id) : ''
        ];

        return response()->json($bill);
    }

    public function verified($id)
    {
        $registration = Registration::findOrFail($id);
        $user = $registration->user;

        DB::transaction(function () use ($user) {
            // $user->registration->update(['status' => 3]);
            Mail::to($user)->send(new PaymentVerified($user));
        });

        return redirect()->back()->with('success', 'Pembayaran telah diverifikasi.');
    }
}
