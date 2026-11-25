# [Changes in PHP 5.2, 5.1](index.md)

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.datetime.php)

## Changes in PHP [datetime](https://php-legacy-docs.zend.com/manual/php5/en/ref.datetime.html) support

Since PHP 5.1.0, there has been an extension named `date` in the PHP core. This is the new implementation of PHP's datetime support. Although it will attempt to guess your system's timezone setting, you should set the timezone manually. You can do this in any of three ways:

- in your `php.ini` using the [date.timezone](https://php-legacy-docs.zend.com/manual/php5/en/datetime.configuration.html#ini.date.timezone) INI directive
- on your system using the `TZ` environmental variable
- from your script using the convenience function [date_default_timezone_set()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-default-timezone-set.html)

All supported [timezones](https://php-legacy-docs.zend.com/manual/php5/en/timezones.html) are listed in the PHP Manual.

With the advent of PHP 5.2.x, there are [object](https://php-legacy-docs.zend.com/manual/php5/en/language.types.object.html) representations of the date and timezone, named `DateTime` and `DateTimeZone` respectively. The methods map to existing procedural date functions.

# [PHP 5.1](https://php-legacy-docs.zend.com/manual/php5/en/migration51.datetime.php)

## Date/time support

Date/time support has been fully rewritten in PHP 5.1.x, and no longer uses the system settings to 'know' the timezone in operation. It will instead utilize, in the following order:

- The timezone set using the [date_default_timezone_set()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-default-timezone-set.html) function (if any)

- The TZ environment variable (if non empty)

- "magical" guess (if the operating system supports it)

- If none of the above options succeeds, UTC

To ensure accuracy (and avoid an **`E_STRICT`** warning), you will need to define your timezone in your `php.ini` using the following format:

date.timezone = Europe/London

The supported timezones are listed, in this format, in the [timezones appendix](https://php-legacy-docs.zend.com/manual/php5/en/timezones.html).

Also note that [strtotime()](https://php-legacy-docs.zend.com/manual/php5/en/function.strtotime.html) now returns **`FALSE`** on failure, instead of -1.
