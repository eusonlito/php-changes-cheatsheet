# [Other changes in PHP 5.4, 5.3, 5.2](index.md)

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.other.php)

## Other changes

- **`E_ALL`** now includes **`E_STRICT`** level errors in the [error_reporting](https://php-legacy-docs.zend.com/manual/php5/en/errorfunc.configuration.html#ini.error-reporting) configuration directive.
- [SNMP](https://php-legacy-docs.zend.com/manual/php5/en/book.snmp.html) now has an OOP API. Functions now return **`FALSE`** on every error condition including SNMP-related (no such instance, end of MIB, etc). Thus, in particular, breaks previous behavior of get/walk functions returning an empty string on SNMP-related errors. Multi OID get/getnext/set queries are now supported. Dropped UCD-SNMP compatibility code, consider upgrading to net-snmp v5.3+, Net-SNMP v5.4+ is required for Windows version. In sake of adding support for IPv6 DNS name resolution of remote SNMP agent (peer) is done by extension now, not by Net-SNMP library anymore.
- [OpenSSL](https://php-legacy-docs.zend.com/manual/php5/en/book.openssl.html) now supports AES.
- [CLI SAPI](https://php-legacy-docs.zend.com/manual/php5/en/features.commandline.html) doesn't terminate any more on fatal errors when using interactive mode with readline support.
- [\$\_SERVER\['REQUEST_TIME_FLOAT'\]](https://php-legacy-docs.zend.com/manual/php5/en/language.variables.superglobals.html) has been added to include microsecond precision.
- Added new hash algorithms: fnv132, fnv164, joaat
- Chained string offsets - e.g. \$a\[0\]\[0\] where \$a is a string - now work.
- Arrays cast from [SimpleXMLElement](https://php-legacy-docs.zend.com/manual/php5/en/class.simplexmlelement.html) now *always* contain all nodes instead of just the first matching node. All [SimpleXMLElement](https://php-legacy-docs.zend.com/manual/php5/en/class.simplexmlelement.html) children are now *always* printed when using [var_dump()](https://php-legacy-docs.zend.com/manual/php5/en/function.var-dump.html), [var_export()](https://php-legacy-docs.zend.com/manual/php5/en/function.var-export.html) and [print_r()](https://php-legacy-docs.zend.com/manual/php5/en/function.print-r.html).
- It's now possible to enforce the class' [\_\_construct](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.decon.html) arguments in an abstract constructor in the base class.

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.other.php)

## Other changes

- [SplFileInfo::getpathinfo()](https://php-legacy-docs.zend.com/manual/php5/en/splfileinfo.getpathinfo.html) now returns information about the path name.
- [SplObjectStorage](https://php-legacy-docs.zend.com/manual/php5/en/class.splobjectstorage.html) now has [ArrayAccess](https://php-legacy-docs.zend.com/manual/php5/en/class.arrayaccess.html) support. It is now also possible to store associative information with objects in [SplObjectStorage](https://php-legacy-docs.zend.com/manual/php5/en/class.splobjectstorage.html).
- In the GD extension, there is now pixelation support available through the [imagefilter()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagefilter.html) function.
- [var_dump()](https://php-legacy-docs.zend.com/manual/php5/en/function.var-dump.html) output now includes private object properties.
- [session_start()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-start.html) now returns **`FALSE`** when session startup fails.
- [property_exists()](https://php-legacy-docs.zend.com/manual/php5/en/function.property-exists.html) now checks the existence of a property independent of accessibility (like [method_exists()](https://php-legacy-docs.zend.com/manual/php5/en/function.method-exists.html)).
- [Stream wrappers](https://php-legacy-docs.zend.com/manual/php5/en/wrappers.html) can now be used by [include_path](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.include-path).
- The `initial` parameter for [array_reduce()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-reduce.html) can now be of any type.
- The [directory functions](https://php-legacy-docs.zend.com/manual/php5/en/ref.dir.html) [opendir()](https://php-legacy-docs.zend.com/manual/php5/en/function.opendir.html), [scandir()](https://php-legacy-docs.zend.com/manual/php5/en/function.scandir.html), and [dir()](https://php-legacy-docs.zend.com/manual/php5/en/function.dir.html) now use the default stream context if no explicit context is passed.
- [crypt()](https://php-legacy-docs.zend.com/manual/php5/en/function.crypt.html) now has Blowfish and extended DES support, and [crypt()](https://php-legacy-docs.zend.com/manual/php5/en/function.crypt.html) features are now 100% portable. PHP has its own internal crypt implementation which drops into place when support for `crypt` or `crypt_r` is not found.
- [getopt()](https://php-legacy-docs.zend.com/manual/php5/en/function.getopt.html) now accepts "long options" on all platforms. Optional values and `=` as a separator for short options are now supported.
- [fopen()](https://php-legacy-docs.zend.com/manual/php5/en/function.fopen.html) has a new mode option (`n`), which passes **`O_NONBLOCK`** to the underlying `open()` system call. Note that this mode is not currently supported on Windows.
- [getimagesize()](https://php-legacy-docs.zend.com/manual/php5/en/function.getimagesize.html) now supports icon files (.ico).
- The mhash extension have moved to PECL, but the [Hash](https://php-legacy-docs.zend.com/manual/php5/en/ref.hash.html) extension have been modified to support mhash if PHP is compiled with `--with-mhash`. Note that the Hash extension does not require the mhash library to be available whether or not the mhash emulation is enabled.

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.other.php)

## Other Enhancements

- Improved memory manager and increased default memory limit. The new memory manager allocates less memory and works faster than the previous incarnation. It allocates memory from the system in large blocks, and then manages the heap by itself. The `memory_limit` value in `php.ini` is checked, not for each `emalloc()` call (as before), but for actual blocks requested from the system. This means that `memory_limit` is far more accurate than it used to be, since the old memory manager didn't calculate all the memory overhead used by the `malloc` library. Thanks to this new-found accuracy memory usage may appear to have increased, although actually it has not. To accommodate this apparent increase, the default `memory_limit` setting was also increased - from 8 to 16 megabytes.
- Added support for constructors in interfaces to force constructor signature checks in implementations. Starting with PHP 5.2.0, interfaces can have constructors. However, if you choose to declare a constructor in an interface, each class implementing that interface MUST include a constructor with a signature matching that of the base interface constructor. By 'signature' we mean the parameter and return type definitions, including any type hints and including whether the data is passed by reference or by value.
