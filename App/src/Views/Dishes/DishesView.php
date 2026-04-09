<?php


namespace App\src\Views\Dishes;

use Core\Views\AbstractView;

class DishesView extends AbstractView 
{


    private array $data;

    public function __construct(array $data) {
        $this->data = $data;
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
        return [
            'ID'          => $this->data['id'],
            'NOM'         => $this->data['nom'],
            'DESCRIPTION' => $this->data['description'],
            'PRIX'        => $this->data['prix'],
        ];
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

        $keys = $this->templateKeys();

        foreach ($keys as $key => $value) {
            $template = str_replace("{{{$key}}}", $value, $template);
        }

        echo $template;
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