<?php declare(strict_types=1);

namespace App\Console;

class Message
{
    /**
     * @const
     */
    protected const COLORS = [
        'default' => '97',

        'bold' => '1',
        'dark' => '2',
        'italic' => '3',
        'underline' => '4',
        'blink' => '5',
        'reverse' => '7',
        'concealed' => '8',

        'default' => '39',
        'black' => '30',
        'red' => '31',
        'green' => '32',
        'yellow' => '33',
        'blue' => '34',
        'magenta' => '35',
        'cyan' => '36',
        'light_gray' => '37',

        'dark_gray' => '90',
        'light_red' => '91',
        'light_green' => '92',
        'light_yellow' => '93',
        'light_blue' => '94',
        'light_magenta' => '95',
        'light_cyan' => '96',
        'white' => '97',

        'bg_default' => '49',
        'bg_black' => '40',
        'bg_red' => '41',
        'bg_green' => '42',
        'bg_yellow' => '43',
        'bg_blue' => '44',
        'bg_magenta' => '45',
        'bg_cyan' => '46',
        'bg_light_gray' => '47',

        'bg_dark_gray' => '100',
        'bg_light_red' => '101',
        'bg_light_green' => '102',
        'bg_light_yellow' => '103',
        'bg_light_blue' => '104',
        'bg_light_magenta' => '105',
        'bg_light_cyan' => '106',
        'bg_white' => '107',
    ];

    /**
     * @param string $message
     *
     * @return void
     */
    public static function echo(string $message): void
    {
        echo static::string($message);
    }

    /**
     * @param string $message
     *
     * @return string
     */
    public static function string(string $message): string
    {
        return static::color('default').static::colors($message).static::color('default');
    }

    /**
     * @param string $message
     *
     * @return string
     */
    protected static function colors(string $message): string
    {
        return preg_replace_callback('/<color:([a-z_]+)>(.*)<\/color>/isU', static function ($matches) {
            return static::color($matches[1]).$matches[2].static::color('default');
        }, $message);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected static function color(string $name): string
    {
        return "\033[".(static::COLORS[$name] ?? static::COLORS['default']).'m';
    }
}
