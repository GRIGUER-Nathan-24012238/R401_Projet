<?php

namespace App\src\Views\Dishes;

use Core\Views\AbstractView;

/**
 * View for listing all dishes.
 */
class DishesView extends AbstractView 
{
    /** @var DishesPresenter The presenter used to format dish data */
    private DishesPresenter $dishesPresenter;

    /**
     * @param DishesPresenter $dishesPresenter
     */
    public function __construct(DishesPresenter $dishesPresenter) {
        $this->dishesPresenter = $dishesPresenter;
    }

    /**
     * Returns the absolute path to the dishes template.
     * 
     * @return string
     */
    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'dishes.html';    
    }

    /**
     * @return array
     */
    protected function templateKeys(): array
    {
        return [];
    }
    
    /**
     * Returns the name of the CSS file for dishes.
     * 
     * @return string
     */
    protected function getNameCss(): string 
    {
        return 'dishes.css';
    }

    /**
     * Returns the overridden page title.
     * 
     * @return string
     */
    protected function getPageTitle(): string
    {
        return 'Menu - Our Dishes';
    }

    /**
     * Renders the body of the dishes listing page.
     * 
     * @return void
     */
    protected function renderBody(): void 
    {
        $template = file_get_contents($this->templatePath());
        $dishesList = "";
        
        $content = $this->dishesPresenter->present();

        if (empty($content)) {
            $dishesList = "<p>No dishes available at the moment.</p>";
        } else {
            foreach ($content as $dish) {
                // Formatting dish card
                $dishesList .= '
                <div class="dish-card">
                    <h3>' . htmlspecialchars($dish['nom']) . '</h3>
                    <p class="price">' . htmlspecialchars($dish['prix']) . ' €</p>
                    <p>' . htmlspecialchars($dish['description']) . '</p>
                    <a href="/plats/' . $dish['id'] . '" class="btn-view">View Details</a>
                </div>';
            }
        }

        echo str_replace('{{DISHES_LIST}}', $dishesList, $template);
    }
}