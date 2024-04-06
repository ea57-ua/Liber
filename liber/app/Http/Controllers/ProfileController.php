<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function showUserInfo(Request $request): View
    {
        $followersCount = $request->user()->followers()->count();
        $followingCount = $request->user()->follows()->count();
        $followers = $request->user()->followers()->get();
        $watchedMoviesCount = $request->user()->watchedMovies()->count();
        $movieListsCount = $request->user()->movieLists()->count();
        $watchedMovies = $request->user()->watchedMovies()->get();
        $lists = $request->user()->movieLists()->get();
        $reviews = $request->user()->reviews()->get();
        $ratings = collect();
        if ($request->user()->critic) {
            $ratings = $request->user()->ratings()->get();
        }

        return view('profile.userProfile', [
            'user' => $request->user(),
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
            'followers' => $followers,
            'watchedMoviesCount' => $watchedMoviesCount,
            'movieListsCount' => $movieListsCount,
            'watchedMovies' => $watchedMovies,
            'lists' => $lists,
            'isBlocked' => null,
            'reviews' => $reviews,
            'ratings' => $ratings,
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

    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Check if new password and confirmation match
        if ($request->new_password !== $request->new_password_confirmation) {
            return back()->withErrors(['new_password' => 'New password and confirmation do not match']);
        }

        // Change password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('message', 'Password changed successfully');
    }

    public function showPublicUserInfo(Request $request, $id): View
    {
        $user = User::findOrFail($id);
        $followersCount = $user->followers()->count();
        $followingCount = $user->follows()->count();
        $followers = $user->followers()->get();
        $watchedMoviesCount = $user->watchedMovies()->count();
        $movieListsCount = $user->movieLists()->count();
        $watchedMovies = $user->watchedMovies()->get();
        $lists = $user->movieLists()->where('public', true)->get();
        $isBlocked =  $user->blockedUsers()->get()->contains($user);
        $reviews = $user->reviews()->get();
        $ratings = collect();

        return view('profile.userProfile', [
            'user' => $user,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
            'followers' => $followers,
            'watchedMoviesCount' => $watchedMoviesCount,
            'movieListsCount' => $movieListsCount,
            'watchedMovies' => $watchedMovies,
            'lists' => $lists,
            'isBlocked' => $isBlocked,
            'reviews' => $reviews,
            'ratings' => $ratings,
        ]);
    }

    public function requestCriticStatus(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');
        $filename = null;
        if ($file) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
        }

        $request->user()->criticRequests()->create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filename,
        ]);

        return back()->with('message', 'Critic status requested successfully');
    }
}
