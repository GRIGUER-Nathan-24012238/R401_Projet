<?php

namespace Core\Views;

use Core\Utils\SessionService;

/**
 * The abstract class which will be used to create all the views.
 *
 * It contains all the required methods and attributes to be used in the implemented views.
 *
 * @category View
 * @package Src
 * @author Nathan Griguer <nathan.griguer@etu.univ-amu.fr>
 * @license MIT License https://opensource.org/licenses/MIT
 **/
abstract class AbstractView
{
      /**
     * Returns the path to the HTML template file.
     *
     * @return string
     */
    abstract protected function templatePath(): string;

    /**
     * Renders the complete HTML page including header, body, and footer.
     *
     * This method orchestrates the rendering of the entire HTML page by calling
     * the methods to render the header, body, and footer in sequence.
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
     * Renders the HTML header section of the page.
     *
     * This method outputs the HTML for the header section, including meta tags,
     * title, CSS links, and navigation bar.
     *
     * @return void
     */
    protected function renderHeader(): void
    {
        echo '<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $this->getPageTitle() . '</title>
    <link rel="icon" type="image/x-icon" href="/image/favicon.ico">

    <link rel="stylesheet" href="/styles/pico.classless.blue.css">

    <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/footer.css">

    ' . $this->getAdditionalHeaders() . '
    <link rel="stylesheet" href="/styles/' . $this->getNameCss() . '">
</head>
<body>

    <header class="container-fluid">
        <nav aria-label="breadcrumb" class="main-nav">
            <a href="/" class="nav-logo">
                <img src="/image/logoamu.png" alt="Logo AMU" style="height: 40px;">
            </a>
            <ul class="nav-links">
                ' . $this->getNavBar() . '
            </ul>
        </nav>
    </header>


';
    }


    /**
     * Returns the name of the CSS file associated with the view.
     *
     * This method should be implemented by subclasses to specify the CSS file
     * that should be included in the HTML header for styling the page.
     *
     * @return string The name of the CSS file.
     */
    abstract protected function getNameCss(): string;

    /**
     * Renders the HTML footer section of the page.
     *
     * This method outputs the HTML for the footer section, including contact information
     * and social media links.
     *
     * @return void
     */
    protected function renderFooter(): void
    {
        echo '

    <footer class="container-fluid">
        <hr>
        <nav>
            <ul>
                <li>
                    <img src="/image/logoamu.png" alt="Logo AMU" style="height: 35px; margin-right: 10px;">
                    <strong>SAEManager</strong>
                </li>
            </ul>

            <ul>
                <li>+33 02 50 65 14 4 </li>
                <li>📧 <a href="mailto:contact@saemanager.alwaysdata.net">Email</a></li>
            </ul>

            <ul>
                <li><a href="#" class="secondary">Instagram</a></li>
                <li><a href="#" class="secondary">Facebook</a></li>
                <li><a href="#" class="secondary">LinkedIn</a></li>
            </ul>

            <ul>
                <li><a href="/legal-notice" class="secondary">Mentions légales</a></li>
                <li><a href="/conservation-date" class="secondary">Conservation des données</a></li>
                <li><a href="/site-map" class="secondary">Plan du site</a></li>
            </ul>
        </nav>
    </footer>

    ' . $this->getAdditionalScripts() . '
</body>
</html>';
    }

    /**
     * Returns the name of the project 'SAE Manager' or be used in some cases like displaying it by some isolated texts.
     * @return string the name of the project 'SAE Manager'.
     */
    protected function getNavBar(): string
    {
        if (SessionService::has('user_id')) {
            return '
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/logout">Déconnexion</a></li>';
        }
        return '
                <li><a href="/">Accueil</a></li>
                <li><a href="/login">Connexion</a></li>
                <li><a href="/register">Inscription</a></li>';
    }

    /**
     * Returns the name of the project 'SAE Manager' or be used in some cases like displaying it by some isolated texts.
     * @return string the name of the project 'SAE Manager'.
     */
    protected function getPageTitle(): string
    {
        return 'Entreprise de Livraison';
    }

}