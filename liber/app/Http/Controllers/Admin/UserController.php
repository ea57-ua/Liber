<?php

namespace App\Http\Controllers\Admin;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    private $rules = [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max: 30',
            'biography' => 'max: 500',
            'admin' => 'boolean',
            'image' => 'image|mimes:png,jpeg,jpg|max:2048',
        ];
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

    public function showCreateUser(){
        return view('admin.createUserForm');
    }

    public function createUser(Request $request){
        request()->validate($this->rules);
        $this->userService->createUser($this->getUserFromRequest($request));
        return redirect()->route('admin.users');
    }

    private function getUserFromRequest(Request $request)
    {
        $userDto = new UserDTO();
        if (request()->input('name')) {
            $userDto->setName($request->input('name'));
        }

        if (request()->input('surname')) {
            $userDto->setSurname($request->input('surname'));
        }

        if (request()->input('email')) {
            $userDto->setEmail($request->input('email'));
        }

        if(request()->input('password') && trim($request->input('password')) !== ''){
            $userDto->setPassword($request->input('password'));
        }

        if($request->input('biography')){
            $userDto->setBiography($request->input('biography'));
        }

        if($request->has('image')){
            $userDto->setImage($request->image);
        }

        $userDto->setAdmin($request->has('admin'));
        return $userDto;
    }

    public function showUser($id){
        $user = $this->userService->getUserById($id);
        return view('admin.userDetails', ['user' => $user]);
    }
}
