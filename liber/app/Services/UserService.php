<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
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
        $user->name = $userDto->getName();
        $user->surname = $userDto->getSurname();
        $user->email = $userDto->getEmail();
        $user->password = Hash::make($userDto->getPassword());
        $user->biography = $userDto->getBiography();
        $user->admin = $userDto->getAdmin();
        $user->save();

        if ($userDto->getImage() != null){
            $this->addImageToUser($user->id, $userDto->getImage());
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

    public function editUser($id, UserDTO $userDto) {
        $user = User::findOrFail($id);
        if ($user->name != $userDto->getName()) {
            $user->name = $userDto->getName();
        }
        if ($user->surname != $userDto->getSurname()) {
            $user->surname = $userDto->getSurname();
        }

        if ($user->email != $userDto->getEmail()) {
            $user->email = $userDto->getEmail();
        }

        if ($user->biography != $userDto->getBiography()) {
            $user->biography = $userDto->getBiography();
        }

        if ($userDto->getPassword() != '') {
            $user->password = Hash::make($userDto->getPassword());
        }

        $user->admin = $userDto->getAdmin();
        $user->save();

        if ($userDto->getImage() != null && $userDto->getImage() != $user->image){
            $this->addImageToUser($user->id, $userDto->getImage());
        }
    }
}
