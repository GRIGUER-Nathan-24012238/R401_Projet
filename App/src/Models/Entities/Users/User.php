<?php

namespace App\src\Models\Entities\Users;

/**
 * Class User
 * 
 * Represents a User entity (Subscriber) in the application.
 * 
 * @package App\src\Models\Entities\Users
 * @author  Hernandez Loic - Griguer Nathan
 */
class User 
{
    /** @var string|null The unique identifier of the user */
    private ?string $id;

    /** @var string The full name of the user */
    private string $nom;

    /** @var string The email address of the user */
    private string $email;

    /** @var string The postal address of the user */
    private string $adresse;

    /**
     * User constructor.
     * 
     * @param string $nom
     * @param string $email
     * @param string $adresse
     * @param string|null $id
     */
    public function __construct(string $nom, string $email, string $adresse, ?string $id = null) 
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string 
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom(): string 
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getEmail(): string 
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAdresse(): string 
    {
        return $this->adresse;
    }
}