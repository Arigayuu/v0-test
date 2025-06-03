<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('users.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string',
            'phone' => 'nullable|string'
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->address = $validated['address'] ?? null;
        $user->phone = $validated['phone'] ?? null;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::find(Auth::id());
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password updated successfully');
    }
    public function isAdmin()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }
} 