<?php

namespace App\DTO;



use Illuminate\Http\UploadedFile;

class UserDTO
{
    public string $name;
    public string $surname;
    public string $email;
    public string $password;
    public string $biography;
    public bool $admin;
    public UploadedFile $image;

    public function __construct()
    {
        $this->name = '';
        $this->surname = '';
        $this->email = '';
        $this->password = '';
        $this->biography = '';
        $this->admin = false;
        //$this->image = '';
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setBiography(string $biography)
    {
        $this->biography = $biography;
    }

    public function setAdmin(bool $admin)
    {
        $this->admin = $admin;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }


}
