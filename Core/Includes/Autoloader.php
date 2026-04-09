<?php

namespace Core\Includes;

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