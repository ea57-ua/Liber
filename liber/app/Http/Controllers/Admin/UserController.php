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
            'password' => 'required|max: 100',
            'biography' => 'max: 500',
            'admin' => 'boolean',
            'image' => 'image|mimes:png,jpeg,jpg|max:2048',
        ];
    public function __construct(){
        $this->userService = new UserService();
    }
    public function showUsersAdminPanel(Request $request){
        $users = User::paginate(8);
        $admin = $request->user();
        return view('admin.users.users',
            ['users' => $users,
            'admin' => $admin]);
    }

    public function destroyUser($id){
        $this->userService->deleteUser($id);
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
        $this->userService->createUser($this->getUserFromRequest($request));
        return redirect()->route('admin.users.users');
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

    public function showEditUser($id){
        $user = $this->userService->getUserById($id);
        return view('admin.users.editUserForm', ['user' => $user]);
    }

    public function editUser(Request $request, $id) {
        request()->validate($this->rules);
        $user = $this->userService->getUserById($id);
        if ($request->has('email') && $user->email == $request->input('email')) {
            // do nothing
        } else {
            $request->validate([
                'email' => 'required|email|unique:users,email',
            ]);
        }

        $this->userService->editUser($id, $this->getUserFromRequest($request));

        return redirect()->route('admin.users.users');
    }

    public function toggleBlock($id){
        $user = $this->userService->getUserById($id);
        $user->blocked = !$user->blocked;
        $user->save();
        return redirect()->route('admin.users');
    }
}
