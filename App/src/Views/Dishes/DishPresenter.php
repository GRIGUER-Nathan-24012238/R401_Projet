<?php

namespace App\src\Views\Dishes;

use App\src\Models\Entities\Dishes\Dish;

/**
 * Class DishPresenter
 * 
 * Formatter for a single Dish entity for display in views.
 * 
 * @package App\src\Views\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class DishPresenter 
{
    /**
     * Formats a single Dish entity into a display-ready array.
     * 
     * @param Dish|null $dish
     * @return array<string, mixed>
     */
    public function present(?Dish $dish): array
    {
        if (!$dish) {
            return [];
        }

        return [
            'id' => $dish->getId(),
            'nom' => htmlspecialchars($dish->getName()),
            'description' => htmlspecialchars($dish->getDescription()),
            'prix' => number_format($dish->getPrix(), 2, ',', ' ') . ' €'
        ];
    }
}
