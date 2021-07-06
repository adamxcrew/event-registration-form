<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PaymentVerified;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function show(Registration $registration)
    {
        $receipt = optional($registration->receipt);
        $bill = [
            'id' => $registration->id,
            'code' => $registration->code,
            'date' => $registration->created_at->format('d/m/Y'),
            'package' => $registration->package->name ?? $registration->package->description,
            'category' => $registration->category->name,
            'fee' => IDR($registration->paybill),
            'status' => $registration->status(),
            'status_code' => $registration->status,
            'paid_at' => optional($receipt->paid_at)->format('d/m/Y'),
            'paid_by' => $receipt->name,
            'paid_bank' => $receipt->bank,
            'paid_struk' => $receipt->file_url,
            'struk_ext' => $receipt->file_info['extension'] ?? null,
            'verification' => $receipt ? route('registration.verify', $registration->id) : '',
        ];

        return response()->json($bill);
    }

    public function verify(Registration $registration)
    {

        DB::transaction(function () use ($registration) {
            $registration->update(['status' => 3]);

            $user = $registration->user;
            Mail::to($user)->send(new PaymentVerified($user));
        });

        return redirect()->back()->with('success', 'Pembayaran telah diverifikasi.');
    }
}
