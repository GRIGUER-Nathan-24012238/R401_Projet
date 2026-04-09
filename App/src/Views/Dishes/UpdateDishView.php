<?php

namespace App\src\Views\Dishes;

use Core\Views\AbstractView;

class UpdateDishView extends AbstractView 
{
    private array $dishData = [];

    public function setDishData(array $dishData): void
    {
        $this->dishData = $dishData;
    }

    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'update_dish.html';    
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
        return 'Modifier - ' . ($this->dishData['nom'] ?? 'Plat');
    }

    protected function renderBody(): void 
    {
        if (empty($this->dishData)) {
            echo '<p>Plat introuvable.</p>';
            return;
        }

        $template = file_get_contents($this->templatePath());
        
        echo str_replace(
            ['{{ID}}', '{{NOM}}', '{{DESCRIPTION}}', '{{PRIX}}'],
            [$this->dishData['id'], $this->dishData['nom'], $this->dishData['description'], $this->dishData['prix']],
            $template
        );
    }
}
