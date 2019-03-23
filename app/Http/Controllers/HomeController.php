<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->hasRole('participant')) {
            $user = $request->user();
            return view('home', compact('user'));
        }

        $registrations = Registration::all();
        $allRegistrations = $registrations->count();
        $waitingVerifications = $registrations->where('status', 1)->count();
        $totalPayments = DB::table('registrations')->where('status', 2)->sum('paybill');

        return view('admin.dashboard', compact('allRegistrations', 'waitingVerifications', 'totalPayments'));
    }
}
