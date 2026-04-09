<?php

namespace App\src\Views\Users;

use Core\Views\AbstractView;

class UsersView extends AbstractView 
{
    private array $users = [];

    public function setUsers(array $users): void
    {
        $this->users = $users;
    }

    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'users.html';    
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
        return 'Abonnés';
    }

    protected function renderBody(): void 
    {
        $template = file_get_contents($this->templatePath());
        $usersList = "";

        if (empty($this->users)) {
            $usersList = "<p>Aucun abonné pour le moment.</p>";
        } else {
            foreach ($this->users as $user) {
                $usersList .= '
                <div class="dish-card">
                    <h3>' . $user['nom'] . '</h3>
                    <p>' . $user['email'] . '</p>
                    <a href="/utilisateurs/' . $user['id'] . '" class="btn-view">Voir le profil</a>
                </div>';
            }
        }

        echo str_replace('{{USERS_LIST}}', $usersList, $template);
    }
}
