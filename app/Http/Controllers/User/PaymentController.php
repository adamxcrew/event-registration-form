<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentReceipt;
use Illuminate\Validation\Rule;
use PDF;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bank' => ['required', 'string', 'max:255'],
            'paid_at' => ['required', 'date'],
            'struk' => [Rule::requiredIf(!$user->registration->receipt), 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $data['file'] = optional($request->file('struk'))->storePublicly('receipts', ['disk' => 'public']);

        // if (!$user->registration->receipt) {
        //     $strukRule = 'required';
        // } else {
        //     $strukRule = 'nullable';
        // }

        // $this->validate($request, [
        //     'name' => 'required|string|max:255',
        //     'bank' => 'required|string|max:255',
        //     'paid_at' => 'required|date',
        //     'struk' => $strukRule . '|file|mimes:jpg,jpeg,png,pdf|max:2048'
        // ]);

        // $file = $request->file('struk');
        // if ($file) {
        //     $ext = $file->getClientOriginalExtension();
        //     $name = 'receipt-' . Carbon::now()->format('Y-m-d-') . $user->id;
        //     $filename = $name  . '.' . $ext;
        //     $path = 'receipts/' . $filename;
        //     $file->move('receipts', $filename);

        //     $request->request->add(['file' => $path]);
        // }

        $payment = PaymentReceipt::updateOrCreate(
            ['registration_id' => $user->registration->id],
            array_filter($data)
        );

        $payment->registration->update(['status' => 2]);

        return redirect()->back()->with('success','Bukti pembayaran telah di-upload dan menunggu verifikasi Admin.');
    }

    public function ticket()
    {
        $user = auth()->user();
        $registration = $user->registration;
        $pdf = PDF::loadView('reports.invoice', compact('registration'))->setPaper('A4');
        return $pdf->download('invoice-' . $registration->code . '.pdf');
    }
}
