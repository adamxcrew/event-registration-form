<?php

namespace App\Http\Controllers\Auth;

use App\Models\Event;
use App\Models\User;
use App\Models\Package;
use App\Models\PackageCategory as Category;

use App\Mail\UserRegistered;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $categories = Category::all();
        $packages = Package::with('prices')->get();
        $events = Event::with('prices')->get();

        return view('auth.register', compact('categories', 'packages', 'events'));
    }

    public function register(RegisterRequest $request)
    {
        DB::transaction(function () use ($request) {
            $password = Str::random(6);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => explode("@", $request->email)[0],
                'password' => Hash::make($password),
            ]);

            $user->participant()->create([
                'name' => $request->name,
                'title' => $request->title,
                'company' => $request->company,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            $user->assignRole('participant');

            $schedule = eventInfo()->isEarly() ? 'early' : 'normal';

            $event = isset($request->package_id)
                       ? Package::find($request->package_id)
                       : Event::find($request->event_id);

            $registration = $event->registrations()->create([
                'user_id' => $user->id,
                'category_id' => $request->category_id,
                'paybill' => optional($event->prices->where('category_id', $request->category_id)->first())->{$schedule} ?? 0
            ]);

            $registration->events()->attach($request->events ?? $request->event_id);

            Mail::to($user)->send(new UserRegistered($user, $password));
        });

        return view('auth.verify');
    }
}
