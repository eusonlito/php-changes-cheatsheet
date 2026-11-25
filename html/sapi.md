# [Changes in SAPI modules in PHP 5.4, 5.3](index.md)

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.sapi.php)

## Changes in SAPI modules

- A new SAPI module named `cli-server` is now available.
- Added CLI option `--rz` which shows information of the named Zend extension.
- Added shortcut `#inisetting=value` to change `php.ini` settings at run-time in interactive readline CLI
- Added apache compatible functions: [apache_child_terminate()](https://php-legacy-docs.zend.com/manual/php5/en/function.apache-child-terminate.html), [getallheaders()](https://php-legacy-docs.zend.com/manual/php5/en/function.getallheaders.html), [apache_request_headers()](https://php-legacy-docs.zend.com/manual/php5/en/function.apache-request-headers.html) and [apache_response_headers()](https://php-legacy-docs.zend.com/manual/php5/en/function.apache-response-headers.html) for FastCGI SAPI.
- PHP-FPM: Added the `process.max` setting, to control the number of processes that FPM can fork.

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.sapi.php)

## Changes in SAPI modules

- A new SAPI module named litespeed is now available.
- FastCGI support in the CGI SAPI is now always enabled and can not be disabled. See `sapi/cgi/CHANGES` for more details.
- A new CGI SAPI option, `-T`, can be used to measure repeated execution time of a script.
- CGI/FastCGI now has support for .htaccess-style user-defined `php.ini` files.
- The [dl()](https://php-legacy-docs.zend.com/manual/php5/en/function.dl.html) function is now disabled by default, and is now available only under the CLI, CGI, and embed SAPIs.
