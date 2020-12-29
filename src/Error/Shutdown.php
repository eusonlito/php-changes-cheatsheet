<?php declare(strict_types=1);

namespace App\Error;

class Shutdown extends ErrorAbstract
{
    /**
     * @return void
     */
    public static function handle(): void
    {
        if ($error = error_get_last()) {
            static::error($error['type'], $error['message'], $error['file'], $error['line']);
        }
    }
}
