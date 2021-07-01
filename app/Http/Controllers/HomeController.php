<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use PDF;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->hasRole('participant')) {
            $user = $request->user();
            $files = File::all();
            return view('home', compact('user', 'files'));
        }

        $registrations = Registration::all();
        $allRegistrations = $registrations->count();
        $waitingVerifications = $registrations->where('status', 1)->count();
        $totalPayments = DB::table('registrations')->where('status', 3)->sum('paybill');

        return view('admin.dashboard', compact('allRegistrations', 'waitingVerifications', 'totalPayments'));
    }
}
