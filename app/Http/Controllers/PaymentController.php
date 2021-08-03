<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentReceipt;
use App\Models\Registration;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function confirm(Request $request)
    {
        $registration = Registration::where('code', $request->code)->first();
        if ($request->code && ! $registration) {
            return back()->withInput()->withErrors(['code' => 'Kode registrasi tidak ditemukan.']);
        }

        if (! $request->code) {
            $registration = auth()->user()->registration;
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bank' => ['required', 'string', 'max:255'],
            'paid_at' => ['required', 'date'],
            'struk' => [Rule::requiredIf(!$registration->receipt), 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $data['file'] = optional($request->file('struk'))->storePublicly('receipts', ['disk' => 'public']);

        $payment = PaymentReceipt::updateOrCreate(
            ['registration_id' => $registration->id],
            array_filter($data)
        );

        $payment->registration->update(['status' => 2]);

        return redirect()->back()->with('success','Terimakasih telah melakukan pembayaran. Pembayarang kamu sedang di-verifikasi.');
    }
}
