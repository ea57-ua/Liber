<?php

namespace App\Services;

use App\Models\User;

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
        $user = User::find($id);
        $user->delete();
    }
}
