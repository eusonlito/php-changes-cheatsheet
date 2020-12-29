<?php declare(strict_types=1);

namespace App\Filesystem;

use Exception;
use App\Console\Message as MessageConsole;

class Directory
{
    /**
     * @const
     */
    protected const FOLDERS = [PATH_BASE.'/cache', PATH_BASE.'/html'];

    /**
     * @param string $path
     * @param string $filter = '*'
     *
     * @return void
     */
    public static function rmdir(string $path, string $filter = '*'): void
    {
        static::isPathValid($path);

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
        static::isPathValid($path);

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
        static::isPathValid($path);

        if (is_dir($path) === false) {
            throw new Exception(MessageConsole::string(sprintf('Path <color:red>%s</color> not exists', $path)));
        }

        return array_filter(glob($path.'/'.$filter), 'is_file');
    }

    /**
     * @param string $path
     *
     * @return void
     */
    protected static function isPathValid(string $path): void
    {
        clearstatcache();

        foreach (static::FOLDERS as $allowed) {
            if (strpos($path, $allowed) === 0) {
                return;
            }
        }

        throw new Exception(MessageConsole::string(sprintf('Path <color:red>%s</color> not allowed', $path)));
    }
}
