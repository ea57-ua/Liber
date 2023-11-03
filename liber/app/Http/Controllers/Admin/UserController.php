<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(){
        $this->userService = new UserService();
    }
    public function showUsersAdminPanel(Request $request){
        $this->userService->prueba();
        return view('admin.users');
    }
}
