<?php

namespace App\src\Views\Dishes;

use Core\Views\AbstractView;

class DishesView extends AbstractView 
{
    private DishesPresenter $dishesPresenter;

    public function __construct(DishesPresenter $dishesPresenter) {
        $this->dishesPresenter = $dishesPresenter;
    }

    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'dishes.html';    
    }

    protected function templateKeys(): array
    {
        return [];
    }
    
    protected function getNameCss(): string 
    {
        return 'dishes.css';
    }

    protected function getPageTitle(): string
    {
        return 'La Carte - Nos Plats';
    }

    protected function renderBody(): void 
    {
        $template = file_get_contents($this->templatePath());
        $dishesList = "";
        
        $content = $this->dishesPresenter->present();

        if (empty($content)) {
            $dishesList = "<p>Aucun plat n'est disponible pour le moment.</p>";
        } else {
            foreach ($content as $dish) {
                // Formatting dish card
                $dishesList .= '
                <div class="dish-card">
                    <h3>' . htmlspecialchars($dish['nom']) . '</h3>
                    <p class="price">' . htmlspecialchars($dish['prix']) . ' €</p>
                    <p>' . htmlspecialchars($dish['description']) . '</p>
                    <a href="/plats/' . $dish['id'] . '" class="btn-view">Voir le plat</a>
                </div>';
            }
        }

        echo str_replace('{{DISHES_LIST}}', $dishesList, $template);
    }
}