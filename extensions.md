# [Other changes to extensions in PHP 5.6, 5.3, 5.2, 5.1](index.md)

# [PHP 5.6](https://www.php.net/manual/en/migration56.extensions.php)

## Other changes to extensions

### [cURL](https://www.php.net/manual/en/book.curl.php)

A number of constants marked obsolete in the cURL library have now been removed:

- **`CURLOPT_CLOSEPOLICY`**

- **`CURLCLOSEPOLICY_CALLBACK`**

- **`CURLCLOSEPOLICY_LEAST_RECENTLY_USED`**

- **`CURLCLOSEPOLICY_LEAST_TRAFFIC`**

- **`CURLCLOSEPOLICY_OLDEST`**

- **`CURLCLOSEPOLICY_SLOWEST`**

### [OCI8](https://www.php.net/manual/en/book.oci8.php)

- Support for implicit result sets for Oracle Database 12c has been added via the new [oci_get_implicit_resultset()](https://www.php.net/manual/en/function.oci-get-implicit-resultset.php) function.

- Using `oci_execute($s, OCI_NO_AUTO_COMMIT)` for a SELECT no longer unnecessarily initiates an internal ROLLBACK during connection close.

- Added DTrace probes controlled by the `--enable-dtrace` configure option.

- [oci_internal_debug()](https://www.php.net/manual/en/function.oci-internal-debug.php) is now a no-op.

- The [phpinfo()](https://www.php.net/manual/en/function.phpinfo.php) output format for OCI8 has changed.

### [Zip](https://www.php.net/manual/en/book.zip.php)

A `--with-libzip` configure option has been added to use a system libzip installation. libzip version 0.11 is required, with 0.11.2 or later recommended.

### [MySQLi](https://www.php.net/manual/en/book.mysqli.php)

A new [mysqli.rollback_on_cached_plink](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.rollback-on-cached-plink) option was added, which controls the rollback behavior of persistent connections.

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.new-extensions.php)

## New Extensions

The following new extensions are added (by default) as of PHP 5.3.0:

- [Enchant](https://php-legacy-docs.zend.com/manual/php5/en/book.enchant.html) - An abstraction layer above various spelling libraries
- [Fileinfo](https://php-legacy-docs.zend.com/manual/php5/en/book.fileinfo.html) - An improved and more solid replacement, featuring full BC, for the [Mimetype](https://php-legacy-docs.zend.com/manual/php5/en/book.mime-magic.html) extension, which has been removed.
- [INTL](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html) - Internationalization extension. INTL is a wrapper around the [» ICU](http://www.icu-project.org/) library.
- [Phar](https://php-legacy-docs.zend.com/manual/php5/en/book.phar.html) - Implementation of PHP-Archive files.
- [SQLite3](https://php-legacy-docs.zend.com/manual/php5/en/book.sqlite3.html) - Support for SQLite version 3 databases.

mysqlnd is a new core library shipped with PHP. It is a PHP-specific replacement for libmysqlclient. mysqlnd will be used to build the [mysql](https://php-legacy-docs.zend.com/manual/php5/en/book.mysql.html), [mysqli](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html) and [PDO_MySQL](https://php-legacy-docs.zend.com/manual/php5/en/ref.pdo-mysql.html) extensions if libmysqlclient isn't found on the system. It may also be used instead of libmysqlclient even when libmysqlclient is present. mysqlnd is recommended for all PHP installations for performance reasons.

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.new-extensions.php)

## New Extensions

The following are new extensions added (by default) as of PHP 5.2.0:

- [Filter](https://php-legacy-docs.zend.com/manual/php5/en/ref.filter.html) - validates and filters data, and is designed for use with insecure data such as user input. This extension is enabled by default; the default mode RAW does not impact input data in any way.
- [JSON](https://php-legacy-docs.zend.com/manual/php5/en/ref.json.html) - implements the JavaScript Object Notation (JSON) data interchange format. This extension is enabled by default.
- [Zip](https://php-legacy-docs.zend.com/manual/php5/en/ref.zip.html) - enables you to transparently read or write ZIP compressed archives and the files inside them.

# [PHP 5.1](https://php-legacy-docs.zend.com/manual/php5/en/migration51.extensions.php)

## Extensions

- [Extensions that are gone from the PHP core](https://php-legacy-docs.zend.com/manual/php5/en/migration51.extensions.html#migration51.extensions-gone)

- [Class constants in new PHP 5.1.x extensions](https://php-legacy-docs.zend.com/manual/php5/en/migration51.extensions.html#migration51.extensions-constants)

## Extensions that are gone from the PHP core

One of the first things you're likely to notice when you download PHP 5.1.x is that several of the older extensions have disappeared. Those extensions that are still actively maintained are available in the PHP Extension Community Library (PECL), at [» https://pecl.php.net/](https://pecl.php.net/).

| Extension | Alternative/Status |
|----|----|
| ext/cpdf | [pecl/pdflib](https://php-legacy-docs.zend.com/manual/php5/en/ref.pdf.html) |
| [ext/dbx](https://php-legacy-docs.zend.com/manual/php5/en/ref.dbx.html) | pecl/dbx |
| [ext/dio](https://php-legacy-docs.zend.com/manual/php5/en/ref.dio.html) | pecl/dio |
| [ext/fam](https://php-legacy-docs.zend.com/manual/php5/en/ref.fam.html) | Not actively maintained |
| [ext/ingres_ii](https://php-legacy-docs.zend.com/manual/php5/en/ref.ingres.html) | pecl/ingres |
| ext/ircg | Not actively maintained |
| [ext/mcve](https://php-legacy-docs.zend.com/manual/php5/en/ref.mcve.html) | pecl/mcve |
| [ext/mnogosearch](https://php-legacy-docs.zend.com/manual/php5/en/ref.mnogosearch.html) | Not actively maintained |
| ext/oracle | [ext/oci8](https://php-legacy-docs.zend.com/manual/php5/en/ref.oci8.html) or [ext/pdo_oci](https://php-legacy-docs.zend.com/manual/php5/en/ref.pdo-oci.html) |
| ext/ovrimos | Not actively maintained |
| ext/pfpro | Not actively maintained |
| ext/w32api | [» pecl/ffi](https://pecl.php.net/package/ffi) |
| [ext/yp](https://php-legacy-docs.zend.com/manual/php5/en/ref.nis.html) | Not actively maintained |
| ext/activescript | [» pecl/activescript](https://pecl.php.net/package/activescript) |

**Removed extensions**

Modules in PECL that are not actively maintained (i.e. have not been supported for some time, have no active maintainer working on them currently, and do not have any PECL package releases), are still available in SVN at [» https://svn.php.net/viewvc/pecl](https://svn.php.net/viewvc/pecl). However, unreleased PHP modules are by their nature unsupported, and your mileage may vary when attempting to install or use them.

## Class constants in new PHP 5.1.x extensions

The Zend Engine 2.1 API allows extension developers to declare class constants in object oriented extensions. New extensions written for PHP 5.1.x, including [SPL](https://php-legacy-docs.zend.com/manual/php5/en/ref.spl.html), [PDO](https://php-legacy-docs.zend.com/manual/php5/en/intro.pdo.html), [XMLReader](https://php-legacy-docs.zend.com/manual/php5/en/book.xmlreader.html) and [date](https://php-legacy-docs.zend.com/manual/php5/en/ref.datetime.html), have their constants in the format **`PDO::CLASS_CONSTANT`** rather than in the C format **`PDO_CLASS_CONSTANT`** in order to minimise pollution of the global namespace in PHP.
