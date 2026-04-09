<?php

namespace App\src\Views\Dishes;

use Core\Views\AbstractView;

class CreateDishView extends AbstractView 
{
    private string $message = "";

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'create_dish.html';    
    }

    protected function templateKeys(): array
    {
        return [];
    }
    
    protected function getNameCss(): string 
    {
        return 'forms.css';
    }

    protected function getPageTitle(): string
    {
        return 'Ajouter un plat';
    }

    protected function renderBody(): void 
    {
        if ($this->message) {
            echo '<div style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border: 1px solid #c3e6cb; border-radius: 4px; text-align: center;">';
            echo $this->message;
            echo '</div>';
        }
        
        parent::renderBody();
    }
}
