# [Changes in SAPI Modules in PHP 7.0](index.md)

# [PHP 7.0](https://www.php.net/manual/en/migration70.sapi-changes.php)

## Changes in SAPI Modules

### [FPM](https://www.php.net/manual/en/book.fpm.php)

#### Unqualified [listen](https://www.php.net/manual/en/install.fpm.configuration.php#listen) ports now listen on both IPv4 and IPv6

In PHP 5, a [listen](https://www.php.net/manual/en/install.fpm.configuration.php#listen) directive with only a port number would listen on all interfaces, but only on IPv4. PHP 7 will now accept requests made via both IPv4 and IPv6.

This does not affect directives which include specific IP addresses; these will continue to only listen on that address and protocol.
