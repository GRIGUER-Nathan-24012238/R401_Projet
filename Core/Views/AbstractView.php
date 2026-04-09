<?php

namespace Core\Views;


abstract class AbstractView
{
    abstract protected function templatePath(): string;


    abstract protected function getNameCss(): string;

    abstract protected function templateKeys(): array;

    public function render(): void
    {
        $this->renderHeader();
        $this->renderBody();
        $this->renderFooter();
    }


    protected function renderBody(): void
    {
        $path = $this->templatePath();
        if (file_exists($path)) {
            include $path;
        } else {
            echo "<main class='container'><p>Erreur : Le template [{$path}] est introuvable.</p></main>";
        }
    }


    protected function renderHeader(): void
    {
        echo '<!DOCTYPE html>
        <html lang="fr" data-theme="light">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . $this->getPageTitle() . '</title>
            
            <link rel="stylesheet" href="/styles/header.css">
            <link rel="stylesheet" href="/styles/footer.css">
            <link rel="stylesheet" href="/styles/' . $this->getNameCss() . '">
        </head>
        <body>
            <header class="container">
                <nav>
                    <ul>
                        <li>
                            <a href="/" class="contrast">
                                <strong>Entreprise Livraison</strong>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        ' . $this->getNavBar() . '
                    </ul>
                </nav>
            </header>';
    }


    protected function renderFooter(): void
    {
        echo '
    <footer class="container">
        <hr>
        <div class="grid">
            <div>
                <strong>Entreprise Livraison</strong><br>
                Service de restauration universitaire
            </div>
            <div>
                <ul>
                    <li><a href="/plats" class="secondary">Nos Plats</a></li>
                    <li><a href="/menus" class="secondary">Nos Menus</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li><a href="/legal" class="secondary">Mentions légales</a></li>
                </ul>
            </div>
        </div>
        <p><small>&copy; 2026 Entreprise Livraison - Projet R4.01 - Hernandez Loic - Griguer Nathan</small></p>
    </footer>
</body>
</html>';
    }

    protected function getNavBar(): string
    {
        return '
            <li><a href="/">Accueil</a></li>
            <li><a href="/plats">La Carte</a></li>
            <li><a href="/plats/nouveau">Ajouter un plat</a></li>
            <li><a href="/menus">Menus</a></li>
            <li><a href="/commandes">Mes Commandes</a></li>';
    }

    protected function getPageTitle(): string
    {
        return 'Entreprise Livraison - Livraison de repas';
    }
}