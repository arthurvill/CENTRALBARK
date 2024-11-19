<?php

namespace App\Http\Controllers\All;

use App\Models\User;
use App\Models\All\TmpImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return match (auth()->user()->role->name) {
            'admin' => view('admin.profile.index'),
            'staff' => view('staff.profile.index'),
            'customer' => view('customer.profile.index'),
        };
    }

    public function update(Request $request, User $user)
    {
        // Validate input
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'old' => 'sometimes|required_with:password',
            'password' => 'sometimes|confirmed|min:6|max:15',
            'avatar' => 'nullable|string',
        ]);

        // Update Name and Email
        if ($request->hasAny(['name', 'email'])) {
            $user->update([
                'name' => $data['name'] ?? $user->name,
                'email' => $data['email'] ?? $user->email,
            ]);

            return back()->with(['message' => 'Profile Updated Successfully']);
        }

        // Update Avatar
        if ($request->avatar) {
            $avatar = $user->getFirstMedia('avatar_image');

            $user->avatar_profile ? $avatar->delete() : '';

            $user->addMedia(storage_path('app/public/tmp/' . $request->avatar))->toMediaCollection('avatar_image');

            TmpImage::where('filename', $request->avatar)->delete();

            return back()->with(['message' => 'Avatar Updated Successfully']);
        }

        // Update Password
        if ($request->password && $request->old) {
            if (!Hash::check($request->old, $user->password)) {
                return back()->with(['error' => 'The old password you entered is invalid']);
            }

            $user->update(['password' => Hash::make($data['password'])]);

            auth()->setUser($user);

            return back()->with(['message' => 'Password Updated Successfully']);
        }

        // Default fallback message
        return back()->with(['error' => 'No changes were made to the profile.']);
    }
}
