<?php


namespace App\src\Views;

use Core\Views\AbstractView;

class MainView extends AbstractView 
{


    /**
     * Implements the path to the specific template for the Main View.
     */
    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'main.html';    
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
        echo file_get_contents($this->templatePath());
    }

    /**
     * Optional: Override the page title specifically for this view.
     */
    protected function getPageTitle(): string
    {
        return 'Accueil - Livraison';
    }

    protected function getAdditionalScripts(): string 
    {
        return '';
    }
}