<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Registration;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $code = $request->c;
        $registration = Registration::where('code', $code)->first();
        if ($registration) {
            $pdf = PDF::loadView('reports.invoice', compact('registration'))->setPaper('A4');
            return $pdf->stream();
            // return $pdf->download('invoice-' . $registration->code . '.pdf');
        }
        abort(404);
    }
}
