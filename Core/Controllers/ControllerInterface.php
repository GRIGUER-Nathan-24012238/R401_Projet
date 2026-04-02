<?php

namespace Core\Controllers;

interface ControllerInterface
{
    /**
     * Principal manager of the controller
     *
     * @return void
     */
    public function control(): void;

    /**
     * Check if this controller can handle the request
     *
     * @param  string $path   The request path.
     * @param  string $method The HTTP request method.
     * @return boolean Is the method post?
     */
    public static function support(string $path, string $method): bool;
}