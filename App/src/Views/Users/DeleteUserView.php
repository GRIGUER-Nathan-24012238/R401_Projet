<?php

namespace App\src\Views\Users;

use Core\Views\AbstractView;

class DeleteUserView extends AbstractView 
{
    private array $userData = [];

    public function setUserData(array $userData): void
    {
        $this->userData = $userData;
    }

    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'delete_user.html';    
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
        return 'Confirmer la suppression - ' . ($this->userData['nom'] ?? 'Abonné');
    }

    protected function renderBody(): void 
    {
        if (empty($this->userData)) {
            echo '<p>Abonné introuvable.</p>';
            return;
        }

        $template = file_get_contents($this->templatePath());
        
        echo str_replace(
            ['{{ID}}', '{{NOM}}', '{{EMAIL}}', '{{ADRESSE}}'],
            [$this->userData['id'], $this->userData['nom'], $this->userData['email'], $this->userData['adresse']],
            $template
        );
    }
}
