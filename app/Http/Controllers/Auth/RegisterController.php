<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Registration;
use App\Models\RegistrationDate;
use App\Models\RegistrationFee;
// use App\Models\Event;
use App\Models\Level;

use App\Mail\UserRegistered;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\RegistersUsers;
// use App\Models\Accommodation;
// use App\Models\BookingAccommodation;
// use App\Models\RoomType;

class RegisterController extends Controller
{
    // use RegistersUsers;

    // protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $request->session()->forget('registration');
        $categories = PackageCategory::all();
        $packages = Package::all();
        $levels = Level::all();
        $date = RegistrationDate::all()->first();
        return view('auth.register', compact('categories', 'packages', 'levels', 'date'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'company' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:13',
            'category_id' => 'required|integer',
            'package_id' => 'required|integer',
            'level_id' => 'required|integer',
            'workshop' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $password = '';
            for ($i = 0; $i <= 6; $i++) {
                $password .= $characters[rand(0, $charactersLength - 1)];
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => explode("@", $request->email)[0],
                'password' => bcrypt($password),
            ]);
            $user->assignRole('participant');
            $user->participant()->create($request->all());

            $paybill = RegistrationFee::where('package_id', $request->package_id)->where('category_id', $request->category_id)->first()->fee ?? 0;

            $registration = Registration::create([
                'user_id' => $user->id,
                'package_id' => $request->package_id,
                'category_id' => $request->category_id,
                'level_id' => $request->level_id,
                'paybill' => $paybill
            ]);

            $registration->events()->attach($request->workshop);

            Mail::to($user)->send(new UserRegistered($user, $password));
        });

        return view('auth.verify');
    }
}
