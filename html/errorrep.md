# [Error Reporting in PHP 5.2](index.md)

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.errorrep.php)

## Error Reporting

Some of the existing **`E_ERROR`** conditions have been converted to something that can be caught with a user-defined error handler. If an [**`E_RECOVERABLE_ERROR`**](https://php-legacy-docs.zend.com/manual/php5/en/errorfunc.constants.html) is not handled, it will behave in the same way as **`E_ERROR`** behaves in all versions of PHP. Errors of this type are logged as `Catchable fatal error`.

This change means that the value of the **`E_ALL`** [error_reporting](https://php-legacy-docs.zend.com/manual/php5/en/errorfunc.configuration.html#ini.error-reporting) constant is now 6143, where the previous value was 2047. Because PHP constants have no meaning outside of PHP, in some cases the integer value is used instead so these will need to be adjusted. So for example by setting the error_reporting mode from either the [httpd.conf](https://php-legacy-docs.zend.com/manual/php5/en/apache.configuration.html) or the `.htaccess` files, the value has to be changed accordingly. The same applies when the numeric values are used rather than the constants in PHP scripts.

As a side-effect of a change made to prevent duplicate error messages when [track_errors](https://php-legacy-docs.zend.com/manual/php5/en/errorfunc.configuration.html#ini.track-errors) is `On`, it is now necessary to return **`FALSE`** from user defined error handlers in order to populate [`$php_errormsg`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.phperrormsg.html). This provides a fine-grain control over the levels of messages stored.
