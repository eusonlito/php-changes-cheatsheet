<?php declare(strict_types=1);

namespace App\Error;

use Throwable;

class Exception extends ErrorAbstract
{
    /**
     * @param \Throwable $e
     *
     * @return void
     */
    public static function handle(Throwable $e): void
    {
        static::error($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    }
}
