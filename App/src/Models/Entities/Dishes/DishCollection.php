<?php

namespace App\src\Models\Entities\Dishes;

use App\src\Models\Entities\Dishes\Dish;

class DishCollection
{
    private array $dishes = [];

    public function add(Dish $dish): void
    {
        $this->dishes[] = $dish;
    }

    public function getAll(): array
    {
        return $this->dishes;
    }
}