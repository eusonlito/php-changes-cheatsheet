<?php declare(strict_types=1);

namespace App\Error;

class Error extends ErrorAbstract
{
    /**
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     *
     * @return void
     */
    public static function handle(int $errno, string $errstr, string $errfile, int $errline): void
    {
        static::error($errno, $errstr, $errfile, $errline);
    }
}
