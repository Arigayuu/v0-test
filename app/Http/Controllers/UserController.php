<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $recentOrders = $user->orders()
            ->with('items.product')
            ->latest()
            ->take(5)
            ->get();
            
        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()
            ->where('payment_status', 'paid')
            ->sum('total_amount');

        return view('users.profile', compact('user', 'recentOrders', 'totalOrders', 'totalSpent'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            $validated['profile_image'] = $imagePath;
        }

        $user->update($validated);

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('profile')
            ->with('success', 'Password updated successfully!');
    }

    public function removeProfileImage()
    {
        $user = Auth::user();
        
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
            $user->update(['profile_image' => null]);
        }

        return back()->with('success', 'Profile image removed successfully!');
    }
}
