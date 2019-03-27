<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Auth;
use App\Models\Registration;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $code = $request->c;
        $registration = Registration::where('code', $code)->first();
        if ($registration) {
            $pdf = PDF::loadView('reports.ticket2', compact('registration'))->setPaper('A4');
            return $pdf->download($registration->code . '.pdf');
        }
        abort(404);
    }
}
