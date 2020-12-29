<?php declare(strict_types=1);

namespace App\View;

class Template
{
    /**
     * @const
     */
    protected const PATH_BASE = PATH_SRC.'/views/templates/';

    /**
     * @param string $name
     * @param array $data = []
     *
     * @return string
     */
    public static function get(string $name, array $data = []): string
    {
        extract($data);

        ob_start();

        require static::file($name);

        return ob_get_clean();
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected static function file(string $name): string
    {
        return static::PATH_BASE.'/'.$name.'.php';
    }
}
