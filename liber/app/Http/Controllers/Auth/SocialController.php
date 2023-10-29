<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleLoginOrRegister()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $this->_registerOrLoginGoogleUser($user);
        return redirect()->route('dashboard');
    }

    protected function _registerOrLoginGoogleUser($incomingUser)
    {
        $user = User::where('google_id',$incomingUser->id)->first();
        $userAlreadyRegistered = User::where('email', $incomingUser->email)->exists();

        if (!$user && !$userAlreadyRegistered) {
            $user = new User();
            $user->name = $incomingUser->name;
            $user->email = $incomingUser->email;
            $user->google_id = $incomingUser->id;
            $user->surname = $incomingUser->user['family_name'];
            $user->password = bcrypt('123456dummy'); // TODO ?
            $user->save();
        }
        if (!$userAlreadyRegistered) {
            $user->sendEmailVerificationNotification();
        }
        Auth::login($user);
    }
}
