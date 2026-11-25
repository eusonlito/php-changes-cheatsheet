# [Other Changes in PHP 8.6, 8.5, 8.4, 8.3, 8.2, 8.1, 8.0, 7.4, 7.3, 7.2, 7.1, 7.0](index.md)

# [PHP 8.6](https://www.php.net/manual/en/migration86.other-changes.php)

## Other Changes

### Core changes

#### Core

In case of a hard OOM (out of memory) condition, PHP now calls `abort()` instead of `exit(1)`, changing the exit code to 134 and possibly creating a core dump.

The **[`PHP_OS_FAMILY`](https://www.php.net/manual/en/reserved.constants.php#constant.php-os-family)** constant has an `AIX` value for when running on AIX or IBM i via PASE.

### Changes in SAPI Modules

#### CLI

The [built-in development server](https://www.php.net/manual/en/features.commandline.webserver.php) now accepts requests using the HTTP `QUERY` method instead of returning `501 Not Implemented`.

The [built-in development server](https://www.php.net/manual/en/features.commandline.webserver.php) no longer reflects the `Host` header from requests.

### Changed Functions

#### Core

[header_register_callback()](https://www.php.net/manual/en/function.header-register-callback.php) now declares [true](https://www.php.net/manual/en/language.types.singleton.php) as its return type. It has not been able to return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** since PHP 8.0.0, when passing an invalid callback started throwing a [TypeError](https://www.php.net/manual/en/class.typeerror.php) instead.

[register_tick_function()](https://www.php.net/manual/en/function.register-tick-function.php) now declares [true](https://www.php.net/manual/en/language.types.singleton.php) as its return type. It has always returned **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** on success; an invalid callback throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php) during argument parsing before the function body is reached.

[ini_get_all()](https://www.php.net/manual/en/function.ini-get-all.php) now includes a `"builtin_default_value"` element for each directive when `details` is **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)**. It holds the built-in default value of the directive (or **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** if it has none), independent of values set in `php.ini`, on the command line, or at runtime.

[fclose()](https://www.php.net/manual/en/function.fclose.php), [file_put_contents()](https://www.php.net/manual/en/function.file-put-contents.php) and [copy()](https://www.php.net/manual/en/function.copy.php) now return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** when flushing or closing the stream fails. Previously such failures were silently ignored.

[stream_select()](https://www.php.net/manual/en/function.stream-select.php), [stream_copy_to_stream()](https://www.php.net/manual/en/function.stream-copy-to-stream.php), [stream_socket_pair()](https://www.php.net/manual/en/function.stream-socket-pair.php) and [stream_is_local()](https://www.php.net/manual/en/function.stream-is-local.php) now have an additional optional `context` argument.

[stream_context_set_default()](https://www.php.net/manual/en/function.stream-context-set-default.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if `options` contains the `error_mode`, `error_store` or `error_handler` [stream context option](https://www.php.net/manual/en/context.stream.php).

#### Date

The following methods now have tentative static return types:

- [DateTime::createFromInterface()](https://www.php.net/manual/en/datetime.createfrominterface.php)
- [DateTimeImmutable::\_\_set_state()](https://www.php.net/manual/en/datetimeimmutable.set-state.php)
- [DateTimeImmutable::modify()](https://www.php.net/manual/en/datetimeimmutable.modify.php)
- [DateTimeImmutable::add()](https://www.php.net/manual/en/datetimeimmutable.add.php)
- [DateTimeImmutable::sub()](https://www.php.net/manual/en/datetimeimmutable.sub.php)
- [DateTimeImmutable::setTimezone()](https://www.php.net/manual/en/datetimeimmutable.settimezone.php)
- [DateTimeImmutable::setTime()](https://www.php.net/manual/en/datetimeimmutable.settime.php)
- [DateTimeImmutable::setDate()](https://www.php.net/manual/en/datetimeimmutable.setdate.php)
- [DateTimeImmutable::setISODate()](https://www.php.net/manual/en/datetimeimmutable.setisodate.php)
- [DateTimeImmutable::setTimestamp()](https://www.php.net/manual/en/datetimeimmutable.settimestamp.php)
- [DateTimeImmutable::createFromInterface()](https://www.php.net/manual/en/datetimeimmutable.createfrominterface.php)
- **DateTimeZone::\_\_set_state()**
- **DateInterval::\_\_set_state()**
- **DatePeriod::\_\_set_state()**

#### Filter

The return type of [filter_var_array()](https://www.php.net/manual/en/function.filter-var-array.php) has been narrowed from [array](https://www.php.net/manual/en/language.types.array.php)\|[false](https://www.php.net/manual/en/language.types.singleton.php)\|[null](https://www.php.net/manual/en/language.types.null.php) to [array](https://www.php.net/manual/en/language.types.array.php)\|[false](https://www.php.net/manual/en/language.types.singleton.php). The function always establishes an array before filtering, so **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** was never returned. [filter_input_array()](https://www.php.net/manual/en/function.filter-input-array.php) is unaffected: it still returns **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** when the requested superglobal does not exist.

#### LDAP

The return type of [ldap_free_result()](https://www.php.net/manual/en/function.ldap-free-result.php) has been narrowed from [bool](https://www.php.net/manual/en/language.types.boolean.php) to [true](https://www.php.net/manual/en/language.types.singleton.php). The function already always returned **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)**.

#### MySQLi

The return structure of [mysqli_get_charset()](https://www.php.net/manual/en/mysqli.get-charset.php) no longer contains the undocumented `"comment"` element. The value of `"charsetnr"` is now set to a constant `0` as this number was an implementation detail that should not have been exposed to the public.

#### OpenSSL

The output of [openssl_x509_parse()](https://www.php.net/manual/en/function.openssl-x509-parse.php) now contains a `"criticalExtensions"` entry listing all critical certificate extensions.

[openssl_sign()](https://www.php.net/manual/en/function.openssl-sign.php) and [openssl_verify()](https://www.php.net/manual/en/function.openssl-verify.php) now have an additional optional `salt_length` argument that allows controlling the RSA-PSS salt length when **[`OPENSSL_PKCS1_PSS_PADDING`](https://www.php.net/manual/en/openssl.padding.php#constant.openssl-pkcs1-pss-padding)** is used. It accepts an explicit length or one of the new **`OPENSSL_RSA_PSS_SALTLEN_*`** constants.

#### PDO_DBLIB

When using persistent connections, there is now a liveness check in [PDO::\_\_construct()](https://www.php.net/manual/en/pdo.construct.php).

#### Phar

[Phar::mungServer()](https://www.php.net/manual/en/phar.mungserver.php) now supports reference values.

#### Readline

[readline_completion_function()](https://www.php.net/manual/en/function.readline-completion-function.php) now declares [true](https://www.php.net/manual/en/language.types.singleton.php) as its return type. It has always returned **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** on success; an invalid callback throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php) during argument parsing before the function body is reached.

#### Reflection

The outputs of [ReflectionClassConstant::\_\_toString()](https://www.php.net/manual/en/reflectionclassconstant.tostring.php) and [ReflectionConstant::\_\_toString()](https://www.php.net/manual/en/reflectionconstant.tostring.php) now print [bool](https://www.php.net/manual/en/language.types.boolean.php) constant values as `true` and `false` rather than `1` and an empty string. This also affects other ways of printing class constants, e.g. [ReflectionClass::\_\_toString()](https://www.php.net/manual/en/reflectionclass.tostring.php).

#### Sockets

[socket_addrinfo_lookup()](https://www.php.net/manual/en/function.socket-addrinfo-lookup.php) now has an additional optional `error_code` argument that, when not **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**, receives the error code on failure (one of the **`EAI_*`** constants).

The return type of [socket_cmsg_space()](https://www.php.net/manual/en/function.socket-cmsg-space.php) has been narrowed from ?[int](https://www.php.net/manual/en/language.types.integer.php) to [int](https://www.php.net/manual/en/language.types.integer.php). Every failure path has thrown a [ValueError](https://www.php.net/manual/en/class.valueerror.php) since PHP 8.0.0, so **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** was never returned.

#### Zip

The return type of [zip_entry_close()](https://www.php.net/manual/en/function.zip-entry-close.php) has been narrowed from [bool](https://www.php.net/manual/en/language.types.boolean.php) to [true](https://www.php.net/manual/en/language.types.singleton.php). The function already always returned **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)**.

### Other Changes to Extensions

#### Fileinfo

Upgraded to file 5.48. Custom compiled magic databases from older file versions must be regenerated.

#### Hash

The bundled version of xxHash was upgraded to 0.8.2.

#### MySQLi

Added the new constant **`MYSQLI_OPT_COMPRESS`**.

#### Opcache

JIT is now supported for ZTS builds on Apple Silicon.

### Changes to INI File Handling

#### Core

The error_include_args INI option has been added to make the display of function arguments consistent in errors; it is off by default. Previously, whether a function showed a parameter in the error was up to each call to the internal error function. Now, all parameters as they were actually passed to the function will be displayed. This uses the same infrastructure as stack traces, so sensitive parameters will not be displayed, and strings will be truncated according to [zend.exception_string_param_max_len](https://www.php.net/manual/en/ini.core.php#ini.zend.exception-string-param-max-len).

#### MBString

The [mbstring.detect_order](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.detect-order) INI directive now updates the internal detection order when changed at runtime via [ini_set()](https://www.php.net/manual/en/function.ini-set.php). Previously, runtime changes using [ini_set()](https://www.php.net/manual/en/function.ini-set.php) did not take effect for [mb_detect_order()](https://www.php.net/manual/en/function.mb-detect-order.php). Setting the directive to **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** or an empty string at runtime now leaves the previously configured detection order unchanged.

#### MySQLi

[mysqli.default_port](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.default-port) now checks the validity of the value, which should be between `0` and `65535` inclusive.

#### Opcache

[opcache.jit_debug](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-debug) accepts a new flag: `ZEND_JIT_DEBUG_TRACE_EXIT_INFO_SRC`. When used along with `ZEND_JIT_DEBUG_TRACE_EXIT_INFO`, the source of exit points is printed in the exit info output, in debug builds.

### Performance

#### Core

[printf()](https://www.php.net/manual/en/function.printf.php) using only `%s` and `%d` will be compiled into the equivalent string interpolation, avoiding the overhead of a function call and repeatedly parsing the format string.

Arguments are now passed more efficiently to known constructors (e.g. when using `new self()`).

[array_map()](https://www.php.net/manual/en/function.array-map.php) using a [first-class callable](https://www.php.net/manual/en/functions.first_class_callable_syntax.php) or [partial function application](https://www.php.net/manual/en/functions.partial-application.php) callback will be compiled into the equivalent [foreach](https://www.php.net/manual/en/control-structures.foreach.php) loop, avoiding the creation of intermediate [Closure](https://www.php.net/manual/en/class.closure.php)s, the overhead of calling userland callbacks from internal functions and providing for better insight for the JIT.

The performance of the TAILCALL VM has been improved, and it is now enabled on Windows when compiling with Clang 19 or later on x86_64.

The performance of ZTS builds has been improved.

Added a stateless closure cache.

Deeply recursive code that causes the VM to allocate new stack pages should now be faster.

Improved performance of sorting single-element arrays.

Improved performance of the following functions:

- [addcslashes()](https://www.php.net/manual/en/function.addcslashes.php), when generating octal escapes
- [array_fill_keys()](https://www.php.net/manual/en/function.array-fill-keys.php)
- [array_intersect()](https://www.php.net/manual/en/function.array-intersect.php)
- [array_map()](https://www.php.net/manual/en/function.array-map.php), with multiple arrays passed
- [array_product()](https://www.php.net/manual/en/function.array-product.php) and [array_sum()](https://www.php.net/manual/en/function.array-sum.php), for integer-only arrays
- [array_unshift()](https://www.php.net/manual/en/function.array-unshift.php)
- [array_walk()](https://www.php.net/manual/en/function.array-walk.php)
- [intval()](https://www.php.net/manual/en/function.intval.php), for `intval('0b...', 2)` and `intval('+0b...', 2)`
- [pathinfo()](https://www.php.net/manual/en/function.pathinfo.php), when requesting a single component
- [str_pad()](https://www.php.net/manual/en/function.str-pad.php)
- [str_repeat()](https://www.php.net/manual/en/function.str-repeat.php), when the multiplier is `1`
- [str_split()](https://www.php.net/manual/en/function.str-split.php)

#### DOM

Made [DOMText::splitText()](https://www.php.net/manual/en/domtext.splittext.php) and [Dom\Text::splitText()](https://www.php.net/manual/en/dom-text.splittext.php) faster and consume less memory.

#### GD

[imagebmp()](https://www.php.net/manual/en/function.imagebmp.php), [imagewbmp()](https://www.php.net/manual/en/function.imagewbmp.php), [imagegd()](https://www.php.net/manual/en/function.imagegd.php), and [imagegd2()](https://www.php.net/manual/en/function.imagegd2.php) now buffer output when writing to PHP streams, significantly improving performance when writing images to files.

Improved performance of [imagegrabscreen()](https://www.php.net/manual/en/function.imagegrabscreen.php) and [imagegrabwindow()](https://www.php.net/manual/en/function.imagegrabwindow.php) on Windows.

#### Intl

Improved performance of [IntlCalendar::getAvailableLocales()](https://www.php.net/manual/en/intlcalendar.getavailablelocales.php) and [IntlDateFormatter::localtime()](https://www.php.net/manual/en/intldateformatter.localtime.php)/[datefmt_localtime()](https://www.php.net/manual/en/intldateformatter.localtime.php) by pre-allocating their returned arrays.

Improved performance of [transliterator_list_ids()](https://www.php.net/manual/en/transliterator.listids.php) and [resourcebundle_locales()](https://www.php.net/manual/en/resourcebundle.locales.php) by pre-allocating their returned arrays.

Optimized callback invocation in [IntlChar::enumCharTypes()](https://www.php.net/manual/en/intlchar.enumchartypes.php).

#### JSON

Improved performance of encoding arrays and objects.

Improved performance of indentation generation in [json_encode()](https://www.php.net/manual/en/function.json-encode.php) when using **[`JSON_PRETTY_PRINT`](https://www.php.net/manual/en/json.constants.php#constant.json-pretty-print)**.

#### MBString

Improved performance of [mb_str_pad()](https://www.php.net/manual/en/function.mb-str-pad.php).

#### Phar

Reduced temporary allocations when iterating Phar directories.

#### URI

Improved performance of [Uri\WhatWg\Url::parse()](https://www.php.net/manual/en/uri-whatwg-url.parse.php) when collecting validation errors by pre-allocating the error array.

Reduced allocations when reading IPv6/IPvFuture hosts and paths with [Uri\Rfc3986\Uri](https://www.php.net/manual/en/class.uri-rfc3986-uri.php).

Improved performance and memory consumption when using normalizing (non-raw) getters on already-normalized URIs with [Uri\Rfc3986\Uri](https://www.php.net/manual/en/class.uri-rfc3986-uri.php).

#### Zip

Improved performance of [ZipArchive::addGlob()](https://www.php.net/manual/en/ziparchive.addglob.php) and [ZipArchive::addPattern()](https://www.php.net/manual/en/ziparchive.addpattern.php) by pre-allocating their returned arrays.

Avoid string copies in [ZipArchive::addFromString()](https://www.php.net/manual/en/ziparchive.addfromstring.php).

# [PHP 8.5](https://www.php.net/manual/en/migration85.other-changes.php)

## Other Changes

### Core changes

#### Core

The high resolution timer ([hrtime()](https://www.php.net/manual/en/function.hrtime.php)) on macOS now uses the recommended `clock_gettime_nsec_np(CLOCK_UPTIME_RAW)` API instead of `mach_absolute_time()`.

#### CGI/CLI

The **-z** or **--zend-extension** option has been removed as it was non-functional. Use **-d zend_extension=\[path\]** instead.

#### PDO_ODBC

The fetch behaviour for larger columns has been changed. Rather than fetching 256 byte blocks, PDO_ODBC will try to fetch a larger block size; currently, this is the page size minus string overhead. Drivers that return SQL_NO_TOTAL in SQLGetData are also better handled as well. This should improve compatibility and performance.

### Changes in SAPI Modules

#### CLI

Trying to set a process title that is too long with [cli_set_process_title()](https://www.php.net/manual/en/function.cli-set-process-title.php) will now fail instead of silently truncating the given title.

Added a new **--ini=diff** option to print INI settings changed from the builtin default.

#### FPM

FPM with httpd [» `ProxyPass`](https://httpd.apache.org/docs/current/mod/mod_proxy.html#proxypass) can optionally decode the full script path as of PHP 8.5.0. The new [fastcgi.script_path_encoded](https://www.php.net/manual/en/install.fpm.configuration.php#ini.fastcgi.script-path-encoded) `INI` setting controls this behavior; it defaults to `1` to preserve the previous behavior of not decoding the path.

FPM access log limit now respects [log_limit](https://www.php.net/manual/en/install.fpm.configuration.php#log-limit) value.

### Changed Functions

#### Intl

[grapheme_extract()](https://www.php.net/manual/en/function.grapheme-extract.php) properly assigns `next` value when skipping over invalid starting bytes. Previously there were cases where it would point to the start of the grapheme boundary instead of the end.

[transliterator_get_error_code()](https://www.php.net/manual/en/transliterator.geterrorcode.php), [transliterator_get_error_message()](https://www.php.net/manual/en/transliterator.geterrormessage.php), [TransLiterator::getErrorCode()](https://www.php.net/manual/en/transliterator.geterrorcode.php), and [TransLiterator::getErrorMessage()](https://www.php.net/manual/en/transliterator.geterrormessage.php) have dropped **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** from the return type union. Returning **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** was actually never possible.

The following functions now support a `locale` argument: [grapheme_strpos()](https://www.php.net/manual/en/function.grapheme-strpos.php), [grapheme_stripos()](https://www.php.net/manual/en/function.grapheme-stripos.php), [grapheme_strrpos()](https://www.php.net/manual/en/function.grapheme-strrpos.php), [grapheme_strripos()](https://www.php.net/manual/en/function.grapheme-strripos.php), [grapheme_substr()](https://www.php.net/manual/en/function.grapheme-substr.php), [grapheme_strstr()](https://www.php.net/manual/en/function.grapheme-strstr.php) and [grapheme_stristr()](https://www.php.net/manual/en/function.grapheme-stristr.php)

#### LDAP

[ldap_get_option()](https://www.php.net/manual/en/function.ldap-get-option.php) now accepts a **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** connection, like [ldap_set_option()](https://www.php.net/manual/en/function.ldap-set-option.php), to allow retrieval of global options.

#### libxml

[libxml_set_external_entity_loader()](https://www.php.net/manual/en/function.libxml-set-external-entity-loader.php) now has a formal return type of [true](https://www.php.net/manual/en/language.types.singleton.php).

#### OpenSSL

[openssl_public_encrypt()](https://www.php.net/manual/en/function.openssl-public-encrypt.php) and [openssl_private_decrypt()](https://www.php.net/manual/en/function.openssl-private-decrypt.php) have a new parameter `digest_algo` that allows specifying the hash digest algorithm for OAEP padding.

[openssl_sign()](https://www.php.net/manual/en/function.openssl-sign.php) and [openssl_verify()](https://www.php.net/manual/en/function.openssl-verify.php) have a new parameter `padding` to allow using more secure RSA PSS padding.

[openssl_cms_encrypt()](https://www.php.net/manual/en/function.openssl-cms-encrypt.php) `cipher_algo` parameter can be a string with the cipher name. That allows to use more algorithms including AES GCM cipher algorithms for auth enveloped data.

#### PCNTL

[pcntl_exec()](https://www.php.net/manual/en/function.pcntl-exec.php) now has a formal return type of [false](https://www.php.net/manual/en/language.types.singleton.php).

[pcntl_waitid()](https://www.php.net/manual/en/function.pcntl-waitid.php) takes an additional resource_usage argument to gather various platform specific metrics about the child process.

#### PDO_PGSQL

[Pdo\Pgsql::copyFromArray()](https://www.php.net/manual/en/pdo-pgsql.copyfromarray.php) now supports [iterable](https://www.php.net/manual/en/language.types.iterable.php) inputs.

**Pdo\Pgsql::setAttribute()** and **Pdo\Pgsql::prepare()** support setting **[`PDO::ATTR_PREFETCH`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-prefetch)** to 0 which enters lazy fetch mode. In this mode, statements cannot be run in parallel.

#### PostgreSQL

[pg_copy_from()](https://www.php.net/manual/en/function.pg-copy-from.php) now supports [iterable](https://www.php.net/manual/en/language.types.iterable.php) inputs.

[pg_connect()](https://www.php.net/manual/en/function.pg-connect.php) checks if the connection_string argument contains any null byte.

[pg_close_stmt()](https://www.php.net/manual/en/function.pg-close-stmt.php) checks if the statement_name argument contains any null byte.

#### POSIX

[posix_ttyname()](https://www.php.net/manual/en/function.posix-ttyname.php) sets last_error to EBADF when encountering an invalid file descriptor.

[posix_isatty()](https://www.php.net/manual/en/function.posix-isatty.php) raises an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** message when encountering an invalid file descriptor.

[posix_fpathconf()](https://www.php.net/manual/en/function.posix-fpathconf.php) checks invalid file descriptors and sets last_error to EBADF and raises an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** message.

#### Reflection

The output of [ReflectionClass::\_\_toString()](https://www.php.net/manual/en/reflectionclass.tostring.php) for enums has changed to better indicate that the class is an enum, and that the enum cases are enum cases rather than normal class constants.

The output of [ReflectionProperty::\_\_toString()](https://www.php.net/manual/en/reflectionproperty.tostring.php) for properties with hooks has changed to indicate what hooks the property has, whether those hooks are final, and whether the property is virtual. This also affects the output of [ReflectionClass::\_\_toString()](https://www.php.net/manual/en/reflectionclass.tostring.php) when a class contains hooked properties.

#### Sockets

[socket_create()](https://www.php.net/manual/en/function.socket-create.php)/[socket_bind()](https://www.php.net/manual/en/function.socket-bind.php) can create **[`AF_PACKET`](https://www.php.net/manual/en/sockets.constants.php#constant.af-packet)** family sockets.

[socket_getsockname()](https://www.php.net/manual/en/function.socket-getsockname.php) gets the interface index and its string representation with **[`AF_PACKET`](https://www.php.net/manual/en/sockets.constants.php#constant.af-packet)** socket.

#### Zlib

The `use_include_path` argument for the [gzfile()](https://www.php.net/manual/en/function.gzfile.php), [gzopen()](https://www.php.net/manual/en/function.gzopen.php) and [readgzfile()](https://www.php.net/manual/en/function.readgzfile.php) functions has been changed from [int](https://www.php.net/manual/en/language.types.integer.php) to [bool](https://www.php.net/manual/en/language.types.boolean.php).

[gzfile()](https://www.php.net/manual/en/function.gzfile.php), [gzopen()](https://www.php.net/manual/en/function.gzopen.php) and [readgzfile()](https://www.php.net/manual/en/function.readgzfile.php) functions now respect the default stream context.

### Other Changes to Extensions

#### cURL

[curl_setopt()](https://www.php.net/manual/en/function.curl-setopt.php) with **[`CURLOPT_FOLLOWLOCATION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-followlocation)** option's value no longer is treated as boolean but integer to handle **[`CURLFOLLOW_OBEYCODE`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-obeycode)** and **[`CURLFOLLOW_FIRSTONLY`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-firstonly)**.

#### Fileinfo

Upgraded file from 5.45 to 5.46.

The return type of [finfo_close()](https://www.php.net/manual/en/function.finfo-close.php) has been changed to [true](https://www.php.net/manual/en/language.types.singleton.php), rather than [bool](https://www.php.net/manual/en/language.types.boolean.php).

#### Intl

Intl's internal error mechanism has been modernized so that it indicates more accurately which call site caused what error. Moreover, some ext/date exceptions have been wrapped inside a [IntlException](https://www.php.net/manual/en/class.intlexception.php) now.

#### Lexbor

An always enabled lexbor extension is added. It contains the lexbor library that was separated from [ext/dom](https://www.php.net/manual/en/book.dom.php) for being reused among other extensions. The new extension is not directly exposed to userland.

#### PCRE

Upgraded pcre2lib from 10.44 to 10.46.

#### PDO_Sqlite

Increased minimum release version support from 3.7.7 to 3.7.17.

#### Readline

The return types of [readline_add_history()](https://www.php.net/manual/en/function.readline-add-history.php), [readline_clear_history()](https://www.php.net/manual/en/function.readline-clear-history.php), and [readline_callback_handler_install()](https://www.php.net/manual/en/function.readline-callback-handler-install.php) have been changed to [true](https://www.php.net/manual/en/language.types.singleton.php), rather than [bool](https://www.php.net/manual/en/language.types.boolean.php).

#### Reflection

[ReflectionConstant](https://www.php.net/manual/en/class.reflectionconstant.php) is no longer final.

### Changes to INI File Handling

#### Core

Added [fatal_error_backtraces](https://www.php.net/manual/en/errorfunc.configuration.php#ini.fatal-error-backtraces) to control whether fatal errors should include a backtrace.

Added startup-only max_memory_limit INI setting to control the maximum memory_limit that may be configured at startup or runtime. Exceeding this value emits a warning, unless set to -1, and sets memory_limit to the current max_memory_limit instead.

#### Opcache

Added opcache.file_cache_read_only to support a read-only [opcache.file_cache](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.file-cache) directory, for use with read-only file systems (e.g. read-only Docker containers). Best used with `opcache.validate_timestamps=0`, `opcache.enable_file_override=1`, and `opcache.file_cache_consistency_checks=0`.

> **Note**:
>
> A cache generated with a different build of PHP, a different file path, or different settings (including which extensions are loaded), may be ignored.

The default value of [opcache.jit_hot_loop](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-hot-loop) is now 61 (a prime) to prevent it from being a multiple of loop iteration counts. It is recommended that this parameter is set to a prime number.

Changing [opcache.memory_consumption](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.memory-consumption) when OPcache SHM is already set up will now correctly report a failure instead of silently doing nothing and showing misleading values in PHPInfo.

#### OpenSSL

Added openssl.libctx to select the OpenSSL library context type. Either custom libctx for each thread can be used or a single global (default) libctx is used.

### Performance

#### Core

Remove OPcodes for identity comparisons against booleans, particularly for the `match(true)` pattern.

Add OPcode specialization for `=== []` and `!== []` comparisons.

Creating exception objects is now much faster.

The parts of the code that used SSE2 have been adapted to use SIMD with ARM NEON as well.

Introduced the TAILCALL VM, enabled by default when compiling with Clang\>=19 on x86_64 or aarch64. The TAILCALL VM is as fast as the HYBRID VM used when compiling with GCC. This makes PHP binaries built with Clang\>=19 as fast as binaries built with GCC. The performance of the CALL VM, used with other compilers, has also improved considerably.

#### Intl

Now avoids creating extra string copies when converting strings for use in the collator.

#### MBString

The parts of the code that used SSE2 have been adapted to use SIMD with ARM NEON as well.

#### Opcache

Improved performance of fetching TLS variables in JIT'ed code in non-Glibc builds.

#### Reflection

Improved performance of the following methods:

- [ReflectionProperty::getValue()](https://www.php.net/manual/en/reflectionproperty.getvalue.php)
- [ReflectionProperty::getRawValue()](https://www.php.net/manual/en/reflectionproperty.getrawvalue.php)
- [ReflectionProperty::isInitialized()](https://www.php.net/manual/en/reflectionproperty.isinitialized.php)
- [ReflectionProperty::isInitialized()](https://www.php.net/manual/en/reflectionproperty.isinitialized.php)
- [ReflectionProperty::setValue()](https://www.php.net/manual/en/reflectionproperty.setvalue.php)
- [ReflectionProperty::setRawValue()](https://www.php.net/manual/en/reflectionproperty.setrawvalue.php)

#### SPL

Improved performance of dimension accessors and methods of [SplFixedArray](https://www.php.net/manual/en/class.splfixedarray.php).

#### Standard

Improved performance of array functions with callbacks ([array_find()](https://www.php.net/manual/en/function.array-find.php), [array_filter()](https://www.php.net/manual/en/function.array-filter.php), [array_map()](https://www.php.net/manual/en/function.array-map.php), [usort()](https://www.php.net/manual/en/function.usort.php), ...).

Improved performance of [urlencode()](https://www.php.net/manual/en/function.urlencode.php) and [rawurlencode()](https://www.php.net/manual/en/function.rawurlencode.php).

Improved [unpack()](https://www.php.net/manual/en/function.unpack.php) performance with nameless repetitions by avoiding creating temporary strings and reparsing them.

Improved [pack()](https://www.php.net/manual/en/function.pack.php) performance.

Minor improvements in [array_chunk()](https://www.php.net/manual/en/function.array-chunk.php) performance.

#### XML

Improved [XMLReader](https://www.php.net/manual/en/class.xmlreader.php) property access performance.

Improved [XMLWriter](https://www.php.net/manual/en/class.xmlwriter.php) performance and reduced memory consumption.

# [PHP 8.4](https://www.php.net/manual/en/migration84.other-changes.php)

## Other Changes

### Core changes

#### Closures

Closure names have been adjusted to include the parent function's name and the line of definition to make them easier to distinguish, for example within stack traces.

#### Fibers

Fiber switching during destructor execution is now allowed. It was previously blocked due to conflicts with garbage collection.

Destructors may now be executed in a separate Fiber:

When garbage collection is triggered in a Fiber, destructors called by the GC are executed in a separate Fiber: the gc_destructor_fiber. If this Fiber suspends, a new one is created to execute the remaining destructors. The previous gc_destructor_fiber is not referenced anymore by the GC and may be collected if it's not referenced anywhere else. Objects whose destructor is suspended will not be collected until the destructor returns or the [Fiber](https://www.php.net/manual/en/class.fiber.php) is collected.

#### Output Handlers

Output handler status flags passed to the `flags` parameter of [ob_start()](https://www.php.net/manual/en/function.ob-start.php) are now cleared.

[output_add_rewrite_var()](https://www.php.net/manual/en/function.output-add-rewrite-var.php) now uses [`url_rewriter.hosts`](https://www.php.net/manual/en/outcontrol.configuration.php#ini.url-rewriter.hosts) instead of [`session.trans_sid_hosts`](https://www.php.net/manual/en/session.configuration.php#ini.session.trans-sid-hosts) for selecting hosts that will be rewritten.

### Changes in SAPI Modules

#### apache2handler

Support for EOL Apache 2.0 and 2.2 has been removed. Minimum required Apache version is now 2.4.

#### CLI

The builtin server looks for an index file recursively by traversing parent directories in case the specified file cannot be located. This process was previously skipped if the path looked like it was referring to a file, i.e. if the last path component contained a period. In that case, a 404 error was returned. The behavior has been changed to look for an index file in all cases.

#### FPM

Flushing headers without a body will now succeed.

Status page has a new field to display a memory peak.

The `/dev/poll` `events.mechanism` setting for Solaris/Illumos had been retired.

### Changed Functions

#### Core

[trigger_error()](https://www.php.net/manual/en/function.trigger-error.php) and [user_error()](https://www.php.net/manual/en/function.user-error.php) now have a return type of [true](https://www.php.net/manual/en/language.types.singleton.php) instead of [bool](https://www.php.net/manual/en/language.types.boolean.php).

#### DOM

[DOMDocument::registerNodeClass()](https://www.php.net/manual/en/domdocument.registernodeclass.php) now has a tentative return type of [true](https://www.php.net/manual/en/language.types.singleton.php) instead of [bool](https://www.php.net/manual/en/language.types.boolean.php). It could only ever return **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** in practice.

#### Hash

[hash_update()](https://www.php.net/manual/en/function.hash-update.php) now has a tentative return type of [true](https://www.php.net/manual/en/language.types.singleton.php) instead of [bool](https://www.php.net/manual/en/language.types.boolean.php). It could only ever return **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** in practice.

#### Intl

**[`NumberFormatter::ROUND_TOWARD_ZERO`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.round-toward-zero)** and **[`NumberFormatter::ROUND_AWAY_FROM_ZERO`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.round-away-from-zero)** have been added as aliases for **[`NumberFormatter::ROUND_DOWN`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.round-down)** and **[`NumberFormatter::ROUND_UP`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.round-up)** to be consistent with the new **[`PHP_ROUND_*`](https://www.php.net/manual/en/math.constants.php#constant.php-round-half-up)** modes.

[ResourceBundle::get()](https://www.php.net/manual/en/resourcebundle.get.php) now has a tentative return type of `ResourceBundle|array|string|int|null`.

The [idn_to_ascii()](https://www.php.net/manual/en/function.idn-to-ascii.php) and [idn_to_utf8()](https://www.php.net/manual/en/function.idn-to-utf8.php) functions now always throw [ValueError](https://www.php.net/manual/en/class.valueerror.php)s if the `domain` name is empty or too long.

The [idn_to_ascii()](https://www.php.net/manual/en/function.idn-to-ascii.php) and [idn_to_utf8()](https://www.php.net/manual/en/function.idn-to-utf8.php) functions now always throw [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `variant` parameter is not **[`INTL_IDNA_VARIANT_UTS46`](https://www.php.net/manual/en/intl.constants.php#constant.intl-idna-variant-uts46)**.

#### LibXML

[libxml_set_streams_context()](https://www.php.net/manual/en/function.libxml-set-streams-context.php) now immediately throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php) when a non-stream-context resource is passed to the function, instead of throwing later when the stream context is used.

#### MBString

The behavior of [mb_strcut()](https://www.php.net/manual/en/function.mb-strcut.php) is more consistent now on invalid UTF-8 and UTF-16 strings. There is no behavioural change for valid UTF-8 and UTF-16 strings.

#### ODBC

The `row` of [odbc_fetch_object()](https://www.php.net/manual/en/function.odbc-fetch-object.php), [odbc_fetch_array()](https://www.php.net/manual/en/function.odbc-fetch-array.php), and [odbc_fetch_into()](https://www.php.net/manual/en/function.odbc-fetch-into.php) now have a default value of **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**, consistent with [odbc_fetch_row()](https://www.php.net/manual/en/function.odbc-fetch-row.php). Previously, the default values were `-1`, `-1`, and `0`, respectively.

#### OpenSSL

The `extra_attributes` in [openssl_csr_new()](https://www.php.net/manual/en/function.openssl-csr-new.php) sets the CSR attributes instead of subject DN, which incorrectly done previously.

The `dn` in [openssl_csr_new()](https://www.php.net/manual/en/function.openssl-csr-new.php) allows setting an [array](https://www.php.net/manual/en/language.types.array.php) of values for a single entry.

New `serial_hex` added to [openssl_csr_sign()](https://www.php.net/manual/en/function.openssl-csr-sign.php) to allow setting serial numbers in the hexadecimal format.

Parsing ASN.1 UTCTime with [openssl_x509_parse()](https://www.php.net/manual/en/function.openssl-x509-parse.php) fails if seconds are omitted for OpenSSL version below 3.2 (`-1` is returned for such fields). OpenSSL version above 3.3 did not load such certificates already.

#### PDO

It is now possible to fetch the value of the **[`PDO::ATTR_STRINGIFY_FETCHES`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-stringify-fetches)** attribute with [PDO::getAttribute()](https://www.php.net/manual/en/pdo.getattribute.php).

A new **[`Pdo\Pgsql::ATTR_RESULT_MEMORY_SIZE`](https://www.php.net/manual/en/class.pdo-pgsql.php#pdo-pgsql.constants.attr-result-memory-size)** has been added to retrieve the memory usage of query results with [PDO::getAttribute()](https://www.php.net/manual/en/pdo.getattribute.php) for drivers that support it.

#### PDO_FIREBIRD

It is now possible to fetch the value of the **`FB_ATTR_DATE_FORMAT`**, **`FB_ATTR_TIME_FORMAT`**, **`FB_ATTR_TIMESTAMP_FORMAT`**, attributes with [PDO::getAttribute()](https://www.php.net/manual/en/pdo.getattribute.php).

Added new attributes to specify transaction isolation level and access mode. Five constants relating to this functionality have been added:

- **[`Pdo\Firebird::TRANSACTION_ISOLATION_LEVEL`](https://www.php.net/manual/en/class.pdo-firebird.php#pdo-firebird.constants.transaction-isolation-level)**
- **[`Pdo\Firebird::READ_COMMITTED`](https://www.php.net/manual/en/class.pdo-firebird.php#pdo-firebird.constants.read-committed)**
- **[`Pdo\Firebird::REPEATABLE_READ`](https://www.php.net/manual/en/class.pdo-firebird.php#pdo-firebird.constants.repeatable-read)**
- **[`Pdo\Firebird::SERIALIZABLE`](https://www.php.net/manual/en/class.pdo-firebird.php#pdo-firebird.constants.serializable)**
- **[`Pdo\Firebird::WRITABLE_TRANSACTION`](https://www.php.net/manual/en/class.pdo-firebird.php#pdo-firebird.constants.writable-transaction)**

When using persistent connections, there is now a liveliness check in the constructor.

The content that is built changes depending on the value of **`FB_API_VER`** in `ibase.h`. A new static method [Pdo\Firebird::getApiVersion()](https://www.php.net/manual/en/pdo-firebird.getapiversion.php) can be used to obtain this information. This information is also now referenced in [phpinfo()](https://www.php.net/manual/en/function.phpinfo.php).

Five new data types are now available: `INT128`, `DEC16`, `DEC34`, `TIMESTAMP_TZ`, `TIME_TZ` . These are available starting with Firebird 4.0.

#### PDO_MYSQL

It is now possible to fetch the value of the **[`PDO::ATTR_FETCH_TABLE_NAMES`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-fetch-table-names)** attribute with [PDO::getAttribute()](https://www.php.net/manual/en/pdo.getattribute.php).

#### PDO_PGSQL

Support retrieving the memory usage of queries for **[`Pdo\Pgsql::ATTR_RESULT_MEMORY_SIZE`](https://www.php.net/manual/en/class.pdo-pgsql.php#pdo-pgsql.constants.attr-result-memory-size)**.

If the column is of type `FLOAT4OID` or `FLOAT8OID` the value will now be returned as a [float](https://www.php.net/manual/en/language.types.float.php) instead of a [string](https://www.php.net/manual/en/language.types.string.php).

#### PGSQL

The `conditions` parameter of [pg_select()](https://www.php.net/manual/en/function.pg-select.php) is now optional and accepts an empty array.

#### Phar

The [Phar::setAlias()](https://www.php.net/manual/en/phar.setalias.php), [Phar::setDefaultStub()](https://www.php.net/manual/en/phar.setdefaultstub.php) methods now have a tentative return type of [true](https://www.php.net/manual/en/language.types.singleton.php) instead of [bool](https://www.php.net/manual/en/language.types.boolean.php).

#### POSIX

[posix_isatty()](https://www.php.net/manual/en/function.posix-isatty.php) now sets the error number when the file descriptor/stream argument is invalid.

#### Reflection

[ReflectionGenerator::getFunction()](https://www.php.net/manual/en/reflectiongenerator.getfunction.php) may now be called after the generator finished executing.

#### Sockets

The `backlog` parameter of [socket_create_listen()](https://www.php.net/manual/en/function.socket-create-listen.php) now has a default value of **[`SOMAXCONN`](https://www.php.net/manual/en/sockets.constants.php#constant.somaxconn)**. Previously, it was `128`.

#### Sodium

The sodium_crypto_aead_aes256gcm\_\* functions are now available on aarch64 CPUs with the ARM cryptographic extensions.

#### SPL

The [SplPriorityQueue::insert()](https://www.php.net/manual/en/splpriorityqueue.insert.php), [SplPriorityQueue::recoverFromCorruption()](https://www.php.net/manual/en/splpriorityqueue.recoverfromcorruption.php), [SplHeap::insert()](https://www.php.net/manual/en/splheap.insert.php), [SplHeap::recoverFromCorruption()](https://www.php.net/manual/en/splheap.recoverfromcorruption.php) methods now have a tentative return type of [true](https://www.php.net/manual/en/language.types.singleton.php) instead of [bool](https://www.php.net/manual/en/language.types.boolean.php).

[SplObjectStorage](https://www.php.net/manual/en/class.splobjectstorage.php) now implements [SeekableIterator](https://www.php.net/manual/en/class.seekableiterator.php).

#### Standard

The default `'cost'` value for the **[`PASSWORD_BCRYPT`](https://www.php.net/manual/en/password.constants.php#constant.password-bcrypt)** hashing algorithm for [password_hash()](https://www.php.net/manual/en/function.password-hash.php) has been increased from `10` to `12`.

[debug_zval_dump()](https://www.php.net/manual/en/function.debug-zval-dump.php) now indicates whether an array is packed.

[long2ip()](https://www.php.net/manual/en/function.long2ip.php) now has a return type of [string](https://www.php.net/manual/en/language.types.string.php) instead of `string|false`.

[highlight_string()](https://www.php.net/manual/en/function.highlight-string.php) now has a return type of string\|true instead of `string|bool`.

[print_r()](https://www.php.net/manual/en/function.print-r.php) now has a return type of string\|true instead of `string|bool`.

##### Rounding with [round()](https://www.php.net/manual/en/function.round.php)

The `mode` parameter of the [round()](https://www.php.net/manual/en/function.round.php) function has been widened to `RoundingMode|int`, accepting instances of a new [RoundingMode](https://www.php.net/manual/en/enum.roundingmode.php) enum.

Four new modes have been added to the [round()](https://www.php.net/manual/en/function.round.php) function: RoundingMode::PositiveInfinity, RoundingMode::NegativeInfinity, RoundingMode::TowardsZero, RoundingMode::AwayFromZero

The internal implementation for rounding to integers has been rewritten to be easier to verify for correctness and to be easier to maintain. Some rounding bugs have been fixed as a result of the rewrite. For example previously rounding `0.49999999999999994` to the nearest integer would have resulted in `1.0` instead of the correct result `0.0`. Additional inputs might also be affected and result in different outputs compared to earlier PHP versions.

Fixed a bug caused by "pre-rounding" of the [round()](https://www.php.net/manual/en/function.round.php) function. Previously, using "pre-rounding" to treat a value like `0.285` (actually `0.28499999999999998`) as a decimal number and round it to `0.29`. However, "pre-rounding" incorrectly rounds certain numbers, so this fix removes "pre-rounding" and changes the way numbers are compared, so that the values are correctly rounded as decimal numbers.

The maximum precision that can be handled by [round()](https://www.php.net/manual/en/function.round.php) has been extended by one digit. For example, `round(4503599627370495.5)` returned in `4503599627370495.5`, but now returns `4503599627370496`.

### Other Changes to Extensions

#### cURL

The minimum libcurl version required is now 7.61.0.

The **[`CURLOPT_DNS_USE_GLOBAL_CACHE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-dns-use-global-cache)** option no longer has any effect, and is silently ignored. This underlying feature was deprecated in libcurl 7.11.1, and removed in libcurl 7.62.0.

#### GMP

Casting a [GMP](https://www.php.net/manual/en/class.gmp.php) object to [bool](https://www.php.net/manual/en/language.types.boolean.php) is now possible instead of emitting a **[`E_RECOVERABLE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-recoverable-error)**. The casting behaviour is overloaded such that a [GMP](https://www.php.net/manual/en/class.gmp.php) object representing the value `0` is cast to **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

#### LibXML

The minimum libxml2 version required is now 2.9.4.

#### Intl

Cloning an Intl object consistently throws an [Error](https://www.php.net/manual/en/class.error.php) when the clone cannot be performed, either because the object has not been initialized, or because the underlying ICU clone operation failed. Formerly, most of these classes threw an [Exception](https://www.php.net/manual/en/class.exception.php) instead, and [Spoofchecker](https://www.php.net/manual/en/class.spoofchecker.php) raised a fatal error.

#### MBString

Unicode data tables have been updated to Unicode 16.0.

#### MySQLnd

Support for the new VECTOR data type from MySQL 9.

#### OpenSSL

The minimum OpenSSL version required is now 1.1.1.

#### PDO_PGSQL

The minimum libpq version required is now 10.0.

#### PGSQL

The minimum libpq version required is now 10.0.

#### SPL

Out of bounds accesses in [SplFixedArray](https://www.php.net/manual/en/class.splfixedarray.php) now throw exceptions of type [OutOfBoundsException](https://www.php.net/manual/en/class.outofboundsexception.php) instead of [RuntimeException](https://www.php.net/manual/en/class.runtimeexception.php). Because [OutOfBoundsException](https://www.php.net/manual/en/class.outofboundsexception.php) is a child class of [RuntimeException](https://www.php.net/manual/en/class.runtimeexception.php) no behavioural changes are exhibited when attempting to catch those exceptions.

#### XSL

The typed properties [XSLTProcessor::\$cloneDocument](https://www.php.net/manual/en/class.xsltprocessor.php#xsltprocessor.props.clonedocument) and [XSLTProcessor::\$doXInclude](https://www.php.net/manual/en/class.xsltprocessor.php#xsltprocessor.props.doxinclude) are now declared.

#### Zlib

The minimum zlib version required is now 1.2.11.

### Performance

#### Core

Improved the performance of floating point number parsing and formatting in ZTS builds under highly concurrent loads. This affects the [printf()](https://www.php.net/manual/en/function.printf.php) family of functions as well as serialization functions such as [json_encode()](https://www.php.net/manual/en/function.json-encode.php), or [serialize()](https://www.php.net/manual/en/function.serialize.php).

[sprintf()](https://www.php.net/manual/en/function.sprintf.php) using only `%s` and `%d` specifiers will be compiled into the equivalent string interpolation, avoiding the overhead of a function call and repeatedly parsing the format string.

#### BCMath

Improved performance of number conversions and operations.

#### DOM

The performance of [DOMNode::C14N()](https://www.php.net/manual/en/domnode.c14n.php) is greatly improved for the case without an xpath query. This can give a time improvement of easily two order of magnitude for documents with tens of thousands of nodes.

Improved performance and reduce memory consumption of XML serialization.

Reduced memory usage of node classes.

#### FTP

Improved the performance of FTP uploads up to a factor of 10x for large uploads.

#### Hash

Added SSE2 and SHA-NI implementations of SHA-256. This improves the performance on supported CPUs by ~1.3x (SSE2), and 3x - 5x (SHA-NI). Credit to Colin Percival / Tarsnap for this optimization.

#### MBString

[mb_strcut()](https://www.php.net/manual/en/function.mb-strcut.php) is much faster now for UTF-8 and UTF-16 strings.

Looking up mbstring encoding names is much faster now.

The performance of converting SJIS-win to Unicode is greatly improved.

#### MySQLnd

Improved the performance of MySQLnd quoting.

#### PCRE

Improved the performance of named capture groups.

#### Random

Improved the performance of [Random\Randomizer](https://www.php.net/manual/en/class.random-randomizer.php), with a specific focus on the [Random\Randomizer::getBytes()](https://www.php.net/manual/en/random-randomizer.getbytes.php), and [Random\Randomizer::getBytesFromString()](https://www.php.net/manual/en/random-randomizer.getbytesfromstring.php) methods.

#### SimpleXML

Improved performance and reduce memory consumption of XML serialization.

#### Standard

The performance of [strspn()](https://www.php.net/manual/en/function.strspn.php) and [strcspn()](https://www.php.net/manual/en/function.strcspn.php) is greatly improved. They now run in linear time instead of being bounded by quadratic time.

Improved the performance of [strpbrk()](https://www.php.net/manual/en/function.strpbrk.php).

[get_browser()](https://www.php.net/manual/en/function.get-browser.php) is much faster now, up to 1.5x - 2.5x for some test cases.

# [PHP 8.3](https://www.php.net/manual/en/migration83.other-changes.php)

## Other Changes

### Core changes

#### FFI

[FFI::load()](https://www.php.net/manual/en/ffi.load.php) is now allowed during preloading when [opcache.preload_user](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.preload-user) is the current system user. Previously, calling [FFI::load()](https://www.php.net/manual/en/ffi.load.php) was not possible during preloading if the [opcache.preload_user](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.preload-user) directive was set.

#### FPM

FPM CLI test now fails if the socket path is longer than supported by the OS.

#### Opcache

In the CLI and phpdbg SAPIs, preloading does not require the [opcache.preload_user](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.preload-user) directive to be set anymore when running as root. In other SAPIs, this directive is required when running as root because preloading is done before the SAPI switches to an unprivileged user.

#### Streams

Blocking [fread()](https://www.php.net/manual/en/function.fread.php) on a socket connection returns immediately if there are any buffered data instead of waiting for more data.

A memory stream no longer fails if the seek offset is past the end. Instead, the memory will be increased on the next write and the data between the old end and the offset is filled with zero bytes, similar to how files work.

[stat()](https://www.php.net/manual/en/function.stat.php) access operations like [file_exists()](https://www.php.net/manual/en/function.file-exists.php) and similar will now use real path instead of the actual stream path. This is consistent with stream opening.

### Changes in SAPI Modules

#### CLI

The **[`STDOUT`](https://www.php.net/manual/en/reserved.constants.php#constant.stdout)**, **[`STDERR`](https://www.php.net/manual/en/reserved.constants.php#constant.stderr)** and **[`STDIN`](https://www.php.net/manual/en/reserved.constants.php#constant.stdin)** streams are no longer closed on resource destruction which is mostly when the CLI finishes. It is however still possible to explicitly close those streams using [fclose()](https://www.php.net/manual/en/function.fclose.php) and similar.

### Changed Functions

#### Core

[gc_status()](https://www.php.net/manual/en/function.gc-status.php) has added the following 8 fields:

- `"running"` =\> bool
- `"protected"` =\> bool
- `"full"` =\> bool
- `"buffer_size"` =\> int
- `"application_time"` =\> float: Total application time, in seconds (including collector_time)
- `"collector_time"` =\> float: Time spent collecting cycles, in seconds (including destructor_time and free_time)
- `"destructor_time"` =\> float: Time spent executing destructors during cycle collection, in seconds
- `"free_time"` =\> float: Time spent freeing values during cycle collection, in seconds

[class_alias()](https://www.php.net/manual/en/function.class-alias.php) now supports creating an alias of an internal class.

Setting [open_basedir](https://www.php.net/manual/en/ini.core.php#ini.open-basedir) at runtime using `ini_set('open_basedir', ...);` no longer accepts paths containing the parent directory (`..`). Previously, only paths starting with `..` were disallowed. This could easily be circumvented by prepending `./` to the path.

User exception handlers now catch exceptions during shutdown.

The resultant HTML of [highlight_string()](https://www.php.net/manual/en/function.highlight-string.php) and [highlight_file()](https://www.php.net/manual/en/function.highlight-file.php) has changed. Whitespace between outer HTML tags is removed. Newlines and spaces are no longer converted to HTML entities. The whole HTML is now wrapped in a `<pre>` tag. The outer `<span>` tag has been merged with the `<code>` tag.

#### Calendar

[easter_date()](https://www.php.net/manual/en/function.easter-date.php) now supports years from 1970 to 2,000,000,000 on 64-bit systems, previously it only supported years in the range from 1970 to 2037.

#### Curl

[curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) now supports two new constants: **[`CURLINFO_CAPATH`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-capath)** and **[`CURLINFO_CAINFO`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-cainfo)**. If option is **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**, the following two additional keys are present: `"capath"` and `"cainfo"`.

#### DOM

Changed [DOMCharacterData::appendData()](https://www.php.net/manual/en/domcharacterdata.appenddata.php) tentative return type to [true](https://www.php.net/manual/en/language.types.singleton.php).

[DOMDocument::loadHTML()](https://www.php.net/manual/en/domdocument.loadhtml.php), [DOMDocument::loadHTMLFile()](https://www.php.net/manual/en/domdocument.loadhtmlfile.php), and [DOMDocument::loadXML()](https://www.php.net/manual/en/domdocument.loadxml.php) now have a tentative return type of [bool](https://www.php.net/manual/en/language.types.boolean.php). Previously, this was documented as having a return type of `DOMDocument|bool`, but, as of PHP 8.0.0, [DOMDocument](https://www.php.net/manual/en/class.domdocument.php) cannot be returned as it is no longer statically callable.

#### Gd

The signature of [imagerotate()](https://www.php.net/manual/en/function.imagerotate.php) has changed. The `ignore_transparent` parameter has been removed, as it was ignored since PHP 5.5.0.

#### Intl

[datefmt_set_timezone()](https://www.php.net/manual/en/intldateformatter.settimezone.php) (and its alias [IntlDateformatter::setTimeZone()](https://www.php.net/manual/en/intldateformatter.settimezone.php)) now returns **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** on success, previously **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** was returned.

[IntlBreakiterator::setText()](https://www.php.net/manual/en/intlbreakiterator.settext.php) now returns **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** on failure, previously **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** was returned. It now returns **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** on success, previously **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** was returned.

[IntlChar::enumCharNames()](https://www.php.net/manual/en/intlchar.enumcharnames.php) is now returning a boolean. Previously it returned **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** on success and **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** on failure.

[IntlDateFormatter::\_\_construct()](https://www.php.net/manual/en/intldateformatter.create.php) throws an **[`U_ILLEGAL_ARGUMENT_ERROR`](https://www.php.net/manual/en/intl.constants.php#constant.u-illegal-argument-error)** exception when an invalid locale had been set.

#### MBString

[mb_strtolower()](https://www.php.net/manual/en/function.mb-strtolower.php) and [mb_convert_case()](https://www.php.net/manual/en/function.mb-convert-case.php) implement conditional casing rules for the Greek letter sigma. For [mb_convert_case()](https://www.php.net/manual/en/function.mb-convert-case.php), conditional casing only applies to **[`MB_CASE_LOWER`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-lower)** and **[`MB_CASE_TITLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-title)** modes, not to **[`MB_CASE_LOWER_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-lower-simple)** and **[`MB_CASE_TITLE_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-title-simple)**.

[mb_decode_mimeheader()](https://www.php.net/manual/en/function.mb-decode-mimeheader.php) interprets underscores in QPrint-encoded MIME encoded words as required by RFC 2047; they are converted to spaces. Underscores must be encoded as `"=5F"` in such MIME encoded words.

In rare cases, [mb_encode_mimeheader()](https://www.php.net/manual/en/function.mb-encode-mimeheader.php) will transfer-encode its input string where it would pass it through as raw ASCII in PHP 8.2.

[mb_encode_mimeheader()](https://www.php.net/manual/en/function.mb-encode-mimeheader.php) no longer drops NUL (zero) bytes when QPrint-encoding the input string. This previously caused strings in certain text encodings, especially UTF-16 and UTF-32, to be corrupted by mb_encode_mimeheader.

[mb_detect_encoding()](https://www.php.net/manual/en/function.mb-detect-encoding.php)'s "non-strict" mode now behaves as described in the documentation. Previously, it would return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** if the same byte (for example, the first byte) of the input string was invalid in all candidate encodings. More generally, it would eliminate candidate encodings from consideration when an invalid byte was seen, and if the same input byte eliminated all remaining encodings still under consideration, it would return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. On the other hand, if all candidate encodings but one were eliminated from consideration, it would return the last remaining one without regard for how many encoding errors might be encountered later in the string. This is different from the behavior described in the documentation, which says: "If strict is set to false, the closest matching encoding will be returned."

#### mysqli

[mysqli_fetch_object()](https://www.php.net/manual/en/mysqli-result.fetch-object.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) instead of an [Exception](https://www.php.net/manual/en/class.exception.php) when the `constructor_args` argument is non empty with the class not having a constructor.

[mysqli_poll()](https://www.php.net/manual/en/mysqli.poll.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when neither the `read` nor the `error` arguments are passed.

[mysqli_field_seek()](https://www.php.net/manual/en/mysqli-result.field-seek.php) and [mysqli_result::field_seek()](https://www.php.net/manual/en/mysqli-result.field-seek.php) now specify the return type as [true](https://www.php.net/manual/en/language.types.singleton.php) instead of [bool](https://www.php.net/manual/en/language.types.boolean.php).

#### ODBC

[odbc_autocommit()](https://www.php.net/manual/en/function.odbc-autocommit.php) now accepts **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** for the `enable` parameter. Passing **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** has the same behaviour as passing only 1 parameter, namely indicating if the autocommit feature is enabled or not.

#### PGSQL

[pg_fetch_object()](https://www.php.net/manual/en/function.pg-fetch-object.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) instead of an [Exception](https://www.php.net/manual/en/class.exception.php) when the `constructor_args` argument is non empty with the class not having a constructor.

[pg_insert()](https://www.php.net/manual/en/function.pg-insert.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) instead of a **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** when the table specified is invalid.

[pg_insert()](https://www.php.net/manual/en/function.pg-insert.php) and [pg_convert()](https://www.php.net/manual/en/function.pg-convert.php) raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) or a [TypeError](https://www.php.net/manual/en/class.typeerror.php) instead of a **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** when the value/type of a field does not match properly with a PostgreSQL's type.

The `row` parameter of [pg_fetch_result()](https://www.php.net/manual/en/function.pg-fetch-result.php), [pg_field_prtlen()](https://www.php.net/manual/en/function.pg-field-prtlen.php), and [pg_field_is_null()](https://www.php.net/manual/en/function.pg-field-is-null.php) is now nullable.

#### Random

Changed [mt_srand()](https://www.php.net/manual/en/function.mt-srand.php) and [srand()](https://www.php.net/manual/en/function.srand.php) to not check the number of arguments to determine whether a random seed should be used. Passing **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** will generate a random seed, `0` will use zero as the seed. The functions are now consistent with [Random\Engine\Mt19937::\_\_construct()](https://www.php.net/manual/en/random-engine-mt19937.construct.php).

#### Reflection

Return type of [ReflectionClass::getStaticProperties()](https://www.php.net/manual/en/reflectionclass.getstaticproperties.php) is no longer nullable.

#### Standard

**[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)**s emitted by [unserialize()](https://www.php.net/manual/en/function.unserialize.php) have been promoted to **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)**.

[unserialize()](https://www.php.net/manual/en/function.unserialize.php) now emits a new **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** if the input contains unconsumed bytes.

[array_pad()](https://www.php.net/manual/en/function.array-pad.php) is now only limited by the maximum number of elements an array can have. Before, it was only possible to add at most 1048576 elements at a time.

[strtok()](https://www.php.net/manual/en/function.strtok.php) raises an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** in the case token is not provided when starting tokenization.

[password_hash()](https://www.php.net/manual/en/function.password-hash.php) will now chain the underlying [Random\RandomException](https://www.php.net/manual/en/class.random-randomexception.php) as the [ValueError](https://www.php.net/manual/en/class.valueerror.php)'s `previous` [Exception](https://www.php.net/manual/en/class.exception.php) when salt generation fails.

If using an array as the `command` for [proc_open()](https://www.php.net/manual/en/function.proc-open.php), it must now have at least one non empty element. Otherwise a [ValueError](https://www.php.net/manual/en/class.valueerror.php) is thrown.

[proc_open()](https://www.php.net/manual/en/function.proc-open.php) returns **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** if `command` array is invalid command instead of resource object that produces warning later. This was already the case for Windows but it is now also the case if a posix_spawn implementation is in use (most Linux, BSD and MacOS platforms). There are still some old platforms where this behavior is not changed as posix_spawn is not supported there.

[array_sum()](https://www.php.net/manual/en/function.array-sum.php) and [array_product()](https://www.php.net/manual/en/function.array-product.php) now warn when values in the array cannot be converted to int/float. Previously arrays and objects where ignored whilst every other value was cast to int. Moreover, objects that define a numeric cast (e.g. [GMP](https://www.php.net/manual/en/book.gmp.php)) are now casted instead of ignored.

The `decimals` of [number_format()](https://www.php.net/manual/en/function.number-format.php) now properly handles negative integers. Rounding with a negative value for `decimals` means that `num` is rounded to `decimals` significant digits before the decimal point. Previously negative `decimals` were silently ignored and the number got rounded to zero decimal places.

A new `before_needle` argument has been added to [strrchr()](https://www.php.net/manual/en/function.strrchr.php). It behaves like its counterpart in the [strstr()](https://www.php.net/manual/en/function.strstr.php) or [stristr()](https://www.php.net/manual/en/function.stristr.php) functions.

[str_getcsv()](https://www.php.net/manual/en/function.str-getcsv.php) and [fgetcsv()](https://www.php.net/manual/en/function.fgetcsv.php) now return an empty string instead of a string with a single null byte for the last field which only contains an unterminated enclosure.

### Other Changes to Extensions

#### Core

Using the [increment/decrement](https://www.php.net/manual/en/language.operators.increment.php) operators (`++`/`--`) on values of type [bool](https://www.php.net/manual/en/language.types.boolean.php) now emit warnings. This is because it currently has no effect, but will behave like `$bool += 1` in the future.

Using the [decrement](https://www.php.net/manual/en/language.operators.increment.php) operator (`--`) on values of type [null](https://www.php.net/manual/en/language.types.null.php) now emit warnings. This is because it currently has no effect, but will behave like `$null -= 1` in the future.

Internal objects that implement an \_IS_NUMBER cast but not a do_operator handler that overrides addition and subtraction now can be incremented and decrement as if one would do `$o += 1` or `$o -= 1`

#### DOM

The DOM lifetime mechanism has been reworked such that implicitly removed nodes can still be fetched. Previously this resulted in an exception.

#### SQLite3

The [SQLite3](https://www.php.net/manual/en/class.sqlite3.php) class now throws [SQLite3Exception](https://www.php.net/manual/en/class.sqlite3exception.php) (extends [Exception](https://www.php.net/manual/en/class.exception.php)) instead of [Exception](https://www.php.net/manual/en/class.exception.php).

The SQLite error code is now passed in the exception error code instead of being included in the error message.

### Changes to INI File Handling

- The `assert.*` INI settings have been deprecated. This comprises the following INI settings:

  - [assert.active](https://www.php.net/manual/en/info.configuration.php#ini.assert.active)
  - [assert.bail](https://www.php.net/manual/en/info.configuration.php#ini.assert.bail)
  - [assert.callback](https://www.php.net/manual/en/info.configuration.php#ini.assert.callback)
  - [assert.exception](https://www.php.net/manual/en/info.configuration.php#ini.assert.exception)
  - [assert.warning](https://www.php.net/manual/en/info.configuration.php#ini.assert.warning)

  If the value of the setting is equal to the default value, no deprecation notice is emitted. The [zend.assertions](https://www.php.net/manual/en/ini.core.php#ini.zend.assertions) INI setting should be used instead.

- [zend.max_allowed_stack_size](https://www.php.net/manual/en/info.configuration.php#ini.zend.max-allowed-stack-size) is a new INI directive to set the maximum allowed stack size. Possible values are `0` (detect the process or thread maximum stack size), `-1` (no limit), or a positive number of bytes. The default is `0`. When it is not possible to detect the process or thread maximum stack size, a known system default is used. Setting this value too high has the same effect as disabling the stack size limit. Fibers use [fiber.stack_size](https://www.php.net/manual/en/info.configuration.php#ini.fiber.stack-size) as maximum allowed stack size. An [Error](https://www.php.net/manual/en/class.error.php) is thrown when the process call stack exceeds [zend.max_allowed_stack_size](https://www.php.net/manual/en/info.configuration.php#ini.zend.max-allowed-stack-size)-[zend.reserved_stack_size](https://www.php.net/manual/en/info.configuration.php#ini.zend.reserved-stack-size) bytes, to prevent stack-overflow-induced segmentation faults, with the goal of making debugging easier. The stack size increases during uncontrolled recursions involving internal functions or the magic methods [\_\_toString()](https://www.php.net/manual/en/language.oop5.magic.php#object.tostring), [\_\_clone()](https://www.php.net/manual/en/language.oop5.cloning.php#object.clone), [\_\_sleep()](https://www.php.net/manual/en/language.oop5.magic.php#object.sleep), [\_\_destruct()](https://www.php.net/manual/en/language.oop5.decon.php#object.destruct). This is not related to stack buffer overflows, and is not a security feature.

- [zend.reserved_stack_size](https://www.php.net/manual/en/info.configuration.php#ini.zend.reserved-stack-size) is a new INI directive to set the reserved stack size, in bytes. This is subtracted from the max allowed stack size, as a buffer, when checking the stack size.

### Performance

#### DOM

Looping over a [DOMNodeList](https://www.php.net/manual/en/class.domnodelist.php) now uses caching. Therefore requesting items no longer takes quadratic time by default.

Getting text content from nodes now avoids an allocation, resulting in a performance gain.

[DOMChildNode::remove()](https://www.php.net/manual/en/domchildnode.remove.php) now runs in O(1) performance.

#### Standard

The [file()](https://www.php.net/manual/en/function.file.php) flags error check is now about 7% faster.

#### SPL

[RecursiveDirectoryIterator](https://www.php.net/manual/en/class.recursivedirectoryiterator.php) now performs less I/O when looping over a directory.

# [PHP 8.2](https://www.php.net/manual/en/migration82.other-changes.php)

## Other Changes

### Core changes

The [iterable](https://www.php.net/manual/en/language.types.iterable.php) type is now a built-in compile time alias for [array](https://www.php.net/manual/en/language.types.array.php)\|[Traversable](https://www.php.net/manual/en/class.traversable.php). Error messages relating to `iterable` will therefore now use `array|Traversable`. Type Reflection is preserved for single `iterable` (and `?iterable`) to produce a [ReflectionNamedType](https://www.php.net/manual/en/class.reflectionnamedtype.php) with name `iterable`, however usage of `iterable` in union types will be converted to `array|Traversable`.

The date format of sent cookies is now `'D, d M Y H:i:s \G\M\T'`; previously it was `'D, d-M-Y H:i:s T'`.

### Changes in SAPI Modules

#### CLI

The STDOUT, STDERR and STDIN streams are no longer closed on resource destruction which is mostly when the CLI finishes. It is however still possible to explicitly close those streams using [fclose()](https://www.php.net/manual/en/function.fclose.php) and similar.

### Changed Functions

#### Core

The [strcmp()](https://www.php.net/manual/en/function.strcmp.php), [strcasecmp()](https://www.php.net/manual/en/function.strcasecmp.php), [strncmp()](https://www.php.net/manual/en/function.strncmp.php), [strncasecmp()](https://www.php.net/manual/en/function.strncasecmp.php), and [substr_compare()](https://www.php.net/manual/en/function.substr-compare.php) functions, using binary safe string comparison is no longer guaranteed to return `strlen($string1) - strlen($string2)` when string lengths are not equal, but may now return `-1` or `1` instead. Instead of depending on any concrete value, the return value should be compared to `0`.

#### DBA

[dba_open()](https://www.php.net/manual/en/function.dba-open.php) and [dba_popen()](https://www.php.net/manual/en/function.dba-popen.php) now have the following enforced signature:

function [dba_open](https://www.php.net/manual/en/function.dba-open.php)(  
    [string](https://www.php.net/manual/en/language.types.string.php) `$path`,  
    [string](https://www.php.net/manual/en/language.types.string.php) `$mode`,  
    [?](https://www.php.net/manual/en/language.types.null.php)[string](https://www.php.net/manual/en/language.types.string.php) `$handler` = **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**,  
    [int](https://www.php.net/manual/en/language.types.integer.php) `$permission` = 0644,  
    [int](https://www.php.net/manual/en/language.types.integer.php) `$map_size` = 0,  
    [?](https://www.php.net/manual/en/language.types.null.php)[int](https://www.php.net/manual/en/language.types.integer.php) `$flags` = **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**  
): [resource](https://www.php.net/manual/en/language.types.resource.php)\|[false](https://www.php.net/manual/en/language.types.singleton.php)

[dba_fetch()](https://www.php.net/manual/en/function.dba-fetch.php)'s optional skip argument is now at the end in line with PHP userland semantics. Its signature is now:

function [dba_fetch](https://www.php.net/manual/en/function.dba-fetch.php)([string](https://www.php.net/manual/en/language.types.string.php)\|[array](https://www.php.net/manual/en/language.types.array.php) `$key`, [resource](https://www.php.net/manual/en/language.types.resource.php) `$handle`, [int](https://www.php.net/manual/en/language.types.integer.php) `$skip`): [string](https://www.php.net/manual/en/language.types.string.php)\|[false](https://www.php.net/manual/en/language.types.singleton.php)

The overloaded signature:

function [dba_fetch](https://www.php.net/manual/en/function.dba-fetch.php)([string](https://www.php.net/manual/en/language.types.string.php)\|[array](https://www.php.net/manual/en/language.types.array.php) `$key`, [int](https://www.php.net/manual/en/language.types.integer.php) `$skip`, [resource](https://www.php.net/manual/en/language.types.resource.php) `$handle`): [string](https://www.php.net/manual/en/language.types.string.php)\|[false](https://www.php.net/manual/en/language.types.singleton.php)

is still accepted, but it is recommended to use the new standard variant.

#### Random

[random_bytes()](https://www.php.net/manual/en/function.random-bytes.php) and [random_int()](https://www.php.net/manual/en/function.random-int.php) now throw a [\Random\RandomException](https://www.php.net/manual/en/class.random-randomexception.php) on CSPRNG failures. Previously a plain [\Exception](https://www.php.net/manual/en/class.exception.php) was thrown instead.

#### SPL

The `iterator` parameter of [iterator_to_array()](https://www.php.net/manual/en/function.iterator-to-array.php) and [iterator_count()](https://www.php.net/manual/en/function.iterator-count.php) is widened to [iterable](https://www.php.net/manual/en/language.types.iterable.php) from [Iterator](https://www.php.net/manual/en/class.iterator.php), allowing arrays to be passed.

### Other Changes to Extensions

#### Date

The properties of [DatePeriod](https://www.php.net/manual/en/class.dateperiod.php) are now properly declared.

Default timezone will fall back to UTC if the [date.timezone](https://www.php.net/manual/en/datetime.configuration.php#ini.date.timezone) ini setting is not set.

#### Intl

Instances of [IntlBreakIterator](https://www.php.net/manual/en/class.intlbreakiterator.php), [IntlRuleBasedBreakIterator](https://www.php.net/manual/en/class.intlrulebasedbreakiterator.php), [IntlCodePointBreakIterator](https://www.php.net/manual/en/class.intlcodepointbreakiterator.php), [IntlPartsIterator](https://www.php.net/manual/en/class.intlpartsiterator.php), [IntlCalendar](https://www.php.net/manual/en/class.intlcalendar.php), [Collator](https://www.php.net/manual/en/class.collator.php), [IntlIterator](https://www.php.net/manual/en/class.intliterator.php), [UConverter](https://www.php.net/manual/en/class.uconverter.php), [IntlDateFormatter](https://www.php.net/manual/en/class.intldateformatter.php), [IntlDatePatternGenerator](https://www.php.net/manual/en/class.intldatepatterngenerator.php), [MessageFormatter](https://www.php.net/manual/en/class.messageformatter.php), [ResourceBundle](https://www.php.net/manual/en/class.resourcebundle.php), [Spoofchecker](https://www.php.net/manual/en/class.spoofchecker.php), [IntlTimeZone](https://www.php.net/manual/en/class.intltimezone.php), and [Transliterator](https://www.php.net/manual/en/class.transliterator.php) are no longer serializable. Previously, they could be serialized, but unserialization yielded unusable objects or failed.

#### MySQLi

The support for libmysql has been removed and it is no longer possible to compile mysqli with libmysql. From now on, the mysqli extension can be compiled only with mysqlnd. All libmysql features unavailable in mysqlnd have been removed:

- The reconnect property of [mysqli_driver](https://www.php.net/manual/en/class.mysqli-driver.php)
- The [mysqli.reconnect](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.reconnect) INI directive
- The **[`MYSQLI_IS_MARIADB`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-is-mariadb)** constant has been deprecated

#### OCI8

The minimum Oracle Client library version required is now 11.2.

#### PCRE

NUL characters (`\0`) in pattern strings are now supported.

#### Session

Trying to change the [session.cookie_samesite](https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-samesite) INI directive while the session is active or output has already been sent will now fail and emit a warning. This aligns the behaviour with all other session INI settings.

#### SQLite3

[sqlite3.defensive](https://www.php.net/manual/en/sqlite3.configuration.php#ini.sqlite3.defensive) is now **[`INI_USER`](https://www.php.net/manual/en/info.constants.php#constant.ini-user)**.

#### Standard

[getimagesize()](https://www.php.net/manual/en/function.getimagesize.php) now reports the actual image dimensions, bits and channels of AVIF images. Previously, the dimensions have been reported as 0x0, and bits and channels have not been reported at all.

#### Tidy

The properties of the [tidy](https://www.php.net/manual/en/class.tidy.php) class are now properly declared. And those of the [tidyNode](https://www.php.net/manual/en/class.tidynode.php) class are now properly declared as readonly.

#### Zip

The Zip extension has been updated to version 1.20.0, which adds the following methods:

- [ZipArchive::clearError()](https://www.php.net/manual/en/ziparchive.clearerror.php)
- [ZipArchive::getStreamName()](https://www.php.net/manual/en/ziparchive.getstreamname.php)
- [ZipArchive::getStreamIndex()](https://www.php.net/manual/en/ziparchive.getstreamindex.php)

### Changes to INI File Handling

Support for binary (`0b`/`0B`) and octal (`0o`/`0O`) prefixes has been added to integer INI settings. Integer INI settings that start with a zero (`0`) continue to be interpreted as an octal integer.

Parsing of some ill-formatted values will now trigger a warning when this was silently ignored before. For backwards compatibility, interpretation of these values has not changed. This affects the following settings:

- [bcmath.scale](https://www.php.net/manual/en/bc.configuration.php#ini.bcmath.scale)
- [com.code_page](https://www.php.net/manual/en/com.configuration.php#ini.com.code-page)
- [default_socket_timeout](https://www.php.net/manual/en/filesystem.configuration.php#ini.default-socket-timeout)
- [fiber.stack_size](https://www.php.net/manual/en/info.configuration.php#ini.fiber.stack-size)
- [hard_timeout](https://www.php.net/manual/en/ini.core.php#ini.hard-timeout)
- [intl.error_level](https://www.php.net/manual/en/intl.configuration.php#ini.intl.error-level)
- [ldap.max_links](https://www.php.net/manual/en/ldap.configuration.php#ini.ldap.max_links)
- [max_input_nesting_level](https://www.php.net/manual/en/info.configuration.php#ini.max-input-nesting-level)
- [max_input_vars](https://www.php.net/manual/en/info.configuration.php#ini.max-input-vars)
- [mbstring.regex_retry_limit](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.regex-retry-limit)
- [mbstring.regex_stack_limit](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.regex-stack-limit)
- [mysqli.allow_local_infile](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.allow-local-infile)
- [mysqli.allow_persistent](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.allow-persistent)
- [mysqli.default_port](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.default-port)
- [mysqli.max_links](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.max-links)
- [mysqli.max_persistent](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.max-persistent)
- [mysqli.rollback_on_cached_plink](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.rollback-on-cached-plink)
- [mysqlnd.log_mask](https://www.php.net/manual/en/mysqlnd.config.php#ini.mysqlnd.log-mask)
- [mysqlnd.mempool_default_size](https://www.php.net/manual/en/mysqlnd.config.php#ini.mysqlnd.mempool-default-size)
- [mysqlnd.net_read_buffer_size](https://www.php.net/manual/en/mysqlnd.config.php#ini.mysqlnd.net-read-buffer-size)
- [mysqlnd.net_read_timeout](https://www.php.net/manual/en/mysqlnd.config.php#ini.mysqlnd.net-read-timeout)
- [oci8.default_prefetch](https://www.php.net/manual/en/oci8.configuration.php#ini.oci8.default-prefetch)
- [oci8.max_persistent](https://www.php.net/manual/en/oci8.configuration.php#ini.oci8.max-persistent)
- [oci8.persistent_timeout](https://www.php.net/manual/en/oci8.configuration.php#ini.oci8.persistent-timeout)
- [oci8.ping_interval](https://www.php.net/manual/en/oci8.configuration.php#ini.oci8.ping-interval)
- [oci8.prefetch_lob_size](https://www.php.net/manual/en/oci8.configuration.php#ini.oci8.prefetch-lob-size)
- [oci8.privileged_connect](https://www.php.net/manual/en/oci8.configuration.php#ini.oci8.privileged-connect)
- [oci8.statement_cache_size](https://www.php.net/manual/en/oci8.configuration.php#ini.oci8.statement-cache-size)
- [odbc.allow_persistent](https://www.php.net/manual/en/odbc.configuration.php#ini.uodbc.allow-persistent)
- [odbc.check_persistent](https://www.php.net/manual/en/odbc.configuration.php#ini.uodbc.check-persistent)
- [odbc.max_persistent](https://www.php.net/manual/en/odbc.configuration.php#ini.uodbc.max-persistent)
- [odbc.max_links](https://www.php.net/manual/en/odbc.configuration.php#ini.uodbc.max-links)
- [odbc.defaultbinmode](https://www.php.net/manual/en/odbc.configuration.php#ini.uodbc.defaultbinmode)
- [odbc.default_cursortype](https://www.php.net/manual/en/odbc.configuration.php#ini.uodbc.defaultcursortype)
- [odbc.defaultlrl](https://www.php.net/manual/en/odbc.configuration.php#ini.uodbc.defaultlrl)
- [opcache.consistency_checks](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.consistency-checks)
- [opcache.file_update_protection](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.file_update_protection)
- [opcache.force_restart_timeout](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.force-restart-timeout)
- [opcache.interned_strings_buffer](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.interned-strings-buffer)
- [opcache.jit_bisect_limit](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-bisect-limit)
- [opcache.jit_blacklist_root_trace](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-blacklist-root-trace)
- [opcache.jit_blacklist_side_trace](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-blacklist-side-trace)
- [opcache.jit_debug](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-debug)
- [opcache.jit_hot_func](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-hot-func)
- [opcache.jit_hot_loop](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-hot-loop)
- [opcache.jit_hot_return](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-hot-return)
- [opcache.jit_hot_side_exit](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-hot-side-exit)
- [opcache.jit_max_exit_counters](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-max-exit-counters)
- [opcache.jit_max_loop_unrolls](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-max-loop-unrolls)
- [opcache.jit_max_polymorphic_calls](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-max-polymorphic-calls)
- [opcache.jit_max_recursive_calls](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-max-recursive-calls)
- [opcache.jit_max_recursive_returns](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-max-recursive-return)
- [opcache.jit_max_root_traces](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-max-root-traces)
- [opcache.jit_max_side_traces](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-max-side-traces)
- [opcache.log_verbosity_level](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.log-verbosity-level)
- [opcache.max_file_size](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.max-file-size)
- [opcache.opt_debug_level](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.opt_debug_level)
- [opcache.optimization_level](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.optimization-level)
- [opcache.revalidate_freq](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.revalidate-freq)
- [output_buffering](https://www.php.net/manual/en/outcontrol.configuration.php#ini.output-buffering)
- [pcre.backtrack_limit](https://www.php.net/manual/en/pcre.configuration.php#ini.pcre.backtrack-limit)
- [pcre.recursion_limit](https://www.php.net/manual/en/pcre.configuration.php#ini.pcre.recursion-limit)
- [pgsql.max_links](https://www.php.net/manual/en/pgsql.configuration.php#ini.pgsql.max-links)
- [pgsql.max_persistent](https://www.php.net/manual/en/pgsql.configuration.php#ini.pgsql.max-persistent)
- [post_max_size](https://www.php.net/manual/en/ini.core.php#ini.post-max-size)
- [realpath_cache_size](https://www.php.net/manual/en/ini.core.php#ini.realpath-cache-size)
- [realpath_cache_ttl](https://www.php.net/manual/en/ini.core.php#ini.realpath-cache-ttl)
- [session.cache_expire](https://www.php.net/manual/en/session.configuration.php#ini.session.cache-expire)
- [session.cookie_lifetime](https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-lifetime)
- [session.gc_divisor](https://www.php.net/manual/en/session.configuration.php#ini.session.gc-divisor)
- [session.gc_maxlifetime](https://www.php.net/manual/en/session.configuration.php#ini.session.gc-maxlifetime)
- [session.gc_probability](https://www.php.net/manual/en/session.configuration.php#ini.session.gc-probability)
- [soap.wsdl_cache_limit](https://www.php.net/manual/en/soap.configuration.php#ini.soap.wsdl-cache-limit)
- [soap.wsdl_cache_ttl](https://www.php.net/manual/en/soap.configuration.php#ini.soap.wsdl-cache-ttl)
- [unserialize_max_depth](https://www.php.net/manual/en/var.configuration.php#ini.unserialize-max-depth)
- [upload_max_filesize](https://www.php.net/manual/en/ini.core.php#ini.upload-max-filesize)
- [user_ini.cache_ttl](https://www.php.net/manual/en/ini.core.php#ini.user-ini.cache-ttl)
- [xmlrpc_error_number](https://www.php.net/manual/en/errorfunc.configuration.php#ini.xmlrpc-error-number)
- [zend.assertions](https://www.php.net/manual/en/ini.core.php#ini.zend.assertions)
- [zlib.output_compression_level](https://www.php.net/manual/en/zlib.configuration.php#ini.zlib.output-compression-level)

# [PHP 8.1](https://www.php.net/manual/en/migration81.other-changes.php)

## Other Changes

### Changes in SAPI Modules

#### CLI

Using **-a** without the [readline extension](https://www.php.net/manual/en/book.readline.php) will now result in an error. Previously, **-a** without readline had the same behavior as calling **php** without any arguments, apart from printing an additional `"Interactive mode enabled"` message. This mode was *not* interactive.

#### PHPDBG

Remote functionality from [phpdbg](https://www.php.net/manual/en/book.phpdbg.php) has been removed.

### Changed Functions

#### Core

The order of properties used in [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php), [var_dump()](https://www.php.net/manual/en/function.var-dump.php), [serialize()](https://www.php.net/manual/en/function.serialize.php), object comparison, etc. was changed. Properties are now ordered naturally according to their declaration and inheritance. Properties declared in a base class are going to be before the child properties.

This order is consistent with internal layout of properties in `zend_object` structure and repeats the order in `default_properties_table[]` and `properties_info_table[]`. The old order was not documented and was caused by class inheritance implementation details.

#### Filter

The **[`FILTER_FLAG_ALLOW_OCTAL`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-flag-allow-octal)** flag of the **[`FILTER_VALIDATE_INT`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-validate-int)** filter now accept octal string with the leading octal prefix (`"0o"`/`"0O"`).

#### GMP

All [GMP](https://www.php.net/manual/en/book.gmp.php) functions now accept octal string with the leading octal prefix (`"0o"`/`"0O"`).

#### PDO ODBC

[PDO::getAttribute()](https://www.php.net/manual/en/pdo.getattribute.php) with **[`PDO::ATTR_SERVER_INFO`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-server-info)** and **[`PDO::ATTR_SERVER_VERSION`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-server-version)** now return values instead of throwing [PDOException](https://www.php.net/manual/en/class.pdoexception.php).

#### Reflection

[ReflectionProperty::setAccessible()](https://www.php.net/manual/en/reflectionproperty.setaccessible.php) and [ReflectionMethod::setAccessible()](https://www.php.net/manual/en/reflectionmethod.setaccessible.php) no longer have an effect. Properties and methods are now always considered accessible via Reflection.

#### Standard

[syslog()](https://www.php.net/manual/en/function.syslog.php) is now binary safe.

### Other Changes to Extensions

#### GD

[imagewebp()](https://www.php.net/manual/en/function.imagewebp.php) can now do lossless WebP encoding by passing **[`IMG_WEBP_LOSSLESS`](https://www.php.net/manual/en/image.constants.php#constant.img-webp-lossless)** as the quality.

This constant is only defined, if the used libgd supports lossless WebP encoding.

#### MySQLi

[mysqli_stmt::next_result()](https://www.php.net/manual/en/mysqli-stmt.next-result.php) and **mysqli::fetch_all()** are now available when linking against libmysqlclient.

#### OpenSSL

- The [OpenSSL extension](https://www.php.net/manual/en/book.openssl.php) now requires at least OpenSSL version 1.0.2.

- OpenSSL 3.0 is now supported. Be aware that many ciphers are no longer enabled by default (part of the legacy provider), and that parameter validation (e.g. minimum key sizes) is stricter now.

#### Phar

- SHA256 is now used by default for signatures.

- Added support for OpenSSL_SHA256 and OpenSSL_SHA512 signatures.

#### SNMP

- Added support for SHA256 and SHA512 for the security protocol.

#### Standard

`--with-password-argon2` now uses pkg-config to detect libargon2. As such, an alternative libargon2 location should now be specified using `PKG_CONFIG_PATH`.

### Changes to INI File Handling

- The [log_errors_max_len](https://www.php.net/manual/en/errorfunc.configuration.php#ini.log-errors-max-len) INI directive has been removed. It no longer had an effect since PHP 8.0.0.

- A leading dollar in a quoted string can now be escaped: `"\${"` will now be interpreted as a string with contents `${`.

- Backslashes in double quoted strings are now more consistently treated as escape characters. Previously, `"foo\\"` followed by something other than a newline was not considered as a terminated string. It is now interpreted as a string with contents `foo\`. However, as an exception, the string `"foo\"` followed by a newline will continue to be treated as a valid string with contents `foo\` rather than an unterminated string. This exception exists to support naive uses of Windows file paths such as `"C:\foo\"`.

# [PHP 8.0](https://www.php.net/manual/en/migration80.other-changes.php)

## Other Changes

### Changes in SAPI Modules

#### Apache2Handler

The PHP module has been renamed from `php7_module` to `php_module`.

### Changed Functions

#### Reflection

[ReflectionClass::getConstants()](https://www.php.net/manual/en/reflectionclass.getconstants.php) and [ReflectionClass::getReflectionConstants()](https://www.php.net/manual/en/reflectionclass.getreflectionconstants.php) results can be now filtered via a new parameter `filter`. Three new constants were added to be used with it:

- **[`ReflectionClassConstant::IS_PUBLIC`](https://www.php.net/manual/en/class.reflectionclassconstant.php#reflectionclassconstant.constants.is-public)**
- **[`ReflectionClassConstant::IS_PROTECTED`](https://www.php.net/manual/en/class.reflectionclassconstant.php#reflectionclassconstant.constants.is-protected)**
- **[`ReflectionClassConstant::IS_PRIVATE`](https://www.php.net/manual/en/class.reflectionclassconstant.php#reflectionclassconstant.constants.is-private)**

#### Standard

The math functions [abs()](https://www.php.net/manual/en/function.abs.php), [ceil()](https://www.php.net/manual/en/function.ceil.php), [floor()](https://www.php.net/manual/en/function.floor.php) and [round()](https://www.php.net/manual/en/function.round.php) now properly heed [the `strict_types` directive](https://www.php.net/manual/en/language.types.declarations.php#language.types.declarations.strict). Previously, they coerced the first argument even in strict type mode.

#### Zip

- The [ZipArchive::addGlob()](https://www.php.net/manual/en/ziparchive.addglob.php) and [ZipArchive::addPattern()](https://www.php.net/manual/en/ziparchive.addpattern.php) methods accept more values in the `options` array argument:

  - `flags`
  - `comp_method`
  - `comp_flags`
  - `env_method`
  - `enc_password`

- [ZipArchive::addEmptyDir()](https://www.php.net/manual/en/ziparchive.addemptydir.php), [ZipArchive::addFile()](https://www.php.net/manual/en/ziparchive.addfile.php) and [ZipArchive::addFromString()](https://www.php.net/manual/en/ziparchive.addfromstring.php) methods have a new `flags` argument. This allows managing name encoding (**[`ZipArchive::FL_ENC_*`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.fl-enc-guess)**) and entry replacement (**[`ZipArchive::FL_OVERWRITE`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.fl-overwrite)**).

- [ZipArchive::extractTo()](https://www.php.net/manual/en/ziparchive.extractto.php) now restores the file modification time.

### Other Changes to Extensions

#### CURL

- The CURL extension now requires at least libcurl 7.29.0.

- The deprecated parameter `version` of [curl_version()](https://www.php.net/manual/en/function.curl-version.php) has been removed.

#### Date and Time

[DatePeriod](https://www.php.net/manual/en/class.dateperiod.php) now implements [IteratorAggregate](https://www.php.net/manual/en/class.iteratoraggregate.php) (instead of [Traversable](https://www.php.net/manual/en/class.traversable.php)).

#### DOM

[DOMNamedNodeMap](https://www.php.net/manual/en/class.domnamednodemap.php) and [DOMNodeList](https://www.php.net/manual/en/class.domnodelist.php) now implement [IteratorAggregate](https://www.php.net/manual/en/class.iteratoraggregate.php) (instead of [Traversable](https://www.php.net/manual/en/class.traversable.php)).

#### Intl

[IntlBreakIterator](https://www.php.net/manual/en/class.intlbreakiterator.php) and [ResourceBundle](https://www.php.net/manual/en/class.resourcebundle.php) now implement [IteratorAggregate](https://www.php.net/manual/en/class.iteratoraggregate.php) (instead of [Traversable](https://www.php.net/manual/en/class.traversable.php)).

#### Enchant

The enchant extension now uses libenchant-2 by default when available. libenchant version 1 is still supported but is deprecated and could be removed in the future.

#### GD

- The `num_points` parameter of [imagepolygon()](https://www.php.net/manual/en/function.imagepolygon.php), [imageopenpolygon()](https://www.php.net/manual/en/function.imageopenpolygon.php) and [imagefilledpolygon()](https://www.php.net/manual/en/function.imagefilledpolygon.php) is now optional, i.e. these functions may be called with either 3 or 4 arguments. If the argument is omitted, it is calculated as `count($points)/2`.

- The function [imagegetinterpolation()](https://www.php.net/manual/en/function.imagegetinterpolation.php) to get the current interpolation method has been added.

#### JSON

The JSON extension cannot be disabled anymore and is always an integral part of any PHP build, similar to the date extension.

#### MBString

The Unicode data tables have been updated to version 13.0.0.

#### PDO

[PDOStatement](https://www.php.net/manual/en/class.pdostatement.php) now implements [IteratorAggregate](https://www.php.net/manual/en/class.iteratoraggregate.php) (instead of [Traversable](https://www.php.net/manual/en/class.traversable.php)).

#### LibXML

The minimum required libxml version is now 2.9.0. This means that external entity loading is now guaranteed to be disabled by default, and no extra steps need to be taken to protect against XXE attacks.

#### MySQLi / PDO MySQL

- When mysqlnd is not used (which is the default and recommended option), the minimum supported libmysqlclient version is now 5.5.

- [mysqli_result](https://www.php.net/manual/en/class.mysqli-result.php) now implements [IteratorAggregate](https://www.php.net/manual/en/class.iteratoraggregate.php) (instead of [Traversable](https://www.php.net/manual/en/class.traversable.php)).

#### PGSQL / PDO PGSQL

The PGSQL and PDO PGSQL extensions now require at least libpq 9.1.

#### Readline

Calling [readline_completion_function()](https://www.php.net/manual/en/function.readline-completion-function.php) before the interactive prompt starts (e.g. in [auto_prepend_file](https://www.php.net/manual/en/ini.core.php#ini.auto-prepend-file)) will now override the default interactive prompt completion function. Previously, [readline_completion_function()](https://www.php.net/manual/en/function.readline-completion-function.php) only worked when called after starting the interactive prompt.

#### SimpleXML

[SimpleXMLElement](https://www.php.net/manual/en/class.simplexmlelement.php) now implements [RecursiveIterator](https://www.php.net/manual/en/class.recursiveiterator.php) and absorbed the functionality of [SimpleXMLIterator](https://www.php.net/manual/en/class.simplexmliterator.php). [SimpleXMLIterator](https://www.php.net/manual/en/class.simplexmliterator.php) is an empty extension of [SimpleXMLElement](https://www.php.net/manual/en/class.simplexmlelement.php).

### Changes to INI File Handling

- com.dotnet_version is a new INI directive to choose the version of the .NET framework to use for [dotnet](https://www.php.net/manual/en/class.dotnet.php) objects.

- zend.exception_string_param_max_len is a new INI directive to set the maximum string length in an argument of a stringified stack strace.

### EBCDIC

EBCDIC targets are no longer supported, though it's unlikely that they were still working in the first place.

### Performance

- A Just-In-Time (JIT) compiler has been added to the opcache extension.

- [array_slice()](https://www.php.net/manual/en/function.array-slice.php) on an array without gaps will no longer scan the whole array to find the start offset. This may significantly reduce the runtime of the function with large offsets and small lengths.

- [strtolower()](https://www.php.net/manual/en/function.strtolower.php) now uses a SIMD implementation when using the `"C"` **[`LC_CTYPE`](https://www.php.net/manual/en/string.constants.php#constant.lc-ctype)** locale (which is the default).

# [PHP 7.4](https://www.php.net/manual/en/migration74.other-changes.php)

## Other Changes

### Performance Improvements

#### PHP Core

A specialized VM opcode for the [array_key_exists()](https://www.php.net/manual/en/function.array-key-exists.php) function has been added, which improves performance of this function if it can be statically resolved. In namespaced code, this may require writing `\array_key_exists()` or explicitly importing the function.

#### Regular Expressions (Perl-Compatible)

When [preg_match()](https://www.php.net/manual/en/function.preg-match.php) in UTF-8 mode (`"u"` modifier) is repeatedly called on the same string (but possibly different offsets), it will only be checked for UTF-8 validity once.

### Changes to INI File Handling

[zend.exception_ignore_args](https://www.php.net/manual/en/ini.core.php#ini.zend.exception-ignore-args) is a new INI directive for including or excluding arguments from stack traces generated from exceptions.

[opcache.preload_user](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.preload-user) is a new INI directive for specifying the user account under which preloading code is executed if it would otherwise be run as root (which is not allowed for security reasons).

### Migration to pkg-config

A number of extensions have been migrated to exclusively use pkg-config for the detection of library dependencies. Generally, this means that instead of using **--with-foo-dir=DIR** or similar only **--with-foo** is used. Custom library paths can be specified either by adding additional directories to `PKG_CONFIG_PATH` or by explicitly specifying compilation options through `FOO_CFLAGS` and `FOO_LIBS`.

The following extensions and SAPIs are affected:

- CURL:

  - **--with-curl** no longer accepts a directory.

- Enchant:

  - **--with-enchant** no longer accepts a directory.

- FPM:

  - **--with-fpm-systemd** now uses only pkg-config for libsystem checks. The libsystemd minimum required version is 209.

- GD:

  - **--with-gd** becomes **--enable-gd** (whether to enable the extension at all) and **--with-external-gd** (to opt into using an external libgd, rather than the bundled one).

  - **--with-png-dir** has been removed. libpng is required.

  - **--with-zlib-dir** has been removed. zlib is required.

  - **--with-freetype-dir** becomes **--with-freetype**

  - **--with-jpeg-dir** becomes **--with-jpeg**

  - **--with-webp-dir** becomes **--with-webp**

  - **--with-xpm-dir** becomes **--with-xpm**

- IMAP:

  - **--with-kerberos-systemd** no longer accepts a directory.

- Intl:

  - **--with-icu-dir** has been removed. If **--enable-intl** is passed, then libicu is always required.

- LDAP:

  - **--with-ldap-sasl** no longer accepts a directory.

- Libxml:

  - **--with-libxml-dir** has been removed.

  - **--enable-libxml** becomes **--with-libxml**.

  - **--with-libexpat-dir** has been renamed to **--with-expat** and no longer accepts a directory.

- LiteSpeed:

  - **--with-litespeed** becomes **--enable-litespeed**.

- Mbstring:

  - **--with-onig** has been removed. Unless **--disable-mbregex** has been passed, libonig is required.

- ODBC:

  - **--with-iodbc** no longer accepts a directory.

  - **--with-unixODBC** without a directory now uses pkg-config (preferred). Directory is still accepted for old versions without libodbc.pc.

- OpenSSL:

  - **--with-openssl** no longer accepts a directory.

- PCRE:

  - **--with-pcre-regex** has been removed. Instead **--with-external-pcre** is provided to opt into using an external PCRE library, rather than the bundled one.

- PDO_SQLite:

  - **--with-pdo-sqlite** no longer accepts a directory.

- Readline:

  - **--with-libedit** no longer accepts a directory.

- Sodium:

  - **--with-sodium** no longer accepts a directory.

- SQLite3:

  - **--with-sqlite3** no longer accepts a directory.

- XSL:

  - **--with-xsl** no longer accepts a directory.

- Zip:

  - **--with-libzip** has been removed.

  - **--enable-zip** becomes **--with-zip**.

### CSV escaping

[fputcsv()](https://www.php.net/manual/en/function.fputcsv.php), [fgetcsv()](https://www.php.net/manual/en/function.fgetcsv.php), [SplFileObject::fputcsv()](https://www.php.net/manual/en/splfileobject.fputcsv.php), [SplFileObject::fgetcsv()](https://www.php.net/manual/en/splfileobject.fgetcsv.php), and [SplFileObject::setCsvControl()](https://www.php.net/manual/en/splfileobject.setcsvcontrol.php) now accept an empty string as `$escape` argument, which disables the proprietary PHP escaping mechanism.

The behavior of [str_getcsv()](https://www.php.net/manual/en/function.str-getcsv.php) has been adjusted accordingly (formerly, an empty string was identical to using the default).

[SplFileObject::getCsvControl()](https://www.php.net/manual/en/splfileobject.getcsvcontrol.php) now may also return an empty string for the third array element, accordingly.

### Data Filtering

The [filter](https://www.php.net/manual/en/book.filter.php) extension no longer exposes **--with-pcre-dir** for Unix builds and can now reliably be built as shared when using **./configure**

### GD

The behavior of [imagecropauto()](https://www.php.net/manual/en/function.imagecropauto.php) in the bundled libgd has been synced with that of system libgd:

- **[`IMG_CROP_DEFAULT`](https://www.php.net/manual/en/image.constants.php#constant.img-crop-default)** is no longer falling back to **[`IMG_CROP_SIDES`](https://www.php.net/manual/en/image.constants.php#constant.img-crop-sides)**

- Threshold-cropping now uses the algorithm of system libgd

The default `$mode` parameter of [imagecropauto()](https://www.php.net/manual/en/function.imagecropauto.php) has been changed to **[`IMG_CROP_DEFAULT`](https://www.php.net/manual/en/image.constants.php#constant.img-crop-default)**; passing `-1` is now deprecated.

[imagescale()](https://www.php.net/manual/en/function.imagescale.php) now supports aspect ratio preserving scaling to a fixed height by passing `-1` as `$new_width`.

### HASH Message Digest Framework

The [hash](https://www.php.net/manual/en/book.hash.php) extension cannot be disabled anymore and is always an integral part of any PHP build, similar to the [date](https://www.php.net/manual/en/book.datetime.php) extension.

### Intl

The [intl](https://www.php.net/manual/en/book.intl.php) extension now requires at least ICU 50.1.

[ResourceBundle](https://www.php.net/manual/en/class.resourcebundle.php) now implements [Countable](https://www.php.net/manual/en/class.countable.php).

### Lightweight Directory Access Protocol

Support for nsldap and umich_ldap has been removed.

### Libxml

All libxml-based extensions now require libxml 2.7.6 or newer.

### Multibyte String

The oniguruma library is no longer bundled with PHP, instead libonig needs to be available on the system. Alternatively **--disable-mbregex** can be used to disable the mbregex component.

### OPcache

The **--disable-opcache-file** and **--enable-opcache-file** configure options have been removed in favor of the [opcache.file_cache](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.file-cache) INI directive.

### Password Hashing

The [password_hash()](https://www.php.net/manual/en/function.password-hash.php) and [password_needs_rehash()](https://www.php.net/manual/en/function.password-needs-rehash.php) functions now accept nullable [string](https://www.php.net/manual/en/language.types.string.php) and [int](https://www.php.net/manual/en/language.types.integer.php) for `$algo` argument.

### PEAR

Installation of PEAR (including PECL) is no longer enabled by default. It can be explicitly enabled using **--with-pear**. This option is deprecated and may be removed in the future.

### Reflection

The numeric values of the modifier constants (`IS_ABSTRACT`, `IS_DEPRECATED`, `IS_EXPLICIT_ABSTRACT`, `IS_FINAL`, `IS_IMPLICIT_ABSTRACT`, `IS_PRIVATE`, `IS_PROTECTED`, `IS_PUBLIC`, and `IS_STATIC`) on the [ReflectionClass](https://www.php.net/manual/en/class.reflectionclass.php), [ReflectionFunction](https://www.php.net/manual/en/class.reflectionfunction.php), [ReflectionMethod](https://www.php.net/manual/en/class.reflectionmethod.php), [ReflectionObject](https://www.php.net/manual/en/class.reflectionobject.php), and [ReflectionProperty](https://www.php.net/manual/en/class.reflectionproperty.php) classes have changed.

### SimpleXML

[SimpleXMLElement](https://www.php.net/manual/en/class.simplexmlelement.php) now implements [Countable](https://www.php.net/manual/en/class.countable.php).

### SQLite3

The bundled libsqlite has been removed. To build the [SQLite3](https://www.php.net/manual/en/book.sqlite3.php) extension a system libsqlite3 ≥ 3.7.4 is now required. To build the [PDO_SQLite](https://www.php.net/manual/en/ref.pdo-sqlite.php) extension a system libsqlite3 ≥ 3.5.0 is now required.

Serialization and unserialization of [SQLite3](https://www.php.net/manual/en/class.sqlite3.php), [SQLite3Stmt](https://www.php.net/manual/en/class.sqlite3stmt.php) and [SQLite3Result](https://www.php.net/manual/en/class.sqlite3result.php) is now explicitly forbidden. Formerly, serialization of instances of these classes was possible, but unserialization yielded unusable objects.

The `@param` notation can now also be used to denote SQL query parameters.

### Zip

The bundled libzip library has been removed. A system libzip \>= 0.11 is now necessary to build the [zip](https://www.php.net/manual/en/book.zip.php) extension.

# [PHP 7.3](https://www.php.net/manual/en/migration73.other-changes.php)

## Other Changes

### PHP Core

#### Set(raw)cookie accepts \$option Argument

[setcookie()](https://www.php.net/manual/en/function.setcookie.php) and [setrawcookie()](https://www.php.net/manual/en/function.setrawcookie.php) now also support the following signature:

function [setcookie](https://www.php.net/manual/en/function.setcookie.php)([string](https://www.php.net/manual/en/language.types.string.php) `$name`, [string](https://www.php.net/manual/en/language.types.string.php) `$value` = "", [array](https://www.php.net/manual/en/language.types.array.php) `$options` = \[\]): [bool](https://www.php.net/manual/en/language.types.boolean.php)

where `$options` is an associative array which may have any of the keys `"expires"`, `"path"`, `"domain"`, `"secure"`, `"httponly"` and `"samesite"`.

#### New Syslog ini Directives

The following ini Directives have been added to customize logging, if [error_log](https://www.php.net/manual/en/errorfunc.configuration.php#ini.error-log) is set to `syslog`:

[syslog.facility](https://www.php.net/manual/en/errorfunc.configuration.php#ini.syslog.facility)  
Specifies what type of program is logging the message.

[syslog.filter](https://www.php.net/manual/en/errorfunc.configuration.php#ini.syslog.filter)  
Specifies the filter type to filter the logged messages, with the supported filter types - `all`, `no-ctrl` and `ascii`. Starting with PHP 7.3.8, `raw` is also available, restoring the way syslog behaved in previous PHP versions. This filter will also affect calls to [syslog()](https://www.php.net/manual/en/function.syslog.php).

[syslog.ident](https://www.php.net/manual/en/errorfunc.configuration.php#ini.syslog.ident)  
Specifies the ident string which is prepended to every message.

#### Garbage Collection

The [cyclic GC](https://www.php.net/manual/en/features.gc.collecting-cycles.php) has been enhanced, which may result in considerable performance improvements.

#### Miscellaneous

[var_export()](https://www.php.net/manual/en/function.var-export.php) now exports [stdClass](https://www.php.net/manual/en/class.stdclass.php) objects as an array cast to an object (`(object) array( ... )`), rather than using the nonexistent method **stdClass::\_\_setState()**.

[debug_zval_dump()](https://www.php.net/manual/en/function.debug-zval-dump.php) was changed to display recursive arrays and objects in the same way as [var_dump()](https://www.php.net/manual/en/function.var-dump.php). Now, it doesn't display them twice.

[array_push()](https://www.php.net/manual/en/function.array-push.php) and [array_unshift()](https://www.php.net/manual/en/function.array-unshift.php) can now also be called with a single argument, which is particularly convenient wrt. the spread operator.

### Interactive PHP Debugger

The unused constants **[`PHPDBG_FILE`](https://www.php.net/manual/en/phpdbg.constants.php#constant.phpdbg-file)**, **[`PHPDBG_METHOD`](https://www.php.net/manual/en/phpdbg.constants.php#constant.phpdbg-method)**, **[`PHPDBG_LINENO`](https://www.php.net/manual/en/phpdbg.constants.php#constant.phpdbg-lineno)** and **[`PHPDBG_FUNC`](https://www.php.net/manual/en/phpdbg.constants.php#constant.phpdbg-func)** have been removed.

### FastCGI Process Manager

The [getallheaders()](https://www.php.net/manual/en/function.getallheaders.php) function is now also available.

### Client URL Library

libcurl ≥ 7.15.5 is now required.

### Data Filtering

**[`FILTER_VALIDATE_FLOAT`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-validate-float)** now also supports a `thousand` option, which defines the set of allowed thousand separator chars. The default (`"',."`) is fully backward compatible with former PHP versions.

**[`FILTER_SANITIZE_ADD_SLASHES`](https://www.php.net/manual/en/filter.constants.sanitization.php#constant.filter-sanitize-add-slashes)** has been added as an alias of the `magic_quotes` filter (**[`FILTER_SANITIZE_MAGIC_QUOTES`](https://www.php.net/manual/en/filter.constants.sanitization.php#constant.filter-sanitize-magic-quotes)**). The `magic_quotes` filter is subject to removal in future versions of PHP.

### FTP

The default transfer mode has been changed to `binary`.

### Internationalization Functions

**`Normalizer::NONE`** is deprecated, when PHP is linked with ICU ≥ 56.

Introduced **[`Normalizer::FORM_KC_CF`](https://www.php.net/manual/en/class.normalizer.php#normalizer.constants.form-kc-cf)** as [Normalizer::normalize()](https://www.php.net/manual/en/normalizer.normalize.php) argument for `NFKC_Casefold` normalization; available when linked with ICU ≥ 56.

### JavaScript Object Notation

A new flag has been added, **[`JSON_THROW_ON_ERROR`](https://www.php.net/manual/en/json.constants.php#constant.json-throw-on-error)**, which can be used with [json_decode()](https://www.php.net/manual/en/function.json-decode.php) or [json_encode()](https://www.php.net/manual/en/function.json-encode.php) and causes these functions to throw the new [JsonException](https://www.php.net/manual/en/class.jsonexception.php) upon an error, instead of setting the global error state that is retrieved with [json_last_error()](https://www.php.net/manual/en/function.json-last-error.php) and [json_last_error_msg()](https://www.php.net/manual/en/function.json-last-error-msg.php). **[`JSON_PARTIAL_OUTPUT_ON_ERROR`](https://www.php.net/manual/en/json.constants.php#constant.json-partial-output-on-error)** takes precedence over **[`JSON_THROW_ON_ERROR`](https://www.php.net/manual/en/json.constants.php#constant.json-throw-on-error)**.

### Multibyte String

The configuration option **--with-libmbfl** is no longer available.

### ODBC (Unified)

Support for `ODBCRouter` and `Birdstep` including the `birdstep.max_links` ini directive has been removed.

### OPcache

The `opcache.inherited_hack` ini directive has been removed. The value has already been ignored since PHP 5.3.0.

### OpenSSL

The `min_proto_version` and `max_proto_version` ssl stream options as well as related constants for possible TLS protocol values have been added.

### Regular Expressions (Perl-Compatible)

The [PCRE extension](https://www.php.net/manual/en/book.pcre.php) has been upgraded to PCRE2, which may cause minor behavioral changes (for instance, character ranges in classes are now more strictly interpreted), and augments the existing regular expression syntax.

[preg_quote()](https://www.php.net/manual/en/function.preg-quote.php) now also escapes the `'#'` character.

### Microsoft SQL Server and Sybase Functions (PDO_DBLIB)

The attribute **`PDO::DBLIB_ATTR_SKIP_EMPTY_ROWSETS`** to enable automatic skipping of empty rowsets has been added.

The **`PDO::DBLIB_ATTR_TDS_VERSION`** attribute which exposes the TDS version has been added.

DATETIME2 columns are now treated like DATETIME columns.

### SQLite Functions (PDO_SQLITE)

SQLite3 databases can now be opened in read-only mode by setting the new **`PDO::SQLITE_ATTR_OPEN_FLAGS`** attribute to **`PDO::SQLITE_OPEN_READONLY`**.

### Session Handling

[session_set_cookie_params()](https://www.php.net/manual/en/function.session-set-cookie-params.php) now also supports the following signature:

function [session_set_cookie_params](https://www.php.net/manual/en/function.session-set-cookie-params.php)([array](https://www.php.net/manual/en/language.types.array.php) `$options`): [bool](https://www.php.net/manual/en/language.types.boolean.php)

where `$options` is an associative array which may have any of the keys `"lifetime"`, `"path"`, `"domain"`, `"secure"`, `"httponly"` and `"samesite"`. Accordingly, the return value of [session_get_cookie_params()](https://www.php.net/manual/en/function.session-get-cookie-params.php) now also has an element with the key `"samesite"`. Furthermore, the new `session.cookie_samesite` ini option to set the default of the SameSite directive for cookies has been added. It defaults to `""` (empty string), so no SameSite directive is set. Can be set to `"Lax"` or `"Strict"`, which sets the respective SameSite directive.

### Tidy

Building against [» tidyp](https://github.com/petdance/tidyp) is now also supported transparently. Since tidyp offers no API to get the release date, [tidy_get_release()](https://www.php.net/manual/en/tidy.getrelease.php) and [tidy::getRelease()](https://www.php.net/manual/en/tidy.getrelease.php) return `'unknown'` in this case.

### XML Parser

The return value of the [xml_set_external_entity_ref_handler()](https://www.php.net/manual/en/function.xml-set-external-entity-ref-handler.php) callback is no longer ignored if the extension has been built against libxml. Formerly, the return value has been ignored, and parsing did never stop.

### Zip

Building against the bundled libzip is discouraged, but still possible by adding **--without-libzip** to the configuration.

### Zlib Compression

The zlib/level context option for the [compress.zlib wrapper](https://www.php.net/manual/en/wrappers.compression.php) to facilitate setting the desired compression level has been added.

# [PHP 7.2](https://www.php.net/manual/en/migration72.other-changes.php)

## Other changes

### Moving of [utf8_encode()](https://www.php.net/manual/en/function.utf8-encode.php) and [utf8_decode()](https://www.php.net/manual/en/function.utf8-decode.php)

The [utf8_encode()](https://www.php.net/manual/en/function.utf8-encode.php) and [utf8_decode()](https://www.php.net/manual/en/function.utf8-decode.php) functions have now been moved to the standard extension as string functions, whereas before the [XML](https://www.php.net/manual/en/book.xml.php) extension was required for them to be available.

### Changes to [mail()](https://www.php.net/manual/en/function.mail.php) and [mb_send_mail()](https://www.php.net/manual/en/function.mb-send-mail.php)

The \$additional_headers parameter of [mail()](https://www.php.net/manual/en/function.mail.php) and [mb_send_mail()](https://www.php.net/manual/en/function.mb-send-mail.php) now also accepts an [array](https://www.php.net/manual/en/language.types.array.php) instead of a [string](https://www.php.net/manual/en/language.types.string.php).

### LMDB support

The [DBA](https://www.php.net/manual/en/book.dba.php) extension now has support for LMDB.

### Changes to the PHP build system

- Unix: Autoconf 2.64 or greater is now required to build PHP.

- Unix: `--with-pdo-oci` configure argument no longer needs the version number of the Oracle Instant Client.

- Unix: `--enable-gd-native-ttf` configure argument has been removed. This was not used since PHP 5.5.0.

- Windows: `--with-config-profile` configure argument has been added. This can be used to save specific configures, much like the magical `config.nice.bat` file.

### Changes to [GD](https://www.php.net/manual/en/book.image.php)

- [imageantialias()](https://www.php.net/manual/en/function.imageantialias.php) is now also available if compiled with a system libgd.

- [imagegd()](https://www.php.net/manual/en/function.imagegd.php) stores truecolor images as real truecolor images. Formerly, they have been converted to palette.

### Moving [MCrypt](https://www.php.net/manual/en/book.mcrypt.php) to PECL

The [MCrypt](https://www.php.net/manual/en/book.mcrypt.php) extension has now been moved out of the core to PECL. Given the mcrypt library has not seen any updates since 2007, its usage is highly discouraged. Instead, either the [OpenSSL](https://www.php.net/manual/en/book.openssl.php) or [Sodium](https://www.php.net/manual/en/book.sodium.php) extension should be used.

### [session_module_name()](https://www.php.net/manual/en/function.session-module-name.php)

Passing `"user"` to [session_module_name()](https://www.php.net/manual/en/function.session-module-name.php) now raises an error of level **[`E_RECOVERABLE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-recoverable-error)**. Formerly, this has been silently ignored.

# [PHP 7.1](https://www.php.net/manual/en/migration71.other-changes.php)

## Other changes

### Notices and warnings on arithmetic with invalid strings

New **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** and **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** errors have been introduced when invalid strings are coerced using operators expecting numbers (`+` `-` `*` `/` `**` `%` `<<` `>>` `|` `&` `^`) or their assignment equivalents. An **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** is emitted when the string begins with a numeric value but contains trailing non-numeric characters, and an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** is emitted when the string does not contain a numeric value.

```
<?php
'1b' + 'something';
```

The above example will output:

    Notice: A non well formed numeric value encountered in %s on line %d
    Warning: A non-numeric value encountered in %s on line %d

### Warn on octal escape sequence overflow

Previously, 3-octet octal string escape sequences would overflow silently. Now, they will still overflow, but **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** will be emitted.

```
<?php
var_dump("\500");
```

The above example will output:

    Warning: Octal escape sequence overflow \500 is greater than \377 in %s on line %d
    string(1) "@"

### Inconsistency fixes to `$this`

Whilst `$this` is considered a special variable in PHP, it lacked proper checks to ensure it wasn't used as a variable name or reassigned. This has now been rectified to ensure that `$this` cannot be a user-defined variable, reassigned to a different value, or be globalised.

### Session ID generation without hashing

Session IDs will no longer be hashed upon generation. With this change brings about the removal of the following four ini settings:

- `session.entropy_file`

- `session.entropy_length`

- `session.hash_function`

- `session.hash_bits_per_character`

And the addition of the following two ini settings:

- `session.sid_length` - defines the length of the session ID, defaulting to 32 characters for backwards compatibility)

- `session.sid_bits_per_character` - defines the number of bits to be stored per character (i.e. increases the range of characters that can be used in the session ID), defaulting to 4 for backwards compatibility

### Changes to INI file handling

`precision`  
If the value is set to -1, then the dtoa mode 0 is used. The default value is still 14.

`serialize_precision`  
If the value is set to -1, then the dtoa mode 0 is used. The value -1 is now used by default.

`gd.jpeg_ignore_warning`  
The default of this `php.ini` setting has been changed to 1, so by default libjpeg warnings are ignored.

`opcache.enable_cli`  
The default of this `php.ini` setting has been changed to 1 (enabled) in PHP 7.1.2, and back to 0 (disabled) in PHP 7.1.7.

### Session ID generation with a CSPRNG only

Session IDs will now only be generated with a CSPRNG.

### More informative [TypeError](https://www.php.net/manual/en/class.typeerror.php) messages when **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** is allowed

[TypeError](https://www.php.net/manual/en/class.typeerror.php) exceptions for arg_info type checks will now provide more informative error messages. If the parameter type or return type accepts **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** (by either having a default value of **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** or being a nullable type), then the error message will now mention this with a message of "must be ... or null" or "must ... or be null."

# [PHP 7.0](https://www.php.net/manual/en/migration70.other-changes.php)

## Other Changes

### Loosening Reserved Word Restrictions

Globally reserved words as property, constant, and method names within classes, interfaces, and traits are now allowed. This reduces the surface of BC breaks when new keywords are introduced and avoids naming restrictions on APIs.

This is particularly useful when creating internal DSLs with fluent interfaces:

```
<?php
// 'new', 'private', and 'for' were previously unusable
Project::new('Project Name')->private()->for('purpose here')->with('username here');
?>
```

The only limitation is that the `class` keyword still cannot be used as a constant name, otherwise it would conflict with the class name resolution syntax (`ClassName::class`).

### Removal of date.timezone Warning

Previously, a warning was emitted if the `date.timezone` INI setting had not been set prior to using any date- or time-based functions. Now, this warning has been removed (with `date.timezone` still defaulting to UTC).
