<?php


namespace App\src\Views\Dishes;

use App\src\Controllers\Dishes\DishesPresenter;
use Core\Views\AbstractView;

class DishesView extends AbstractView 
{
    private DishesPresenter $dishesPresenter;

    public function __construct(DishesPresenter $dishesPresenter) {
        $this->dishesPresenter = $dishesPresenter;
    }

    /**
     * Implements the path to the specific template for the Main View.
     */
    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'dishes.html';    
    }

    protected function templateKeys(): array
    {
        return [];
    }
    
    /**
     * Implements the name of the CSS file for this specific view.
     * This will result in <link rel="stylesheet" href="/styles/main.css">
     */
    protected function getNameCss(): string 
    {
        return 'main.css';
    }

    /**
     * Renders the specific content for the body of the page.
     * This is required because AbstractView::render() calls this method.
     */
    protected function renderBody(): void 
    {

        $template = file_get_contents($this->templatePath());

        echo '<section>';
        
        $content = $this->dishesPresenter->present();

        foreach ($content as $dish) {
            
            // 4. On remplace les balises par les valeurs du Presenter
            echo str_replace(
                ['{{NOM}}', '{{DESCRIPTION}}', '{{PRIX}}'],
                [$dish['nom'], $dish['description'], $dish['prix']],
                $template
            );
            
        }
        echo '</section>';
    }

    /**
     * Optional: Override the page title specifically for this view.
     */
    protected function getPageTitle(): string
    {
        return 'Accueil - Plats';
    }

    protected function getAdditionalScripts(): string 
    {
        return '';
    }
}