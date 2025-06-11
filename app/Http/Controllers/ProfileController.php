<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $user = $request->user();

        
        if ($request->hasFile('profile_image')) {
           
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            
            $path = $request->file('profile_image')->store('profile_images', 'public');

            
            $user->profile_image = $path;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->back()->with('status', 'profile-updated');
    }
}
