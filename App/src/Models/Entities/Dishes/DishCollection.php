<?php

namespace App\src\Models\Entities\Dishes;

use App\src\Models\Entities\Dishes\Dish;
use IteratorAggregate;
use ArrayIterator;

/**
 * Class DishCollection
 * 
 * Collection of Dish entities.
 * 
 * Implements IteratorAggregate to allow iterating directly over the dishes.
 * 
 * @package App\src\Models\Entities\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class DishCollection implements IteratorAggregate
{
    /** @var Dish[] Internal storage for dishes */
    private array $dishes = [];

    /**
     * Adds a dish to the collection.
     * 
     * @param Dish $dish
     * @return void
     */
    public function add(Dish $dish): void
    {
        $this->dishes[] = $dish;
    }

    /**
     * Returns all dishes in the collection.
     * 
     * @return Dish[]
     */
    public function getAll(): array
    {
        return $this->dishes;
    }

    /**
     * Returns an iterator for the dishes.
     * 
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->dishes);
    }
}