<?php

namespace App\src\Models\Entities\Dishes;

class Dish {
    private ?string $id = null;
    private string $name;
    private string $description;
    private float $prix;

    public function __construct(string $name, string $description, float $prix, ?string $id = null) {
        $this->name = $name;
        $this->description = $description;
        $this->prix = $prix;
        $this->id = $id;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPrix(): float {
        return $this->prix;
    }
}