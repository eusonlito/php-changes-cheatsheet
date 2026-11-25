# [Changes made to Windows support in PHP 5.3](index.md)

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.windows.php)

## Changes made to Windows support

Changes to the Windows releases:

- The minimum Windows version is now Windows XP SP3; Windows 98, ME, 2000 and NT4 are no longer supported.
- Windows binaries now target i586 and later. i386 and i486 are not supported.
- There is now experimental support for x64 versions of PHP on Windows.
- There is now compiler support for Visual C++ 9 (VC9), using Visual Studio 2008. Snapshots and releases will now also be available for VC9. Old binaries using VC6 are still supported and released in the line with VC9.
- The [PDO_OCI](https://php-legacy-docs.zend.com/manual/php5/en/ref.pdo-oci.html) `php_pdo_oci8.dll` library (for use with Oracle version 8 client libraries) is no longer being built. Instead, use `php_pdo_oci.dll` (note no '8') with Oracle 10 or 11 client libraries. Connection to other database versions is still supported.
- For the [OCI8](https://php-legacy-docs.zend.com/manual/php5/en/book.oci8.html) extension, a new library `php_oci8_11g.dll` is available in addition to `php_oci8.dll`. Only one can be enabled at any time. Use `php_oci8.dll` with Oracle 10.2 client libraries. Use `php_oci8_11g.dll` with Oracle 11 or later client libraries. Connection to other database versions is still supported.

Windows support has been added for the following functions:

- [checkdnsrr()](https://php-legacy-docs.zend.com/manual/php5/en/function.checkdnsrr.html)
- [dns_get_record()](https://php-legacy-docs.zend.com/manual/php5/en/function.dns-get-record.html)
- [fnmatch()](https://php-legacy-docs.zend.com/manual/php5/en/function.fnmatch.html)
- [getmxrr()](https://php-legacy-docs.zend.com/manual/php5/en/function.getmxrr.html)
- [getopt()](https://php-legacy-docs.zend.com/manual/php5/en/function.getopt.html)
- [imagecolorclosesthwb()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagecolorclosesthwb.html)
- [inet_ntop()](https://php-legacy-docs.zend.com/manual/php5/en/function.inet-ntop.html)
- [inet_pton()](https://php-legacy-docs.zend.com/manual/php5/en/function.inet-pton.html)
- [link()](https://php-legacy-docs.zend.com/manual/php5/en/function.link.html)
- [linkinfo()](https://php-legacy-docs.zend.com/manual/php5/en/function.linkinfo.html)
- [mcrypt_create_iv()](https://php-legacy-docs.zend.com/manual/php5/en/function.mcrypt-create-iv.html)
- [readlink()](https://php-legacy-docs.zend.com/manual/php5/en/function.readlink.html)
- [socket_create_pair()](https://php-legacy-docs.zend.com/manual/php5/en/function.socket-create-pair.html) - This function was previously available on Windows, but was disabled as of PHP 4.3.0 due to a bug.
- [stream_socket_pair()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-socket-pair.html)
- [symlink()](https://php-legacy-docs.zend.com/manual/php5/en/function.symlink.html)
- [time_nanosleep()](https://php-legacy-docs.zend.com/manual/php5/en/function.time-nanosleep.html)
- [time_sleep_until()](https://php-legacy-docs.zend.com/manual/php5/en/function.time-sleep-until.html)

Other changes:

- Improved portability of the [stat()](https://php-legacy-docs.zend.com/manual/php5/en/function.stat.html), [touch()](https://php-legacy-docs.zend.com/manual/php5/en/function.touch.html), [filemtime()](https://php-legacy-docs.zend.com/manual/php5/en/function.filemtime.html), [filesize()](https://php-legacy-docs.zend.com/manual/php5/en/function.filesize.html) functions, and other related functions (100% portable for the available data).
- It is now possible to create hard links on Windows using the [link()](https://php-legacy-docs.zend.com/manual/php5/en/function.link.html) function, and symbolic links using the [symlink()](https://php-legacy-docs.zend.com/manual/php5/en/function.symlink.html) function. Hard links are available as of Windows 2000, and symbolic links as of Windows Vista.
- The Windows version of PHP now exposes a set of constants prefixed `PHP_WINDOWS_*`. A list of these constants and their usage can be found at [Predefined Constants](https://php-legacy-docs.zend.com/manual/php5/en/info.constants.html).

**Warning**

Support for the ISAPI module has been dropped. Use the improved FastCGI SAPI module instead.

> **Note**: A new dedicated site for PHP on Windows is now available, including downloads, release candidates, and snapshots in various flavors (thread-safe/not-thread-safe, VC6/VC9, x86/x64). The URL of this site is [» https://windows.php.net/](https://windows.php.net/).
