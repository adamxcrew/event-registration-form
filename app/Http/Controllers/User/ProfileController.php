<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date_format:"d/m/Y"',
            'gender' => 'required|in:L,P',
            'profession' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:13',
            'information' => 'nullable|string|max:255'
        ]);
        $user->update($request->all());
        $user->participant->update($request->all());
        return redirect()->back()->with('success','Perubahan disimpan.');
    }
}
