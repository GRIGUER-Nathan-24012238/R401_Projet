<?php

namespace App\src\Models\Entities\Users;
class User {
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $address;

    public function __construct(int $id, string $firstname, string $lastname, string $email, string $address) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->address = $address;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFirstname(): string {
        return $this->firstname;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getAddress(): string {
        return $this->address;
    }
}