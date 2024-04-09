<?php

namespace App\DTO;



use Illuminate\Http\UploadedFile;

class UserDTO
{
    private string $name;
    private string $surname;
    private string $email;
    private string $password;
    private string $biography;
    private bool $admin;
    private ?UploadedFile $image;

    public function __construct()
    {
        $this->name = '';
        $this->surname = '';
        $this->email = '';
        $this->password = '';
        $this->biography = '';
        $this->admin = false;
        $this->image = null;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getBiography(): string
    {
        return $this->biography;
    }

    public function getAdmin(): bool
    {
        return $this->admin;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }
}
