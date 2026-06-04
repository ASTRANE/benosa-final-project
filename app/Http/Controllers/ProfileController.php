<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:Doctor,Nurse,Admin',
            'password' => 'nullable|min:8|confirmed',
            'avatar'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'email', 'role');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $disk = config('filesystems.default');
            if ($user->avatar) {
                Storage::disk($disk)->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', $disk);
        }

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
