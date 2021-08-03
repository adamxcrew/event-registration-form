<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use PDF;

class InvoiceController extends Controller
{
    public function __invoke(Request $request)
    {
        $code = $request->c;
        $registration = Registration::where('code', $code)->first();

        if ($code && !$registration) {
            abort(404, 'Kode registrasi tidak ditemukan.');
        }

        if (!$code) {
            $registration = auth()->user()->registration;
        }

        $pdf = PDF::loadView('reports.invoice', compact('registration'))->setPaper('A4');
        return $pdf->download('invoice-' . $registration->code . '.pdf');

        // return view('reports.invoice', compact('registration'));
        // return $pdf->stream();
    }
}
