<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Participant;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Registration;
use App\Models\RegistrationDate;
use App\Models\RegistrationFee;

use App\Mail\UserRegistered;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    // use RegistersUsers;

    // protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $categories = PackageCategory::all();
        $packages = Package::all();
        $date = RegistrationDate::all()->first();
        return view('auth.register', compact('categories', 'packages', 'date'));
    }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);
    // }

    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'company' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:13',
            'category_id' => 'required|integer',
            'package_id' => 'required|integer'
        ]);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $password = '';
        for ($i = 0; $i <= 12; $i++) {
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

        $fee = RegistrationFee::where('package_id', $request->package_id)
                ->where('category_id', $request->category_id)
                ->first()->fee;

        $registration = Registration::create([
            'user_id' => $user->id,
            'package_id' => $request->package_id,
            'category_id' => $request->category_id,
            'paybill' => $fee
        ]);

        Mail::to($user)->send(new UserRegistered($user, $password));

        return view('auth.verify');
    }
}
