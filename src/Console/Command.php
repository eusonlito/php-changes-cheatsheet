<?php declare(strict_types=1);

namespace App\Console;

use App\Console\Message as MessageConsole;

class Command
{
    /**
     * @const
     */
    protected const NAMESPACE = '\\App\\Command';

    /**
     * @param ?string $command
     * @param array $arguments
     *
     * @return void
     */
    public static function factory(?string $command, ...$arguments): void
    {
        if (empty($command)) {
            die(MessageConsole::string("\n<color:red>Empty command</color>\n\n"));
        }

        if (strpos($command, ',') && $arguments) {
            die(MessageConsole::string("\n<color:red>Multiple commands and arguments are not compatible together</color>\n\n"));
        }

        foreach (array_filter(explode(',', $command)) as $command) {
            static::command($command, $arguments);
        }
    }

    /**
     * @param string $command
     * @param array $arguments
     *
     * @return void
     */
    protected static function command(string $command, array $arguments): void
    {
        if ($command === 'Manager') {
            die(MessageConsole::string("\n<color:red>Invalid command</color>\n\n"));
        }

        $class = static::getClass($command);

        static::classExists($class);
        static::print($command);
        static::handle($class, $arguments);

        echo "\n";
    }

    /**
     * @param string $command
     *
     * @return string
     */
    protected static function getClass(string $command): string
    {
        return static::NAMESPACE.'\\'.preg_replace('/[^a-zA-Z]/', '', $command);
    }

    /**
     * @param string $class
     *
     * @return void
     */
    protected static function classExists(string $class): void
    {
        if (!class_exists($class)) {
            die(MessageConsole::string(sprintf("\nCommand <color:red>%s</color> not exists\n\n", $class)));
        }
    }

    /**
     * @param string $command
     *
     * @return void
     */
    protected static function print(string $command): void
    {
        MessageConsole::echo(sprintf("\n<color:blue>Executing command</color> <color:green>%s</color>\n\n", $command));
    }

    /**
     * @param string $command
     * @param array $arguments
     *
     * @return void
     */
    protected static function handle(string $class, array $arguments): void
    {
        (new $class())->handle(...$arguments);
    }
}
