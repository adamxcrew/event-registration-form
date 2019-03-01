<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

use App\Models\PaymentReceipt;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $user = Auth::user();
        $paybill = $user->registration->paybill;
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'paid_at' => 'required|date_format:"d/m/Y"',
            'struk' => 'required|file|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('struk');
        $ext = $file->getClientOriginalExtension();
        $name = 'receipt-' . Carbon::now()->format('Y-m-d-') . $user->id;
        $filename = $name  . '.' . $ext;
        $path = 'images/receipts/' . $filename;
        $file->move('images/receipts', $filename);

        $request->request->add(['file' => $path]);

        $receipt = PaymentReceipt::updateOrCreate(
            ['registration_id' => $user->registration->id],
            $request->all()
        );
        $user->registration->update(['status' => 1]);

        return redirect()->back()->with('success','Bukti pembayaran telah di-upload dan menunggu verifikasi Admin.');
    }
}
