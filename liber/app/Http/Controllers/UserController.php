<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function follow(Request $request, $id)
    {
        try {
            $userToFollow = User::find($id);
            if (!$userToFollow) {
                return back()->withErrors(['message' => 'User not found']);
            }

            $request->user()->follows()->attach($userToFollow);

            return back()->with('message', 'You are now following this user');
        } catch (\Exception $e) {
            // Log the exception message for debugging
            Log::error($e->getMessage());

            // Redirect back with an error message
            return back()->withErrors(['message' => 'An error occurred while trying to follow this user']);
        }
    }

    public function unfollow(Request $request, $id)
    {
        $userToUnfollow = User::find($id);
        $request->user()->follows()->detach($userToUnfollow);

        return back()->with('message', 'You have unfollowed this user');
    }

    public function blockUnblock(Request $request, $id)
    {
       //TODO
    }
}
