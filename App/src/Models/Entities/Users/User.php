<?php

namespace App\src\Models\Entities\Users;

class User 
{
    private ?string $id;
    private string $nom;
    private string $email;
    private string $adresse;

    public function __construct(string $nom, string $email, string $adresse, ?string $id = null) 
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->id = $id;
    }

    public function getId(): ?string 
    {
        return $this->id;
    }

    public function getNom(): string 
    {
        return $this->nom;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getAdresse(): string 
    {
        return $this->adresse;
    }
}