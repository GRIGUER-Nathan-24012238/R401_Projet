<?php

namespace Core\Views;


/**
 * Abstract Class AbstractView
 * 
 * Base class for all views in the application.
 * 
 * Provides the structure for rendering HTML pages with shared headers and footers.
 * 
 * @package Core\Views
 * @author  Hernandez Loic - Griguer Nathan
 */
abstract class AbstractView
{
    /**
     * Returns the absolute path to the HTML template file.
     * 
     * @return string
     */
    abstract protected function templatePath(): string;

    /**
     * Returns the name of the CSS file to be included in the header.
     * 
     * @return string
     */
    abstract protected function getNameCss(): string;

    /**
     * Returns an array of keys to be replaced in the template.
     * 
     * @return array<string, mixed>
     */
    abstract protected function templateKeys(): array;

    /**
     * Renders the complete HTML page (Header, Body, Footer).
     * 
     * @return void
     */
    public function render(): void
    {
        $this->renderHeader();
        $this->renderBody();
        $this->renderFooter();
    }


    /**
     * Renders the main body of the page by including the template.
     * 
     * @return void
     */
    protected function renderBody(): void
    {
        $path = $this->templatePath();
        if (file_exists($path)) {
            include $path;
        } else {
            echo "<main class='container'><p>Error: Template [{$path}] not found.</p></main>";
        }
    }


    /**
     * Renders the HTML header common to all pages.
     * 
     * @return void
     */
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


    /**
     * Renders the HTML footer common to all pages.
     * 
     * @return void
     */
    protected function renderFooter(): void
    {
        echo '
    <footer class="container">
        <hr>
        <div class="grid">
            <div>
                <strong>Entreprise Livraison</strong><br>
                University catering service
            </div>
            <div>
                <ul>
                    <li><a href="/plats" class="secondary">Our Dishes</a></li>
                    <li><a href="/utilisateurs" class="secondary">Our Subscribers</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li><a href="/" class="secondary">Home</a></li>
                </ul>
            </div>
        </div>
        <p><small>&copy; 2026 Entreprise Livraison - Project R4.01 - Hernandez Loic - Griguer Nathan</small></p>
    </footer>
</body>
</html>';
    }

    /**
     * Returns the HTML structure for the navigation bar.
     * 
     * @return string
     */
    protected function getNavBar(): string
    {
        return '
            <li><a href="/">Home</a></li>
            <li><a href="/plats">Menu</a></li>
            <li><a href="/plats/nouveau">Add Dish</a></li>
            <li><a href="/utilisateurs">Subscribers</a></li>
            <li><a href="/utilisateurs/nouveau">Register Member</a></li>';
    }

    /**
     * Returns the title of the HTML document.
     * 
     * @return string
     */
    protected function getPageTitle(): string
    {
        return 'Entreprise Livraison - Meal Delivery Service';
    }
}