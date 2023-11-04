<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;
    public function __construct(){
        $this->userService = new UserService();
    }
    public function showUsersAdminPanel(Request $request){
        $users = User::paginate(8);
        return view('admin.users', ['users' => $users]);
    }

    public function destroyUser($id){
        $this->userService->deleteUser($id);
        return redirect()->route('admin.users');
    }
}
