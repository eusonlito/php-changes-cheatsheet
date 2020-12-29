<?php declare(strict_types=1);

namespace App\Filesystem;

class File
{
    /**
     * @param string $file
     * @param string $contents
     * @param bool $remote = false
     *
     * @return void
     */
    public static function write(string $file, string $contents, bool $remote = false): void
    {
        Directory::mkdir(dirname($file));

        if ($remote) {
            $contents = file_get_contents($contents);
        }

        file_put_contents($file, $contents, LOCK_EX);
    }
}
