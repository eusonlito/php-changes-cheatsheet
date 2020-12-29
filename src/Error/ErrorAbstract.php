<?php declare(strict_types=1);

namespace App\Error;

abstract class ErrorAbstract
{
    /**
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     *
     * @return void
     */
    protected static function error(int $errno, string $errstr, string $errfile, int $errline): void
    {
        die(static::message($errno, $errstr, $errfile, $errline));
    }

    /**
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     *
     * @return string
     */
    protected static function message(int $errno, string $errstr, string $errfile, int $errline): string
    {
        return "\n".$errstr."\n"
            ."\n".'FILE: '.static::file($errfile)
            ."\n".'LINE: '.$errline
            ."\n\n".static::trace();
    }

    /**
     * @return string
     */
    protected static function trace(): string
    {
        $trace = [];

        foreach (array_slice(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS), 3) as $line) {
            if (empty($line['file'])) {
                continue;
            }

            $trace[] = array(
                'file' => static::file($line['file']),
                'line' => $line['line'] ?? '',
                'function' => $line['function'] ?? '',
                'class' => $line['class'] ?? '',
            );
        }

        return print_r($trace, true);
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected static function file(string $file): string
    {
        return str_replace(PATH_BASE, '', $file);
    }
}
