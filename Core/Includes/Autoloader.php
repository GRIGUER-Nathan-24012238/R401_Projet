<?php

namespace Core\Includes;

/**
 * Class Autoloader
 * 
 * Custom Autoloader for the application.
 * 
 * Handles dynamic loading of classes based on their namespaces, 
 * mapping them to the correct file paths in the 'App/src' and 'Core' directories.
 * 
 * @package Core\Includes
 * @author  Hernandez Loic - Griguer Nathan
 */
class Autoloader
{
    /**
     * The base directory of the project.
     * @var string
     */
    private static string $projectRoot;

    /**
     * Registers the autoloader function with SPL.
     *
     * This method sets up the autoloader to look for class files in the
     * 'App/src' and 'Core' directories based on the class namespace.
     *
     * @return void
     */
    public static function register(): void
    {
        // Calculate project root dynamically.
        self::$projectRoot = dirname(dirname(__DIR__));

        spl_autoload_register(
            function ($class) {
                $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

                $file = null;

                if (str_starts_with($class, 'App\\')) {
                    $file = self::$projectRoot . DIRECTORY_SEPARATOR . $classPath;
                } elseif (
                    str_starts_with($class, 'Models\\')
                    || str_starts_with($class, 'Services\\') || str_starts_with($class, 'Controllers\\')
                    || str_starts_with($class, 'Views\\') || str_starts_with($class, 'Validator\\')
                ) {
                    $file = self::$projectRoot . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'src' .
                            DIRECTORY_SEPARATOR . $classPath;
                } elseif (str_starts_with($class, 'Core\\')) {
                    $file = self::$projectRoot . DIRECTORY_SEPARATOR . $classPath;
                }

                if ($file !== null && file_exists($file)) {
                    require_once $file;
                }
            }
        );
    }
}