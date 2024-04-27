<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $rules = [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'password' => 'required|max: 100',
            'biography' => 'max: 500',
            'admin' => 'boolean',
            'image' => 'image|mimes:png,jpeg,jpg|max:2048',
        ];

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

    public function showCreateUser(){
        return view('admin.users.createUserForm');
    }

    public function createUser(Request $request){
        request()->validate($this->rules);
        request()->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // TODO revisar esto
        return redirect()->route('admin.users.users');
    }
    public function showEditUser($id){
        $user = User::findOrFail($id);
        return view('admin.users.editUserForm', ['user' => $user]);
    }


    public function toggleBlock($id){
        $user = User::findOrFail($id);
        $user->blocked = !$user->blocked;
        $user->save();
        return redirect()->route('admin.users');
    }
}
