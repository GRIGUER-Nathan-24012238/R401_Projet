<?php

namespace App\src\Models\Entities\Dishes;

/**
 * Class Dish
 * 
 * Represents a Dish entity in the culinary menu.
 * 
 * @package App\src\Models\Entities\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class Dish
{
    /** @var string|null The unique identifier of the dish */
    private ?string $id = null;

    /** @var string The name of the dish */
    private string $name;

    /** @var string A detailed description of the dish */
    private string $description;

    /** @var float The price of the dish in Euros */
    private float $prix;

    /**
     * Dish constructor.
     * 
     * @param string $name
     * @param string $description
     * @param float $prix
     * @param string|null $id
     */
    public function __construct(string $name, string $description, float $prix, ?string $id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->prix = $prix;
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string {
        return $this->id;
    }

    /**
     * @param string $id
     * @return void
     */
    public function setId(string $id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrix(): float {
        return $this->prix;
    }
}