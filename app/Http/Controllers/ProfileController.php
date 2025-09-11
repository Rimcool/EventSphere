<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the user dashboard with profile + bookings.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->with('event')->latest()->take(5)->get();

        return view('user_profile.dashboard', compact('user', 'bookings'));
    }

    /**
     * Show the edit profile form.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('user_profile.edit_profile', compact('user'));
    }

    /**
     * Update the profile information.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone'  => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio'    => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'notifications' => 'required|in:all,important,none'
        ]);

        $user = Auth::user();

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $user->profile_picture = $path;
        }

        // Update other fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->location = $request->location;
        $user->bio = $request->bio;
        $user->facebook = $request->facebook;
        $user->instagram = $request->instagram;
        $user->twitter = $request->twitter;
        $user->linkedin = $request->linkedin;
        $user->notifications = $request->notifications;

        $user->save();

        return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully!');
    }

    /**
     * Show the change password form.
     */
    public function changePasswordForm()
    {
        return view('user_profile.change_password');
    }

    /**
     * Handle password change.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.dashboard')->with('success', 'Password updated successfully!');
    }

    /**
     * Logout the user.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
