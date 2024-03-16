<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function showUserInfo(Request $request): View
    {
        return view('profile.userProfile', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'biography' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($request->email != $user->email) {
            $user->email_verified_at = null;
            $user->email = $request->email;
            $user->save();

            $user->sendEmailVerificationNotification();
            $request->session()->flash('info', 'We have sent you an email to verify your new email address.');
        }

        // Actualiza el nombre y la biografía del usuario
        $user->name = $request->name;
        $user->biography = $request->biography;
        $user->save();

        // Redirige al usuario a la página de perfil con un mensaje de éxito
        return redirect()->route('profile.edit', $id)->with('message', 'User information updated successfully!');
    }

    public function uploadImage(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'image' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['image' => 'Please select an image']);
        }
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:png,jpeg,jpg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['image' => 'Please select an image']);
        }
        $user = User::findOrFail($id);
        if ($request->has('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $filename = $id . '_user.' . $extension;
            $request->image->move(public_path('images/user_images'), $filename);
            $user->image = '/images/user_images/' . $filename;
            $user->save();
            return redirect()->back()->with('message', "Image uploaded successfully");
        }
        return redirect()->back();
    }
}
