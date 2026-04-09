<?php

namespace App\src\Models\Entities\Dishes;

use App\src\Models\Entities\Dishes\Dish;
use IteratorAggregate;
use ArrayIterator;

class DishCollection implements IteratorAggregate
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

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->dishes);
    }
}