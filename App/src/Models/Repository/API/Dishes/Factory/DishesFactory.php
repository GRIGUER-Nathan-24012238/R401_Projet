<?php
namespace App\src\Models\Repository\API\Dishes\Factory;

use App\src\Models\Entities\Dishes\Dish;

/**
 * Class DishesFactory
 * 
 * Factory for creating Dish entities from raw data arrays.
 * 
 * @package App\src\Models\Repository\API\Dishes\Factory
 * @author  Hernandez Loic - Griguer Nathan
 */
class DishesFactory 
{
    /**
     * Creates a Dish entity from an associative array.
     * 
     * @param array $data Raw dish data from the API
     * @return Dish
     */
    public static function fromArray(array $data): Dish
    {
        return new Dish(
            $data['nom'],
            $data['description'],
            $data['prix'],
            $data['id'] ?? null
        );
    }
}