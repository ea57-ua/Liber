<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUsersAdminPanel(Request $request){
        $users = User::paginate(8);
        $admin = $request->user();
        return view('admin.users.users',
            ['users' => $users,
            'admin' => $admin]);
    }

    public function destroyUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users');
    }

    public function toggleBlock($id){
        $user = User::findOrFail($id);
        $user->blocked = !$user->blocked;
        $user->save();
        return redirect()->route('admin.users');
    }
}
