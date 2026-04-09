<?php

namespace App\src\Views\Dishes;

use Core\Views\AbstractView;

class GetDishView extends AbstractView 
{
    private array $dishData = [];

    public function setDishData(array $dishData): void
    {
        $this->dishData = $dishData;
    }

    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'dish.html';    
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
        return isset($this->dishData['nom']) ? $this->dishData['nom'] . ' - Détails' : 'Détails du plat';
    }

    protected function renderBody(): void 
    {
        if (empty($this->dishData)) {
            echo '<p>Plat introuvable.</p>';
            return;
        }

        $template = file_get_contents($this->templatePath());
        
        echo str_replace(
            ['{{NOM}}', '{{DESCRIPTION}}', '{{PRIX}}'],
            [$this->dishData['nom'], $this->dishData['description'], $this->dishData['prix']],
            $template
        );
    }
}
