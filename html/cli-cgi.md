# [CLI and CGI in PHP 5.0](index.md)

# [PHP 5.0](https://php-legacy-docs.zend.com/manual/php5/en/migration5.cli-cgi.php)

## CLI and CGI

In PHP 5 there were some changes in CLI and CGI filenames. In PHP 5, the CGI version was renamed to `php-cgi.exe` (previously `php.exe`) and the CLI version now sits in the main directory (previously `cli/php.exe`).

In PHP 5 it was also introduced a new mode: `php-win.exe`. This is equal to the CLI version, except that php-win doesn't output anything and thus provides no console (no "dos box" appears on the screen). This behavior is similar to php-gtk.

In PHP 5, the CLI version will always populate the global [`$argv`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.argv.html) and [`$argc`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.argc.html) variables regardless of any `php.ini` directive setting. Even having [register_argc_argv](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.register-argc-argv) set to `off` will have no affect in CLI.

See also the [command line reference](https://php-legacy-docs.zend.com/manual/php5/en/features.commandline.html).
