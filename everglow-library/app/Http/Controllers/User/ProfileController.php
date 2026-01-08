<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; // <--- make sure this line exists
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('user.profile.edit');   // <--- FIXED
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-Za-z0-9 ]+$/',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('profile_image')) {

            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $user->profile_image = $request->file('profile_image')->store('users', 'public');
        }

        $user->name = e($request->name);
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
