<?php
namespace App\src\Models\Repository\API\Dishes\Factory;

use App\src\Models\Entities\Dishes\Dish;

class DishesFactory 
{
    public static function fromArray(array $data): Dish
    {
        return new Dish(
            $data['nom'],
            $data['description'],
            $data['prix']
        );
    }
}