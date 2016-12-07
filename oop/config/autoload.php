<?php

/**
 * Internal class autoloader.
 *
 * @param string $className Class name to load.
 *
 * @return void
 */
function autoload($className)
{
    $baseDir = realpath(__DIR__ . '/../lib') . '/';
    $prefix = 'Academy\\';

    $len = strlen($prefix);
    if (strncmp($prefix, $className, $len) !== 0) {
        // The class to be loaded is not in our
        // namespace.
        return;
    }
    
    $relativeClass = substr($className, $len);
    $file = $baseDir . str_replace(
        '\\',
        DIRECTORY_SEPARATOR,
        $relativeClass
    ) . '.php';

    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('autoload');
