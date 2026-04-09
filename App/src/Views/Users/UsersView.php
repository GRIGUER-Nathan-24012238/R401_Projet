<?php

namespace App\src\Views\Users;

use Core\Views\AbstractView;

/**
 * View for listing all subscribers (users).
 */
class UsersView extends AbstractView 
{
    /** @var array List of users to display */
    private array $users = [];

    /**
     * Sets the users data for the view.
     * 
     * @param array $users
     * @return void
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }

    /**
     * Returns the absolute path to the users template.
     * 
     * @return string
     */
    protected function templatePath(): string 
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'users.html';    
    }

    /**
     * @return array
     */
    protected function templateKeys(): array
    {
        return [];
    }
    
    /**
     * Returns the name of the CSS file for users.
     * 
     * @return string
     */
    protected function getNameCss(): string 
    {
        return 'users.css';
    }

    /**
     * Returns the overridden page title.
     * 
     * @return string
     */
    protected function getPageTitle(): string
    {
        return 'Subscribers - Membership List';
    }

    /**
     * Renders the body of the users listing page.
     * 
     * @return void
     */
    protected function renderBody(): void 
    {
        $template = file_get_contents($this->templatePath());
        $usersList = "";

        if (empty($this->users)) {
            $usersList = "<p>No subscribers found at the moment.</p>";
        } else {
            foreach ($this->users as $user) {
                $usersList .= '
                <div class="dish-card">
                    <h3>' . htmlspecialchars($user['nom']) . '</h3>
                    <p>' . htmlspecialchars($user['email']) . '</p>
                    <a href="/utilisateurs/' . $user['id'] . '" class="btn-view">View Profile</a>
                </div>';
            }
        }

        echo str_replace('{{USERS_LIST}}', $usersList, $template);
    }
}
