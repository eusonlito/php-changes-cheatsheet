# [Other changes to extensions in PHP 5.5, 5.4, 5.3](index.md)

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.extensions-other.php)

## Other changes to extensions

### [Intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html)

The [intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html) extension now requires ICU 4.0 or later.

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.extensions-other.php)

## Other changes to extensions

Changes in extension behavior, and new features:

- [mysqli](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html) - [mysqli_result](https://php-legacy-docs.zend.com/manual/php5/en/class.mysqli-result.html) now implements [Traversable](https://php-legacy-docs.zend.com/manual/php5/en/class.traversable.html)

&nbsp;

- [pdo_mysql](https://php-legacy-docs.zend.com/manual/php5/en/ref.pdo-mysql.html) - Removed support for linking with MySQL client libraries older than 4.1

&nbsp;

- The MySQL extensions [mysql](https://php-legacy-docs.zend.com/manual/php5/en/book.mysql.html), [mysqli](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html) and [PDO_mysql](https://php-legacy-docs.zend.com/manual/php5/en/ref.pdo-mysql.html) use [mysqlnd](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqlnd.html) as the default library now. It is still possible to use libmysqlclient by specifying a path to the configure options.

&nbsp;

- [mysqlnd](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqlnd.html) - Added named pipes support

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.extensions-other.php)

## Other changes to extensions

The following extensions can no longer be disabled during build configuration:

- [PCRE](https://php-legacy-docs.zend.com/manual/php5/en/book.pcre.html)
- [Reflection](https://php-legacy-docs.zend.com/manual/php5/en/book.reflection.html)
- [SPL](https://php-legacy-docs.zend.com/manual/php5/en/book.spl.html)

Changes in extension behaviour, and new features:

- [Date and Time](https://php-legacy-docs.zend.com/manual/php5/en/book.datetime.html) - The TZ environment variable is no longer used to guess the timezone
- [cURL](https://php-legacy-docs.zend.com/manual/php5/en/book.curl.html) - cURL now supports SSH
- [Network](https://php-legacy-docs.zend.com/manual/php5/en/book.network.html) - [dns_check_record()](https://php-legacy-docs.zend.com/manual/php5/en/function.dns-check-record.html) now returns an extra "entries" index, containing the TXT elements.
- [Hash](https://php-legacy-docs.zend.com/manual/php5/en/book.hash.html) - The SHA-224 and salsa hash algorithms are now supported.
- [mbstring](https://php-legacy-docs.zend.com/manual/php5/en/book.mbstring.html) - Now supports CP850 encoding.
- [OCI8](https://php-legacy-docs.zend.com/manual/php5/en/book.oci8.html) - A call to [oci_close()](https://php-legacy-docs.zend.com/manual/php5/en/function.oci-close.html) on a persistent connection, or a variable referencing a persistent connection going out of scope, will now roll back any uncommitted transaction. To avoid unexpected behavior, explicitly issue a commit or roll back as needed. The old behavior can be enabled with the INI directive [oci8.old_oci_close_semantics](https://php-legacy-docs.zend.com/manual/php5/en/oci8.configuration.html#ini.oci8.old-oci-close-semantics). Database Resident Connection Pooling (DRCP) and Fast Application Notification (FAN) are now supported. Oracle External Authentication is now supported (except on Windows). The [oci_bind_by_name()](https://php-legacy-docs.zend.com/manual/php5/en/function.oci-bind-by-name.html) function now supports SQLT_AFC (aka the CHAR datatype).
- [OpenSSL](https://php-legacy-docs.zend.com/manual/php5/en/book.openssl.html) - OpenSSL digest and cipher functions are now supported. It is also now possible to access the internal values of DSA, RSA and DH keys.
- [Session](https://php-legacy-docs.zend.com/manual/php5/en/book.session.html) - Sessions will no longer store session-files in `"/tmp"` when [open_basedir](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.open-basedir) restrictions apply, unless `"/tmp"` is explicitly added to the list of allowed paths.
- [SOAP](https://php-legacy-docs.zend.com/manual/php5/en/book.soap.html) Now supports sending user supplied HTTP headers.
- [MySQLi](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html) Now supports persistent connections, by prepending the hostname with `"p:"`.
- [Image Processing and GD](https://php-legacy-docs.zend.com/manual/php5/en/book.image.html) The "JPG Support" index returned from [gd_info()](https://php-legacy-docs.zend.com/manual/php5/en/function.gd-info.html) has been renamed to "JPEG Support".
