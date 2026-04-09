<?php

namespace App\src\Models\Entities\Dishes;

class Dish {
    private string $name;
    private string $description;
    private float $prix;

    public function __construct(string $name, string $description, float $prix) {
        $this->name = $name;
        $this->description = $description;
        $this->prix = $prix;
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