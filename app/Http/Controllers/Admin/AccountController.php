<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.account', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string'],
            'photo' => ['nullable', 'image', 'max:1024'],
            'email' => ['nullable', 'string', 'min:6', "unique:users,email,{$user->id}"],
            'username' => ['required', 'string', 'min:6', "unique:users,username,{$user->id}"],
            'password' => ['nullable', 'string', 'min:6']
        ]);

        $user->update([
            'name' => $data['name'],
            'username' => is_null($data['username'])
                            ? $user->username
                            : $data['username'],
            'password' => is_null($data['password'])
                            ? $user->password
                            : Hash::make($data['password'])
        ]);

        return redirect()->back()->withSuccess('Account updated successfully.');
    }
}
