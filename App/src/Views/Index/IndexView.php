<?php


namespace App\src\Views\Index;

use Core\Views\AbstractView;
use Override;

/**
 * Class IndexView
 * 
 * View for the home page.
 * 
 * @package App\src\Views\Index
 * @author  Hernandez Loic - Griguer Nathan
 */
class IndexView extends AbstractView 
{
    /**
     * Returns the absolute path to the home page template.
     * 
     * @return string
     */
    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'index.html';    
    }

    /**
     * Returns an empty array (no logic placeholders in the index template).
     *
     * @return array<string, mixed>
     */
    #[Override]
    protected function templateKeys(): array
    {
        return [];
    }

    /**
     * Returns the name of the main CSS file.
     * 
     * @return string
     */
    protected function getNameCss(): string 
    {
        return 'home.css';
    }

    /**
     * Renders the home page body.
     * 
     * @return void
     */
    protected function renderBody(): void 
    {
        echo file_get_contents($this->templatePath());
    }

    /**
     * Returns the overridden page title.
     * 
     * @return string
     */
    protected function getPageTitle(): string
    {
        return 'Home - Meal Delivery Service';
    }

    /**
     * @return string
     */
    protected function getAdditionalScripts(): string 
    {
        return '';
    }
}