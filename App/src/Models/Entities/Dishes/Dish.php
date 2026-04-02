<?php

class Dish {
    private string $name;
    private string $description;
    private int $prix;

    public function __construct(string $name, string $description, int $prix) {
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

    public function getPrix(): int {
        return $this->prix;
    }
}