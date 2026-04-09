<?php

namespace Core\Controllers;

/**
 * Interface ControllerInterface
 * 
 * Defines the contract for all controllers in the application.
 * 
 * @package Core\Controllers
 * @author  Hernandez Loic - Griguer Nathan
 */
interface ControllerInterface
{
    /**
     * Executes the main business logic of the controller.
     *
     * @return void
     */
    public function control(): void;

    /**
     * Determines if this controller can handle the given request path and method.
     *
     * @param  string $path   The request path.
     * @param  string $method The HTTP request method (GET, POST, etc.).
     * @return bool True if the controller supports the request, false otherwise.
     */
    public static function support(string $path, string $method): bool;
}