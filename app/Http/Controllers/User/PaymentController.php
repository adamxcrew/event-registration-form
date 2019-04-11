<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

use App\Models\PaymentReceipt;
use PDF;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $user = Auth::user();
        if (!$user->registration->receipt) {
            $strukRule = 'required';
        } else {
            $strukRule = 'nullable';
        }
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'paid_at' => 'required|date',
            'struk' => $strukRule . '|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $file = $request->file('struk');
        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $name = 'receipt-' . Carbon::now()->format('Y-m-d-') . $user->id;
            $filename = $name  . '.' . $ext;
            $path = 'receipts/' . $filename;
            $file->move('receipts', $filename);

            $request->request->add(['file' => $path]);
        }

        $receipt = PaymentReceipt::updateOrCreate(
            ['registration_id' => $user->registration->id],
            $request->all()
        );
        $user->registration->update(['status' => 1]);

        return redirect()->back()->with('success','Bukti pembayaran telah di-upload dan menunggu verifikasi Admin.');
    }

    public function ticket()
    {
        $user = Auth::user();
        $registration = $user->registration;
        $pdf = PDF::loadView('reports.invoice', compact('registration'))->setPaper('A4');
        return $pdf->download('invoice-' . $registration->code . '.pdf');
    }
}
