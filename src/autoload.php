<?php declare(strict_types=1);

spl_autoload_register(function ($class) {
    $file = PATH_SRC.'/'.preg_replace('/^App\//', '', str_replace('\\', '/', $class)).'.php';

    if (is_file($file)) {
        require $file;
    }
});
