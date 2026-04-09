<?php

namespace App\src\Views\Dishes;

use App\src\Models\Entities\Dishes\Dish;

class DishPresenter 
{
    public function present(?Dish $dish): array
    {
        if (!$dish) {
            return [];
        }

        return [
            'nom' => htmlspecialchars($dish->getName()),
            'description' => htmlspecialchars($dish->getDescription()),
            'prix' => number_format($dish->getPrix(), 2, ',', ' ') . ' €'
        ];
    }
}
