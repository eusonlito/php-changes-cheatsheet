<?php declare(strict_types=1);

namespace App\Filesystem;

use Exception;
use App\Console\Message as MessageConsole;

class Directory
{
    /**
     * @const
     */
    protected const R = [PATH_BASE.'/src/views/assets', PATH_BASE.'/cache', PATH_BASE.'/html'];

    /**
     * @const
     */
    protected const RW = [PATH_BASE.'/cache', PATH_BASE.'/html'];

    /**
     * @param string $path
     * @param string $filter = '*'
     *
     * @return void
     */
    public static function rmdir(string $path, string $filter = '*'): void
    {
        static::isPathValid($path, static::RW);

        if (is_dir($path) === false) {
            return;
        }

        foreach (static::files($path, $filter) as $file) {
            unlink($file);
        }
    }

    /**
     * @param string $path
     *
     * @return void
     */
    public static function mkdir(string $path): void
    {
        static::isPathValid($path, static::RW);

        if (is_dir($path) === false) {
            mkdir($path, 0755, true);
        }
    }

    /**
     * @param string $path
     * @param string $filter = '*'
     *
     * @return array
     */
    public static function files(string $path, string $filter = '*'): array
    {
        static::isPathValid($path, static::R);

        if (is_dir($path) === false) {
            throw new Exception(MessageConsole::string(sprintf('Path <color:red>%s</color> not exists', $path)));
        }

        return array_filter(glob($path.'/'.$filter), 'is_file');
    }

    /**
     * @param string $path
     * @param array $allowed
     *
     * @return void
     */
    protected static function isPathValid(string $path, array $allowed): void
    {
        clearstatcache();

        foreach ($allowed as $folder) {
            if (strpos($path, $folder) === 0) {
                return;
            }
        }

        throw new Exception(MessageConsole::string(sprintf('Path <color:red>%s</color> not allowed', $path)));
    }
}
