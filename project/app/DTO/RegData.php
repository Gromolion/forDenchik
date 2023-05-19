<?php

namespace App\DTO;

class RegData
{
    private string $name;
    private string $email;
    private string $password;
    private string $codeRole;

    public function __construct(string $name, string $email, string $password, string $codeRole)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->codeRole = $codeRole;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCodeRole(): string
    {
        return $this->codeRole;
    }
}