<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function prueba() {
        //dd("Aqui estoy");
    }

    public function getUsers() {
        $users = User::all();
        return $users;
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function createUser(UserDTO $userDto) {
        $user = new User();
        $user->name = $userDto->name;
        $user->surname = $userDto->surname;
        $user->email = $userDto->email;
        $user->password = Hash::make($userDto->password);
        $user->biography = $userDto->biography;
        $user->admin = $userDto->admin;
        $user->save();

        if ($userDto->image != ''){
            $this->addImageToUser($user->id, $userDto->image);
        }
    }

    public function getUserById($id) {
        $user = User::findOrFail($id);
        return $user;
    }

    public function addImageToUser($id, $image) {
        $user = User::findOrFail($id);
        $extension = $image->getClientOriginalExtension();
        $imageName = $id . '_user.' . $extension;
        $image->move(public_path('images/user_images'), $imageName);
        $user->image = 'images/user_images/' . $imageName;
        $user->save();
    }
}
