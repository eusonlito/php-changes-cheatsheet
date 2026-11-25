# [Windows Support in PHP 8.6, 8.5, 8.4, 8.3, 8.2, 7.4, 7.3, 7.1](index.md)

# [PHP 8.6](https://www.php.net/manual/en/migration86.windows-support.php)

## Windows Support

### Core

The official Windows builds now use Visual Studio 2026 (VS18).

### LibXML

The libxml2 library used by the official Windows builds has been upgraded to version 2.15.3. As a result, [DOMDocument::\$documentURI](https://www.php.net/manual/en/class.domdocument.php#domdocument.props.documenturi) for documents loaded from a local file now contains a native filesystem path instead of a file URI.

### OpenSSL

The OpenSSL library used by the official Windows builds has been upgraded to OpenSSL 4.

# [PHP 8.5](https://www.php.net/manual/en/migration85.windows-support.php)

## Windows Support

### Core

The configuration variables **[`PHP_VERSION`](https://www.php.net/manual/en/reserved.constants.php#constant.php-version)**, **[`PHP_MINOR_VERSION`](https://www.php.net/manual/en/reserved.constants.php#constant.php-minor-version)**, and **[`PHP_RELEASE_VERSION`](https://www.php.net/manual/en/reserved.constants.php#constant.php-release-version)** are now always numbers. Previously, they have been strings for buildconf builds.

**phpize** builds now reflect the source tree in the build dir (as it already worked for in-tree builds); some extension builds (especially when using Makefile.frag.w32) may need adjustments.

**--enable-sanitizer** is now supported for MSVC builds. This enables ASan and debug assertions, and is supported as of MSVC 16.10 and Windows 10.

The **--with-uncritical-warn-choke** configuration option for clang builds is no longer supported. Select warnings to suppress via CFLAGS instead.

### COM

The extension is now build shared by default; previously it defaulted to a static extension, although the official Windows binaries built a shared extension.

### FFI

It is no longer necessary to specify the library when using [FFI::cdef()](https://www.php.net/manual/en/ffi.cdef.php) and [FFI::load()](https://www.php.net/manual/en/ffi.load.php). However, this convenience feature should not be used in production.

### Streams

If only pipe streams are contained in the `read` array, and the `write` and `except` arrays are empty, [stream_select()](https://www.php.net/manual/en/function.stream-select.php) now behaves similar to POSIX systems, i.e. the function only returns if at least one pipe is ready to be read, or after the timeout expires. Previously, [stream_select()](https://www.php.net/manual/en/function.stream-select.php) returned immediately, reporting all streams as ready to read.

# [PHP 8.4](https://www.php.net/manual/en/migration84.windows-support.php)

## Windows Support

### Core

Building with Visual Studio now requires at least Visual Studio 2019. However, Visual Studio 2022 is recommended.

AVX(2) CPU support is now properly detected for MSVC builds.

Native AVX-512 builds are now supported via the **--enable-native-intrinsics=avx512** configure option.

# [PHP 8.3](https://www.php.net/manual/en/migration83.windows-support.php)

## Windows Support

### Core

Minimum supported Windows version has been bumped to Windows 8 or Windows Server 2012.

# [PHP 8.2](https://www.php.net/manual/en/migration82.windows-support.php)

## Windows Support

### Core

Windows specific error messages are no longer localized, but instead always displayed in English to better match PHP error messages.

Preliminary and highly experimental support for building on ARM64 has been added.

### OCI8

Because building against Oracle Client 10g is no longer supported anyway, the configuration option **--with-oci8** has been dropped. The **--with-oci8-11g**, **--with-oci8-12c** and **--with-oci8-19** configuration options are still supported.

### Zip

The Zip extension is upgraded to version 1.21.0, and is now built as shared library (DLL) by default.

# [PHP 7.4](https://www.php.net/manual/en/migration74.windows-support.php)

## Windows Support

### **configure** flags

**configure** now regards additional `CFLAGS` and `LDFLAGS` set as environment variables.

### CTRL handling

CTRL +C and CTRL +BREAK on console can be caught by setting a handler function with [sapi_windows_set_ctrl_handler()](https://www.php.net/manual/en/function.sapi-windows-set-ctrl-handler.php).

[proc_open()](https://www.php.net/manual/en/function.proc-open.php) on Windows can be passed a "create_process_group" option. It is required if the child process is supposed to handle CTRL events.

### OPcache

OPcache now supports an arbitrary number of separate caches per user via the INI directive `opcache.cache_id`. All processes with the same cache ID and user share an OPcache instance.

### stat

The stat implementation has been refactored.

- An inode number is delivered and is based on the NTFS file index.

- The device number is now based on the volume serial number.

Note that both values are derived from the system and provided as-is on 64-bit systems. On 32-bit systems, these values might overflow the 32-bit integer in PHP, so they're fake.

### libsqlite3

libsqlite3 is no longer compiled statically into `php_sqlite3.dll` and `php_pdo_sqlite.dll`, but rather available as `libsqlite3.dll`. Refer to the installation instructions for [SQLite3](https://www.php.net/manual/en/sqlite3.installation.php) and [PDO_SQLITE](https://www.php.net/manual/en/ref.pdo-sqlite.php#ref.pdo-sqlite.installation), respectively.

# [PHP 7.3](https://www.php.net/manual/en/migration73.windows-support.php)

## Windows Support

### PHP Core

#### More POSIX Conforming File Deletion

File descriptors are opened in shared read/write/delete mode by default. This effectively maps the POSIX semantics and allows to delete files with handles in use. It is not 100% same, some platform differences still persist. After the deletion, the filename entry is blocked, until all the opened handles to it are closed.

# [PHP 7.1](https://www.php.net/manual/en/migration71.windows-support.php)

## Windows Support

### Support for long and UTF-8 path

If a web application is UTF-8 conform, no further action is required. For applications depending on paths in non UTF-8 encodings for I/O, an explicit INI directive has to be set. The encoding INI settings check relies on the order in the core:

- internal_encoding

- default_charset

- zend.multibyte

Several functions for codepage handling were introduced:

- sapi_windows_cp_set() to set the default codepage

- sapi_windows_cp_get() to retrieve the current codepage

- sapi_windows_cp_is_utf8()

- sapi_windows_cp_conv() to convert between codepages, using iconv() compatible signature

These functions are thread safe.

The console output codepage is adjusted depending on the encoding used in PHP. Depending on the concrete system OEM codepage, the visible output might or might be not correct. For example, in the default cmd.exe and on a system with the OEM codepage 437, outputs in codepages 1251, 1252, 1253 and some others can be shown correctly when using UTF-8. On the same system, chars in codepage like 20932 probably won't be shown correctly. This refers to the particular system rules for codepage, font compatibility and the particular console program used. PHP automatically sets the console codepage according to the encoding rules from php.ini. Using alternative consoles instead of cmd.exe directly might bring better experience in some cases.

Nevertheless be aware, runtime codepage switch after the request start might bring unexpected side effects on CLI. The preferable way is php.ini, When PHP CLI is used in a console emulator, that doesn't support Unicode, it might possibly be required, to avoid changing the console codepage. The best way to achieve it is by setting the default or internal encoding to correspond the ANSI codepage. Another method is to set the INI directives output_encoding and input_encoding to the required codepage, in which case however the difference between internal and I/O codepage is likely to cause mojibake. In rare cases, if PHP happens to crash gracefully, the original console codepage might be not restored. In this case, the chcp command can be used, to restore it manually.

Special awareness for the DBCS systems - the codepage switch on runtime using [ini_set()](https://www.php.net/manual/en/function.ini-set.php) is likely to cause display issues. The difference to the non DBCS systems is, that the extended characters require two console cells to be displayed. In certain case, only the mapping of the characters into the glyph set of the font could happen, no actual font change. This is the nature of DBCS systems, the most simple way to prevent display issues is to avoid usage of [ini_set()](https://www.php.net/manual/en/function.ini-set.php) for the codepage change.

As a result of UTF-8 support in the streams, PHP scripts are not limited to ASCII or ANSI filenames anymore. This is supported out of the box on CLI. For other SAPI, the documentation for the corresponding server is useful.

Long paths support is transparent. Paths longer than 260 bytes get automatically prefixed with `\\?\`. The max path length is limited to 2048 bytes. Be aware, that the path segment limit (basename length) still persists.

For the best portability, it is strongly recommended to handle filenames, I/O and other related topics using UTF-8. Additionally, for the console applications, the usage of a TrueType font is preferable and the usage of ini_set() for the codepage change is discouraged.

### readline

The [readline extension](https://www.php.net/manual/en/book.readline.php) is supported through the [» WinEditLine library](https://mingweditline.sourceforge.net/). Thereby, the interactive CLI shell is supported as well (`php.exe -a`).

### PHP_FCGI_CHILDREN

`PHP_FCGI_CHILDREN` is now respected. If this environment variable is defined, the first `php-cgi.exe` process will exec the specified number of children. These will share the same TCP socket.

### ftok()

Added support for [ftok()](https://www.php.net/manual/en/function.ftok.php)
