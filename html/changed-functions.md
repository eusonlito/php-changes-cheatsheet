# [Changed functions in PHP 7.1, 7.0, 5.6, 5.5](index.md)

# [PHP 7.1](https://www.php.net/manual/en/migration71.changed-functions.php)

## Changed functions

### PHP Core

- [getopt()](https://www.php.net/manual/en/function.getopt.php) has an optional third parameter that exposes the index of the next element in the argument vector list to be processed. This is done via a by-ref parameter.

- [getenv()](https://www.php.net/manual/en/function.getenv.php) no longer requires its parameter. If the parameter is omitted, then the current environment variables will be returned as an associative array.

- [get_headers()](https://www.php.net/manual/en/function.get-headers.php) now has an additional parameter to enable for the passing of custom stream contexts.

- [output_reset_rewrite_vars()](https://www.php.net/manual/en/function.output-reset-rewrite-vars.php) no longer resets session URL rewrite variables.

- [parse_url()](https://www.php.net/manual/en/function.parse-url.php) is now more restrictive and supports RFC3986.

- [unpack()](https://www.php.net/manual/en/function.unpack.php) now accepts an optional third parameter to specify the offset to begin unpacking from.

### File System

- [file_get_contents()](https://www.php.net/manual/en/function.file-get-contents.php) now accepts a negative seek offset if the stream is seekable.

- [tempnam()](https://www.php.net/manual/en/function.tempnam.php) now emits a notice when falling back to the system's temp directory.

### JSON

- [json_encode()](https://www.php.net/manual/en/function.json-encode.php) now accepts a new option, **[`JSON_UNESCAPED_LINE_TERMINATORS`](https://www.php.net/manual/en/json.constants.php#constant.json-unescaped-line-terminators)**, to disable the escaping of U+2028 and U+2029 characters when **[`JSON_UNESCAPED_UNICODE`](https://www.php.net/manual/en/json.constants.php#constant.json-unescaped-unicode)** is supplied.

### Multibyte String

- [mb_ereg()](https://www.php.net/manual/en/function.mb-ereg.php) now rejects illegal byte sequences.

- [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php) now rejects illegal byte sequences.

### PDO

- [PDO::lastInsertId()](https://www.php.net/manual/en/pdo.lastinsertid.php) for PostgreSQL will now trigger an error when `nextval` has not been called for the current session (the postgres connection).

### PostgreSQL

- [pg_last_notice()](https://www.php.net/manual/en/function.pg-last-notice.php) now accepts an optional parameter to specify an operation. This can be done with one of the following new constants: **[`PGSQL_NOTICE_LAST`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-notice-last)**, **[`PGSQL_NOTICE_ALL`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-notice-all)**, or **[`PGSQL_NOTICE_CLEAR`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-notice-clear)**.

- [pg_fetch_all()](https://www.php.net/manual/en/function.pg-fetch-all.php) now accepts an optional second parameter to specify the result type (similar to the third parameter of [pg_fetch_array()](https://www.php.net/manual/en/function.pg-fetch-array.php)).

- [pg_select()](https://www.php.net/manual/en/function.pg-select.php) now accepts an optional fourth parameter to specify the result type (similar to the third parameter of [pg_fetch_array()](https://www.php.net/manual/en/function.pg-fetch-array.php)).

### Session

- [session_start()](https://www.php.net/manual/en/function.session-start.php) now returns **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** and no longer initializes [`$_SESSION`](https://www.php.net/manual/en/reserved.variables.session.php) when it failed to start the session.

# [PHP 7.0](https://www.php.net/manual/en/migration70.changed-functions.php)

## Changed functions

### PHP Core

- [debug_zval_dump()](https://www.php.net/manual/en/function.debug-zval-dump.php) now prints "int" instead of "long", and "float" instead of "double"

- [dirname()](https://www.php.net/manual/en/function.dirname.php) now optionally takes a second parameter, `depth`, to get the name of the directory `depth` levels up from the current directory.

- [getrusage()](https://www.php.net/manual/en/function.getrusage.php) is now supported on Windows.

- [mktime()](https://www.php.net/manual/en/function.mktime.php) and [gmmktime()](https://www.php.net/manual/en/function.gmmktime.php) functions no longer accept `is_dst` parameter.

- [preg_replace()](https://www.php.net/manual/en/function.preg-replace.php) function no longer supports "\e" (**`PREG_REPLACE_EVAL`**). [preg_replace_callback()](https://www.php.net/manual/en/function.preg-replace-callback.php) should be used instead.

- [setlocale()](https://www.php.net/manual/en/function.setlocale.php) function no longer accepts `category` passed as string. **[`LC_*`](https://www.php.net/manual/en/string.constants.php#constant.lc-ctype)** constants must be used instead.

- [exec()](https://www.php.net/manual/en/function.exec.php), [system()](https://www.php.net/manual/en/function.system.php) and [passthru()](https://www.php.net/manual/en/function.passthru.php) functions have NULL byte protection now.

- [shmop_open()](https://www.php.net/manual/en/function.shmop-open.php) now returns a resource instead of an int, which has to be passed to [shmop_size()](https://www.php.net/manual/en/function.shmop-size.php), [shmop_write()](https://www.php.net/manual/en/function.shmop-write.php), [shmop_read()](https://www.php.net/manual/en/function.shmop-read.php), [shmop_close()](https://www.php.net/manual/en/function.shmop-close.php) and [shmop_delete()](https://www.php.net/manual/en/function.shmop-delete.php).

- [substr()](https://www.php.net/manual/en/function.substr.php) and [iconv_substr()](https://www.php.net/manual/en/function.iconv-substr.php) now return an empty string, if string is equal to start characters long.

- [xml_parser_free()](https://www.php.net/manual/en/function.xml-parser-free.php) is no longer sufficient to free the parser resource, if it references an object and this object references that parser resource. In this case it is necessary to additionally unset the \$parser.

# [PHP 5.6](https://www.php.net/manual/en/migration56.changed-functions.php)

## Changed functions

### PHP Core

- [crypt()](https://www.php.net/manual/en/function.crypt.php) will now raise an **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** error if the `salt` parameter is omitted.

- [substr_compare()](https://www.php.net/manual/en/function.substr-compare.php) will now accept `0` for its `length` parameter.

- [unserialize()](https://www.php.net/manual/en/function.unserialize.php) will now fail if passed serialised data that has been manipulated to attempt to instantiate an object without calling its constructor.

### [cURL](https://www.php.net/manual/en/book.curl.php)

- Uploads using the `@file` syntax are now only supported if the **[`CURLOPT_SAFE_UPLOAD`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-safe-upload)** option is set to **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. [CURLFile](https://www.php.net/manual/en/class.curlfile.php) should be used instead.

### [Mcrypt](https://www.php.net/manual/en/book.mcrypt.php)

- The `source` parameter of [mcrypt_create_iv()](https://www.php.net/manual/en/function.mcrypt-create-iv.php) now defaults to **[`MCRYPT_DEV_URANDOM`](https://www.php.net/manual/en/mcrypt.constants.php#constant.mcrypt-dev-urandom)** instead of **[`MCRYPT_DEV_RANDOM`](https://www.php.net/manual/en/mcrypt.constants.php#constant.mcrypt-dev-random)**.

### [OpenSSL](https://www.php.net/manual/en/book.openssl.php)

- [stream_socket_enable_crypto()](https://www.php.net/manual/en/function.stream-socket-enable-crypto.php) now allows the `crypto_type` parameter to be optional if the stream's SSL context includes the new `crypto_type` option.

### [PostgreSQL](https://www.php.net/manual/en/book.pgsql.php)

- [pg_insert()](https://www.php.net/manual/en/function.pg-insert.php), [pg_select()](https://www.php.net/manual/en/function.pg-select.php), [pg_update()](https://www.php.net/manual/en/function.pg-update.php) and [pg_delete()](https://www.php.net/manual/en/function.pg-delete.php) are no longer experimental.

- [pg_send_execute()](https://www.php.net/manual/en/function.pg-send-execute.php), [pg_send_prepare()](https://www.php.net/manual/en/function.pg-send-prepare.php), [pg_send_query()](https://www.php.net/manual/en/function.pg-send-query.php) and [pg_send_query_params()](https://www.php.net/manual/en/function.pg-send-query-params.php) will no longer block until query write completion if the underlying socket stream for the database connection is set to non-blocking mode.

### [Reflection](https://www.php.net/manual/en/book.reflection.php)

- [ReflectionClass::newInstanceWithoutConstructor()](https://www.php.net/manual/en/reflectionclass.newinstancewithoutconstructor.php) now allows non-final internal classes to be instantiated.

### [XMLReader](https://www.php.net/manual/en/book.xmlreader.php)

- [XMLReader::getAttributeNs()](https://www.php.net/manual/en/xmlreader.getattributens.php) and [XMLReader::getAttributeNo()](https://www.php.net/manual/en/xmlreader.getattributeno.php) now return **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** if the attribute could not be found, like [XMLReader::getAttribute()](https://www.php.net/manual/en/xmlreader.getattribute.php).

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.changed-functions.php)

## Changed Functions

### PHP Core

- [set_error_handler()](https://php-legacy-docs.zend.com/manual/php5/en/function.set-error-handler.html) can now be called with **`NULL`** as an argument to reset the error handler.
- When called with **`NULL`**, [set_error_handler()](https://php-legacy-docs.zend.com/manual/php5/en/function.set-error-handler.html) and [set_exception_handler()](https://php-legacy-docs.zend.com/manual/php5/en/function.set-exception-handler.html) now return the previous error or exception handler, respectively.
- [json_encode()](https://php-legacy-docs.zend.com/manual/php5/en/function.json-encode.html) now accepts `depth` parameter.
- The behaviour of [pack()](https://php-legacy-docs.zend.com/manual/php5/en/function.pack.html) and [unpack()](https://php-legacy-docs.zend.com/manual/php5/en/function.unpack.html) with the "a" and "A" format codes has changed. [Detailed notes on these changes are available.](https://php-legacy-docs.zend.com/manual/php5/en/migration55.incompatible.html#migration55.incompatible.pack)

### [intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html)

- [MessageFormatter::format()](https://php-legacy-docs.zend.com/manual/php5/en/messageformatter.format.html) and related functions now accept named arguments and mixed numeric and named arguments when PHP is linked to ICU 4.8 or later.
- [MessageFormatter::format()](https://php-legacy-docs.zend.com/manual/php5/en/messageformatter.format.html) and related functions no longer error when an insufficient number of arguments have been provided. Instead, the placeholders will not be substituted.
- [MessageFormatter::format()](https://php-legacy-docs.zend.com/manual/php5/en/messageformatter.format.html) and [MessageFormatter::parse()](https://php-legacy-docs.zend.com/manual/php5/en/messageformatter.parse.html) are no longer limited to second precision when dealing with times.
- [IntlDateFormatter::\_\_construct()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.create.html) and [datefmt_create()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.create.html) now accept [IntlTimeZone](https://php-legacy-docs.zend.com/manual/php5/en/class.intltimezone.html) and [DateTimeZone](https://php-legacy-docs.zend.com/manual/php5/en/class.datetimezone.html) objects for the `timezone` argument, and [IntlCalendar](https://php-legacy-docs.zend.com/manual/php5/en/class.intlcalendar.html) objects for the `calendar` argument. Furthermore, if the time zone is omitted and the `calendar` doesn't specify a time zone, PHP's default time zone from [date_default_timezone_get()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-default-timezone-get.html) is now used instead of the default ICU time zone.
- [IntlDateFormatter::getCalendar()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.getcalendar.html) and [datefmt_get_calendar()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.getcalendar.html) return false if the [IntlDateFormatter](https://php-legacy-docs.zend.com/manual/php5/en/class.intldateformatter.html) object was created with an [IntlCalendar](https://php-legacy-docs.zend.com/manual/php5/en/class.intlcalendar.html) instance instead of one of the [IntlDateFormatter](https://php-legacy-docs.zend.com/manual/php5/en/class.intldateformatter.html) constants.
- [IntlDateFormatter::setCalendar()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.setcalendar.html) and [datefmt_set_calendar()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.setcalendar.html) now accept [IntlCalendar](https://php-legacy-docs.zend.com/manual/php5/en/class.intlcalendar.html) objects in addition to the [IntlDateFormatter](https://php-legacy-docs.zend.com/manual/php5/en/class.intldateformatter.html) constants.
- [IntlDateFormatter::format()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.format.html) and [datefmt_format()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.format.html) now accept [IntlCalendar](https://php-legacy-docs.zend.com/manual/php5/en/class.intlcalendar.html) objects.
