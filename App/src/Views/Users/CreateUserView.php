<?php

namespace App\src\Views\Users;

use Core\Views\AbstractView;

class CreateUserView extends AbstractView 
{
    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'create_user.html';    
    }

    protected function templateKeys(): array
    {
        return [];
    }
    
    protected function getNameCss(): string 
    {
        return 'main.css';
    }

    protected function getPageTitle(): string
    {
        return 'Inscription - Nouvel Abonné';
    }

    protected function renderBody(): void 
    {
        echo file_get_contents($this->templatePath());
    }
}
