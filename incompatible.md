# [Backward Incompatible Changes in PHP 8.6, 8.5, 8.4, 8.3, 8.2, 8.1, 8.0, 7.4, 7.3, 7.2, 7.1, 7.0, 5.6, 5.5, 5.4, 5.3, 5.2, 5.0](index.md)

# [PHP 8.6](https://www.php.net/manual/en/migration86.incompatible.php)

## Backward Incompatible Changes

### PHP Core

#### By-reference foreach after array compaction

By-reference [foreach](https://www.php.net/manual/en/control-structures.foreach.php) loops may now visit previously skipped elements after array compaction. Internal pointers on deleted elements now move to the next surviving element during copy-on-write.

#### Null coalescing and [empty()](https://www.php.net/manual/en/function.empty.php) on magic properties

`??` and [empty()](https://www.php.net/manual/en/function.empty.php) on a magic property no longer call [\_\_get()](https://www.php.net/manual/en/language.oop5.overloading.php#object.get) when [\_\_isset()](https://www.php.net/manual/en/language.oop5.overloading.php#object.isset) has materialized the property by writing into the property table. The freshly-written value is returned directly. [isset()](https://www.php.net/manual/en/function.isset.php) applied directly to the property is unaffected; nested forms such as `isset($o->p['k'])` follow the same path as `??`.

```
<?php
#[\AllowDynamicProperties]
class Example
{
    public function __isset(string $name): bool
    {
        $this->$name = 'from __isset()';
        return true;
    }

    public function __get(string $name): string
    {
        return 'from __get()';
    }
}

$example = new Example();
var_dump($example->foo ?? 'default');
// As of PHP 8.6.0: string(14) "from __isset()"
// Prior to PHP 8.6.0: string(12) "from __get()"
```

#### String conversion in [array_intersect()](https://www.php.net/manual/en/function.array-intersect.php)

[array_intersect()](https://www.php.net/manual/en/function.array-intersect.php) with at least two arrays now converts values to strings while scanning its inputs instead of during sort comparisons. This can change the number and order of conversion warnings and [\_\_toString()](https://www.php.net/manual/en/language.oop5.magic.php#object.tostring) calls, which conversion exception is reached, and the result for stateful [\_\_toString()](https://www.php.net/manual/en/language.oop5.magic.php#object.tostring) implementations. Argument types are validated before checking for empty arrays or converting values, so an invalid later argument can suppress conversion side effects from earlier arrays. Values are not converted if any input array is empty.

#### Form feed trimmed by default

Form feed (`\f`) is now added to the default trimmed characters of [trim()](https://www.php.net/manual/en/function.trim.php), [rtrim()](https://www.php.net/manual/en/function.rtrim.php) and [ltrim()](https://www.php.net/manual/en/function.ltrim.php).

```
<?php
var_dump(trim("\f hello \f"));
// As of PHP 8.6.0: string(5) "hello"
// Prior to PHP 8.6.0: string(9) "\f hello \f"
```

#### New errors for invalid arguments

The following functions now raise a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when an invalid flag or mode value is passed:

- [array_filter()](https://www.php.net/manual/en/function.array-filter.php) (`mode`)
- [array_change_key_case()](https://www.php.net/manual/en/function.array-change-key-case.php) (`case`)
- [pathinfo()](https://www.php.net/manual/en/function.pathinfo.php) (`flags`)
- [scandir()](https://www.php.net/manual/en/function.scandir.php) (`sorting_order`)

The following functions now raise a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the given argument contains `NUL` bytes:

- [getenv()](https://www.php.net/manual/en/function.getenv.php) and [putenv()](https://www.php.net/manual/en/function.putenv.php) (first argument)
- [dl()](https://www.php.net/manual/en/function.dl.php) (`extension_filename`)
- [openlog()](https://www.php.net/manual/en/function.openlog.php) (`prefix`)
- [parse_str()](https://www.php.net/manual/en/function.parse-str.php) (`string`)
- [proc_open()](https://www.php.net/manual/en/function.proc-open.php) (`cwd`)

The following functions now raise a [ValueError](https://www.php.net/manual/en/class.valueerror.php) for out-of-range values instead of silently clamping them or allowing them to overflow:

- [number_format()](https://www.php.net/manual/en/function.number-format.php), when `decimals` is outside the integer range.
- [sleep()](https://www.php.net/manual/en/function.sleep.php), when `seconds` is greater than `UINT_MAX`, or `UINT_MAX / 1000` on Windows.
- [usleep()](https://www.php.net/manual/en/function.usleep.php), when `microseconds` is greater than `UINT_MAX`.

[linkinfo()](https://www.php.net/manual/en/function.linkinfo.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the `path` argument is empty.

[setlocale()](https://www.php.net/manual/en/function.setlocale.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when a locale name contains `NUL` bytes, instead of silently truncating it. Arrays are now accepted only for the `locales` argument. Passing an array as a later variadic locale argument now throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php). Passing any additional locale arguments when `locales` is an array now throws an [ArgumentCountError](https://www.php.net/manual/en/class.argumentcounterror.php).

The following functions now raise a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the `filename` argument contains `NUL` bytes:

- [fileperms()](https://www.php.net/manual/en/function.fileperms.php)
- [fileinode()](https://www.php.net/manual/en/function.fileinode.php)
- [filesize()](https://www.php.net/manual/en/function.filesize.php)
- [fileowner()](https://www.php.net/manual/en/function.fileowner.php)
- [filegroup()](https://www.php.net/manual/en/function.filegroup.php)
- [fileatime()](https://www.php.net/manual/en/function.fileatime.php)
- [filemtime()](https://www.php.net/manual/en/function.filemtime.php)
- [filectime()](https://www.php.net/manual/en/function.filectime.php)
- [filetype()](https://www.php.net/manual/en/function.filetype.php)
- [is_writable()](https://www.php.net/manual/en/function.is-writable.php)
- [is_readable()](https://www.php.net/manual/en/function.is-readable.php)
- [is_executable()](https://www.php.net/manual/en/function.is-executable.php)
- [is_file()](https://www.php.net/manual/en/function.is-file.php)
- [is_dir()](https://www.php.net/manual/en/function.is-dir.php)
- [is_link()](https://www.php.net/manual/en/function.is-link.php)
- [file_exists()](https://www.php.net/manual/en/function.file-exists.php)
- [lstat()](https://www.php.net/manual/en/function.lstat.php)
- [stat()](https://www.php.net/manual/en/function.stat.php)

#### Notice on imprecise number conversion

[base_convert()](https://www.php.net/manual/en/function.base-convert.php), [bindec()](https://www.php.net/manual/en/function.bindec.php), [hexdec()](https://www.php.net/manual/en/function.hexdec.php) and [octdec()](https://www.php.net/manual/en/function.octdec.php) now raise a notice when they cannot precisely convert the given number.

#### Endianness modifiers in [unpack()](https://www.php.net/manual/en/function.unpack.php) format names

[unpack()](https://www.php.net/manual/en/function.unpack.php) now reads a `<` or `>` immediately following a format code as an endianness modifier rather than as the first character of the element name. Formats such as `"s<value"` now produce the key `"value"` instead of `"<value"`, and `"C>name"` raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) because the `C` format code accepts no endianness modifier. A name starting with these characters is unaffected when a repeater precedes it, as in `"s1<value"`. See also the [new endianness modifiers](https://www.php.net/manual/en/migration86.new-features.php#migration86.new-features.core.pack-unpack-endianness).

```
<?php
var_dump(unpack('s<value', "\x01\x00"));
// As of PHP 8.6.0: ["value" => 1]
// Prior to PHP 8.6.0: ["<value" => 1]
```

### COM

It is no longer possible to clone [variant](https://www.php.net/manual/en/class.variant.php) objects, because the cloning behavior was ill-defined.

### cURL

The callback registered with **[`CURLOPT_READFUNCTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-readfunction)** now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when returning an integer other than `0`, **`CURL_READFUNC_ABORT`** or **[`CURL_READFUNC_PAUSE`](https://www.php.net/manual/en/curl.constants.php#constant.curl-readfunc-pause)**.

### DOM

Properties previously documented as read-only (e.g. [DOMNode::\$nodeType](https://www.php.net/manual/en/class.domnode.php#domnode.props.nodetype), [DOMDocument::\$xmlEncoding](https://www.php.net/manual/en/class.domdocument.php#domdocument.props.xmlencoding), [DOMEntity::\$actualEncoding](https://www.php.net/manual/en/class.domentity.php#domentity.props.actualencoding), [DOMEntity::\$encoding](https://www.php.net/manual/en/class.domentity.php#domentity.props.encoding), [DOMEntity::\$version](https://www.php.net/manual/en/class.domentity.php#domentity.props.version)) are now declared with [asymmetric visibility](https://www.php.net/manual/en/language.oop5.visibility.php#language.oop5.visibility-members-aviz) (`public private(set)`). Attempts to write to them from outside the class now raise “Cannot modify private(set) property class::\$prop from global scope” instead of the prior readonly modification error. [ReflectionProperty::isWritable()](https://www.php.net/manual/en/reflectionproperty.iswritable.php) also reports these properties accurately.

Array access on [Dom\DtdNamedNodeMap](https://www.php.net/manual/en/class.dom-dtdnamednodemap.php) objects now returns **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** for negative integer indexes instead of returning the first node, and raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the integer index is greater than `INT_MAX` instead of overflowing to a smaller index.

### Fileinfo

TrueType fonts are now detected as `font/ttf` instead of `font/sfnt`.

### FTP

[ftp_nb_fget()](https://www.php.net/manual/en/function.ftp-nb-fget.php), [ftp_nb_fput()](https://www.php.net/manual/en/function.ftp-nb-fput.php), [ftp_nb_get()](https://www.php.net/manual/en/function.ftp-nb-get.php) and [ftp_nb_put()](https://www.php.net/manual/en/function.ftp-nb-put.php) now throw an [Error](https://www.php.net/manual/en/class.error.php) when the connection is already transferring, instead of emitting a warning and returning **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. [ftp_close()](https://www.php.net/manual/en/function.ftp-close.php) already throws on the same condition.

### GD

[imagesetstyle()](https://www.php.net/manual/en/function.imagesetstyle.php), [imagefilter()](https://www.php.net/manual/en/function.imagefilter.php) and [imagecrop()](https://www.php.net/manual/en/function.imagecrop.php) filter the types and values of their array arguments and raise a [TypeError](https://www.php.net/manual/en/class.typeerror.php) or [ValueError](https://www.php.net/manual/en/class.valueerror.php) accordingly.

[imageaffinematrixget()](https://www.php.net/manual/en/function.imageaffinematrixget.php) now enforces the documented [array](https://www.php.net/manual/en/language.types.array.php)\|[float](https://www.php.net/manual/en/language.types.float.php) type for the `options` parameter, including the corresponding weak and strict typing behavior.

### GMP

[gmp_fact()](https://www.php.net/manual/en/function.gmp-fact.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if `num` does not fit into an unsigned long.

[gmp_pow()](https://www.php.net/manual/en/function.gmp-pow.php), [gmp_binomial()](https://www.php.net/manual/en/function.gmp-binomial.php), [gmp_root()](https://www.php.net/manual/en/function.gmp-root.php) and [gmp_rootrem()](https://www.php.net/manual/en/function.gmp-rootrem.php) now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if their second argument does not fit into an unsigned long.

The shift (`<<`, `>>`) and exponentiation (`**`) operators on [GMP](https://www.php.net/manual/en/class.gmp.php) objects now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when [GMP](https://www.php.net/manual/en/class.gmp.php) right operands are outside the unsigned long range, instead of silently truncating them.

[GMP](https://www.php.net/manual/en/class.gmp.php) integer string parsing now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) for strings containing `NUL` bytes, instead of silently truncating them.

The message of the [DivisionByZeroError](https://www.php.net/manual/en/class.divisionbyzeroerror.php) raised by [gmp_powm()](https://www.php.net/manual/en/function.gmp-powm.php) on modulo by zero now includes the function name and argument index (`modulus`).

### Intl

Passing a non-stringable object as a time zone to Intl APIs that accept time zone objects or strings now raises a [TypeError](https://www.php.net/manual/en/class.typeerror.php) instead of an [Error](https://www.php.net/manual/en/class.error.php).

[IntlIterator::current()](https://www.php.net/manual/en/intliterator.current.php) now returns **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** when called before the iterator is positioned, or after the iterator becomes invalid, instead of exposing an undefined value.

[IntlBreakIterator::getLocale()](https://www.php.net/manual/en/intlbreakiterator.getlocale.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the type is neither **[`Locale::ACTUAL_LOCALE`](https://www.php.net/manual/en/class.locale.php#locale.constants.actual-locale)** nor **[`Locale::VALID_LOCALE`](https://www.php.net/manual/en/class.locale.php#locale.constants.valid-locale)** instead of returning **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

[MessageFormatter::parse()](https://www.php.net/manual/en/messageformatter.parse.php) and [MessageFormatter::parseMessage()](https://www.php.net/manual/en/messageformatter.parsemessage.php) now return **[`PHP_INT_MIN`](https://www.php.net/manual/en/reserved.constants.php#constant.php-int-min)** as [int](https://www.php.net/manual/en/language.types.integer.php), rather than [float](https://www.php.net/manual/en/language.types.float.php), on 64-bit platforms when parsing integer values.

The `type` parameter of [IntlBreakIterator::getPartsIterator()](https://www.php.net/manual/en/intlbreakiterator.getpartsiterator.php) has been changed from [string](https://www.php.net/manual/en/language.types.string.php) to [int](https://www.php.net/manual/en/language.types.integer.php) to match the underlying implementation.

[UConverter::transcode()](https://www.php.net/manual/en/uconverter.transcode.php) now rejects `from_subst` and `to_subst` option values longer than 127 bytes instead of silently truncating the length before passing it to ICU.

[ResourceBundle::get()](https://www.php.net/manual/en/resourcebundle.get.php) and [resourcebundle_get()](https://www.php.net/manual/en/resourcebundle.get.php) now report fallback-disabled resource lookups with “without fallback to locale” instead of the malformed “without fallback from to locale”.

[IntlDateFormatter::parse()](https://www.php.net/manual/en/intldateformatter.parse.php)/[datefmt_parse()](https://www.php.net/manual/en/intldateformatter.parse.php) and [IntlDateFormatter::localtime()](https://www.php.net/manual/en/intldateformatter.localtime.php)/[datefmt_localtime()](https://www.php.net/manual/en/intldateformatter.localtime.php) now raise a [TypeError](https://www.php.net/manual/en/class.typeerror.php) when the `offset` argument is not of type [int](https://www.php.net/manual/en/language.types.integer.php) instead of silently converting the value.

[Collator::sort()](https://www.php.net/manual/en/collator.sort.php), [collator_sort()](https://www.php.net/manual/en/collator.sort.php), [Collator::asort()](https://www.php.net/manual/en/collator.asort.php), and [collator_asort()](https://www.php.net/manual/en/collator.asort.php) now report UTF-8/UTF-16 conversion failures during comparison through the intl error mechanism and return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. With [intl.use_exceptions](https://www.php.net/manual/en/intl.configuration.php#ini.intl.use-exceptions) enabled, these failures throw an [IntlException](https://www.php.net/manual/en/class.intlexception.php). Previously, these paths emitted a warning and compared the value as an empty string.

### MBString

Unicode data tables have been updated to Unicode 18.0.

### PCNTL

[pcntl_alarm()](https://www.php.net/manual/en/function.pcntl-alarm.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `seconds` argument is lower than zero or greater than the platform's `UINT_MAX`.

[pcntl_exec()](https://www.php.net/manual/en/function.pcntl-exec.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `args` argument is not a list array.

### PCRE

[preg_grep()](https://www.php.net/manual/en/function.preg-grep.php) now returns **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** instead of a partial array when a PCRE execution error occurs (e.g. malformed UTF-8 input with the `u` modifier). This is consistent with the other `preg_*` functions.

### PDO_PGSQL

When the last [PDO](https://www.php.net/manual/en/class.pdo.php) object using a persistent connection is destroyed, settings changed with `SET`, temporary tables, and other session state are now reset. Prepared statements created with `PREPARE` are kept.

### PGSQL

When [pg_fetch_object()](https://www.php.net/manual/en/function.pg-fetch-object.php) is given a non-empty `constructor_args` for a class without a constructor, the [ValueError](https://www.php.net/manual/en/class.valueerror.php) now refers to the `constructor_args` argument instead of `class`. Errors raised when the requested class is not instantiable (abstract, interface, enum) now surface before the row is fetched.

### Phar

[Phar::mungServer()](https://www.php.net/manual/en/phar.mungserver.php) now raises a [PharException](https://www.php.net/manual/en/class.pharexception.php) when the array contains a string other than `REQUEST_URI`, `PHP_SELF`, `SCRIPT_NAME`, or `SCRIPT_FILENAME`, instead of silently ignoring it.

[Phar::addEmptyDir()](https://www.php.net/manual/en/phar.addemptydir.php) now rejects `"/.phar"` paths in addition to `".phar"` paths, and raises the same [BadMethodCallException](https://www.php.net/manual/en/class.badmethodcallexception.php) for attempts to create the reserved magic `".phar"` directory through that form. Non-magic names that merely share the `".phar"` prefix are now treated as ordinary directories.

Files are only automatically interpreted as Phar archives when included if `".phar"` occurs as an extension in the filename component of their paths. Previously, it could occur in a directory name or as part of an extension such as `".pharma"`.

### Session

Setting [session.cookie_path](https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-path), [session.cookie_domain](https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-domain), or [session.cache_limiter](https://www.php.net/manual/en/session.configuration.php#ini.session.cache-limiter) to a value containing `NUL` bytes now emits a warning and leaves the setting unchanged. Previously, `NUL` bytes were silently accepted: for `cookie_path` and `cookie_domain` this caused the SAPI to drop the `Set-Cookie` header; for `cache_limiter` the value was silently truncated at the `NUL` byte.

[session_module_name()](https://www.php.net/manual/en/function.session-module-name.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if `name` is a string containing `NUL` bytes.

[session_encode()](https://www.php.net/manual/en/function.session-encode.php) now returns an empty string instead of **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** for empty sessions. It only returns **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** now when the session data could not be encoded. This mainly happens with the default serialization handler if a key contains the pipe (`|`) character.

When [session.lazy_write](https://www.php.net/manual/en/session.configuration.php#ini.session.lazy-write) is enabled and a session handler implements [SessionUpdateTimestampHandlerInterface](https://www.php.net/manual/en/class.sessionupdatetimestamphandlerinterface.php), sessions that were read as empty and remain empty at write time will now trigger [SessionUpdateTimestampHandlerInterface::updateTimestamp()](https://www.php.net/manual/en/sessionupdatetimestamphandlerinterface.updatetimestamp.php) instead of [SessionHandlerInterface::write()](https://www.php.net/manual/en/sessionhandlerinterface.write.php). Previously, [SessionHandlerInterface::write()](https://www.php.net/manual/en/sessionhandlerinterface.write.php) was always called for empty sessions because [session_encode()](https://www.php.net/manual/en/function.session-encode.php) returned **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**, bypassing the lazy_write comparison. Custom session handlers that rely on [SessionHandlerInterface::write()](https://www.php.net/manual/en/sessionhandlerinterface.write.php) being called with empty data (e.g. to destroy the session) should implement the same logic in their [SessionUpdateTimestampHandlerInterface::updateTimestamp()](https://www.php.net/manual/en/sessionupdatetimestamphandlerinterface.updatetimestamp.php) method.

The defaults of three session INI settings have changed to provide secure behavior out of the box:

- [session.use_strict_mode](https://www.php.net/manual/en/session.configuration.php#ini.session.use-strict-mode) is now `1` (was `0`). Strict mode rejects uninitialized session IDs, mitigating session fixation. Custom session handlers that previously relied on accepting externally supplied IDs without a corresponding storage entry must either implement [SessionUpdateTimestampHandlerInterface::validateId()](https://www.php.net/manual/en/sessionupdatetimestamphandlerinterface.validateid.php) and [SessionIdInterface::create_sid()](https://www.php.net/manual/en/sessionidinterface.create-sid.php), or explicitly set this to `0`.
- [session.cookie_httponly](https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-httponly) is now `1` (was `0`). Session cookies are no longer accessible to JavaScript via `document.cookie`. Applications that read the session cookie from JavaScript must explicitly set this to `0`.
- [session.cookie_samesite](https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-samesite) is now `"Lax"` (was unset). Session cookies are no longer sent on cross-site requests other than top-level navigations using safe HTTP methods. Applications that depend on session cookies being sent on cross-site POST submissions must explicitly set this to `"None"` (and also set [session.cookie_secure](https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-secure) to `1`).

**SessionHandler::validateId()** has been added and delegates to the configured save handler. A subclass that declares **SessionHandler::validateId()** without a return type now emits a deprecation notice for the tentative [bool](https://www.php.net/manual/en/language.types.boolean.php) return type. A subclass that overrides [SessionHandler::open()](https://www.php.net/manual/en/sessionhandler.open.php) without calling `parent::open()` keeps its previous behavior and emits a warning when an ID is validated.

### Shmop

[shmop_open()](https://www.php.net/manual/en/function.shmop-open.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the `key` argument is outside the platform's `key_t` range instead of passing a truncated key to the operating system.

### SimpleXML

[SimpleXMLElement::\_\_construct()](https://www.php.net/manual/en/simplexmlelement.construct.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the `data` argument contains `NUL` bytes, matching [simplexml_load_file()](https://www.php.net/manual/en/function.simplexml-load-file.php). With `dataIsURL` set, it previously truncated the path at the first `NUL` byte. Without it, the string went to libxml, which with default options rejects a `NUL` on current versions but accepts the truncated document on older ones and under **[`LIBXML_RECOVER`](https://www.php.net/manual/en/libxml.constants.php#constant.libxml-recover)**.

### SOAP

The `"classmap"` option of [SoapClient](https://www.php.net/manual/en/class.soapclient.php) and [SoapServer](https://www.php.net/manual/en/class.soapserver.php) now rejects arrays containing integer keys. Previously, sparse integer-keyed and mixed-keyed arrays could be accepted. [SoapClient](https://www.php.net/manual/en/class.soapclient.php) now throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php) for non-array `"classmap"` options and a [ValueError](https://www.php.net/manual/en/class.valueerror.php) for arrays containing integer keys, also when the `"exceptions"` option is disabled.

WSDL/XML Schema parsing now rejects out-of-range integer values for occurrence constraints and integer restriction facets. Negative `minOccurs` and `maxOccurs` values are rejected as well.

SOAP encoding errors now report the affected type or failing operation in the error message instead of the generic “Encoding: Violation of encoding rules” message. Code that compares the exact message may need to be updated.

### Sockets

[socket_set_option()](https://www.php.net/manual/en/function.socket-set-option.php) with **[`SO_ATTACH_REUSEPORT_CBPF`](https://www.php.net/manual/en/sockets.constants.php#constant.so-attach-reuseport-cbpf)** now requires an [int](https://www.php.net/manual/en/language.types.integer.php) `value` and a `level` of **[`SOL_SOCKET`](https://www.php.net/manual/en/sockets.constants.php#constant.sol-socket)**. Any other value type throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php) instead of being coerced, and any other level raises a warning and returns **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

[socket_set_option()](https://www.php.net/manual/en/function.socket-set-option.php) with **[`SO_ATTACH_REUSEPORT_CBPF`](https://www.php.net/manual/en/sockets.constants.php#constant.so-attach-reuseport-cbpf)** and a `value` of `0` now detaches the reuseport filter through **`SO_DETACH_REUSEPORT_BPF`**. It previously used **[`SO_DETACH_BPF`](https://www.php.net/manual/en/sockets.constants.php#constant.so-detach-bpf)**, an alias of **[`SO_DETACH_FILTER`](https://www.php.net/manual/en/sockets.constants.php#constant.so-detach-filter)**, which left the reuseport program attached.

### Sodium

The password-hashing functions [sodium_crypto_pwhash()](https://www.php.net/manual/en/function.sodium-crypto-pwhash.php), [sodium_crypto_pwhash_str()](https://www.php.net/manual/en/function.sodium-crypto-pwhash-str.php), [sodium_crypto_pwhash_scryptsalsa208sha256()](https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256.php) and [sodium_crypto_pwhash_scryptsalsa208sha256_str()](https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256-str.php) now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) instead of a [SodiumException](https://www.php.net/manual/en/class.sodiumexception.php) when an argument is out of range, such as an `opslimit` or `memlimit` below the documented minimum. [SodiumException](https://www.php.net/manual/en/class.sodiumexception.php) is still thrown for internal libsodium failures.

### SPL

[SplObjectStorage::getHash()](https://www.php.net/manual/en/splobjectstorage.gethash.php) implementations may no longer mutate any [SplObjectStorage](https://www.php.net/manual/en/class.splobjectstorage.php) instance. Attempting to do so now throws an [Error](https://www.php.net/manual/en/class.error.php).

[SplFileObject::next()](https://www.php.net/manual/en/splfileobject.next.php) now advances the stream when no prior [SplFileObject::current()](https://www.php.net/manual/en/splfileobject.current.php) call has cached a line. A subsequent [SplFileObject::current()](https://www.php.net/manual/en/splfileobject.current.php) call returns the new line rather than the previous one.

[SplFileObject::fgets()](https://www.php.net/manual/en/splfileobject.fgets.php) no longer caches the returned line for subsequent [SplFileObject::current()](https://www.php.net/manual/en/splfileobject.current.php) calls. [SplFileObject::current()](https://www.php.net/manual/en/splfileobject.current.php) now re-reads from the current stream position instead of returning the line [SplFileObject::fgets()](https://www.php.net/manual/en/splfileobject.fgets.php) just returned.

[SplFileObject::next()](https://www.php.net/manual/en/splfileobject.next.php) past EOF no longer increments [SplFileObject::key()](https://www.php.net/manual/en/splfileobject.key.php) without bound. [SplFileObject::seek()](https://www.php.net/manual/en/splfileobject.seek.php) past EOF now produces the same [SplFileObject::key()](https://www.php.net/manual/en/splfileobject.key.php) value as [SplTempFileObject](https://www.php.net/manual/en/class.spltempfileobject.php); the two previously returned different values.

[DirectoryIterator::key()](https://www.php.net/manual/en/directoryiterator.key.php) now returns [int](https://www.php.net/manual/en/language.types.integer.php)\|[string](https://www.php.net/manual/en/language.types.string.php), and [DirectoryIterator::current()](https://www.php.net/manual/en/directoryiterator.current.php) returns [string](https://www.php.net/manual/en/language.types.string.php)\|[SplFileInfo](https://www.php.net/manual/en/class.splfileinfo.php)\|static.

### Sysvshm

[shm_attach()](https://www.php.net/manual/en/function.shm-attach.php) now raises a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the `key` argument is outside the platform's `key_t` range instead of passing a truncated key to the operating system.

### URI

[Uri\WhatWg\Url::\_\_construct()](https://www.php.net/manual/en/uri-whatwg-url.construct.php) now sets `softErrors` to an empty array when URL processing throws an exception, instead of preserving its value. URL validation errors remain available in the [Uri\WhatWg\InvalidUrlException::\$errors](https://www.php.net/manual/en/class.uri-whatwg-invalidurlexception.php#uri-whatwg-invalidurlexception.props.errors) property.

[Uri\WhatWg\Url::\_\_construct()](https://www.php.net/manual/en/uri-whatwg-url.construct.php), [Uri\WhatWg\Url::parse()](https://www.php.net/manual/en/uri-whatwg-url.parse.php), the `Uri\WhatWg\Url::with*()` methods, and **Uri\WhatWg\UrlBuilder::build()** now report validation errors in the order in which they are detected. This reverses the order of multiple errors compared to PHP 8.5.

### Zip

[ZipArchive::extractTo()](https://www.php.net/manual/en/ziparchive.extractto.php) now raises a [TypeError](https://www.php.net/manual/en/class.typeerror.php) for the `files` argument if one or more of the entries is not a string.

[ZipArchive::addGlob()](https://www.php.net/manual/en/ziparchive.addglob.php) and [ZipArchive::addPattern()](https://www.php.net/manual/en/ziparchive.addpattern.php) now raise a [TypeError](https://www.php.net/manual/en/class.typeerror.php) when the `"remove_all_path"` option is not of type [bool](https://www.php.net/manual/en/language.types.boolean.php), or when the `"comp_method"`, `"comp_flags"`, or `"enc_method"` options are not of type [int](https://www.php.net/manual/en/language.types.integer.php) (numeric strings are coerced), instead of emitting a warning.

Serializing or unserializing a [ZipArchive](https://www.php.net/manual/en/class.ziparchive.php) now throws an [Exception](https://www.php.net/manual/en/class.exception.php). A subclass can override [\_\_serialize()](https://www.php.net/manual/en/language.oop5.magic.php#object.serialize) and [\_\_unserialize()](https://www.php.net/manual/en/language.oop5.magic.php#object.unserialize) to round-trip through **ZipArchive::closeString()** and **ZipArchive::openString()**.

### Zlib

[deflate_init()](https://www.php.net/manual/en/function.deflate-init.php) now raises a [TypeError](https://www.php.net/manual/en/class.typeerror.php) when the value for option `"level"`, `"memory"`, `"window"`, or `"strategy"` is not of type [int](https://www.php.net/manual/en/language.types.integer.php).

[inflate_init()](https://www.php.net/manual/en/function.inflate-init.php) now raises a [TypeError](https://www.php.net/manual/en/class.typeerror.php) when the value for option `"window"` is not of type [int](https://www.php.net/manual/en/language.types.integer.php).

# [PHP 8.5](https://www.php.net/manual/en/migration85.incompatible.php)

## Backward Incompatible Changes

### PHP Core

#### `"array"` and `"callable"` alias name

It is no longer possible to use `"array"` and `"callable"` as class alias names in [class_alias()](https://www.php.net/manual/en/function.class-alias.php)

#### Loosely comparing uncomparable objects

Loosely comparing uncomparable objects (e.g. enums, [CurlHandle](https://www.php.net/manual/en/class.curlhandle.php) and other internal classes) to booleans was previously inconsistent. If compared to a boolean literal `$object == true`, it would behave the same way as `(bool)$object`. If compared to a statically unknown value `$object == $true`, it would always return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. This behavior was consolidated to always follow the behavior of `(bool)$object`.

#### Return value of gc_collect_cycles

The return value of [gc_collect_cycles()](https://www.php.net/manual/en/function.gc-collect-cycles.php) no longer includes strings and resources that were indirectly collected through cycles.

#### Substitute static keyword in final subclass

It is now allowed to substitute static with self or the concrete class name in final subclasses.

#### Tick handlers

The tick handlers are now deactivated after all shutdown functions, destructors have run and the output handlers have been cleaned up.

#### Traits binding

Traits are now bound before the parent class. This is a subtle behavioral change, but should more closely match user expectations.

#### Errors during compilation and class linking

Errors emitted during compilation and class linking are now always delayed and handled after compilation or class linking. Fatal errors emitted during compilation or class linking cause any delayed errors to be handled immediately, without calling user-defined error handlers.

#### Exceptions thrown by user-defined error handler

Exceptions thrown by user-defined error handlers when handling class linking errors are not promoted to fatal errors anymore and do not prevent linking.

#### Attribute apply error during compilation

Applying `#[\Attribute]` to an abstract class, enum, interface, or trait triggers an error during compilation. Previously, the attribute could be added, but when [ReflectionAttribute::newInstance()](https://www.php.net/manual/en/reflectionattribute.newinstance.php) was called an error would be thrown. The error can be delayed from compilation to runtime using the new `#[\DelayedTargetValidation]` attribute.

#### disable_classes INI setting

The [disable_classes](https://www.php.net/manual/en/ini.core.php#ini.disable-classes) INI setting has been removed as it causes various engine assumptions to be broken.

#### Destructuring non-array values

Destructuring non-array values (other than **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**) using `[]` or [list()](https://www.php.net/manual/en/function.list.php) now emits a warning.

#### Warnings related to cast

A warning is now emitted when casting floats (or strings that look like floats) to int if they cannot be represented as one. This affects explicit int casts and implicit int casts.

A warning is now emitted when casting NAN to other types.

### Bzip2

[bzcompress()](https://www.php.net/manual/en/function.bzcompress.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when `block_size` is not between 1 and 9.

[bzcompress()](https://www.php.net/manual/en/function.bzcompress.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when `work_factor` is not between 0 and 250.

### DOM

Cloning a [DOMNamedNodeMap](https://www.php.net/manual/en/class.domnamednodemap.php), [DOMNodeList](https://www.php.net/manual/en/class.domnodelist.php), [Dom\NamedNodeMap](https://www.php.net/manual/en/class.dom-namednodemap.php), [Dom\NodeList](https://www.php.net/manual/en/class.dom-nodelist.php), [Dom\HTMLCollection](https://www.php.net/manual/en/class.dom-htmlcollection.php), and [Dom\DtdNamedNodeMap](https://www.php.net/manual/en/class.dom-dtdnamednodemap.php) now fails. This never actually resulted in a working object, therefore no impact is expected.

### FileInfo

[finfo_file()](https://www.php.net/manual/en/function.finfo-file.php) and [finfo::file()](https://www.php.net/manual/en/finfo.file.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) instead of a [TypeError](https://www.php.net/manual/en/class.typeerror.php) when `filename` contains nul bytes. This aligns the type of Error thrown to be consistent with the rest of the language.

### Intl

The extension now requires at least ICU 57.1.

[IntlDateFormatter::setTimeZone()](https://www.php.net/manual/en/intldateformatter.settimezone.php)/[datefmt_set_timezone()](https://www.php.net/manual/en/intldateformatter.settimezone.php) now throws an [IntlException](https://www.php.net/manual/en/class.intlexception.php) on uninitialised classes/clone failures.

All [Locale](https://www.php.net/manual/en/class.locale.php) methods now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the locale argument contain null bytes.

The behaviour of **[`Collator::SORT_REGULAR`](https://www.php.net/manual/en/class.collator.php#collator.constants.sort-regular)** with respect to handling numeric strings is now aligned with the behaviour of **[`SORT_REGULAR`](https://www.php.net/manual/en/array.constants.php#constant.sort-regular)** in ext/standard.

### LDAP

[ldap_get_option()](https://www.php.net/manual/en/function.ldap-get-option.php) and [ldap_set_option()](https://www.php.net/manual/en/function.ldap-set-option.php) now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when passing an invalid option.

### MBString

Unicode data tables have been updated to Unicode 17.0

### MySQLi

Calling the mysqli constructor on an already-constructed object is now no longer possible and throws an [Error](https://www.php.net/manual/en/class.error.php).

### ODBC

ODBC now assumes that at least ODBC 3.5 functionality is available. The ODBCVER definition and build system flags to control it have been removed.

ODBC no longer has build flags to build against specific drivers (except for DB2) and removes special cases for those drivers. It is strongly recommended to use a driver manager like iODBC or unixODBC on non-Windows.

### Opcache

The Opcache extension is now always built into the PHP binary and is always loaded. The INI directives [opcache.enable](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.enable) and [opcache.enable_cli](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.enable-cli) are still honored.

The **--enable-opcache**/**--disable-opcache** configure flags have been removed, and the build does not produce `opcache.so` or `php_opcache.dll` objects anymore.

Using `zend_extension=opcache.so` or `zend_extension=php_opcache.dll` INI directives will emit a warning.

### PCNTL

[pcntl_exec()](https://www.php.net/manual/en/function.pcntl-exec.php) now throws [ValueError](https://www.php.net/manual/en/class.valueerror.php) when entries of the `args` parameter contain null bytes.

[pcntl_exec()](https://www.php.net/manual/en/function.pcntl-exec.php) now throws [ValueError](https://www.php.net/manual/en/class.valueerror.php) when entries or keys of the `env_vars` parameter contain null bytes.

### PCRE

The extension is compiled without semi-deprecated PCRE2_EXTRA_ALLOW_LOOKAROUND_BSK compile option.

### PDO

The constructor arguments set in conjunction with **[`PDO::FETCH_CLASS`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-class)** now follow the usual CUFA ([call_user_func_array()](https://www.php.net/manual/en/function.call-user-func-array.php)) semantics. This means string keys will act like a named argument. Moreover, automatic wrapping for by-value arguments passed to a by-ref parameter has been removed, and the usual **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** about this is now emitted. To pass a variable by-ref to a constructor argument use the general array value reference assignment: `$ctor_args = [&$valByRef]`

Attempting to call [PDOStatement::setFetchMode()](https://www.php.net/manual/en/pdostatement.setfetchmode.php) during a call to [PDOStatement::fetch()](https://www.php.net/manual/en/pdostatement.fetch.php), [PDOStatement::fetchObject()](https://www.php.net/manual/en/pdostatement.fetchobject.php), [PDOStatement::fetchAll()](https://www.php.net/manual/en/pdostatement.fetchall.php), for example using tricks such as passing the statement object as a constructor argument when fetching into an object, will now throw an [Error](https://www.php.net/manual/en/class.error.php).

The value of the constants **[`PDO::FETCH_GROUP`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-group)**, **[`PDO::FETCH_UNIQUE`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-unique)**, **[`PDO::FETCH_CLASSTYPE`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-classtype)**, **[`PDO::FETCH_PROPS_LATE`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-props-late)**, and **[`PDO::FETCH_SERIALIZE`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-serialize)** have changed.

A [ValueError](https://www.php.net/manual/en/class.valueerror.php) is now thrown if **[`PDO::FETCH_PROPS_LATE`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-props-late)** is used with a fetch mode different than **[`PDO::FETCH_CLASS`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-class)**, consistent with other fetch flags.

A [ValueError](https://www.php.net/manual/en/class.valueerror.php) is now thrown if **[`PDO::FETCH_INTO`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-into)** is used as a fetch mode in [PDOStatement::fetchAll()](https://www.php.net/manual/en/pdostatement.fetchall.php), similar to **[`PDO::FETCH_LAZY`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-lazy)**.

### PDO_FIREBIRD

A [ValueError](https://www.php.net/manual/en/class.valueerror.php) is now thrown when trying to set a cursor name that is too long on a [PDOStatement](https://www.php.net/manual/en/class.pdostatement.php) resulting from the Firebird driver.

### PDO_SQLITE

SQLite [PDO::quote()](https://www.php.net/manual/en/pdo.quote.php) will now throw an exception or emit a warning, depending on the error mode, if the string contains a null byte.

[PDO::sqliteCreateCollation()](https://www.php.net/manual/en/pdo.sqlitecreatecollation.php) will now throw an exception if the callback has the wrong return type, making it more in line with [Pdo\Sqlite::createCollation()](https://www.php.net/manual/en/pdo-sqlite.createcollation.php) behavior.

### POSIX

[posix_kill()](https://www.php.net/manual/en/function.posix-kill.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the process_id argument is lower or greater than what the platform supports (signed integer or long range), [posix_setpgid()](https://www.php.net/manual/en/function.posix-setpgid.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the process_id or the process_group_id is lower than zero or greater than what the platform supports.

[posix_setrlimit()](https://www.php.net/manual/en/function.posix-setrlimit.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the hard_limit or soft_limit arguments are lower than -1 or if soft_limit is greater than hard_limit.

### Reflection

[ReflectionAttribute::newInstance()](https://www.php.net/manual/en/reflectionattribute.newinstance.php) can now throw errors for internal attributes if the attribute was applied on an invalid target and the error was delayed from compile time to runtime via the \#\[\DelayedTargetValidation\] attribute.

### Session

Attempting to write session data where [`$_SESSION`](https://www.php.net/manual/en/reserved.variables.session.php) has a key containing the pipe character (`|`) will now emit a warning instead of silently failing.

[session_start()](https://www.php.net/manual/en/function.session-start.php) is stricter in regard to the options argument. It now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the array is not a hashmap, or a [TypeError](https://www.php.net/manual/en/class.typeerror.php) if the read_and_close value is not a valid type compatible with int.

### SimpleXML

Passing an XPath expression that returns something other than a node set to [SimpleXMLElement::xpath()](https://www.php.net/manual/en/simplexmlelement.xpath.php) will now emit a warning and return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**, instead of silently failing and returning an empty array.

### SNMP

[snmpget()](https://www.php.net/manual/en/function.snmpget.php), [snmpset()](https://www.php.net/manual/en/function.snmpset.php), [snmp2_get()](https://www.php.net/manual/en/function.snmp2-get.php), [snmp2_set()](https://www.php.net/manual/en/function.snmp2-set.php), [snmp3_get()](https://www.php.net/manual/en/function.snmp3-get.php), [snmp3_set()](https://www.php.net/manual/en/function.snmp3-set.php) and [SNMP::\_\_construct()](https://www.php.net/manual/en/snmp.construct.php) now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the hostname is too large, contains any null byte or if the port is given when negative or greater than 65535, timeout and retries values are lower than -1 or too large.

### SOAP

[SoapClient::\_\_doRequest()](https://www.php.net/manual/en/soapclient.dorequest.php) now accepts a new, optional `uriParserClass` parameter accepting string or **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** arguments. **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** represents the original ([parse_url()](https://www.php.net/manual/en/function.parse-url.php)) based method, while the new backends will be used when passing either [Uri\Rfc3986\Uri](https://www.php.net/manual/en/class.uri-rfc3986-uri.php) or [Uri\WhatWg\Url](https://www.php.net/manual/en/class.uri-whatwg-url.php).

### Sockets

[socket_create_listen()](https://www.php.net/manual/en/function.socket-create-listen.php), [socket_bind()](https://www.php.net/manual/en/function.socket-bind.php) and [socket_sendto()](https://www.php.net/manual/en/function.socket-sendto.php) now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the port is lower than 0 or greater than 65535, and also if any of the hints array entries are indexed numerically.

[socket_addrinfo_lookup()](https://www.php.net/manual/en/function.socket-addrinfo-lookup.php) now throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php) if any of the hints values cannot be cast to int and can throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if any of these values overflow.

[socket_set_option()](https://www.php.net/manual/en/function.socket-set-option.php) with **[`MCAST_LEAVE_GROUP`](https://www.php.net/manual/en/sockets.constants.php#constant.mcast-leave-group)**/**[`MCAST_LEAVE_SOURCE_GROUP`](https://www.php.net/manual/en/sockets.constants.php#constant.mcast-leave-source-group)** options now throw an exception if the value isn't a valid object or array.

[socket_set_option()](https://www.php.net/manual/en/function.socket-set-option.php) with multicast context now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when the created socket is not of **[`AF_INET`](https://www.php.net/manual/en/sockets.constants.php#constant.af-inet)**/**[`AF_INET6`](https://www.php.net/manual/en/sockets.constants.php#constant.af-inet6)** family.

### SPL

[ArrayObject](https://www.php.net/manual/en/class.arrayobject.php) no longer accepts enums, as modifying the \$name or \$value properties can break engine assumptions.

[SplFileObject::fwrite()](https://www.php.net/manual/en/splfileobject.fwrite.php)'s parameter `length` is now nullable. The default value changed from `0` to **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**.

### Standard

Using a printf-family function with a formatter that did not specify the precision previously incorrectly reset the precision instead of treating it as a precision of 0.

Passing an integer `0` as the `locales` argument to [setlocale()](https://www.php.net/manual/en/function.setlocale.php) is no longer supported and now throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php).

### Tidy

[tidy::\_\_construct()](https://www.php.net/manual/en/tidy.construct.php), [tidy::parseFile()](https://www.php.net/manual/en/tidy.parsefile.php), [tidy::parseString()](https://www.php.net/manual/en/tidy.parsestring.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the configuration contains an invalid value or attempts to set a read-only internal entry, and a [TypeError](https://www.php.net/manual/en/class.typeerror.php) if a configuration key is not a string.

# [PHP 8.4](https://www.php.net/manual/en/migration84.incompatible.php)

## Backward Incompatible Changes

Although not explicitly stated in this section, every new [function](https://www.php.net/manual/en/migration84.new-functions.php), [class, interface, enum](https://www.php.net/manual/en/migration84.new-classes.php), or [constant](https://www.php.net/manual/en/migration84.constants.php) may cause a redeclaration [Error](https://www.php.net/manual/en/class.error.php) to be thrown.

### PHP Core

#### [exit()](https://www.php.net/manual/en/function.exit.php) behavioral change

The [exit()](https://www.php.net/manual/en/function.exit.php) (and [die()](https://www.php.net/manual/en/function.die.php)) language constructs now behave more like a function. This means that they can now be passed like [callable](https://www.php.net/manual/en/language.types.callable.php)s, are affected by the `strict_types` declare statement, and now perform the usual type coercions instead of casting any non-integer value to a string.

As such, passing invalid types to [exit()](https://www.php.net/manual/en/function.exit.php) and [die()](https://www.php.net/manual/en/function.die.php) now consistently result in a [TypeError](https://www.php.net/manual/en/class.typeerror.php) being thrown.

#### Recursion during comparison

Encountering recursion during comparison now results in an [Error](https://www.php.net/manual/en/class.error.php) exception instead of a **[`E_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-error)** fatal error.

#### Indirect Modification of readonly Properties

Indirect modification of readonly properties within `__clone()` is no longer allowed, e.g. `$ref = &$this->readonly`. This was already forbidden for readonly initialization, and was an oversight in the "readonly reinitialization during cloning" implementation.

#### Type Change of Constants

The **[`PHP_DEBUG`](https://www.php.net/manual/en/reserved.constants.php#constant.php-debug)** and **[`PHP_ZTS`](https://www.php.net/manual/en/reserved.constants.php#constant.php-zts)** constants are now of type [bool](https://www.php.net/manual/en/language.types.boolean.php). Previously they were of type [int](https://www.php.net/manual/en/language.types.integer.php).

#### Temporary Filename Length

The name of uploaded files and files created by the [tempnam()](https://www.php.net/manual/en/function.tempnam.php) function are now 13 bytes longer. The total length is still platform-dependent.

#### Removal of **[`E_STRICT`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-strict)** error level

The **[`E_STRICT`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-strict)** error level has been removed, as it was no longer in use within the PHP engine. The **[`E_STRICT`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-strict)** constant has been deprecated.

### Extension Class Constants which are now Typed

The following extension class constants now declare a type on their constants:

- [Date](https://www.php.net/manual/en/book.datetime.php)
- [Intl](https://www.php.net/manual/en/book.intl.php)
- [PDO](https://www.php.net/manual/en/book.pdo.php)
- [Reflection](https://www.php.net/manual/en/book.reflection.php)
- [SPL](https://www.php.net/manual/en/book.spl.php)
- [Sqlite](https://www.php.net/manual/en/book.sqlite3.php)
- [XMLReader](https://www.php.net/manual/en/book.xmlreader.php)

### Resource to Object Migration

Several [resource](https://www.php.net/manual/en/language.types.resource.php)s have been migrated to [object](https://www.php.net/manual/en/language.types.object.php)s. Return value checks using [is_resource()](https://www.php.net/manual/en/function.is-resource.php) should be replaced with checks for **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**, unless specified otherwise.

#### DBA

The [DBA](https://www.php.net/manual/en/book.dba.php) functions now accept and return [Dba\Connection](https://www.php.net/manual/en/class.dba-connection.php) objects instead of `dba_connection` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

#### ODBC

The [ODBC](https://www.php.net/manual/en/book.uodbc.php) functions now accept and return [Odbc\Result](https://www.php.net/manual/en/class.odbc-result.php) objects instead of `odbc_result` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

The [ODBC](https://www.php.net/manual/en/book.uodbc.php) functions now accept and return [Odbc\Connection](https://www.php.net/manual/en/class.odbc-connection.php) objects instead of `odbc_connection` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

#### SOAP

The [SoapClient::\$httpurl](https://www.php.net/manual/en/class.soapclient.php#soapclient.props.httpurl) property is now a [Soap\Url](https://www.php.net/manual/en/class.soap-url.php) object rather than a `soap_url` [resource](https://www.php.net/manual/en/language.types.resource.php). Checks using [is_resource()](https://www.php.net/manual/en/function.is-resource.php) (i.e. `is_resource($client->httpurl)`) should be replaced with checks for **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** (i.e. `$client->httpurl !== null`).

The [SoapClient::\$sdl](https://www.php.net/manual/en/class.soapclient.php#soapclient.props.sdl) property is now a [Soap\Sdl](https://www.php.net/manual/en/class.soap-sdl.php) object rather than a `soap_sdl` [resource](https://www.php.net/manual/en/language.types.resource.php). Checks using [is_resource()](https://www.php.net/manual/en/function.is-resource.php) (i.e. `is_resource($client->sdl)`) should be replaced with checks for **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** (i.e. `$client->sdl !== null`).

### New warnings and exceptions

New warnings and exceptions have been added which are triggered on programming errors, i.e. invalid values provided as arguments.

#### Curl

[curl_multi_select()](https://www.php.net/manual/en/function.curl-multi-select.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `timeout` parameter is less than `0` or greater than **[`PHP_INT_MAX`](https://www.php.net/manual/en/reserved.constants.php#constant.php-int-max)**.

#### Gd

[imagejpeg()](https://www.php.net/manual/en/function.imagejpeg.php), [imagewebp()](https://www.php.net/manual/en/function.imagewebp.php), [imagepng()](https://www.php.net/manual/en/function.imagepng.php), [imageavif()](https://www.php.net/manual/en/function.imageavif.php) now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when an invalid `quality` is passed.

[imageavif()](https://www.php.net/manual/en/function.imageavif.php) will now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if an invalid `speed` parameter value is passed.

[imagescale()](https://www.php.net/manual/en/function.imagescale.php) will now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `width` or `height` parameters underflows/overflows.

[imagescale()](https://www.php.net/manual/en/function.imagescale.php) will now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if an invalid `mode` parameter value is passed.

[imagefilter()](https://www.php.net/manual/en/function.imagefilter.php) will now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) with the **[`IMG_FILTER_SCATTER`](https://www.php.net/manual/en/image.constants.php#constant.img-filter-scatter)** filter if the `sub` or `plus` parameters underflows/overflows.

#### Gettext

[bind_textdomain_codeset()](https://www.php.net/manual/en/function.bind-textdomain-codeset.php), [textdomain()](https://www.php.net/manual/en/function.textdomain.php), d\*gettext now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if `domain` is the empty string.

#### Intl

[resourcebundle_get()](https://www.php.net/manual/en/resourcebundle.get.php), [ResourceBundle::get()](https://www.php.net/manual/en/resourcebundle.get.php), and accessing offsets on a [ResourceBundle](https://www.php.net/manual/en/class.resourcebundle.php) object now throw:

- [TypeError](https://www.php.net/manual/en/class.typeerror.php) for invalid offset types
- [ValueError](https://www.php.net/manual/en/class.valueerror.php) for an empty [string](https://www.php.net/manual/en/language.types.string.php)
- [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the integer index does not fit in a signed 32 bit integer

[IntlDateFormatter::\_\_construct()](https://www.php.net/manual/en/intldateformatter.create.php) throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `locale` is invalid.

[NumberFormatter::\_\_construct()](https://www.php.net/manual/en/numberformatter.create.php) throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `locale` is invalid.

#### MBString

[mb_encode_numericentity()](https://www.php.net/manual/en/function.mb-encode-numericentity.php) and [mb_decode_numericentity()](https://www.php.net/manual/en/function.mb-decode-numericentity.php) now check that the `map` is only composed of [int](https://www.php.net/manual/en/language.types.integer.php)s, if not a [ValueError](https://www.php.net/manual/en/class.valueerror.php) is now thrown.

[mb_http_input()](https://www.php.net/manual/en/function.mb-http-input.php) now always throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if `type` is invalid.

[mb_http_output()](https://www.php.net/manual/en/function.mb-http-output.php) now check that the `encoding` does not contain any null bytes, if it does a [ValueError](https://www.php.net/manual/en/class.valueerror.php) is now thrown.

#### ODBC

[odbc_fetch_row()](https://www.php.net/manual/en/function.odbc-fetch-row.php) returns **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** when `row` is less than or equal to `0`. A warning is now emitted in this case.

#### PCNTL

The [pcntl_sigprocmask()](https://www.php.net/manual/en/function.pcntl-sigprocmask.php), [pcntl_sigwaitinfo()](https://www.php.net/manual/en/function.pcntl-sigwaitinfo.php), and [pcntl_sigtimedwait()](https://www.php.net/manual/en/function.pcntl-sigtimedwait.php) functions now throw:

- A [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `signals` array is empty (except for [pcntl_sigprocmask()](https://www.php.net/manual/en/function.pcntl-sigprocmask.php) if the `mode` **[`SIG_SETMASK`](https://www.php.net/manual/en/pcntl.constants.php#constant.sig-setmask)**)
- A [TypeError](https://www.php.net/manual/en/class.typeerror.php) if a value of the `signals` array is not an [int](https://www.php.net/manual/en/language.types.integer.php)
- A [ValueError](https://www.php.net/manual/en/class.valueerror.php) if a value of the `signals` array is not a valid signal number

The [pcntl_sigprocmask()](https://www.php.net/manual/en/function.pcntl-sigprocmask.php) function now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `mode` is not one of **[`SIG_BLOCK`](https://www.php.net/manual/en/pcntl.constants.php#constant.sig-block)**, **[`SIG_UNBLOCK`](https://www.php.net/manual/en/pcntl.constants.php#constant.sig-unblock)**, or **[`SIG_SETMASK`](https://www.php.net/manual/en/pcntl.constants.php#constant.sig-setmask)**.

The [pcntl_sigtimedwait()](https://www.php.net/manual/en/function.pcntl-sigtimedwait.php) function now throw:

- A [ValueError](https://www.php.net/manual/en/class.valueerror.php) if `seconds` is less than `0`
- A [ValueError](https://www.php.net/manual/en/class.valueerror.php) if `nanoseconds` is less than `0` or greater than `1e9`
- A [ValueError](https://www.php.net/manual/en/class.valueerror.php) if both `seconds` and `nanoseconds` are `0`

#### Session

Setting a non-positive value for [session.gc_divisor](https://www.php.net/manual/en/session.configuration.php#ini.session.gc-divisor) or a negative value for [session.gc_probability](https://www.php.net/manual/en/session.configuration.php#ini.session.gc-probability) now emits a warning.

#### SimpleXML

Calling [simplexml_import_dom()](https://www.php.net/manual/en/function.simplexml-import-dom.php) with a non-XML object now throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php) instead of a [ValueError](https://www.php.net/manual/en/class.valueerror.php).

#### Standard

The [round()](https://www.php.net/manual/en/function.round.php) function now validates the value of the `mode` and throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) for invalid modes. Previously, invalid modes would have been interpreted as **[`PHP_ROUND_HALF_UP`](https://www.php.net/manual/en/math.constants.php#constant.php-round-half-up)**.

The [str_getcsv()](https://www.php.net/manual/en/function.str-getcsv.php) now throws [ValueError](https://www.php.net/manual/en/class.valueerror.php)s when the `separator` and `enclosure` arguments are not one byte long, or if the `escape` argument is not one byte long nor the empty string. This aligns the behaviour to be identical to the one of [fputcsv()](https://www.php.net/manual/en/function.fputcsv.php) and [fgetcsv()](https://www.php.net/manual/en/function.fgetcsv.php).

The [php_uname()](https://www.php.net/manual/en/function.php-uname.php) function now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php) if the `mode` is invalid.

The `"allowed_classes"` option for [unserialize()](https://www.php.net/manual/en/function.unserialize.php) now throws [TypeError](https://www.php.net/manual/en/class.typeerror.php) and [ValueError](https://www.php.net/manual/en/class.valueerror.php) if it is neither an [array](https://www.php.net/manual/en/language.types.array.php) of class names nor a [bool](https://www.php.net/manual/en/language.types.boolean.php).

#### XMLReader

Passing an invalid character encoding to [XMLReader::open()](https://www.php.net/manual/en/xmlreader.open.php) or [XMLReader::XML()](https://www.php.net/manual/en/xmlreader.xml.php) now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php).

Passing a [string](https://www.php.net/manual/en/language.types.string.php) containing null bytes previously emitted a warning and now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php).

#### XMLWriter

Passing a [string](https://www.php.net/manual/en/language.types.string.php) containing null bytes previously emitted a warning and now throws a [ValueError](https://www.php.net/manual/en/class.valueerror.php).

#### XSL

[XSLTProcessor::setParameter()](https://www.php.net/manual/en/xsltprocessor.setparameter.php) will now throw a [ValueError](https://www.php.net/manual/en/class.valueerror.php) when its arguments contain null bytes. This never actually worked correctly in the first place, which is why it throws an exception now.

Calling [XSLTProcessor::importStyleSheet()](https://www.php.net/manual/en/xsltprocessor.importstylesheet.php) with a non-XML object now throws a [TypeError](https://www.php.net/manual/en/class.typeerror.php) instead of a [ValueError](https://www.php.net/manual/en/class.valueerror.php).

Failure to call a PHP function callback during evaluation now throws instead of emitting a warning.

### Date

`number` symbols in [relative formats](https://www.php.net/manual/en/datetime.formats.php#datetime.formats.relative) once again accept multiple signs, e.g. `+-2`.

### DOM

Some DOM methods previously returned **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** or a [DOMException](https://www.php.net/manual/en/class.domexception.php) with code **[`DOM_PHP_ERR`](https://www.php.net/manual/en/dom.constants.php#constant.dom-php-err)** if a new node could not be allocated. They now consistently throw a [DOMException](https://www.php.net/manual/en/class.domexception.php) with code **[`DOM_INVALID_STATE_ERR`](https://www.php.net/manual/en/dom.constants.php#constant.dom-invalid-state-err)**. This situation is extremely unlikely and the probability of being affected is low. As a result [DOMImplementation::createDocument()](https://www.php.net/manual/en/domimplementation.createdocument.php) now has a tentative return type of [DOMDocument](https://www.php.net/manual/en/class.domdocument.php) instead of `DOMDocument|false`.

Previously, [DOMXPath](https://www.php.net/manual/en/class.domxpath.php) objects could be cloned, but resulted in an unusable object. This is no longer possible, and cloning a [DOMXPath](https://www.php.net/manual/en/class.domxpath.php) object now throws an [Error](https://www.php.net/manual/en/class.error.php).

The **DOMImplementation::getFeature()** method has been removed.

### GMP

The [GMP](https://www.php.net/manual/en/class.gmp.php) class is now final and cannot be extended anymore.

### MBString

As of PHP 8.3.2, on invalid strings (those with encoding errors), [mb_substr()](https://www.php.net/manual/en/function.mb-substr.php) and [mb_strstr()](https://www.php.net/manual/en/function.mb-strstr.php) interpret character indices in the same manner as most other mbstring functions. This means that character indices returned by [mb_strpos()](https://www.php.net/manual/en/function.mb-strpos.php) can be passed to [mb_substr()](https://www.php.net/manual/en/function.mb-substr.php).

For `SJIS-mac` (MacJapanese) strings, those character indices refer to the indices of the Unicode codepoints which are produced when the string is converted to Unicode, which differ from the character indices for the `SJIS-mac` characters that convert to a sequence of several codepoints.

### MySQLi

The unused and undocumented constant **`MYSQLI_SET_CHARSET_DIR`** has been removed.

The **[`MYSQLI_STMT_ATTR_PREFETCH_ROWS`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-stmt-attr-prefetch-rows)** constant has been removed. The feature is unavailable with mysqlnd.

The **[`MYSQLI_CURSOR_TYPE_FOR_UPDATE`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-cursor-type-for-update)** and **[`MYSQLI_CURSOR_TYPE_SCROLLABLE`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-cursor-type-scrollable)** constants have been removed. This functionality was never implemented, neither with mysqlnd nor with libmysql.

The unused **[`MYSQLI_TYPE_INTERVAL`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-type-interval)** constant, which is currently a stub and an alias for **[`MYSQLI_TYPE_ENUM`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-type-enum)**, has been removed.

### MySQLnd

The error code reported for MySQL server wait timeouts has been changed from `2006` to `4031` for MySQL server versions 8.0.24 and above.

### Opcache

The maximum value of the [opcache.interned_strings_buffer](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.interned-strings-buffer) setting on 64bit architectures is now `32767`. Previously it was `4095`.

#### JIT

The default configuration values for the JIT changed from [`opcache.jit=tracing`](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit) and [`opcache.jit_buffer_size=0`](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-buffer-size) to [`opcache.jit=disable`](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit) and [`opcache.jit_buffer_size=64M`](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-buffer-size), respectively.

This does not affect the default observable behavior, as the JIT is still disabled by default. However, it is now disabled through the [opcache.jit](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit) setting, rather than [opcache.jit_buffer_size](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-buffer-size). This may affect users who previously enabled JIT through [opcache.jit_buffer_size](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit-buffer-size) exclusively, without also specifying a JIT mode using [opcache.jit](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit). To enable JIT compilation, set the [opcache.jit](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.jit) config value accordingly.

If JIT compilation is enabled, PHP will now exit with a fatal error on startup if the initialization of the JIT compiler failed for any reason.

### PCNTL

The [pcntl_sigprocmask()](https://www.php.net/manual/en/function.pcntl-sigprocmask.php), [pcntl_sigwaitinfo()](https://www.php.net/manual/en/function.pcntl-sigwaitinfo.php), and [pcntl_sigtimedwait()](https://www.php.net/manual/en/function.pcntl-sigtimedwait.php) functions now always return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** on failure. In some case previously it could return the value `-1`.

### PCRE

The bundled pcre2lib has been updated to version 10.44. As a consequence, this means `{,3}` is now recognized as a quantifier instead of as text. Furthermore, the meaning of some character classes in UCP mode has changed. Consult the [» PCRE2 Changelog](https://github.com/PCRE2Project/pcre2/blob/master/NEWS) for a full changelog.

### PDO_DBLIB

The **[`Pdo\Dblib::ATTR_STRINGIFY_UNIQUEIDENTIFIER`](https://www.php.net/manual/en/class.pdo-dblib.php#pdo-dblib.constants.attr-stringify-uniqueidentifier)** and **[`Pdo\Dblib::ATTR_DATETIME_CONVERT`](https://www.php.net/manual/en/class.pdo-dblib.php#pdo-dblib.constants.attr-datetime-convert)** attributes now act as boolean attributes instead of integer attributes. Thus setting the attribute via [PDO::setAttribute()](https://www.php.net/manual/en/pdo.setattribute.php) and retrieving it via [PDO::getAttribute()](https://www.php.net/manual/en/pdo.getattribute.php) expects and or return a [bool](https://www.php.net/manual/en/language.types.boolean.php).

### PDO_FIREBIRD

The **[`PDO::ATTR_AUTOCOMMIT`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-autocommit)** attribute now act as boolean attributes instead of integer attributes. Thus setting the attribute via [PDO::setAttribute()](https://www.php.net/manual/en/pdo.setattribute.php) and retrieving it via [PDO::getAttribute()](https://www.php.net/manual/en/pdo.getattribute.php) expects and or return a [bool](https://www.php.net/manual/en/language.types.boolean.php).

The extension now exposes some Firebird C++ APIs, therefore building this extension now requires a C++ compiler. Moreover, the extension must now be compiled against fbclient 3.0 or higher.

### PDO_MYSQL

The **[`PDO::ATTR_AUTOCOMMIT`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-autocommit)**, **[`PDO::ATTR_EMULATE_PREPARES`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-emulate-prepares)**, and **[`PDO::MYSQL_ATTR_DIRECT_QUERY`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-direct-query)** attributes now act as boolean attributes instead of integer attributes. Thus setting the attribute via [PDO::setAttribute()](https://www.php.net/manual/en/pdo.setattribute.php) and retrieving it via [PDO::getAttribute()](https://www.php.net/manual/en/pdo.getattribute.php) expects and or return a [bool](https://www.php.net/manual/en/language.types.boolean.php).

### PDO_PGSQL

The DSN's credentials, when set, are given priority over their PDO constructor counterparts, being closer to the documentation states.

### SimpleXML

[SimpleXMLElement](https://www.php.net/manual/en/class.simplexmlelement.php) is not only a representation of an XML element, but it is also a [RecursiveIterator](https://www.php.net/manual/en/class.recursiveiterator.php). Prior to PHP 8.4.0, some of its methods (e.g. [SimpleXMLElement::asXML()](https://www.php.net/manual/en/simplexmlelement.asxml.php) or [SimpleXMLElement::getName()](https://www.php.net/manual/en/simplexmlelement.getname.php)) and casting such instances to [string](https://www.php.net/manual/en/language.types.string.php) would implicitly reset the iterator.

This could cause unexpected infinite loops as the iterator was rewound. For example:

```
<?php

$xmlString = "<root><a><b>1</b><b>2</b><b>3</b></a></root>";
$xml = simplexml_load_string($xmlString);

$nodes = $xml->a->b;
foreach ($nodes as $nodeData) {
    echo "nodeData: " . $nodeData . "\n";

    $xml = $nodes->asXml();
}
```

would result in an infinite loop.

    nodeData: 1
    nodeData: 2
    nodeData: 2
    nodeData: 2
    nodeData: 2
    nodeData: 2
    nodeData: 2
    // ...

However, this behavior has now been corrected, and a [SimpleXMLElement](https://www.php.net/manual/en/class.simplexmlelement.php) will no longer implicitly reset the iterator data, unless explicitly rewound. Meaning the previous example would now result in:

    nodeData: 1
    nodeData: 2
    nodeData: 3

### SOAP

[SoapClient::\$typemap](https://www.php.net/manual/en/class.soapclient.php#soapclient.props.typemap) is now an [array](https://www.php.net/manual/en/language.types.array.php) rather than a [resource](https://www.php.net/manual/en/language.types.resource.php). Checks using [is_resource()](https://www.php.net/manual/en/function.is-resource.php) (i.e. `is_resource($client->typemap)`) should be replaced with checks for **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** (i.e. `$client->typemap !== null`).

The SOAP extension gained an optional dependency on the [session](https://www.php.net/manual/en/book.session.php) extension. If PHP is built without the session extension and with the **--enable-rtld-now** configure flag enabled, startup errors will now occur if the [SOAP](https://www.php.net/manual/en/book.soap.php) extension is also used. To solve this either don't use rtld-now or load the session extension.

### Standard

When using [strcspn()](https://www.php.net/manual/en/function.strcspn.php) with `characters` being the empty string, the length of the string is now returned instead of incorrectly stopping at the first null byte.

[http_build_query()](https://www.php.net/manual/en/function.http-build-query.php) now correctly handles backed enums.

[stream_bucket_make_writeable()](https://www.php.net/manual/en/function.stream-bucket-make-writeable.php) and [stream_bucket_new()](https://www.php.net/manual/en/function.stream-bucket-new.php) will now return a [StreamBucket](https://www.php.net/manual/en/class.streambucket.php) instance instead of an instance of [stdClass](https://www.php.net/manual/en/class.stdclass.php).

### Tidy

Failures in the constructor now throw exceptions rather than emitting warnings and having a broken object.

### XML

The xml_set\_\*\_handler functions now declare and check for an effective signature of [callable](https://www.php.net/manual/en/language.types.callable.php)\|[string](https://www.php.net/manual/en/language.types.string.php)\|[null](https://www.php.net/manual/en/language.types.null.php) for the `handler` parameters. Moreover, values of type [string](https://www.php.net/manual/en/language.types.string.php) that correspond to method names, of object set with [xml_set_object()](https://www.php.net/manual/en/function.xml-set-object.php) are now checked to see if the method exists on the class of the previously passed object. This means that [xml_set_object()](https://www.php.net/manual/en/function.xml-set-object.php) must now always be called prior to setting method names as [callable](https://www.php.net/manual/en/language.types.callable.php)s. Passing an empty string to disable the handler is still allowed, but deprecated.

However, as [xml_set_object()](https://www.php.net/manual/en/function.xml-set-object.php) and passing non-[callable](https://www.php.net/manual/en/language.types.callable.php) strings is deprecated. It is recommended to change such instances with a [callable](https://www.php.net/manual/en/language.types.callable.php) referring to the method directly.

# [PHP 8.3](https://www.php.net/manual/en/migration83.incompatible.php)

## Backward Incompatible Changes

### PHP Core

#### Programs that were very close to overflowing the call stack

Programs that were very close to overflowing the call stack may now throw an [Error](https://www.php.net/manual/en/class.error.php) when using more than zend.max_allowed_stack_size-zend.reserved_stack_size bytes of stack (fiber.stack_size-zend.reserved_stack_size for fibers).

#### Executing proc_get_status() multiple times

Executing [proc_get_status()](https://www.php.net/manual/en/function.proc-get-status.php) multiple times will now always return the right value on POSIX systems. Previously, only the first call of the function returned the right value. Executing [proc_close()](https://www.php.net/manual/en/function.proc-close.php) after [proc_get_status()](https://www.php.net/manual/en/function.proc-get-status.php) will now also return the right exit code. Previously this would return `-1`. Internally, this works by caching the result on POSIX systems. If the previous behaviour is required, it is possible to check the `"cached"` key in the array returned by [proc_get_status()](https://www.php.net/manual/en/function.proc-get-status.php) to check whether the result was cached.

#### Zend Max Execution Timers

Zend Max Execution Timers is now enabled by default for ZTS builds on Linux.

#### Uses of traits with static properties

Uses of traits with static properties will now redeclare static properties inherited from the parent class. This will create a separate static property storage for the current class. This is analogous to adding the static property to the class directly without traits.

#### Assigning a negative index to an empty array

Assigning a negative index `$n` to an empty array will now make sure that the next index is `$n+1` instead of `0`.

#### Class constant visibility variance check

Class constant visibility variance is now correctly checked when inherited from interfaces.

#### WeakMap entries whose key maps to itself

[WeakMap](https://www.php.net/manual/en/class.weakmap.php) entries whose key maps to itself (possibly transitively) may now be removed during cycle collection if the key is not reachable except by iterating over the WeakMap (reachability via iteration is considered weak). Previously, such entries would never be automatically removed.

### Date

The DateTime extension has introduced Date extension specific exceptions and errors under the [DateError](https://www.php.net/manual/en/class.dateerror.php) and [DateException](https://www.php.net/manual/en/class.dateexception.php) hierarchies, instead of warnings and generic exceptions. This improves error handling, at the expense of having to check for errors and exceptions.

### DOM

Calling [DOMChildNode::after()](https://www.php.net/manual/en/domchildnode.after.php), [DOMChildNode::before()](https://www.php.net/manual/en/domchildnode.before.php), [DOMChildNode::replaceWith()](https://www.php.net/manual/en/domchildnode.replacewith.php) on a node that has no parent is now a no-op instead of a hierarchy exception, which is the behaviour demanded by the DOM specification.

Using the [DOMParentNode](https://www.php.net/manual/en/class.domparentnode.php) and [DOMChildNode](https://www.php.net/manual/en/class.domchildnode.php) methods without a document now works instead of throwing a **[`DOM_HIERARCHY_REQUEST_ERR`](https://www.php.net/manual/en/dom.constants.php#constant.dom-hierarchy-request-err)** [DOMException](https://www.php.net/manual/en/class.domexception.php). This is in line with the behaviour demanded by the DOM specification.

Calling [DOMDocument::createAttributeNS()](https://www.php.net/manual/en/domdocument.createattributens.php) without specifying a prefix would incorrectly create a default namespace, placing the element inside the namespace instead of the attribute. This bug is now fixed.

[DOMDocument::createAttributeNS()](https://www.php.net/manual/en/domdocument.createattributens.php) would previously incorrectly throw a **`DOM_NAMESPACE_ERRNAMESPACE_ERR`** [DOMException](https://www.php.net/manual/en/class.domexception.php) when the prefix was already used for a different URI. It now correctly chooses a different prefix when there's a prefix name conflict.

New methods and properties were added to some DOM classes. If a userland class inherits from these classes and declare a method or property with the same name, the declarations must be compatible. Otherwise, a typical compile error about incompatible declarations will be thrown. See the [list of new features](https://www.php.net/manual/en/migration83.new-features.php#migration83.new-features.dom) and [new functions](https://www.php.net/manual/en/migration83.new-functions.php#migration83.new-functions.dom) for a list of the newly implemented methods and properties.

### FFI

C functions that have a return type of [void](https://www.php.net/manual/en/language.types.void.php) now return **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** instead of returning the following object `object(FFI\CData:void) { }`

### Opcache

The [opcache.consistency_checks](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.consistency-checks) INI directive was removed. This feature was broken with the tracing JIT, as well as with inheritance cache, and has been disabled without a way to enable it since PHP 8.1.18 and PHP 8.2.5. Both the tracing JIT and inheritance cache may modify shm after the script has been persisted by invalidating its checksum. The attempted fix skipped over the modifiable pointers but was rejected due to complexity. For this reason, it was decided to remove the feature instead.

### Phar

The type of [Phar](https://www.php.net/manual/en/class.phar.php) class constants are now declared.

### Standard

The [range()](https://www.php.net/manual/en/function.range.php) function has had various changes:

- A [TypeError](https://www.php.net/manual/en/class.typeerror.php) is now thrown when passing [object](https://www.php.net/manual/en/language.types.object.php)s, [resource](https://www.php.net/manual/en/language.types.resource.php)s, or [array](https://www.php.net/manual/en/language.types.array.php)s as the boundary inputs.
- A more descriptive [ValueError](https://www.php.net/manual/en/class.valueerror.php) is thrown when passing `0` for `step`.
- A [ValueError](https://www.php.net/manual/en/class.valueerror.php) is now thrown when using a negative `step` for increasing ranges.
- If `step` is a float that can be interpreted as an int, it is now done so.
- A [ValueError](https://www.php.net/manual/en/class.valueerror.php) is now thrown if any argument is infinity or NAN.
- An **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** is now emitted if `start` or `end` is the empty string. The value continues to be cast to the value `0`.
- An **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** is now emitted if `start` or `end` has more than one byte, only if it is a non-numeric string.
- An **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** is now emitted if `start` or `end` is cast to an integer because the other boundary input is a number. (e.g. `range(5, 'z');`).
- An **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** is now emitted if `step` is a float when trying to generate a range of characters, except if both boundary inputs are numeric strings (e.g. `range('5', '9', 0.5);` does not produce a warning).
- [range()](https://www.php.net/manual/en/function.range.php) now produce a list of characters if one of the boundary inputs is a string digit instead of casting the other input to int (e.g. `range('9', 'A');`).

```
<?php
range('9', 'A');  // ["9", ":", ";", "<", "=", ">", "?", "@", "A"], as of PHP 8.3.0
range('9', 'A');  // [9, 8, 7, 6, 5, 4, 3, 2, 1, 0], prior to PHP 8.3.0
?>
```

[number_format()](https://www.php.net/manual/en/function.number-format.php) now handles negative `decimals` values by rounding `num` to `abs($decimals)` digits before the decimal point. Previously, negative `decimals` values were ignored.

The [file()](https://www.php.net/manual/en/function.file.php) flags error check now catches all invalid flags. Notably **[`FILE_APPEND`](https://www.php.net/manual/en/filesystem.constants.php#constant.file-append)** was previously silently accepted.

### SNMP

The type of [SNMP](https://www.php.net/manual/en/class.snmp.php) class constants are now declared.

# [PHP 8.2](https://www.php.net/manual/en/migration82.incompatible.php)

## Backward Incompatible Changes

### Date

[DateTime::createFromImmutable()](https://www.php.net/manual/en/datetime.createfromimmutable.php) now has a tentative return type of static, previously it was [DateTime](https://www.php.net/manual/en/class.datetime.php).

[DateTimeImmutable::createFromMutable()](https://www.php.net/manual/en/datetimeimmutable.createfrommutable.php) now has a tentative return type of static, previously it was [DateTimeImmutable](https://www.php.net/manual/en/class.datetimeimmutable.php).

`number` symbols in [relative formats](https://www.php.net/manual/en/datetime.formats.php#datetime.formats.relative) no longer accept multiple signs, e.g. `+-2`.

[DateTime::getLastErrors()](https://www.php.net/manual/en/datetime.getlasterrors.php) and [DateTimeImmutable::getLastErrors()](https://www.php.net/manual/en/datetimeimmutable.getlasterrors.php) now return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** when there are no warnings or errors, previously they always returned an array.

### ODBC

The ODBC extension now escapes the username and password for the case when both a connection string and username/password are passed, and the string must be appended to. Before, user values containing values needing escaping could have created a malformed connection string, or injected values from user-provided data. The escaping rules should be identical to the .NET BCL DbConnectionOptions behaviour.

### PDO_ODBC

The PDO_ODBC extension also escapes the username and password when a connection string is passed. See the [change to the ODBC extension](https://www.php.net/manual/en/migration82.incompatible.php#migration82.incompatible.odbc) for further details.

### Standard

[glob()](https://www.php.net/manual/en/function.glob.php) now returns an empty [array](https://www.php.net/manual/en/language.types.array.php) if all paths are restricted by [open_basedir](https://www.php.net/manual/en/ini.core.php#ini.open-basedir). Previously it returned **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. Moreover, a warning is now emitted even if only some paths are restricted by [open_basedir](https://www.php.net/manual/en/ini.core.php#ini.open-basedir).

[FilesystemIterator::\_\_construct()](https://www.php.net/manual/en/filesystemiterator.construct.php): prior to PHP 8.2.0, **[`FilesystemIterator::SKIP_DOTS`](https://www.php.net/manual/en/class.filesystemiterator.php#filesystemiterator.constants.skip-dots)** constant was always set and couldn't be disabled. In order to maintain the previous behaviour the constant must be explicitly set when using the `flags` parameter. The default value from `flags` parameter has not been modified.

[strtolower()](https://www.php.net/manual/en/function.strtolower.php), [strtoupper()](https://www.php.net/manual/en/function.strtoupper.php), [stristr()](https://www.php.net/manual/en/function.stristr.php), [stripos()](https://www.php.net/manual/en/function.stripos.php), [strripos()](https://www.php.net/manual/en/function.strripos.php), [lcfirst()](https://www.php.net/manual/en/function.lcfirst.php), [ucfirst()](https://www.php.net/manual/en/function.ucfirst.php), [ucwords()](https://www.php.net/manual/en/function.ucwords.php), and [str_ireplace()](https://www.php.net/manual/en/function.str-ireplace.php) are no longer locale-sensitive. They now perform ASCII case conversion, as if the locale were "C". Localized versions of these functions are available in the [MBString extension](https://www.php.net/manual/en/book.mbstring.php). Moreover, [array_change_key_case()](https://www.php.net/manual/en/function.array-change-key-case.php), and sorting with **[`SORT_FLAG_CASE`](https://www.php.net/manual/en/array.constants.php#constant.sort-flag-case)** now also use ASCII case conversion.

[str_split()](https://www.php.net/manual/en/function.str-split.php) returns an empty [array](https://www.php.net/manual/en/language.types.array.php) for an empty [string](https://www.php.net/manual/en/language.types.string.php) now. Previously it returned an array with a single empty string entry. [mb_str_split()](https://www.php.net/manual/en/function.mb-str-split.php) is not affected by this change as it was already behaving like that.

[ksort()](https://www.php.net/manual/en/function.ksort.php) and [krsort()](https://www.php.net/manual/en/function.krsort.php) now do numeric string comparison under **[`SORT_REGULAR`](https://www.php.net/manual/en/array.constants.php#constant.sort-regular)** using the standard PHP 8 rules now.

[var_export()](https://www.php.net/manual/en/function.var-export.php) no longer omits the leading backslash for exported classes, i.e. these are now fully qualified.

### Standard PHP Library (SPL)

The following methods now enforce their signature:

- **SplFileInfo::\_bad_state_ex()**
- [SplFileObject::getCsvControl()](https://www.php.net/manual/en/splfileobject.getcsvcontrol.php)
- [SplFileObject::fflush()](https://www.php.net/manual/en/splfileobject.fflush.php)
- [SplFileObject::ftell()](https://www.php.net/manual/en/splfileobject.ftell.php)
- [SplFileObject::fgetc()](https://www.php.net/manual/en/splfileobject.fgetc.php)
- [SplFileObject::fpassthru()](https://www.php.net/manual/en/splfileobject.fpassthru.php)

[SplFileObject::hasChildren()](https://www.php.net/manual/en/splfileobject.haschildren.php) now has a tentative return type of [false](https://www.php.net/manual/en/language.types.singleton.php), previously it was [bool](https://www.php.net/manual/en/language.types.boolean.php).

[SplFileObject::getChildren()](https://www.php.net/manual/en/splfileobject.getchildren.php) now has a tentative return type of [null](https://www.php.net/manual/en/language.types.null.php), previously it was ?[RecursiveIterator](https://www.php.net/manual/en/class.recursiveiterator.php).

[GlobIterator](https://www.php.net/manual/en/class.globiterator.php) now returns an empty [array](https://www.php.net/manual/en/language.types.array.php) if all paths are restricted by [open_basedir](https://www.php.net/manual/en/ini.core.php#ini.open-basedir). Previously it returned **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. Moreover, a warning is now emitted even if only some paths are restricted by [open_basedir](https://www.php.net/manual/en/ini.core.php#ini.open-basedir).

# [PHP 8.1](https://www.php.net/manual/en/migration81.incompatible.php)

## Backward Incompatible Changes

### PHP Core

#### \$GLOBALS Access Restrictions

Access to the [`$GLOBALS`](https://www.php.net/manual/en/reserved.variables.globals.php) array is now subject to a number of restrictions. Read and write access to individual array elements like `$GLOBALS['var']` continues to work as-is. Read-only access to the entire [`$GLOBALS`](https://www.php.net/manual/en/reserved.variables.globals.php) array also continues to be supported. However, write access to the entire [`$GLOBALS`](https://www.php.net/manual/en/reserved.variables.globals.php) array is no longer supported. For example, `array_pop($GLOBALS)` will result in an error.

#### Usage of static Variables in Inherited Methods

When a method using static variables is inherited (but not overridden), the inherited method will now share static variables with the parent method.

```
<?php
class A {
    public static function counter() {
        static $counter = 0;
        $counter++;
        return $counter;
    }
}
class B extends A {}
var_dump(A::counter()); // int(1)
var_dump(A::counter()); // int(2)
var_dump(B::counter()); // int(3), previously int(1)
var_dump(B::counter()); // int(4), previously int(2)
?>
```

This means that static variables in methods now behave the same way as static properties.

#### Optional parameters specified before required parameters

An [optional parameter](https://www.php.net/manual/en/functions.arguments.php#functions.arguments.default) specified before required parameters is now always treated as required, even when called using [named arguments](https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments). As of PHP 8.0.0, but prior to PHP 8.1.0, the below emits a deprecation notice on the definition, but runs successfully when called. As of PHP 8.1.0, an error of class [ArgumentCountError](https://www.php.net/manual/en/class.argumentcounterror.php) is thrown, as it would be when called with positional arguments.

```
<?php
function makeyogurt($container = "bowl", $flavour)
{
    return "Making a $container of $flavour yogurt.\n";
}
try
{
    echo makeyogurt(flavour: "raspberry");
}
catch (Error $e)
{
    echo get_class($e), ' - ', $e->getMessage(), "\n";
}
?>
```

Output of the above example in PHP 8.0:

    Deprecated: Required parameter $flavour follows optional parameter $container
     in example.php on line 3
    Making a bowl of raspberry yogurt.

Output of the above example in PHP 8.1:

    Deprecated: Optional parameter $container declared before required parameter
     $flavour is implicitly treated as a required parameter in example.php on line 3
    ArgumentCountError - makeyogurt(): Argument #1 ($container) not passed

Note that a default value of **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** can be used before required parameters to specify a [nullable type](https://www.php.net/manual/en/language.types.declarations.php#language.types.declarations.nullable), but the parameter will still be required.

#### Return Type Compatibility with Internal Classes

Most non-final internal methods now require overriding methods to declare a compatible return type, otherwise a deprecated notice is emitted during inheritance validation. In case the return type cannot be declared for an overriding method due to PHP cross-version compatibility concerns, a [ReturnTypeWillChange](https://www.php.net/manual/en/class.returntypewillchange.php) attribute can be added to silence the deprecation notice.

#### New Keywords

`readonly` is a keyword now. However, it still may be used as function name.

`never` is now a reserved word, so it cannot be used to name a class, interface or trait, and is also prohibited from being used in namespaces.

### Resource to Object Migration

Several [resource](https://www.php.net/manual/en/language.types.resource.php)s have been migrated to [object](https://www.php.net/manual/en/language.types.object.php)s. Return value checks using [is_resource()](https://www.php.net/manual/en/function.is-resource.php) should be replaced with checks for **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

- The [FileInfo](https://www.php.net/manual/en/book.fileinfo.php) functions now accept and return [finfo](https://www.php.net/manual/en/class.finfo.php) objects instead of `fileinfo` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [FTP](https://www.php.net/manual/en/book.ftp.php) functions now accept and return [FTP\Connection](https://www.php.net/manual/en/class.ftp-connection.php) objects instead of `ftp` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [IMAP](https://www.php.net/manual/en/book.imap.php) functions now accept and return [IMAP\Connection](https://www.php.net/manual/en/class.imap-connection.php) objects instead of `imap` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [LDAP](https://www.php.net/manual/en/book.ldap.php) functions now accept and return [LDAP\Connection](https://www.php.net/manual/en/class.ldap-connection.php) objects instead of `ldap link` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [LDAP](https://www.php.net/manual/en/book.ldap.php) functions now accept and return [LDAP\Result](https://www.php.net/manual/en/class.ldap-result.php) objects instead of `ldap result` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [LDAP](https://www.php.net/manual/en/book.ldap.php) functions now accept and return [LDAP\ResultEntry](https://www.php.net/manual/en/class.ldap-result-entry.php) objects instead of `ldap result entry` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [PgSQL](https://www.php.net/manual/en/book.pgsql.php) functions now accept and return [PgSql\Connection](https://www.php.net/manual/en/class.pgsql-connection.php) objects instead of `pgsql link` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [PgSQL](https://www.php.net/manual/en/book.pgsql.php) functions now accept and return [PgSql\Result](https://www.php.net/manual/en/class.pgsql-result.php) objects instead of `pgsql result` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [PgSQL](https://www.php.net/manual/en/book.pgsql.php) functions now accept and return [PgSql\Lob](https://www.php.net/manual/en/class.pgsql-lob.php) objects instead of `pgsql large object` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [PSpell](https://www.php.net/manual/en/book.pspell.php) functions now accept and return [PSpell\Dictionary](https://www.php.net/manual/en/class.pspell-dictionary.php) objects instead of `pspell` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- The [PSpell](https://www.php.net/manual/en/book.pspell.php) functions now accept and return [PSpell\Config](https://www.php.net/manual/en/class.pspell-config.php) objects instead of `pspell config` [resource](https://www.php.net/manual/en/language.types.resource.php)s.

### MySQLi

[mysqli_fetch_fields()](https://www.php.net/manual/en/mysqli-result.fetch-fields.php), and [mysqli_fetch_field_direct()](https://www.php.net/manual/en/mysqli-result.fetch-field-direct.php) will now always return `0` for the max_length. This information can be computed by iterating over the result set, and taking the maximum length. This is what PHP was doing internally previously.

The **[`MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-stmt-attr-update-max-length)** option no longer has any effect.

The **[`MYSQLI_STORE_RESULT_COPY_DATA`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-store-result-copy-data)** option no longer has any effect. Passing any value to the `mode` parameter of [mysqli::store_result()](https://www.php.net/manual/en/mysqli.store-result.php) no longer has any effect.

[mysqli::connect()](https://www.php.net/manual/en/mysqli.construct.php) now returns **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** instead of **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** on success.

The default error handling mode has been changed from "silent" to "exceptions" See the [MySQLi reporting mode](https://www.php.net/manual/en/mysqli-driver.report-mode.php) page for more details on what this entails, and how to explicitly set this attribute. To restore the previous behaviour use: `mysqli_report(MYSQLI_REPORT_OFF);`

Classes extending [mysqli_stmt::execute()](https://www.php.net/manual/en/mysqli-stmt.execute.php) are now required to specify the additional optional parameter.

### MySQLnd

The [mysqlnd.fetch_data_copy](https://www.php.net/manual/en/mysqlnd.config.php#ini.mysqlnd.fetch_data_copy) INI directive has been removed. This should not result in user-visible behavior changes.

### OpenSSL

EC private keys will now be exported in PKCS\#8 format rather than traditional format, just like all other keys.

[openssl_pkcs7_encrypt()](https://www.php.net/manual/en/function.openssl-pkcs7-encrypt.php) and [openssl_cms_encrypt()](https://www.php.net/manual/en/function.openssl-cms-encrypt.php) will now default to using AES-128-CBC rather than RC2-40. The RC2-40 cipher is considered insecure and not enabled by default by OpenSSL 3.

### PHP Data Objects

**[`PDO::ATTR_STRINGIFY_FETCHES`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-stringify-fetches)** now stringifies values of type [bool](https://www.php.net/manual/en/language.types.boolean.php) to `"0"` or `"1"`. Previously [bool](https://www.php.net/manual/en/language.types.boolean.php)s were not stringified.

Calling [PDOStatement::bindColumn()](https://www.php.net/manual/en/pdostatement.bindcolumn.php) with **[`PDO::PARAM_LOB`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.param-lob)** will now constantly bind a stream result when **[`PDO::ATTR_STRINGIFY_FETCHES`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-stringify-fetches)** is not enabled. Previously, the result would either be a stream or a string depending on the used database driver and the time the binding is performed.

#### MySQL Driver

Integers and floats in result sets will now be returned using native PHP types instead of [string](https://www.php.net/manual/en/language.types.string.php)s when using emulated prepared statements. This matches the behavior of native prepared statements. The previous behaviour can be restored by enabling the **[`PDO::ATTR_STRINGIFY_FETCHES`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-stringify-fetches)** option.

#### SQLite Driver

Integers and floats in results sets will now be returned using native PHP types. The previous behaviour can be restored by enabling the **[`PDO::ATTR_STRINGIFY_FETCHES`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-stringify-fetches)** option.

### Phar

To comply with the [ArrayAccess](https://www.php.net/manual/en/class.arrayaccess.php) interface, [Phar::offsetUnset()](https://www.php.net/manual/en/phar.offsetunset.php) and [PharData::offsetUnset()](https://www.php.net/manual/en/phardata.offsetunset.php) no longer return a [bool](https://www.php.net/manual/en/language.types.boolean.php).

### Standard

[version_compare()](https://www.php.net/manual/en/function.version-compare.php) no longer accepts undocumented operator abbreviations.

[htmlspecialchars()](https://www.php.net/manual/en/function.htmlspecialchars.php), [htmlentities()](https://www.php.net/manual/en/function.htmlentities.php), [htmlspecialchars_decode()](https://www.php.net/manual/en/function.htmlspecialchars-decode.php), [html_entity_decode()](https://www.php.net/manual/en/function.html-entity-decode.php), and [get_html_translation_table()](https://www.php.net/manual/en/function.get-html-translation-table.php) now use `ENT_QUOTES | ENT_SUBSTITUTE` rather than **[`ENT_COMPAT`](https://www.php.net/manual/en/string.constants.php#constant.ent-compat)** by default. This means that `'` is escaped to `&#039;` while previously nothing was done. Additionally, malformed UTF-8 will be replaced by a Unicode substitution character, instead of resulting in an empty string.

[debug_zval_dump()](https://www.php.net/manual/en/function.debug-zval-dump.php) now prints the refcount of a reference wrappers with their refcount, instead of only prepending `&` to the value. This more accurately models reference representation since PHP 7.0.

[debug_zval_dump()](https://www.php.net/manual/en/function.debug-zval-dump.php) now prints `interned` instead of a dummy refcount for interned strings and immutable arrays.

### Standard PHP Library (SPL)

[SplFixedArray](https://www.php.net/manual/en/class.splfixedarray.php), will now be JSON encoded like an [array](https://www.php.net/manual/en/language.types.array.php)

# [PHP 8.0](https://www.php.net/manual/en/migration80.incompatible.php)

## Backward Incompatible Changes

### PHP Core

#### String to Number Comparison

Non-strict comparisons between numbers and non-numeric strings now work by casting the number to string and comparing the strings. Comparisons between numbers and numeric strings continue to work as before. Notably, this means that `0 == "not-a-number"` is considered false now.

| Comparison | Before | After |
|----|----|----|
| `0 == "0"` | **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** | **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** |
| `0 == "0.0"` | **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** | **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** |
| `0 == "foo"` | **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** | **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** |
| `0 == ""` | **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** | **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** |
| `42 == " 42"` | **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** | **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** |
| `42 == "42foo"` | **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** | **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** |

#### Other incompatible Changes

- `match` is now a reserved keyword.

- `mixed` is now a reserved word, so it cannot be used to name a class, interface or trait, and is also prohibited from being used in namespaces.

- Assertion failures now throw by default. If the old behavior is desired, `assert.exception=0` can be set in the INI settings.

- Methods with the same name as the class are no longer interpreted as constructors. The [\_\_construct()](https://www.php.net/manual/en/language.oop5.decon.php#object.construct) method should be used instead.

- The ability to call non-static methods statically has been removed. Thus [is_callable()](https://www.php.net/manual/en/function.is-callable.php) will fail when checking for a non-static method with a classname (must check with an object instance).

- The `(real)` and `(unset)` casts have been removed.

- The [track_errors](https://www.php.net/manual/en/errorfunc.configuration.php#ini.track-errors) ini directive has been removed. This means that `php_errormsg` is no longer available. The [error_get_last()](https://www.php.net/manual/en/function.error-get-last.php) function may be used instead.

- The ability to define case-insensitive constants has been removed. The third argument to [define()](https://www.php.net/manual/en/function.define.php) may no longer be **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)**.

- The ability to specify an autoloader using an [\_\_autoload()](https://www.php.net/manual/en/function.autoload.php) function has been removed. [spl_autoload_register()](https://www.php.net/manual/en/function.spl-autoload-register.php) should be used instead.

- The `errcontext` argument will no longer be passed to custom error handlers set with [set_error_handler()](https://www.php.net/manual/en/function.set-error-handler.php).

- [create_function()](https://www.php.net/manual/en/function.create-function.php) has been removed. Anonymous functions may be used instead.

- [each()](https://www.php.net/manual/en/function.each.php) has been removed. [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php) or [ArrayIterator](https://www.php.net/manual/en/class.arrayiterator.php) should be used instead.

- The ability to unbind `this` from closures that were created from a method, using [Closure::fromCallable()](https://www.php.net/manual/en/closure.fromcallable.php) or [ReflectionMethod::getClosure()](https://www.php.net/manual/en/reflectionmethod.getclosure.php), has been removed.

- The ability to unbind `this` from proper closures that contain uses of `this` has also been removed.

- The ability to use [array_key_exists()](https://www.php.net/manual/en/function.array-key-exists.php) with objects has been removed. [isset()](https://www.php.net/manual/en/function.isset.php) or [property_exists()](https://www.php.net/manual/en/function.property-exists.php) may be used instead.

- The behavior of [array_key_exists()](https://www.php.net/manual/en/function.array-key-exists.php) regarding the type of the `key` parameter has been made consistent with [isset()](https://www.php.net/manual/en/function.isset.php) and normal array access. All key types now use the usual coercions and array/object keys throw a [TypeError](https://www.php.net/manual/en/class.typeerror.php).

- Any array that has a number n as its first numeric key will use n+1 for its next implicit key, even if n is negative.

- The default error_reporting level is now **[`E_ALL`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-all)**. Previously it excluded **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** and **[`E_DEPRECATED`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-deprecated)**.

- [display_startup_errors](https://www.php.net/manual/en/errorfunc.configuration.php#ini.display-startup-errors) is now enabled by default.

- Using parent inside a class that has no parent will now result in a fatal compile-time error.

- The `@` operator will no longer silence fatal errors (**[`E_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-error)**, **[`E_CORE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-core-error)**, **[`E_COMPILE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-compile-error)**, **[`E_USER_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-user-error)**, **[`E_RECOVERABLE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-recoverable-error)**, **[`E_PARSE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-parse)**). Error handlers that expect error_reporting to be `0` when `@` is used, should be adjusted to use a mask check instead:

  ```
  <?php
  // Replace
  function my_error_handler($err_no, $err_msg, $filename, $linenum) {
      if (error_reporting() == 0) {
          return false;
      }
      // ...
  }

  // With
  function my_error_handler($err_no, $err_msg, $filename, $linenum) {
      if (!(error_reporting() & $err_no)) {
          return false;
      }
      // ...
  }
  ?>
  ```

  Additionally, care should be taken that error messages are not displayed in production environments, which can result in information leaks. Please ensure that `display_errors=Off` is used in conjunction with error logging.

- `#[` is no longer interpreted as the start of a comment, as this syntax is now used for attributes.

- Inheritance errors due to incompatible method signatures (LSP violations) will now always generate a fatal error. Previously a warning was generated in some cases.

- The precedence of the concatenation operator has changed relative to bitshifts and addition as well as subtraction.

  ```
  <?php
  echo "Sum: " . $a + $b;
  // was previously interpreted as:
  echo ("Sum: " . $a) + $b;
  // is now interpreted as:
  echo "Sum:" . ($a + $b);
  ?>
  ```

- Arguments with a default value that resolves to **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** at runtime will no longer implicitly mark the argument type as nullable. Either an explicit nullable type, or an explicit **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** default value has to be used instead.

  ```
  <?php
  // Replace
  function test(int $arg = CONST_RESOLVING_TO_NULL) {}
  // With
  function test(?int $arg = CONST_RESOLVING_TO_NULL) {}
  // Or
  function test(int $arg = null) {}
  ?>
  ```

- A number of warnings have been converted into [Error](https://www.php.net/manual/en/class.error.php) exceptions:

  - Attempting to write to a property of a non-object. Previously this implicitly created an stdClass object for null, false and empty strings.
  - Attempting to append an element to an array for which the PHP_INT_MAX key is already used.
  - Attempting to use an invalid type (array or object) as an array key or string offset.
  - Attempting to write to an array index of a scalar value.
  - Attempting to unpack a non-array/Traversable.
  - Attempting to access unqualified constants which are undefined. Previously, unqualified constant accesses resulted in a warning and were interpreted as strings.
  - Passing the wrong number of arguments to a non-variadic built-in function will throw an [ArgumentCountError](https://www.php.net/manual/en/class.argumentcounterror.php).
  - Passing invalid countable types to [count()](https://www.php.net/manual/en/function.count.php) will throw a [TypeError](https://www.php.net/manual/en/class.typeerror.php).

  A number of notices have been converted into warnings:

  - Attempting to read an undefined variable.
  - Attempting to read an undefined property.
  - Attempting to read an undefined array key.
  - Attempting to read a property of a non-object.
  - Attempting to access an array index of a non-array.
  - Attempting to convert an array to string.
  - Attempting to use a resource as an array key.
  - Attempting to use null, a boolean, or a float as a string offset.
  - Attempting to read an out-of-bounds string offset.
  - Attempting to assign an empty string to a string offset.

- Attempting to assign multiple bytes to a string offset will now emit a warning.

- Unexpected characters in source files (such as NUL bytes outside of strings) will now result in a [ParseError](https://www.php.net/manual/en/class.parseerror.php) exception instead of a compile warning.

- Uncaught exceptions now go through "clean shutdown", which means that destructors will be called after an uncaught exception.

- The compile time fatal error "Only variables can be passed by reference" has been delayed until runtime, and converted into an "Argument cannot be passed by reference" [Error](https://www.php.net/manual/en/class.error.php) exception.

- Some "Only variables should be passed by reference" notices have been converted to "Argument cannot be passed by reference" exception.

- The generated name for anonymous classes has changed. It will now include the name of the first parent or interface:

  ```
  <?php
  new class extends ParentClass {};
  // -> ParentClass@anonymous
  new class implements FirstInterface, SecondInterface {};
  // -> FirstInterface@anonymous
  new class {};
  // -> class@anonymous
  ?>
  ```

  The name shown above is still followed by a NUL byte and a unique suffix.

- Non-absolute trait method references in trait alias adaptations are now required to be unambiguous:

  ```
  <?php
  class X {
      use T1, T2 {
          func as otherFunc;
      }
      function func() {}
  }
  ?>
  ```

  If both `T1::func()` and `T2::func()` exist, this code was previously silently accepted, and func was assumed to refer to `T1::func`. Now it will generate a fatal error instead, and either `T1::func` or `T2::func` needs to be written explicitly.

- The signature of abstract methods defined in traits is now checked against the implementing class method:

  ```
  <?php
  trait MyTrait {
      abstract private function neededByTrait(): string;
  }

  class MyClass {
      use MyTrait;

      // Error, because of return type mismatch.
      private function neededByTrait(): int { return 42; }
  }
  ?>
  ```

- Disabled functions are now treated exactly like non-existent functions. Calling a disabled function will report it as unknown, and redefining a disabled function is now possible.

- `data://` stream wrappers are no longer writable, which matches the documented behavior.

- The arithmetic and bitwise operators `+`, `-`, `*`, `/`, `**`, `%`, `<<`, `>>`, `&`, `|`, `^`, `~`, `++`, `--` will now consistently throw a [TypeError](https://www.php.net/manual/en/class.typeerror.php) when one of the operands is an [array](https://www.php.net/manual/en/language.types.array.php), [resource](https://www.php.net/manual/en/language.types.resource.php) or non-overloaded [object](https://www.php.net/manual/en/language.types.object.php). The only exception to this is the array `+` array merge operation, which remains supported.

- Float to string casting will now always behave locale-independently.

  ```
  <?php
  setlocale(LC_ALL, "de_DE");
  $f = 3.14;
  echo $f, "\n";
  // Previously: 3,14
  // Now:        3.14
  ?>
  ```

  See [printf()](https://www.php.net/manual/en/function.printf.php), [number_format()](https://www.php.net/manual/en/function.number-format.php) and **NumberFormatter()** for ways to customize number formatting.

- Support for deprecated curly braces for offset access has been removed.

  ```
  <?php
  // Instead of:
  $array{0};
  $array{"key"};
  // Write:
  $array[0];
  $array["key"];
  ?>
  ```

- Applying the final modifier on a private method will now produce a warning unless that method is the constructor.

- If an object constructor [exit()](https://www.php.net/manual/en/function.exit.php)s, the object destructor will no longer be called. This matches the behavior when the constructor throws.

- Namespaced names can no longer contain whitespace: While `Foo\Bar` will be recognized as a namespaced name, `Foo \ Bar` will not. Conversely, reserved keywords are now permitted as namespace segments, which may also change the interpretation of code: `new\x` is now the same as `constant('new\x')`, not `new \x()`.

- Nested ternaries now require explicit parentheses.

- [debug_backtrace()](https://www.php.net/manual/en/function.debug-backtrace.php) and [Exception::getTrace()](https://www.php.net/manual/en/exception.gettrace.php) will no longer provide references to arguments. It will not be possible to change function arguments through the backtrace.

- Numeric string handling has been altered to be more intuitive and less error-prone. Trailing whitespace is now allowed in numeric strings for consistency with how leading whitespace is treated. This mostly affects:

  - The [is_numeric()](https://www.php.net/manual/en/function.is-numeric.php) function
  - String-to-string comparisons
  - Type declarations
  - Increment and decrement operations

  The concept of a "leading-numeric string" has been mostly dropped; the cases where this remains exist in order to ease migration. Strings which emitted an **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** "A non well-formed numeric value encountered" will now emit an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** "A non-numeric value encountered" and all strings which emitted an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** "A non-numeric value encountered" will now throw a [TypeError](https://www.php.net/manual/en/class.typeerror.php). This mostly affects:

  - Arithmetic operations
  - Bitwise operations

  This **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** to [TypeError](https://www.php.net/manual/en/class.typeerror.php) change also affects the **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** "Illegal string offset 'string'" for illegal string offsets. The behavior of explicit casts to int/float from strings has not been changed.

- Magic Methods will now have their arguments and return types checked if they have them declared. The signatures should match the following list:

  - `__call(string $name, array $arguments): mixed`
  - `__callStatic(string $name, array $arguments): mixed`
  - `__clone(): void`
  - `__debugInfo(): ?array`
  - `__get(string $name): mixed`
  - `__invoke(mixed $arguments): mixed`
  - `__isset(string $name): bool`
  - `__serialize(): array`
  - `__set(string $name, mixed $value): void`
  - `__set_state(array $properties): object`
  - `__sleep(): array`
  - `__unserialize(array $data): void`
  - `__unset(string $name): void`
  - `__wakeup(): void`

- [call_user_func_array()](https://www.php.net/manual/en/function.call-user-func-array.php) array keys will now be interpreted as parameter names, instead of being silently ignored.

- Declaring a function called `assert()` inside a namespace is no longer allowed, and issues **[`E_COMPILE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-compile-error)**. The [assert()](https://www.php.net/manual/en/function.assert.php) function is subject to special handling by the engine, which may lead to inconsistent behavior when defining a namespaced function with the same name.

### Resource to Object Migration

Several [resource](https://www.php.net/manual/en/language.types.resource.php)s have been migrated to [object](https://www.php.net/manual/en/language.types.object.php)s. Return value checks using [is_resource()](https://www.php.net/manual/en/function.is-resource.php) should be replaced with checks for **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

- [curl_init()](https://www.php.net/manual/en/function.curl-init.php) will now return a [CurlHandle](https://www.php.net/manual/en/class.curlhandle.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php). The [curl_close()](https://www.php.net/manual/en/function.curl-close.php) function no longer has an effect, instead the [CurlHandle](https://www.php.net/manual/en/class.curlhandle.php) instance is automatically destroyed if it is no longer referenced.

- [curl_multi_init()](https://www.php.net/manual/en/function.curl-multi-init.php) will now return a [CurlMultiHandle](https://www.php.net/manual/en/class.curlmultihandle.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php). The [curl_multi_close()](https://www.php.net/manual/en/function.curl-multi-close.php) function no longer has an effect, instead the [CurlMultiHandle](https://www.php.net/manual/en/class.curlmultihandle.php) instance is automatically destroyed if it is no longer referenced.

- [curl_share_init()](https://www.php.net/manual/en/function.curl-share-init.php) will now return a [CurlShareHandle](https://www.php.net/manual/en/class.curlsharehandle.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php). The [curl_share_close()](https://www.php.net/manual/en/function.curl-share-close.php) function no longer has an effect, instead the [CurlShareHandle](https://www.php.net/manual/en/class.curlsharehandle.php) instance is automatically destroyed if it is no longer referenced.

- [enchant_broker_init()](https://www.php.net/manual/en/function.enchant-broker-init.php) will now return an [EnchantBroker](https://www.php.net/manual/en/class.enchantbroker.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php).

- [enchant_broker_request_dict()](https://www.php.net/manual/en/function.enchant-broker-request-dict.php) and [enchant_broker_request_pwl_dict()](https://www.php.net/manual/en/function.enchant-broker-request-pwl-dict.php) will now return an [EnchantDictionary](https://www.php.net/manual/en/class.enchantdictionary.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php).

- The GD extension now uses [GdImage](https://www.php.net/manual/en/class.gdimage.php) objects as the underlying data structure for images, rather than [resource](https://www.php.net/manual/en/language.types.resource.php)s. The [imagedestroy()](https://www.php.net/manual/en/function.imagedestroy.php) function no longer has an effect; instead the [GdImage](https://www.php.net/manual/en/class.gdimage.php) instance is automatically destroyed if it is no longer referenced.

- [openssl_x509_read()](https://www.php.net/manual/en/function.openssl-x509-read.php) and [openssl_csr_sign()](https://www.php.net/manual/en/function.openssl-csr-sign.php) will now return an [OpenSSLCertificate](https://www.php.net/manual/en/class.opensslcertificate.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php). The [openssl_x509_free()](https://www.php.net/manual/en/function.openssl-x509-free.php) function is deprecated and no longer has an effect, instead the [OpenSSLCertificate](https://www.php.net/manual/en/class.opensslcertificate.php) instance is automatically destroyed if it is no longer referenced.

- [openssl_csr_new()](https://www.php.net/manual/en/function.openssl-csr-new.php) will now return an [OpenSSLCertificateSigningRequest](https://www.php.net/manual/en/class.opensslcertificatesigningrequest.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php).

- [openssl_pkey_new()](https://www.php.net/manual/en/function.openssl-pkey-new.php) will now return an [OpenSSLAsymmetricKey](https://www.php.net/manual/en/class.opensslasymmetrickey.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php). The [openssl_pkey_free()](https://www.php.net/manual/en/function.openssl-pkey-free.php) function is deprecated and no longer has an effect, instead the [OpenSSLAsymmetricKey](https://www.php.net/manual/en/class.opensslasymmetrickey.php) instance is automatically destroyed if it is no longer referenced.

- [shmop_open()](https://www.php.net/manual/en/function.shmop-open.php) will now return a [Shmop](https://www.php.net/manual/en/class.shmop.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php). The [shmop_close()](https://www.php.net/manual/en/function.shmop-close.php) function no longer has an effect, and is deprecated; instead the [Shmop](https://www.php.net/manual/en/class.shmop.php) instance is automatically destroyed if it is no longer referenced.

- [socket_create()](https://www.php.net/manual/en/function.socket-create.php), [socket_create_listen()](https://www.php.net/manual/en/function.socket-create-listen.php), [socket_accept()](https://www.php.net/manual/en/function.socket-accept.php), [socket_import_stream()](https://www.php.net/manual/en/function.socket-import-stream.php), [socket_addrinfo_connect()](https://www.php.net/manual/en/function.socket-addrinfo-connect.php), [socket_addrinfo_bind()](https://www.php.net/manual/en/function.socket-addrinfo-bind.php), and [socket_wsaprotocol_info_import()](https://www.php.net/manual/en/function.socket-wsaprotocol-info-import.php) will now return a [Socket](https://www.php.net/manual/en/class.socket.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php). [socket_addrinfo_lookup()](https://www.php.net/manual/en/function.socket-addrinfo-lookup.php) will now return an array of [AddressInfo](https://www.php.net/manual/en/class.addressinfo.php) objects rather than [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- [msg_get_queue()](https://www.php.net/manual/en/function.msg-get-queue.php) will now return an [SysvMessageQueue](https://www.php.net/manual/en/class.sysvmessagequeue.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php).

- [sem_get()](https://www.php.net/manual/en/function.sem-get.php) will now return an [SysvSemaphore](https://www.php.net/manual/en/class.sysvsemaphore.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php).

- [shm_attach()](https://www.php.net/manual/en/function.shm-attach.php) will now return an [SysvSharedMemory](https://www.php.net/manual/en/class.sysvsharedmemory.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php).

- [xml_parser_create()](https://www.php.net/manual/en/function.xml-parser-create.php) and [xml_parser_create_ns()](https://www.php.net/manual/en/function.xml-parser-create-ns.php) will now return an [XMLParser](https://www.php.net/manual/en/class.xmlparser.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php). The [xml_parser_free()](https://www.php.net/manual/en/function.xml-parser-free.php) function no longer has an effect, instead the XMLParser instance is automatically destroyed if it is no longer referenced.

- The [XMLWriter](https://www.php.net/manual/en/book.xmlwriter.php) functions now accept and return, respectively, [XMLWriter](https://www.php.net/manual/en/class.xmlwriter.php) objects instead of [resource](https://www.php.net/manual/en/language.types.resource.php)s.

- [inflate_init()](https://www.php.net/manual/en/function.inflate-init.php) will now return an [InflateContext](https://www.php.net/manual/en/class.inflatecontext.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php).

- [deflate_init()](https://www.php.net/manual/en/function.deflate-init.php) will now return a [DeflateContext](https://www.php.net/manual/en/class.deflatecontext.php) object rather than a [resource](https://www.php.net/manual/en/language.types.resource.php).

### COM and .Net (Windows)

The ability to import case-insensitive constants from type libraries has been removed. The second argument to [com_load_typelib()](https://www.php.net/manual/en/function.com-load-typelib.php) may no longer be false; [com.autoregister_casesensitive](https://www.php.net/manual/en/com.configuration.php#ini.com.autoregister-casesensitive) may no longer be disabled; case-insensitive markers in [com.typelib_file](https://www.php.net/manual/en/com.configuration.php#ini.com.typelib-file) are ignored.

### CURL

**[`CURLOPT_POSTFIELDS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-postfields)** no longer accepts objects as arrays. To interpret an object as an array, perform an explicit `(array)` cast. The same applies to other options accepting arrays as well.

### Date and Time

[mktime()](https://www.php.net/manual/en/function.mktime.php) and [gmmktime()](https://www.php.net/manual/en/function.gmmktime.php) now require at least one argument. [time()](https://www.php.net/manual/en/function.time.php) can be used to get the current timestamp.

### DOM

Unimplemented classes from the DOM extension that had no behavior and contained test data have been removed. These classes have also been removed in the latest version of the DOM standard:

- **DOMNameList**
- **DomImplementationList**
- **DOMConfiguration**
- **DomError**
- **DomErrorHandler**
- **DOMImplementationSource**
- **DOMLocator**
- **DOMUserDataHandler**
- **DOMTypeInfo**
- **DOMStringExtend**

Unimplemented methods from the DOM extension that had no behavior have been removed:

- **DOMNamedNodeMap::setNamedItem()**
- **DOMNamedNodeMap::removeNamedItem()**
- **DOMNamedNodeMap::setNamedItemNS()**
- **DOMNamedNodeMap::removeNamedItemNS()**
- **DOMText::replaceWholeText()**
- [DOMNode::compareDocumentPosition()](https://www.php.net/manual/en/domnode.comparedocumentposition.php)
- [DOMNode::isEqualNode()](https://www.php.net/manual/en/domnode.isequalnode.php)
- **DOMNode::getFeature()**
- **DOMNode::setUserData()**
- **DOMNode::getUserData()**
- **DOMDocument::renameNode()**

### Enchant

- [enchant_broker_list_dicts()](https://www.php.net/manual/en/function.enchant-broker-list-dicts.php), [enchant_broker_describe()](https://www.php.net/manual/en/function.enchant-broker-describe.php) and [enchant_dict_suggest()](https://www.php.net/manual/en/function.enchant-dict-suggest.php) will now return an empty array instead of **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**.

### Exif

[read_exif_data()](https://www.php.net/manual/en/function.read-exif-data.php) has been removed; [exif_read_data()](https://www.php.net/manual/en/function.exif-read-data.php) should be used instead.

### Filter

- The **[`FILTER_FLAG_SCHEME_REQUIRED`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-flag-scheme-required)** and **[`FILTER_FLAG_HOST_REQUIRED`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-flag-host-required)** flags for the **[`FILTER_VALIDATE_URL`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-validate-url)** filter have been removed. The `scheme` and `host` are (and have been) always required.

- The **[`INPUT_REQUEST`](https://www.php.net/manual/en/filter.constants.input.php#constant.input-request)** and **[`INPUT_SESSION`](https://www.php.net/manual/en/filter.constants.input.php#constant.input-session)** source for [filter_input()](https://www.php.net/manual/en/function.filter-input.php) etc. have been removed. These were never implemented and their use always generated a warning.

### GD

- The deprecated function [image2wbmp()](https://www.php.net/manual/en/function.image2wbmp.php) has been removed.

- The deprecated functions [png2wbmp()](https://www.php.net/manual/en/function.png2wbmp.php) and [jpeg2wbmp()](https://www.php.net/manual/en/function.jpeg2wbmp.php) have been removed.

- The default `mode` parameter of [imagecropauto()](https://www.php.net/manual/en/function.imagecropauto.php) no longer accepts `-1`. **[`IMG_CROP_DEFAULT`](https://www.php.net/manual/en/image.constants.php#constant.img-crop-default)** should be used instead.

- On Windows, `php_gd2.dll` has been renamed to `php_gd.dll`.

### GMP

[gmp_random()](https://www.php.net/manual/en/function.gmp-random.php) has been removed. One of [gmp_random_range()](https://www.php.net/manual/en/function.gmp-random-range.php) or [gmp_random_bits()](https://www.php.net/manual/en/function.gmp-random-bits.php) should be used instead.

### Iconv

iconv implementations which do not properly set `errno` in case of errors are no longer supported.

### IMAP

- The unused `default_host` argument of [imap_headerinfo()](https://www.php.net/manual/en/function.imap-headerinfo.php) has been removed.

- The [imap_header()](https://www.php.net/manual/en/function.imap-header.php) function which is an alias of [imap_headerinfo()](https://www.php.net/manual/en/function.imap-headerinfo.php) has been removed.

### Internationalization Functions

- The deprecated constant **[`INTL_IDNA_VARIANT_2003`](https://www.php.net/manual/en/intl.constants.php#constant.intl-idna-variant-2003)** has been removed.

- The deprecated **`Normalizer::NONE`** constant has been removed.

### LDAP

- The deprecated functions [ldap_sort()](https://www.php.net/manual/en/function.ldap-sort.php), [ldap_control_paged_result()](https://www.php.net/manual/en/function.ldap-control-paged-result.php) and [ldap_control_paged_result_response()](https://www.php.net/manual/en/function.ldap-control-paged-result-response.php) have been removed.

- The interface of [ldap_set_rebind_proc()](https://www.php.net/manual/en/function.ldap-set-rebind-proc.php) has changed; the `callback` parameter does not accept empty strings anymore; **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** should be used instead.

### MBString

- The [mbstring.func_overload](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.func-overload) directive has been removed. The related **[`MB_OVERLOAD_MAIL`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-overload-mail)**, **[`MB_OVERLOAD_STRING`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-overload-string)**, and **[`MB_OVERLOAD_REGEX`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-overload-regex)** constants have also been removed. Finally, the `"func_overload"` and `"func_overload_list"` entries in [mb_get_info()](https://www.php.net/manual/en/function.mb-get-info.php) have been removed.

- [mb_parse_str()](https://www.php.net/manual/en/function.mb-parse-str.php) can no longer be used without specifying a result array.

- A number of deprecated mbregex aliases have been removed. See the following list for which functions should be used instead:

  - **mbregex_encoding()** → [mb_regex_encoding()](https://www.php.net/manual/en/function.mb-regex-encoding.php)
  - **mbereg()** → [mb_ereg()](https://www.php.net/manual/en/function.mb-ereg.php)
  - **mberegi()** → [mb_eregi()](https://www.php.net/manual/en/function.mb-eregi.php)
  - **mbereg_replace()** → [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php)
  - **mberegi_replace()** → [mb_eregi_replace()](https://www.php.net/manual/en/function.mb-eregi-replace.php)
  - **mbsplit()** → [mb_split()](https://www.php.net/manual/en/function.mb-split.php)
  - **mbereg_match()** → [mb_ereg_match()](https://www.php.net/manual/en/function.mb-ereg-match.php)
  - **mbereg_search()** → [mb_ereg_search()](https://www.php.net/manual/en/function.mb-ereg-search.php)
  - **mbereg_search_pos()** → [mb_ereg_search_pos()](https://www.php.net/manual/en/function.mb-ereg-search-pos.php)
  - **mbereg_search_regs()** → [mb_ereg_search_regs()](https://www.php.net/manual/en/function.mb-ereg-search-regs.php)
  - **mbereg_search_init()** → [mb_ereg_search_init()](https://www.php.net/manual/en/function.mb-ereg-search-init.php)
  - **mbereg_search_getregs()** → [mb_ereg_search_getregs()](https://www.php.net/manual/en/function.mb-ereg-search-getregs.php)
  - **mbereg_search_getpos()** → [mb_ereg_search_getpos()](https://www.php.net/manual/en/function.mb-ereg-search-getpos.php)
  - **mbereg_search_setpos()** → [mb_ereg_search_setpos()](https://www.php.net/manual/en/function.mb-ereg-search-setpos.php)

- The `e` modifier for [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php) has been removed. [mb_ereg_replace_callback()](https://www.php.net/manual/en/function.mb-ereg-replace-callback.php) should be used instead.

- A non-string pattern argument to [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php) will now be interpreted as a string instead of an ASCII codepoint. The previous behavior may be restored with an explicit call to [chr()](https://www.php.net/manual/en/function.chr.php).

- The `needle` argument for [mb_strpos()](https://www.php.net/manual/en/function.mb-strpos.php), [mb_strrpos()](https://www.php.net/manual/en/function.mb-strrpos.php), [mb_stripos()](https://www.php.net/manual/en/function.mb-stripos.php), [mb_strripos()](https://www.php.net/manual/en/function.mb-strripos.php), [mb_strstr()](https://www.php.net/manual/en/function.mb-strstr.php), [mb_stristr()](https://www.php.net/manual/en/function.mb-stristr.php), [mb_strrchr()](https://www.php.net/manual/en/function.mb-strrchr.php) and [mb_strrichr()](https://www.php.net/manual/en/function.mb-strrichr.php) can now be empty.

- The `is_hex` parameter, which was not used internally, has been removed from [mb_decode_numericentity()](https://www.php.net/manual/en/function.mb-decode-numericentity.php).

- The legacy behavior of passing the encoding as the third argument instead of an offset for the [mb_strrpos()](https://www.php.net/manual/en/function.mb-strrpos.php) function has been removed; an explicit `0` offset with the encoding should be provided as the fourth argument instead.

- The `ISO_8859-*` character encoding aliases have been replaced by `ISO8859-*` aliases for better interoperability with the iconv extension. The mbregex ISO 8859 aliases with underscores (`ISO_8859_*` and `ISO8859_*`) have also been removed.

- [mb_ereg()](https://www.php.net/manual/en/function.mb-ereg.php) and [mb_eregi()](https://www.php.net/manual/en/function.mb-eregi.php) will now return boolean **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** on a successful match. Previously they returned integer `1` if `matches` was not passed, or `max(1, strlen($matches[0]))` if `matches` was passed.

### OCI8

- The **OCI-Lob** class is now called [OCILob](https://www.php.net/manual/en/class.ocilob.php), and the **OCI-Collection** class is now called [OCICollection](https://www.php.net/manual/en/class.ocicollection.php) for name compliance enforced by PHP 8 arginfo type annotation tooling.

- Several alias functions have been marked as deprecated.

- [oci_internal_debug()](https://www.php.net/manual/en/function.oci-internal-debug.php) and its alias [ociinternaldebug()](https://www.php.net/manual/en/function.ociinternaldebug.php) have been removed.

### ODBC

- [odbc_connect()](https://www.php.net/manual/en/function.odbc-connect.php) no longer reuses connections.

- The unused `flags` parameter of [odbc_exec()](https://www.php.net/manual/en/function.odbc-exec.php) has been removed.

### OpenSSL

- [openssl_seal()](https://www.php.net/manual/en/function.openssl-seal.php) and [openssl_open()](https://www.php.net/manual/en/function.openssl-open.php) now require `method` to be passed, as the previous default of `"RC4"` is considered insecure.

### Regular Expressions (Perl-Compatible)

When passing invalid escape sequences they are no longer interpreted as literals. This behavior previously required the `X` modifier – which is now ignored.

### PHP Data Objects

- The default error handling mode has been changed from "silent" to "exceptions". See [Errors and error handling](https://www.php.net/manual/en/pdo.error-handling.php) for details.

- The signatures of some PDO methods have changed:

  - `PDO::query(string $query, ?int $fetchMode = null, mixed ...$fetchModeArgs)`
  - `PDOStatement::setFetchMode(int $mode, mixed ...$args)`

### PDO ODBC

The `php.ini` directive [pdo_odbc.db2_instance_name](https://www.php.net/manual/en/ref.pdo-odbc.php#ini.pdo-odbc.db2-instance-name) has been removed.

### PDO MySQL

[PDO::inTransaction()](https://www.php.net/manual/en/pdo.intransaction.php) now reports the actual transaction state of the connection, rather than an approximation maintained by PDO. If a query that is subject to "implicit commit" is executed, [PDO::inTransaction()](https://www.php.net/manual/en/pdo.intransaction.php) will subsequently return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**, as a transaction is no longer active.

### PostgreSQL

- The deprecated [pg_connect()](https://www.php.net/manual/en/function.pg-connect.php) syntax using multiple parameters instead of a connection string is no longer supported.

- The deprecated [pg_lo_import()](https://www.php.net/manual/en/function.pg-lo-import.php) and [pg_lo_export()](https://www.php.net/manual/en/function.pg-lo-export.php) signature that passes the connection as the last argument is no longer supported. The connection should be passed as first argument instead.

- [pg_fetch_all()](https://www.php.net/manual/en/function.pg-fetch-all.php) will now return an empty array instead of **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** for result sets with zero rows.

### Phar

Metadata associated with a phar will no longer be automatically unserialized, to fix potential security vulnerabilities due to object instantiation, autoloading, etc.

### Reflection

- The method signatures

  - `ReflectionClass::newInstance($args)`
  - `ReflectionFunction::invoke($args)`
  - `ReflectionMethod::invoke($object, $args)`

  have been changed to:

  - `ReflectionClass::newInstance(...$args)`
  - `ReflectionFunction::invoke(...$args)`
  - `ReflectionMethod::invoke($object, ...$args)`

  Code that must be compatible with both PHP 7 and PHP 8 can use the following signatures to be compatible with both versions:

  - `ReflectionClass::newInstance($arg = null, ...$args)`
  - `ReflectionFunction::invoke($arg = null, ...$args)`
  - `ReflectionMethod::invoke($object, $arg = null, ...$args)`

- The [ReflectionType::\_\_toString()](https://www.php.net/manual/en/reflectiontype.tostring.php) method will now return a complete debug representation of the type, and is no longer deprecated. In particular the result will include a nullability indicator for nullable types. The format of the return value is not stable and may change between PHP versions.

- Reflection export() methods have been removed. Instead reflection objects can be cast to string.

- [ReflectionMethod::isConstructor()](https://www.php.net/manual/en/reflectionmethod.isconstructor.php) and [ReflectionMethod::isDestructor()](https://www.php.net/manual/en/reflectionmethod.isdestructor.php) now also return **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** for [\_\_construct()](https://www.php.net/manual/en/language.oop5.decon.php#object.construct) and [\_\_destruct()](https://www.php.net/manual/en/language.oop5.decon.php#object.destruct) methods of interfaces. Previously, this would only be true for methods of classes and traits.

- **ReflectionType::isBuiltin()** method has been moved to [ReflectionNamedType](https://www.php.net/manual/en/class.reflectionnamedtype.php). [ReflectionUnionType](https://www.php.net/manual/en/class.reflectionuniontype.php) does not have it.

### Sockets

- The deprecated **`AI_IDN_ALLOW_UNASSIGNED`** and **`AI_IDN_USE_STD3_ASCII_RULES`** `flags` for [socket_addrinfo_lookup()](https://www.php.net/manual/en/function.socket-addrinfo-lookup.php) have been removed.

### Standard PHP Library (SPL)

- [SplFileObject::fgetss()](https://www.php.net/manual/en/splfileobject.fgetss.php) has been removed.

- [SplFileObject::seek()](https://www.php.net/manual/en/splfileobject.seek.php) now always seeks to the beginning of the line. Previously, positions `>=1` sought to the beginning of the next line.

- [SplHeap::compare()](https://www.php.net/manual/en/splheap.compare.php) now specifies a method signature. Inheriting classes implementing this method will now have to use a compatible method signature.

- [SplDoublyLinkedList::push()](https://www.php.net/manual/en/spldoublylinkedlist.push.php), [SplDoublyLinkedList::unshift()](https://www.php.net/manual/en/spldoublylinkedlist.unshift.php) and [SplQueue::enqueue()](https://www.php.net/manual/en/splqueue.enqueue.php) now return [void](https://www.php.net/manual/en/language.types.void.php) instead of **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)**.

- [spl_autoload_register()](https://www.php.net/manual/en/function.spl-autoload-register.php) will now always throw a [TypeError](https://www.php.net/manual/en/class.typeerror.php) on invalid arguments, therefore the second argument `do_throw` is ignored and a notice will be emitted if it is set to **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

- [SplFixedArray](https://www.php.net/manual/en/class.splfixedarray.php) is now an [IteratorAggregate](https://www.php.net/manual/en/class.iteratoraggregate.php) and not an [Iterator](https://www.php.net/manual/en/class.iterator.php). [SplFixedArray::rewind()](https://www.php.net/manual/en/splfixedarray.rewind.php), [SplFixedArray::current()](https://www.php.net/manual/en/splfixedarray.current.php), [SplFixedArray::key()](https://www.php.net/manual/en/splfixedarray.key.php), [SplFixedArray::next()](https://www.php.net/manual/en/splfixedarray.next.php), and [SplFixedArray::valid()](https://www.php.net/manual/en/splfixedarray.valid.php) have been removed. In their place, [SplFixedArray::getIterator()](https://www.php.net/manual/en/splfixedarray.getiterator.php) has been added. Any code which uses explicit iteration over SplFixedArray must now obtain an [Iterator](https://www.php.net/manual/en/class.iterator.php) through [SplFixedArray::getIterator()](https://www.php.net/manual/en/splfixedarray.getiterator.php). This means that [SplFixedArray](https://www.php.net/manual/en/class.splfixedarray.php) is now safe to use in nested loops.

### Standard Library

- [assert()](https://www.php.net/manual/en/function.assert.php) will no longer evaluate string arguments, instead they will be treated like any other argument. `assert($a == $b)` should be used instead of `assert('$a == $b')`. The [assert.quiet_eval](https://www.php.net/manual/en/info.configuration.php#ini.assert.quiet-eval) ini directive and the **[`ASSERT_QUIET_EVAL`](https://www.php.net/manual/en/info.constants.php#constant.assert-quiet-eval)** constant have also been removed, as they would no longer have any effect.

- [parse_str()](https://www.php.net/manual/en/function.parse-str.php) can no longer be used without specifying a result array.

- The [string.strip_tags](https://www.php.net/manual/en/filters.string.php#filters.string.strip_tags) filter has been removed.

- The `needle` argument of [strpos()](https://www.php.net/manual/en/function.strpos.php), [strrpos()](https://www.php.net/manual/en/function.strrpos.php), [stripos()](https://www.php.net/manual/en/function.stripos.php), [strripos()](https://www.php.net/manual/en/function.strripos.php), [strstr()](https://www.php.net/manual/en/function.strstr.php), [strchr()](https://www.php.net/manual/en/function.strchr.php), [strrchr()](https://www.php.net/manual/en/function.strrchr.php), and [stristr()](https://www.php.net/manual/en/function.stristr.php) will now always be interpreted as a string. Previously non-string needles were interpreted as an ASCII code point. An explicit call to [chr()](https://www.php.net/manual/en/function.chr.php) can be used to restore the previous behavior.

- The `needle` argument for [strpos()](https://www.php.net/manual/en/function.strpos.php), [strrpos()](https://www.php.net/manual/en/function.strrpos.php), [stripos()](https://www.php.net/manual/en/function.stripos.php), [strripos()](https://www.php.net/manual/en/function.strripos.php), [strstr()](https://www.php.net/manual/en/function.strstr.php), [stristr()](https://www.php.net/manual/en/function.stristr.php) and [strrchr()](https://www.php.net/manual/en/function.strrchr.php) can now be empty.

- The `length` argument for [substr()](https://www.php.net/manual/en/function.substr.php), [substr_count()](https://www.php.net/manual/en/function.substr-count.php), [substr_compare()](https://www.php.net/manual/en/function.substr-compare.php), and [iconv_substr()](https://www.php.net/manual/en/function.iconv-substr.php) can now be **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**. **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** values will behave as if no length argument was provided and will therefore return the remainder of the string instead of an empty string.

- The `length` argument for [array_splice()](https://www.php.net/manual/en/function.array-splice.php) can now be **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**. **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** values will behave identically to omitting the argument, thus removing everything from the `offset` to the end of the array.

- The `args` argument of [vsprintf()](https://www.php.net/manual/en/function.vsprintf.php), [vfprintf()](https://www.php.net/manual/en/function.vfprintf.php), and [vprintf()](https://www.php.net/manual/en/function.vprintf.php) must now be an array. Previously any type was accepted.

- The `'salt'` option of [password_hash()](https://www.php.net/manual/en/function.password-hash.php) is no longer supported. If the `'salt'` option is used a warning is generated, the provided salt is ignored, and a generated salt is used instead.

- The [quotemeta()](https://www.php.net/manual/en/function.quotemeta.php) function will now return an empty string if an empty string was passed. Previously **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** was returned.

- The following functions have been removed:

  - [hebrevc()](https://www.php.net/manual/en/function.hebrevc.php)
  - [convert_cyr_string()](https://www.php.net/manual/en/function.convert-cyr-string.php)
  - [money_format()](https://www.php.net/manual/en/function.money-format.php)
  - [ezmlm_hash()](https://www.php.net/manual/en/function.ezmlm-hash.php)
  - [restore_include_path()](https://www.php.net/manual/en/function.restore-include-path.php)
  - [get_magic_quotes_gpc()](https://www.php.net/manual/en/function.get-magic-quotes-gpc.php)
  - [get_magic_quotes_runtime()](https://www.php.net/manual/en/function.get-magic-quotes-runtime.php)
  - [fgetss()](https://www.php.net/manual/en/function.fgetss.php)

- **[`FILTER_SANITIZE_MAGIC_QUOTES`](https://www.php.net/manual/en/filter.constants.sanitization.php#constant.filter-sanitize-magic-quotes)** has been removed.

- Calling [implode()](https://www.php.net/manual/en/function.implode.php) with parameters in a reverse order `($pieces, $glue)` is no longer supported.

- [parse_url()](https://www.php.net/manual/en/function.parse-url.php) will now distinguish absent and empty queries and fragments:

  - `http://example.com/foo → query = null, fragment = null`
  - `http://example.com/foo? → query = "", fragment = null`
  - `http://example.com/foo# → query = null, fragment = ""`
  - `http://example.com/foo?# → query = "", fragment = ""`

  Previously all cases resulted in query and fragment being **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**.

- [var_dump()](https://www.php.net/manual/en/function.var-dump.php) and [debug_zval_dump()](https://www.php.net/manual/en/function.debug-zval-dump.php) will now print floating-point numbers using [serialize_precision](https://www.php.net/manual/en/ini.core.php#ini.serialize-precision) rather than [precision](https://www.php.net/manual/en/ini.core.php#ini.precision). In a default configuration, this means that floating-point numbers are now printed with full accuracy by these debugging functions.

- If the array returned by [\_\_sleep()](https://www.php.net/manual/en/language.oop5.magic.php#object.sleep) contains non-existing properties, these are now silently ignored. Previously, such properties would have been serialized as if they had the value **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**.

- The default locale on startup is now always `"C"`. No locales are inherited from the environment by default. Previously, **[`LC_ALL`](https://www.php.net/manual/en/string.constants.php#constant.lc-all)** was set to `"C"`, while **[`LC_CTYPE`](https://www.php.net/manual/en/string.constants.php#constant.lc-ctype)** was inherited from the environment. However, some functions did not respect the inherited locale without an explicit [setlocale()](https://www.php.net/manual/en/function.setlocale.php) call. An explicit [setlocale()](https://www.php.net/manual/en/function.setlocale.php) call is now always required if a locale component should be changed from the default.

- The deprecated DES fallback in [crypt()](https://www.php.net/manual/en/function.crypt.php) has been removed. If an unknown salt format is passed to [crypt()](https://www.php.net/manual/en/function.crypt.php), the function will fail with `*0` instead of falling back to a weak DES hash now.

- Specifying out of range rounds for SHA256/SHA512 [crypt()](https://www.php.net/manual/en/function.crypt.php) will now fail with `*0` instead of clamping to the closest limit. This matches glibc behavior.

- The result of sorting functions may have changed, if the array contains elements that compare as equal.

- Any functions accepting callbacks that are not explicitly specified to accept parameters by reference will now warn if a callback with reference parameters is used. Examples include [array_filter()](https://www.php.net/manual/en/function.array-filter.php) and [array_reduce()](https://www.php.net/manual/en/function.array-reduce.php). This was already the case for most, but not all, functions previously.

- The HTTP stream wrapper as used by functions like [file_get_contents()](https://www.php.net/manual/en/function.file-get-contents.php) now advertises HTTP/1.1 rather than HTTP/1.0 by default. This does not change the behavior of the client, but may cause servers to respond differently. To retain the old behavior, set the `'protocol_version'` stream context option, e.g.

  ```
  <?php
  $ctx = stream_context_create(['http' => ['protocol_version' => '1.0']]);
  echo file_get_contents('http://example.org', false, $ctx);
  ?>
  ```

- Calling [crypt()](https://www.php.net/manual/en/function.crypt.php) without an explicit salt is no longer supported. If you would like to produce a strong hash with an auto-generated salt, use [password_hash()](https://www.php.net/manual/en/function.password-hash.php) instead.

- [substr()](https://www.php.net/manual/en/function.substr.php), [mb_substr()](https://www.php.net/manual/en/function.mb-substr.php), [iconv_substr()](https://www.php.net/manual/en/function.iconv-substr.php) and [grapheme_substr()](https://www.php.net/manual/en/function.grapheme-substr.php) now consistently clamp out-of-bounds offsets to the string boundary. Previously, **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** was returned instead of the empty string in some cases.

- On Windows, the program execution functions ([proc_open()](https://www.php.net/manual/en/function.proc-open.php), [exec()](https://www.php.net/manual/en/function.exec.php), [popen()](https://www.php.net/manual/en/function.popen.php) etc.) using the shell, now consistently execute **%comspec% /s /c "\$commandline"**, which has the same effect as executing **\$commandline** (without additional quotes).

### Sysvsem

- The `auto_release` parameter of [sem_get()](https://www.php.net/manual/en/function.sem-get.php) was changed to accept bool values rather than int.

### Tidy

- The `use_include_path` parameter, which was not used internally, has been removed from [tidy_repair_string()](https://www.php.net/manual/en/tidy.repairstring.php).

- [tidy::repairString()](https://www.php.net/manual/en/tidy.repairstring.php) and [tidy::repairFile()](https://www.php.net/manual/en/tidy.repairfile.php) became static methods.

### Tokenizer

- **[`T_COMMENT`](https://www.php.net/manual/en/tokens.php#constant.t-comment)** tokens will no longer include a trailing newline. The newline will instead be part of a following **[`T_WHITESPACE`](https://www.php.net/manual/en/tokens.php#constant.t-whitespace)** token. It should be noted that **[`T_COMMENT`](https://www.php.net/manual/en/tokens.php#constant.t-comment)** is not always followed by whitespace, it may also be followed by **[`T_CLOSE_TAG`](https://www.php.net/manual/en/tokens.php#constant.t-close-tag)** or end-of-file.

- Namespaced names are now represented using the **[`T_NAME_QUALIFIED`](https://www.php.net/manual/en/tokens.php#constant.t-name-qualified)** (`Foo\Bar`), **[`T_NAME_FULLY_QUALIFIED`](https://www.php.net/manual/en/tokens.php#constant.t-name-fully-qualified)** (`\Foo\Bar`) and **[`T_NAME_RELATIVE`](https://www.php.net/manual/en/tokens.php#constant.t-name-relative)** (`namespace\Foo\Bar`) tokens. **[`T_NS_SEPARATOR`](https://www.php.net/manual/en/tokens.php#constant.t-ns-separator)** is only used for standalone namespace separators, and only syntactially valid in conjunction with group use declarations.

### XMLReader

[XMLReader::open()](https://www.php.net/manual/en/xmlreader.open.php) and [XMLReader::XML()](https://www.php.net/manual/en/xmlreader.xml.php) are now static methods. They can still be called as instance methods, but inheriting classes need to declare them as static if they override these methods.

### XML-RPC

The XML-RPC extension has been moved to PECL and is no longer part of the PHP distribution.

### Zip

**`ZipArchive::OPSYS_Z_CPM`** has been removed (this name was a typo). Use **[`ZipArchive::OPSYS_CPM`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.opsys-cpm)** instead.

### Zlib

- [gzgetss()](https://www.php.net/manual/en/function.gzgetss.php) has been removed.

- [zlib.output_compression](https://www.php.net/manual/en/zlib.configuration.php#ini.zlib.output-compression) is no longer automatically disabled for `Content-Type: image/*`.

### Windows PHP Test Packs

The test runner has been renamed from `run-test.php` to `run-tests.php`, to match its name in php-src.

# [PHP 7.4](https://www.php.net/manual/en/migration74.incompatible.php)

## Backward Incompatible Changes

### PHP Core

#### Array-style access of non-arrays

Trying to use values of type [null](https://www.php.net/manual/en/language.types.null.php), [bool](https://www.php.net/manual/en/language.types.boolean.php), [int](https://www.php.net/manual/en/language.types.integer.php), [float](https://www.php.net/manual/en/language.types.float.php) or [resource](https://www.php.net/manual/en/language.types.resource.php) as an array (such as `$null["key"]`) will now generate a notice.

#### [get_declared_classes()](https://www.php.net/manual/en/function.get-declared-classes.php) function

The [get_declared_classes()](https://www.php.net/manual/en/function.get-declared-classes.php) function no longer returns anonymous classes that have not been instantiated yet.

#### `fn` keyword

`fn` is now a reserved keyword. In particular, it can no longer be used as a function or class name. It can still be used as a method or class constant name.

#### `<?php` tag at end of file

`<?php` at the end of the file (without trailing newline) will now be interpreted as an opening PHP tag. Previously it was interpreted either as a short opening tag followed by literal `php` and resulted in a syntax error (with `short_open_tag=1`) or was interpreted as a literal `<?php` string (with `short_open_tag=0`).

#### Stream wrappers

When using include/require on a stream, [streamWrapper::stream_set_option()](https://www.php.net/manual/en/streamwrapper.stream-set-option.php) will be invoked with the **[`STREAM_OPTION_READ_BUFFER`](https://www.php.net/manual/en/stream.constants.php#constant.stream-option-read-buffer)** option. Custom stream wrapper implementations may need to implement the [streamWrapper::stream_set_option()](https://www.php.net/manual/en/streamwrapper.stream-set-option.php) method to avoid a warning (always returning **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** is a sufficient implementation).

#### Serialization

The `o` serialization format has been removed. As it is never produced by PHP, this may only break unserialization of manually crafted strings.

#### Password algorithm constants

Password hashing algorithm identifiers are now nullable strings rather than integers.

- **[`PASSWORD_DEFAULT`](https://www.php.net/manual/en/password.constants.php#constant.password-default)** was int 1; now is string '2y' (in PHP 7.4.0, 7.4.1, and 7.4.2 it was **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**)

- **[`PASSWORD_BCRYPT`](https://www.php.net/manual/en/password.constants.php#constant.password-bcrypt)** was int 1; now is string '2y'

- **[`PASSWORD_ARGON2I`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2i)** was int 2; now is string 'argon2i'

- **[`PASSWORD_ARGON2ID`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2id)** was int 3; now is string 'argon2id'

Applications correctly using the constants PASSWORD_DEFAULT, PASSWORD_BCRYPT, PASSWORD_ARGON2I, and PASSWORD_ARGON2ID will continue to function correctly.

#### [htmlentities()](https://www.php.net/manual/en/function.htmlentities.php) function

[htmlentities()](https://www.php.net/manual/en/function.htmlentities.php) will now raise a notice (instead of a strict standards warning) if it is used with an encoding for which only basic entity substitution is supported, in which case it is equivalent to [htmlspecialchars()](https://www.php.net/manual/en/function.htmlspecialchars.php).

#### [fread()](https://www.php.net/manual/en/function.fread.php) and [fwrite()](https://www.php.net/manual/en/function.fwrite.php) function

[fread()](https://www.php.net/manual/en/function.fread.php) and [fwrite()](https://www.php.net/manual/en/function.fwrite.php) will now return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** if the operation failed. Previously an empty string or 0 was returned. EAGAIN/EWOULDBLOCK are not considered failures.

These functions now also raise a notice on failure, such as when trying to write to a read-only file resource.

### BCMath Arbitrary Precision Mathematics

BCMath functions will now warn if a non well-formed number is passed, such as `"32foo"`. The argument will be interpreted as zero, as before.

### CURL

Attempting to serialize a [CURLFile](https://www.php.net/manual/en/class.curlfile.php) class will now generate an exception. Previously the exception was only thrown on unserialization.

Using **[`CURLPIPE_HTTP1`](https://www.php.net/manual/en/curl.constants.php#constant.curlpipe-http1)** is deprecated, and is no longer supported as of cURL 7.62.0.

The `$version` parameter of [curl_version()](https://www.php.net/manual/en/function.curl-version.php) is deprecated. If any value not equal to the default **[`CURLVERSION_NOW`](https://www.php.net/manual/en/curl.constants.php#constant.curlversion-now)** is passed, a warning is raised and the parameter is ignored.

### Date and Time

Calling [var_dump()](https://www.php.net/manual/en/function.var-dump.php) or similar on a [DateTime](https://www.php.net/manual/en/class.datetime.php) or [DateTimeImmutable](https://www.php.net/manual/en/class.datetimeimmutable.php) instance will no longer leave behind accessible properties on the object.

Comparison of [DateInterval](https://www.php.net/manual/en/class.dateinterval.php) objects (using `==`, `<`, and so on) will now generate a warning and always return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. Previously all [DateInterval](https://www.php.net/manual/en/class.dateinterval.php) objects were considered equal, unless they had properties.

### Intl

The default parameter value of [idn_to_ascii()](https://www.php.net/manual/en/function.idn-to-ascii.php) and [idn_to_utf8()](https://www.php.net/manual/en/function.idn-to-utf8.php) is now **[`INTL_IDNA_VARIANT_UTS46`](https://www.php.net/manual/en/intl.constants.php#constant.intl-idna-variant-uts46)** instead of the deprecated **[`INTL_IDNA_VARIANT_2003`](https://www.php.net/manual/en/intl.constants.php#constant.intl-idna-variant-2003)**.

### MySQLi

The embedded server functionality has been removed. It was broken since at least PHP 7.0.

The undocumented `mysqli::$stat` property has been removed in favor of [mysqli::stat()](https://www.php.net/manual/en/mysqli.stat.php).

### OpenSSL

The [openssl_random_pseudo_bytes()](https://www.php.net/manual/en/function.openssl-random-pseudo-bytes.php) function will now throw an exception in error situations, similar to [random_bytes()](https://www.php.net/manual/en/function.random-bytes.php). In particular, an [Error](https://www.php.net/manual/en/class.error.php) is thrown if the number of requested bytes is less than or equal to zero, and an [Exception](https://www.php.net/manual/en/class.exception.php) is thrown if sufficient randomness cannot be gathered. The `$crypto_strong` output argument is guaranteed to always be **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** if the function does not throw, so explicitly checking it is not necessary.

### Regular Expressions (Perl-Compatible)

When **[`PREG_UNMATCHED_AS_NULL`](https://www.php.net/manual/en/pcre.constants.php#constant.preg-unmatched-as-null)** mode is used, trailing unmatched capturing groups will now also be set to **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** (or `[null, -1]` if offset capture is enabled). This means that the size of the `$matches` will always be the same.

### PHP Data Objects

Attempting to serialize a [PDO](https://www.php.net/manual/en/class.pdo.php) or [PDOStatement](https://www.php.net/manual/en/class.pdostatement.php) instance will now generate an [Exception](https://www.php.net/manual/en/class.exception.php) rather than a [PDOException](https://www.php.net/manual/en/class.pdoexception.php), consistent with other internal classes which do not support serialization.

### Reflection

Reflection objects will now generate an exception if an attempt is made to serialize them. Serialization for reflection objects was never supported and resulted in corrupted reflection objects. It has been explicitly prohibited now.

The values of the class constant of [ReflectionClassConstant](https://www.php.net/manual/en/class.reflectionclassconstant.php), [ReflectionMethod](https://www.php.net/manual/en/class.reflectionmethod.php) and [ReflectionProperty](https://www.php.net/manual/en/class.reflectionproperty.php) have changed.

### Standard PHP Library (SPL)

Calling [get_object_vars()](https://www.php.net/manual/en/function.get-object-vars.php) on an [ArrayObject](https://www.php.net/manual/en/class.arrayobject.php) instance will now always return the properties of the [ArrayObject](https://www.php.net/manual/en/class.arrayobject.php) itself (or a subclass). Previously it returned the values of the wrapped array/object unless the **[`ArrayObject::STD_PROP_LIST`](https://www.php.net/manual/en/class.arrayobject.php#arrayobject.constants.std-prop-list)** flag was specified.

Other affected operations are:

- **ReflectionObject::getProperties()**

- [reset()](https://www.php.net/manual/en/function.reset.php), [current()](https://www.php.net/manual/en/function.current.php), etc. Use [Iterator](https://www.php.net/manual/en/class.iterator.php) methods instead.

- Potentially others working on object properties as a list, e.g. [array_walk()](https://www.php.net/manual/en/function.array-walk.php).

`(array)` casts are not affected. They will continue to return either the wrapped array, or the [ArrayObject](https://www.php.net/manual/en/class.arrayobject.php) properties, depending on whether the **[`ArrayObject::STD_PROP_LIST`](https://www.php.net/manual/en/class.arrayobject.php#arrayobject.constants.std-prop-list)** flag is used.

[SplPriorityQueue::setExtractFlags()](https://www.php.net/manual/en/splpriorityqueue.setextractflags.php) will throw an exception if zero is passed. Previously this would generate a recoverable fatal error on the next extraction operation.

[ArrayObject](https://www.php.net/manual/en/class.arrayobject.php), [ArrayIterator](https://www.php.net/manual/en/class.arrayiterator.php), [SplDoublyLinkedList](https://www.php.net/manual/en/class.spldoublylinkedlist.php) and [SplObjectStorage](https://www.php.net/manual/en/class.splobjectstorage.php) now support the `__serialize()` and `__unserialize()` mechanism in addition to the [Serializable](https://www.php.net/manual/en/class.serializable.php) interface. This means that serialization payloads created on older PHP versions can still be unserialized, but new payloads created by PHP 7.4 will not be understood by older versions.

### Tokenizer

[token_get_all()](https://www.php.net/manual/en/function.token-get-all.php) will now emit a **[`T_BAD_CHARACTER`](https://www.php.net/manual/en/tokens.php#constant.t-bad-character)** token for unexpected characters instead of leaving behind holes in the token stream.

### Incoming Cookies

As of PHP 7.4.11, the *names* of incoming cookies are no longer url-decoded for security reasons.

# [PHP 7.3](https://www.php.net/manual/en/migration73.incompatible.php)

## Backward Incompatible Changes

### PHP Core

#### Heredoc/Nowdoc Ending Label Interpretation

Due to the introduction of [flexible heredoc/nowdoc syntax](https://www.php.net/manual/en/migration73.new-features.php#migration73.new-features.core.heredoc), doc strings that contain the ending label inside their body may cause syntax errors or change in interpretation. For example in:

```
<?php
$str = <<<FOO
abcdefg
   FOO
FOO;
?>
```

the indented occurrence of `FOO` did not previously have any special meaning. Now it will be interpreted as the end of the heredoc string and the following `FOO;` will cause a syntax error. This issue can always be resolved by choosing an ending label that does not occur within the contents of the string.

#### Continue Targeting Switch issues Warning

`continue` statements targeting `switch` control flow structures will now generate a warning. In PHP such `continue` statements are equivalent to `break`, while they behave as `continue 2` in other languages.

```
<?php
while ($foo) {
    switch ($bar) {
      case "baz":
         continue;
         // Warning: "continue" targeting switch is equivalent to
         //          "break". Did you mean to use "continue 2"?
   }
}
?>
```

#### Strict Interpretation of Integer String Keys on ArrayAccess

Array accesses of type `$obj["123"]`, where `$obj` implements [ArrayAccess](https://www.php.net/manual/en/class.arrayaccess.php) and `"123"` is an integer [string](https://www.php.net/manual/en/language.types.string.php) literal will no longer result in an implicit conversion to integer, i.e., `$obj->offsetGet("123")` will be called instead of `$obj->offsetGet(123)`. This matches existing behavior for non-literals. The behavior of arrays is not affected in any way, they continue to implicitly convert integral string keys to integers.

#### Static Properties no longer separated by Reference Assignment

In PHP, static properties are shared between inheriting classes, unless the static property is explicitly overridden in a child class. However, due to an implementation artifact it was possible to separate the static properties by assigning a reference. This loophole has been fixed.

```
<?php
class Test {
    public static $x = 0;
}
class Test2 extends Test { }

Test2::$x = &$x;
$x = 1;

var_dump(Test::$x, Test2::$x);
// Previously: int(0), int(1)
// Now:        int(1), int(1)
?>
```

#### References returned by Array and Property Accesses are immediately unwrapped

References returned by array and property accesses are now unwrapped as part of the access. This means that it is no longer possible to modify the reference between the access and the use of the accessed value:

```
<?php
$arr = [1];
$ref =& $arr[0];
var_dump($arr[0] + ($arr[0] = 2));
// Previously: int(4), Now: int(3)
?>
```

This makes the behavior of references and non-references consistent. Please note that reading and writing a value inside a single expression remains undefined behavior and may change again in the future.

#### Argument Unpacking of Traversables with non-Integer Keys no longer supported

Argument unpacking stopped working with [Traversable](https://www.php.net/manual/en/class.traversable.php)s with non-integer keys. The following code worked in PHP 5.6-7.2 by accident.

```
<?php
function foo(...$args) {
    var_dump($args);
}
function gen() {
    yield 1.23 => 123;
}
foo(...gen());
?>
```

#### Miscellaneous

The `ext_skel` utility has been completely redesigned with new options and some old options removed. This is now written in PHP and has no external dependencies.

Support for BeOS has been dropped.

Exceptions thrown due to automatic conversion of warnings into exceptions in `EH_THROW` mode (e.g. some [DateTime](https://www.php.net/manual/en/class.datetime.php) exceptions) no longer populate [error_get_last()](https://www.php.net/manual/en/function.error-get-last.php) state. As such, they now work the same way as manually thrown exceptions.

[TypeError](https://www.php.net/manual/en/class.typeerror.php) now reports wrong types as `int` and `bool` instead of `integer` and `boolean`, respectively.

Undefined variables passed to [compact()](https://www.php.net/manual/en/function.compact.php) will now be reported as a notice.

[getimagesize()](https://www.php.net/manual/en/function.getimagesize.php) and related functions now report the mime type of BMP images as `image/bmp` instead of `image/x-ms-bmp`, since the former has been registered with the IANA (see [» RFC 7903](https://datatracker.ietf.org/doc/html/rfc7903)).

[stream_socket_get_name()](https://www.php.net/manual/en/function.stream-socket-get-name.php) will now return IPv6 addresses wrapped in brackets. For example `"[::1]:1337"` will be returned instead of `"::1:1337"`.

### BCMath Arbitrary Precision Mathematics

All warnings thrown by [BCMath functions](https://www.php.net/manual/en/ref.bc.php) are now using PHP's error handling. Formerly some warnings have directly been written to stderr.

[bcmul()](https://www.php.net/manual/en/function.bcmul.php) and [bcpow()](https://www.php.net/manual/en/function.bcpow.php) now return numbers with the requested scale. Formerly, the returned numbers may have omitted trailing decimal zeroes.

### IMAP, POP3 and NNTP

**rsh**/**ssh** logins are disabled by default. Use [imap.enable_insecure_rsh](https://www.php.net/manual/en/imap.configuration.php#ini.imap.enable-insecure-rsh) if you want to enable them. Note that the IMAP library does not filter mailbox names before passing them to the **rsh**/**ssh** command, thus passing untrusted data to this function with **rsh**/**ssh** enabled is insecure.

### Multibyte String

Due to added support for named captures, `mb_ereg_*()` patterns using named captures will behave differently. In particular named captures will be part of matches and [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php) will interpret additional syntax. See [Named Captures](https://www.php.net/manual/en/migration73.new-features.php#migration73.new-features.mbstring.named-captures) for more information.

### MySQL Improved Extension

Prepared statements now properly report the fractional seconds for `DATETIME`, `TIME` and `TIMESTAMP` columns with decimals specifier (e.g. `TIMESTAMP(6)` when using microseconds). Formerly, the fractional seconds part was simply omitted from the returned values.

### MySQL Functions (PDO_MYSQL)

Prepared statements now properly report the fractional seconds for `DATETIME`, `TIME` and `TIMESTAMP` columns with decimals specifier (e.g. `TIMESTAMP(6)` when using microseconds). Formerly, the fractional seconds part was simply omitted from the returned values. Please note that this only affects the usage of [PDO_MYSQL](https://www.php.net/manual/en/ref.pdo-mysql.php) with emulated prepares turned off (e.g. using the native preparation functionality). Statements using connections having **[`PDO::ATTR_EMULATE_PREPARES`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-emulate-prepares)**=**[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** (which is the default) were not affected by the bug fixed and have already been getting the proper fractional seconds values from the engine.

### Reflection

[Reflection](https://www.php.net/manual/en/book.reflection.php) export to string now uses `int` and `bool` instead of `integer` and `boolean`, respectively.

### Standard PHP Library (SPL)

If an [SPL](https://www.php.net/manual/en/book.spl.php) autoloader throws an exception, following autoloaders will not be executed. Previously all autoloaders were executed and exceptions were chained.

### SimpleXML

Mathematic operations involving [SimpleXML](https://www.php.net/manual/en/book.simplexml.php) objects will now treat the text as an [int](https://www.php.net/manual/en/language.types.integer.php) or [float](https://www.php.net/manual/en/language.types.float.php), whichever is more appropriate. Previously values were treated as [int](https://www.php.net/manual/en/language.types.integer.php)s unconditionally.

### Incoming Cookies

As of PHP 7.3.23, the *names* of incoming cookies are no longer url-decoded for security reasons.

# [PHP 7.2](https://www.php.net/manual/en/migration72.incompatible.php)

## Backward incompatible changes

### Prevent [number_format()](https://www.php.net/manual/en/function.number-format.php) from returning negative zero

Previously, it was possible for the [number_format()](https://www.php.net/manual/en/function.number-format.php) function to return `-0`. Whilst this is perfectly valid according to the IEEE 754 floating point specification, this oddity was not desirable for displaying formatted numbers in a human-readable form.

```
<?php

var_dump(number_format(-0.01)); // now outputs string(1) "0" instead of string(2) "-0"
```

### Convert numeric keys in object and array casts

Numeric keys are now better handled when casting arrays to objects and objects to arrays (either from explicit casting or by [settype()](https://www.php.net/manual/en/function.settype.php)).

This means that integer (or stringy integer) keys from arrays being casted to objects are now accessible:

```
<?php

// array to object
$arr = [0 => 1];
$obj = (object) $arr;
var_dump(
    $obj,
    $obj->{'0'}, // now accessible
    $obj->{0} // now accessible
);
```

The above example will output:

    object(stdClass)#1 (1) {
      ["0"]=>    // string key now, rather than integer key
      int(1)
    }
    int(1)
    int(1)

And integer (or stringy integer) keys from objects being casted to arrays are now accessible:

```
<?php

// object to array
$obj = new class {
    public function __construct()
    {
        $this->{0} = 1;
    }
};
$arr = (array) $obj;
var_dump(
    $arr,
    $arr[0], // now accessible
    $arr['0'] // now accessible
);
```

The above example will output:

    array(1) {
      [0]=>    // integer key now, rather than string key
      int(1)
    }
    int(1)
    int(1)

### Disallow passing **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** to [get_class()](https://www.php.net/manual/en/function.get-class.php)

Previously, passing **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** to the [get_class()](https://www.php.net/manual/en/function.get-class.php) function would output the name of the enclosing class. This behaviour has now been removed, where an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** will be output instead. To achieve the same behaviour as before, the argument should simply be omitted.

### Warn when counting non-countable types

An **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** will now be emitted when attempting to [count()](https://www.php.net/manual/en/function.count.php) non-countable types (this includes the [sizeof()](https://www.php.net/manual/en/function.sizeof.php) alias function).

```
<?php

var_dump(
    count(null), // NULL is not countable
    count(1), // integers are not countable
    count('abc'), // strings are not countable
    count(new stdClass), // objects not implementing the Countable interface are not countable
    count([1,2]) // arrays are countable
);
```

The above example will output:

    Warning: count(): Parameter must be an array or an object that implements Countable in %s on line %d

    Warning: count(): Parameter must be an array or an object that implements Countable in %s on line %d

    Warning: count(): Parameter must be an array or an object that implements Countable in %s on line %d

    Warning: count(): Parameter must be an array or an object that implements Countable in %s on line %d
    int(0)
    int(1)
    int(1)
    int(1)
    int(2)

### Move ext/hash from resources to objects

As part of the long-term migration away from resources, the [Hash](https://www.php.net/manual/en/book.hash.php) extension has been updated to use objects instead of resources. The change should be seamless for PHP developers, except for where [is_resource()](https://www.php.net/manual/en/function.is-resource.php) checks have been made (which will need updating to [is_object()](https://www.php.net/manual/en/function.is-object.php) instead).

### Improve SSL/TLS defaults

The following changes to the defaults have been made:

- `tls://` now defaults to TLSv1.0 or TLSv1.1 or TLSv1.2

- `ssl://` an alias of `tls://`

- `STREAM_CRYPTO_METHOD_TLS_*` constants default to TLSv1.0 or TLSv1.1 + TLSv1.2, instead of TLSv1.0 only

### [gettype()](https://www.php.net/manual/en/function.gettype.php) return value on closed resources

Previously, using [gettype()](https://www.php.net/manual/en/function.gettype.php) on a closed resource would return a string of `"unknown type"`. Now, a string of `"resource (closed)"` will be returned.

### [is_object()](https://www.php.net/manual/en/function.is-object.php) and [\_\_PHP_Incomplete_Class](https://www.php.net/manual/en/class.php-incomplete-class.php)

Previously, using [is_object()](https://www.php.net/manual/en/function.is-object.php) on the [\_\_PHP_Incomplete_Class](https://www.php.net/manual/en/class.php-incomplete-class.php) class would return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. Now, **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** will be returned.

### Promote the error level of undefined constants

Unqualified references to undefined constants will now generate an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** (instead of an **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)**). In the next major version of PHP, they will generate [Error](https://www.php.net/manual/en/class.error.php) exceptions.

### Windows support

The officially supported, minimum Windows versions are now Windows 7/Server 2008 R2.

### Checks on default property values of traits

Compatibility checks upon default trait property values will no longer perform casting.

### `object` for class names

The `object` name was previously soft-reserved in PHP 7.0. This is now hard-reserved, prohibiting it from being used as a class, trait, or interface name.

### NetWare support

Support for NetWare has now been removed.

### [array_unique()](https://www.php.net/manual/en/function.array-unique.php) with **[`SORT_STRING`](https://www.php.net/manual/en/array.constants.php#constant.sort-string)**

[array_unique()](https://www.php.net/manual/en/function.array-unique.php) with **[`SORT_STRING`](https://www.php.net/manual/en/array.constants.php#constant.sort-string)** builds the returned array by adding the unique elements to a new array; formerly, it was a copy of the input from which the non-unique elements were removed. Both hold the same elements under the same keys, but if the element with the largest integer key is among those removed, the index generated for an element appended to the returned array differs from the one the input would have generated.

### [bcmod()](https://www.php.net/manual/en/function.bcmod.php) changes with floats

The [bcmod()](https://www.php.net/manual/en/function.bcmod.php) function no longer truncates fractional numbers to integers. As such, its behavior now follows [fmod()](https://www.php.net/manual/en/function.fmod.php), rather than the `%` operator. For example `bcmod('4', '3.5')` now returns `0.5` instead of `1`.

### Hashing functions and non-cryptographic hashes

The [hash_hmac()](https://www.php.net/manual/en/function.hash-hmac.php), [hash_hmac_file()](https://www.php.net/manual/en/function.hash-hmac-file.php), [hash_pbkdf2()](https://www.php.net/manual/en/function.hash-pbkdf2.php), and [hash_init()](https://www.php.net/manual/en/function.hash-init.php) (with **[`HASH_HMAC`](https://www.php.net/manual/en/hash.constants.php#constant.hash-hmac)**) functions no longer accept non-cryptographic hashes.

### [json_decode()](https://www.php.net/manual/en/function.json-decode.php) function options

The [json_decode()](https://www.php.net/manual/en/function.json-decode.php) function option, **[`JSON_OBJECT_AS_ARRAY`](https://www.php.net/manual/en/json.constants.php#constant.json-object-as-array)**, is now used if the second parameter (assoc) is **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**. Previously, **[`JSON_OBJECT_AS_ARRAY`](https://www.php.net/manual/en/json.constants.php#constant.json-object-as-array)** was always ignored.

### [rand()](https://www.php.net/manual/en/function.rand.php) and [mt_rand()](https://www.php.net/manual/en/function.mt-rand.php) output

Sequences generated by [rand()](https://www.php.net/manual/en/function.rand.php) and [mt_rand()](https://www.php.net/manual/en/function.mt-rand.php) for a specific seed may differ from PHP 7.1 on 64-bit machines (due to the fixing of a modulo bias bug in the implementation).

### Removal of [`sql.safe_mode`](https://www.php.net/manual/en/ini.core.php#ini.sql.safe-mode) ini setting

The `sql.safe_mode` ini setting has now been removed.

### Changes to [date_parse()](https://www.php.net/manual/en/function.date-parse.php) and [date_parse_from_format()](https://www.php.net/manual/en/function.date-parse-from-format.php)

The `zone` element of the array returned by [date_parse()](https://www.php.net/manual/en/function.date-parse.php) and [date_parse_from_format()](https://www.php.net/manual/en/function.date-parse-from-format.php) represents seconds instead of minutes now, and its sign is inverted. For instance `-120` is now `7200`.

### Incoming Cookies

As of PHP 7.2.34, the *names* of incoming cookies are no longer url-decoded for security reasons.

# [PHP 7.1](https://www.php.net/manual/en/migration71.incompatible.php)

## Backward incompatible changes

### Throw on passing too few function arguments

Previously, a warning would be emitted for invoking user-defined functions with too few arguments. Now, this warning has been promoted to an Error exception. This change only applies to user-defined functions, not internal functions. For example:

```
<?php
function test($param){}
test();
```

The above example will output something similar to:

    Fatal error: Uncaught ArgumentCountError: Too few arguments to function test(), 0 passed in %s on line %d and exactly 1 expected in %s:%d

### Forbid dynamic calls to scope introspection functions

Dynamic calls for certain functions have been forbidden (in the form of `$func()` or `array_map('extract', ...)`, etc). These functions either inspect or modify another scope, and present with them ambiguous and unreliable behavior. The functions are as follows:

- [assert()](https://www.php.net/manual/en/function.assert.php) - with a string as the first argument

- [compact()](https://www.php.net/manual/en/function.compact.php)

- [extract()](https://www.php.net/manual/en/function.extract.php)

- [func_get_args()](https://www.php.net/manual/en/function.func-get-args.php)

- [func_get_arg()](https://www.php.net/manual/en/function.func-get-arg.php)

- [func_num_args()](https://www.php.net/manual/en/function.func-num-args.php)

- [get_defined_vars()](https://www.php.net/manual/en/function.get-defined-vars.php)

- [mb_parse_str()](https://www.php.net/manual/en/function.mb-parse-str.php) - with one arg

- [parse_str()](https://www.php.net/manual/en/function.parse-str.php) - with one arg

```
<?php
(function () {
    $func = 'func_num_args';
    $func();
})();
```

The above example will output:

    Warning: Cannot call func_num_args() dynamically in %s on line %d

### Invalid class, interface, and trait names

The following names cannot be used to name classes, interfaces, or traits:

- [void](https://www.php.net/manual/en/language.types.void.php)

- [iterable](https://www.php.net/manual/en/language.types.iterable.php)

### Numerical string conversions now respect scientific notation

Integer operations and conversions on numerical strings now respect scientific notation. This also includes the `(int)` cast operation, and the following functions: [intval()](https://www.php.net/manual/en/function.intval.php) (where the base is 10), [settype()](https://www.php.net/manual/en/function.settype.php), [decbin()](https://www.php.net/manual/en/function.decbin.php), [decoct()](https://www.php.net/manual/en/function.decoct.php), and [dechex()](https://www.php.net/manual/en/function.dechex.php).

### Fixes to [mt_rand()](https://www.php.net/manual/en/function.mt-rand.php) algorithm

[mt_rand()](https://www.php.net/manual/en/function.mt-rand.php) will now default to using the fixed version of the Mersenne Twister algorithm. If deterministic output from [mt_rand()](https://www.php.net/manual/en/function.mt-rand.php) was relied upon, then **[`MT_RAND_PHP`](https://www.php.net/manual/en/random.constants.php#constant.mt-rand-php)** can be used as optional second parameter to [mt_srand()](https://www.php.net/manual/en/function.mt-srand.php) to preserve the old (incorrect) implementation.

### [rand()](https://www.php.net/manual/en/function.rand.php) aliased to [mt_rand()](https://www.php.net/manual/en/function.mt-rand.php) and [srand()](https://www.php.net/manual/en/function.srand.php) aliased to [mt_srand()](https://www.php.net/manual/en/function.mt-srand.php)

[rand()](https://www.php.net/manual/en/function.rand.php) and [srand()](https://www.php.net/manual/en/function.srand.php) have now been made aliases to [mt_rand()](https://www.php.net/manual/en/function.mt-rand.php) and [mt_srand()](https://www.php.net/manual/en/function.mt-srand.php), respectively. This means that the output for the following functions have changed: [rand()](https://www.php.net/manual/en/function.rand.php), [shuffle()](https://www.php.net/manual/en/function.shuffle.php), [str_shuffle()](https://www.php.net/manual/en/function.str-shuffle.php), and [array_rand()](https://www.php.net/manual/en/function.array-rand.php).

### Disallow the ASCII delete control character in identifiers

The ASCII delete control character (`0x7F`) can no longer be used in identifiers that are not quoted.

### `error_log` changes with `syslog` value

If the `error_log` ini setting is set to `syslog`, the PHP error levels are mapped to the syslog error levels. This brings finer differentiation in the error logs in contrary to the previous approach where all the errors are logged with the notice level only.

### Do not call destructors on incomplete objects

Destructors are now never called for objects that throw an exception during the execution of their constructor. In previous versions this behavior depended on whether the object was referenced outside the constructor (e.g. by an exception backtrace).

### [call_user_func()](https://www.php.net/manual/en/function.call-user-func.php) handling of reference arguments

[call_user_func()](https://www.php.net/manual/en/function.call-user-func.php) will now always generate a warning upon calls to functions that expect references as arguments. Previously this depended on whether the call was fully qualified.

Additionally, [call_user_func()](https://www.php.net/manual/en/function.call-user-func.php) and [call_user_func_array()](https://www.php.net/manual/en/function.call-user-func-array.php) will no longer abort the function call in this case. The "expected reference" warning will be emitted, but the call will proceed as usual.

### The empty index operator is not supported for strings anymore

Applying the empty index operator to a string (e.g. `$str[] = $x`) throws a fatal error instead of converting silently to array.

### Assignment via string index access on an empty string

String modification by character on an empty string now works like for non-empty strings, i.e. writing to an out of range offset pads the string with spaces, where non-integer types are converted to integer, and only the first character of the assigned string is used. Formerly, empty strings where silently treated like an empty array.

```
<?php
$a = '';
$a[10] = 'foo';
var_dump($a);
?>
```

Output of the above example in PHP 7.0:

    array(1) {
      [10]=>
      string(3) "foo"
    }

Output of the above example in PHP 7.1:

    string(11) "          f"

### Removed ini directives

The following ini directives have been removed:

- `session.entropy_file`

- `session.entropy_length`

- `session.hash_function`

- `session.hash_bits_per_character`

### Array ordering when elements are automatically created during by reference assignments has changed

The order of the elements in an array has changed when those elements have been automatically created by referencing them in a by reference assignment. For example:

```
<?php
$array = [];
$array["a"] =& $array["b"];
$array["b"] = 1;
var_dump($array);
?>
```

Output of the above example in PHP 7.0:

    array(2) {
      ["a"]=>
      &int(1)
      ["b"]=>
      &int(1)
    }

Output of the above example in PHP 7.1:

    array(2) {
      ["b"]=>
      &int(1)
      ["a"]=>
      &int(1)
    }

### Sort order of equal elements

The internal sorting algorithm has been improved, what may result in different sort order of elements, which compare as equal, than before.

> **Note**:
>
> Don't rely on the order of elements which compare as equal; it might change anytime.

### Error message for E_RECOVERABLE errors

The error message for E_RECOVERABLE errors has been changed from "Catchable fatal error" to "Recoverable fatal error".

### \$options parameter of unserialize()

The `allowed_classes` element of the \$options parameter of [unserialize()](https://www.php.net/manual/en/function.unserialize.php) is now strictly typed, i.e. if anything other than an [array](https://www.php.net/manual/en/language.types.array.php) or a [bool](https://www.php.net/manual/en/language.types.boolean.php) is given, unserialize() returns **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** and issues an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)**.

### DateTime constructor incorporates microseconds

[DateTime](https://www.php.net/manual/en/class.datetime.php) and [DateTimeImmutable](https://www.php.net/manual/en/class.datetimeimmutable.php) now properly incorporate microseconds when constructed from the current time, either explicitly or with a relative string (e.g. `"first day of next month"`). This means that naive comparisons of two newly created instances will now more likely return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** instead of **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)**:

```
<?php
new DateTime() == new DateTime();
?>
```

### Fatal errors to [Error](https://www.php.net/manual/en/class.error.php) exceptions conversions

In the Date extension, invalid serialization data for [DateTime](https://www.php.net/manual/en/class.datetime.php) or [DatePeriod](https://www.php.net/manual/en/class.dateperiod.php) classes, or timezone initialization failure from serialized data, will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception from the **\_\_wakeup()** or **\_\_set_state()** methods, instead of resulting in a fatal error.

In the DBA extension, data modification functions (such as [dba_insert()](https://www.php.net/manual/en/function.dba-insert.php)) will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of triggering a catchable fatal error if the key does not contain exactly two elements.

In the DOM extension, invalid schema or RelaxNG validation contexts will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error. Similarly, attempting to register a node class that does not extend the appropriate base class, or attempting to read an invalid property or write to a readonly property, will also now throw an [Error](https://www.php.net/manual/en/class.error.php) exception.

In the IMAP extension, email addresses longer than 16385 bytes will throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error.

In the Intl extension, failing to call the parent constructor in a class extending [Collator](https://www.php.net/manual/en/class.collator.php) before invoking the parent methods will now throw an [Error](https://www.php.net/manual/en/class.error.php) instead of resulting in a recoverable fatal error. Also, cloning a [Transliterator](https://www.php.net/manual/en/class.transliterator.php) object will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception on failure to clone the internal transliterator instead of resulting in a fatal error.

In the LDAP extension, providing an unknown modification type to **ldap_batch_modify()** will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error.

In the mbstring extension, the [mb_ereg()](https://www.php.net/manual/en/function.mb-ereg.php) and [mb_eregi()](https://www.php.net/manual/en/function.mb-eregi.php) functions will now throw a [ParseError](https://www.php.net/manual/en/class.parseerror.php) exception if an invalid PHP expression is provided and the 'e' option is used.

In the Mcrypt extension, the [mcrypt_encrypt()](https://www.php.net/manual/en/function.mcrypt-encrypt.php) and [mcrypt_decrypt()](https://www.php.net/manual/en/function.mcrypt-decrypt.php) will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error if mcrypt cannot be initialized.

In the mysqli extension, attempting to read an invalid property or write to a readonly property will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error.

In the Reflection extension, failing to retrieve a reflection object or retrieve an object property will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error.

In the Session extension, custom session handlers that do not return strings for session IDs will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error when a function is called that must generate a session ID.

In the SimpleXML extension, creating an unnamed or duplicate attribute will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error.

In the SPL extension, attempting to clone an **SplDirectory** object will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error. Similarly, calling [ArrayIterator::append()](https://www.php.net/manual/en/arrayiterator.append.php) when iterating over an object will also now throw an [Error](https://www.php.net/manual/en/class.error.php) exception.

In the standard extension, the [assert()](https://www.php.net/manual/en/function.assert.php) function, when provided with a string argument as its first parameter, will now throw a [ParseError](https://www.php.net/manual/en/class.parseerror.php) exception instead of resulting in a catchable fatal error if the PHP code is invalid. Similarly, calling [forward_static_call()](https://www.php.net/manual/en/function.forward-static-call.php) outside of a class scope will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception.

In the Tidy extension, creating a [tidyNode](https://www.php.net/manual/en/class.tidynode.php) manually will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error.

In the WDDX extension, a circular reference when serializing will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error.

In the XML-RPC extension, a circular reference when serializing will now throw an instance of [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error.

In the Zip extension, the [ZipArchive::addGlob()](https://www.php.net/manual/en/ziparchive.addglob.php) method will now throw an [Error](https://www.php.net/manual/en/class.error.php) exception instead of resulting in a fatal error if glob support is not available.

### Lexically bound variables cannot reuse names

Variables bound to a [closure](https://www.php.net/manual/en/functions.anonymous.php) via the `use` construct cannot use the same name as any [superglobals](https://www.php.net/manual/en/language.variables.predefined.php), `$this`, or any parameter. For example, all of these function definition will result in a fatal error:

```
<?php
$f = function () use ($_SERVER) {};
$f = function () use ($this) {};
$f = function ($param) use ($param) {};
```

### long2ip() parameter type change

[long2ip()](https://www.php.net/manual/en/function.long2ip.php) now expects an [int](https://www.php.net/manual/en/language.types.integer.php) instead of a [string](https://www.php.net/manual/en/language.types.string.php).

### JSON encoding and decoding

The `serialize_precision` ini setting now controls the serialization precision when encoding [float](https://www.php.net/manual/en/language.types.float.php)s.

Decoding an empty key now results in an empty property name, rather than `_empty_` as a property name.

```
<?php
var_dump(json_decode(json_encode(['' => 1])));
```

The above example will output something similar to:

    object(stdClass)#1 (1) {
      [""]=>
      int(1)
    }

When supplying the **[`JSON_UNESCAPED_UNICODE`](https://www.php.net/manual/en/json.constants.php#constant.json-unescaped-unicode)** flag to [json_encode()](https://www.php.net/manual/en/function.json-encode.php), the sequences U+2028 and U+2029 are now escaped.

### Changes to [mb_ereg()](https://www.php.net/manual/en/function.mb-ereg.php) and [mb_eregi()](https://www.php.net/manual/en/function.mb-eregi.php) parameter semantics

The third parameter to the [mb_ereg()](https://www.php.net/manual/en/function.mb-ereg.php) and [mb_eregi()](https://www.php.net/manual/en/function.mb-eregi.php) functions (`regs`) will now be set to an empty array if nothing was matched. Formerly, the parameter would not have been modified.

### Drop support for the sslv2 stream

The sslv2 stream has now been dropped in OpenSSL.

### Forbid "return;" for typed returns already at compile-time

Return statements without argument in functions which declare a return type now trigger **[`E_COMPILE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-compile-error)** (unless the return type is declared as [void](https://www.php.net/manual/en/language.types.void.php)), even if the return statement would never be reached.

# [PHP 7.0](https://www.php.net/manual/en/migration70.incompatible.php)

## Backward incompatible changes

### Changes to error and exception handling

Many fatal and recoverable fatal errors have been converted to exceptions in PHP 7. These error exceptions inherit from the [Error](https://www.php.net/manual/en/class.error.php) class, which itself implements the [Throwable](https://www.php.net/manual/en/class.throwable.php) interface (the new base interface all exceptions inherit).

This means that custom error handlers may no longer be triggered because exceptions may be thrown instead (causing new fatal errors for uncaught [Error](https://www.php.net/manual/en/class.error.php) exceptions).

A more complete description of how errors operate in PHP can be found [on the Throwable errors page](https://www.php.net/manual/en/language.error-handling.throwable.php). This migration guide will merely enumerate the changes that affect backward compatibility.

#### [set_exception_handler()](https://www.php.net/manual/en/function.set-exception-handler.php) is no longer guaranteed to receive [Exception](https://www.php.net/manual/en/class.exception.php) objects

Code that implements an exception handler registered with [set_exception_handler()](https://www.php.net/manual/en/function.set-exception-handler.php) using a type declaration of [Exception](https://www.php.net/manual/en/class.exception.php) will cause a fatal error when an [Error](https://www.php.net/manual/en/class.error.php) object is thrown.

If the handler needs to work on both PHP 5 and 7, you should remove the type declaration from the handler, while code that is being migrated to work on PHP 7 exclusively can simply replace the [Exception](https://www.php.net/manual/en/class.exception.php) type declaration with [Throwable](https://www.php.net/manual/en/class.throwable.php) instead.

```
<?php
// PHP 5 era code that will break.
function handler(Exception $e) { /* ... */ }
set_exception_handler('handler');

// PHP 5 and 7 compatible.
function handler($e) { /* ... */ }

// PHP 7 only.
function handler(Throwable $e) { /* ... */ }
?>
```

#### Internal constructors always throw exceptions on failure

Previously, some internal classes would return **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** or an unusable object when the constructor failed. All internal classes will now throw an [Exception](https://www.php.net/manual/en/class.exception.php) in this case in the same way that user classes already had to.

#### Parse errors throw [ParseError](https://www.php.net/manual/en/class.parseerror.php)

Parser errors now throw a [ParseError](https://www.php.net/manual/en/class.parseerror.php) object. Error handling for [eval()](https://www.php.net/manual/en/function.eval.php) should now include a [`catch`](https://www.php.net/manual/en/control-structures.try-catch.php#control-structures.catch) block that can handle this error.

#### E_STRICT notices severity changes

All of the **[`E_STRICT`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-strict)** notices have been reclassified to other levels. **[`E_STRICT`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-strict)** constant is retained, so calls like `error_reporting(E_ALL|E_STRICT)` will not cause an error.

| Situation | New level/behaviour |
|----|----|
| Indexing by a resource | **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** |
| Abstract static methods | Notice removed, triggers no error |
| "Redefining" a constructor | Notice removed, triggers no error |
| Signature mismatch during inheritance | **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** |
| Same (compatible) property in two used traits | Notice removed, triggers no error |
| Accessing static property non-statically | **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** |
| Only variables should be assigned by reference | **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** |
| Only variables should be passed by reference | **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** |
| Calling non-static methods statically | **[`E_DEPRECATED`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-deprecated)** |

****[`E_STRICT`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-strict)** notices severity changes**

### Changes to variable handling

PHP 7 now uses an abstract syntax tree when parsing source files. This has permitted many improvements to the language which were previously impossible due to limitations in the parser used in earlier versions of PHP, but has resulted in the removal of a few special cases for consistency reasons, which has resulted in backward compatibility breaks. These cases are detailed in this section.

#### Changes to the handling of indirect variables, properties, and methods

Indirect access to variables, properties, and methods will now be evaluated strictly in left-to-right order, as opposed to the previous mix of special cases. The table below shows how the order of evaluation has changed.

| Expression            | PHP 5 interpretation    | PHP 7 interpretation    |
|-----------------------|-------------------------|-------------------------|
| `$$foo['bar']['baz']` | `${$foo['bar']['baz']}` | `($$foo)['bar']['baz']` |
| `$foo->$bar['baz']`   | `$foo->{$bar['baz']}`   | `($foo->$bar)['baz']`   |
| `$foo->$bar['baz']()` | `$foo->{$bar['baz']}()` | `($foo->$bar)['baz']()` |
| `Foo::$bar['baz']()`  | `Foo::{$bar['baz']}()`  | `(Foo::$bar)['baz']()`  |

**Old and new evaluation of indirect expressions**

Code that used the old right-to-left evaluation order must be rewritten to explicitly use that evaluation order with curly braces (see the above middle column). This will make the code both forwards compatible with PHP 7.x and backwards compatible with PHP 5.x.

This also affects the [`global`](https://www.php.net/manual/en/language.variables.scope.php#language.variables.scope.global) keyword. The curly brace syntax can be used to emulate the previous behaviour if required:

```
<?php
function f() {
    // Valid in PHP 5 only.
    global $$foo->bar;

    // Valid in PHP 5 and 7.
    global ${$foo->bar};
}
?>
```

#### Changes to [list()](https://www.php.net/manual/en/function.list.php) handling

##### [list()](https://www.php.net/manual/en/function.list.php) no longer assigns variables in reverse order

[list()](https://www.php.net/manual/en/function.list.php) will now assign values to variables in the order they are defined, rather than reverse order. In general, this only affects the case where [list()](https://www.php.net/manual/en/function.list.php) is being used in conjunction with the array `[]` operator, as shown below:

```
<?php
list($a[], $a[], $a[]) = [1, 2, 3];
var_dump($a);
?>
```

Output of the above example in PHP 5:

    array(3) {
      [0]=>
      int(3)
      [1]=>
      int(2)
      [2]=>
      int(1)
    }

Output of the above example in PHP 7:

    array(3) {
      [0]=>
      int(1)
      [1]=>
      int(2)
      [2]=>
      int(3)
    }

In general, it is recommended not to rely on the order in which [list()](https://www.php.net/manual/en/function.list.php) assignments occur, as this is an implementation detail that may change again in the future.

##### Empty [list()](https://www.php.net/manual/en/function.list.php) assignments have been removed

[list()](https://www.php.net/manual/en/function.list.php) constructs can no longer be empty. The following are no longer allowed:

```
<?php
list() = $a;
list(,,) = $a;
list($x, list(), $y) = $a;
?>
```

##### [list()](https://www.php.net/manual/en/function.list.php) cannot unpack [string](https://www.php.net/manual/en/language.types.string.php)s

[list()](https://www.php.net/manual/en/function.list.php) can no longer unpack [string](https://www.php.net/manual/en/language.types.string.php) variables. [str_split()](https://www.php.net/manual/en/function.str-split.php) should be used instead.

#### Array ordering when elements are automatically created during by reference assignments has changed

The order of the elements in an array has changed when those elements have been automatically created by referencing them in a by reference assignment. For example:

```
<?php
$array = [];
$array["a"] =& $array["b"];
$array["b"] = 1;
var_dump($array);
?>
```

Output of the above example in PHP 5:

    array(2) {
      ["b"]=>
      &int(1)
      ["a"]=>
      &int(1)
    }

Output of the above example in PHP 7:

    array(2) {
      ["a"]=>
      &int(1)
      ["b"]=>
      &int(1)
    }

#### Parentheses around function arguments no longer affect behaviour

In PHP 5, using redundant parentheses around a function argument could quiet strict standards warnings when the function argument was passed by reference. The warning will now always be issued.

```
<?php
function getArray() {
    return [1, 2, 3];
}

function squareArray(array &$a) {
    foreach ($a as &$v) {
        $v **= 2;
    }
}

// Generates a warning in PHP 7.
squareArray((getArray()));
?>
```

The above example will output:

    Notice: Only variables should be passed by reference in /tmp/test.php on line 13

### Changes to [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php)

Minor changes have been made to the behaviour of the [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php) control structure, primarily around the handling of the internal array pointer and modification of the array being iterated over.

#### [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php) no longer changes the internal array pointer

Prior to PHP 7, the internal array pointer was modified while an array was being iterated over with [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php). This is no longer the case, as shown in the following example:

```
<?php
$array = [0, 1, 2];
foreach ($array as &$val) {
    var_dump(current($array));
}
?>
```

Output of the above example in PHP 5:

    int(1)
    int(2)
    bool(false)

Output of the above example in PHP 7:

    int(0)
    int(0)
    int(0)

#### [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php) by-value operates on a copy of the array

When used in the default by-value mode, [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php) will now operate on a copy of the array being iterated rather than the array itself. This means that changes to the array made during iteration will not affect the values that are iterated.

#### [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php) by-reference has improved iteration behaviour

When iterating by-reference, [`foreach`](https://www.php.net/manual/en/control-structures.foreach.php) will now do a better job of tracking changes to the array made during iteration. For example, appending to an array while iterating will now result in the appended values being iterated over as well:

```
<?php
$array = [0];
foreach ($array as &$val) {
    var_dump($val);
    $array[1] = 1;
}
?>
```

Output of the above example in PHP 5:

    int(0)

Output of the above example in PHP 7:

    int(0)
    int(1)

#### Iteration of non-[Traversable](https://www.php.net/manual/en/class.traversable.php) objects

Iterating over a non-[Traversable](https://www.php.net/manual/en/class.traversable.php) object will now have the same behaviour as iterating over by-reference arrays. This results in the [improved behaviour when modifying an array during iteration](https://www.php.net/manual/en/migration70.incompatible.php#migration70.incompatible.foreach.by-ref) also being applied when properties are added to or removed from the object.

### Changes to [int](https://www.php.net/manual/en/language.types.integer.php) handling

#### Invalid octal literals

Previously, octal literals that contained invalid numbers were silently truncated (`0128` was taken as `012`). Now, an invalid octal literal will cause a parse error.

#### Negative bitshifts

Bitwise shifts by negative numbers will now throw an [ArithmeticError](https://www.php.net/manual/en/class.arithmeticerror.php):

```
<?php
var_dump(1 >> -1);
?>
```

Output of the above example in PHP 5:

    int(0)

Output of the above example in PHP 7:

    Fatal error: Uncaught ArithmeticError: Bit shift by negative number in /tmp/test.php:2
    Stack trace:
    #0 {main}
      thrown in /tmp/test.php on line 2

#### Out of range bitshifts

Bitwise shifts (in either direction) beyond the bit width of an [int](https://www.php.net/manual/en/language.types.integer.php) will always result in 0. Previously, the behaviour of such shifts was architecture dependent.

#### Changes to Division By Zero

Previously, when 0 was used as the divisor for either the divide (/) or modulus (%) operators, an E_WARNING would be emitted and **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** would be returned. Now, the divide operator returns a float as either +INF, -INF, or NAN, as specified by IEEE 754. The modulus operator E_WARNING has been removed and will throw a [DivisionByZeroError](https://www.php.net/manual/en/class.divisionbyzeroerror.php) exception.

```
<?php
var_dump(3/0);
var_dump(0/0);
var_dump(0%0);
?>
```

Output of the above example in PHP 5:

    Warning: Division by zero in %s on line %d
    bool(false)

    Warning: Division by zero in %s on line %d
    bool(false)

    Warning: Division by zero in %s on line %d
    bool(false)

Output of the above example in PHP 7:

    Warning: Division by zero in %s on line %d
    float(INF)

    Warning: Division by zero in %s on line %d
    float(NAN)

    PHP Fatal error:  Uncaught DivisionByZeroError: Modulo by zero in %s line %d

### Changes to [string](https://www.php.net/manual/en/language.types.string.php) handling

#### Hexadecimal strings are no longer considered numeric

Strings containing hexadecimal numbers are no longer considered to be numeric. For example:

```
<?php
var_dump("0x123" == "291");
var_dump(is_numeric("0x123"));
var_dump("0xe" + "0x1");
var_dump(substr("foo", "0x1"));
?>
```

Output of the above example in PHP 5:

    bool(true)
    bool(true)
    int(15)
    string(2) "oo"

Output of the above example in PHP 7:

    bool(false)
    bool(false)
    int(0)

    Notice: A non well formed numeric value encountered in /tmp/test.php on line 5
    string(3) "foo"

[filter_var()](https://www.php.net/manual/en/function.filter-var.php) can be used to check if a [string](https://www.php.net/manual/en/language.types.string.php) contains a hexadecimal number, and also to convert a string of that type to an [int](https://www.php.net/manual/en/language.types.integer.php):

```
<?php
$str = "0xffff";
$int = filter_var($str, FILTER_VALIDATE_INT, FILTER_FLAG_ALLOW_HEX);
if (false === $int) {
    throw new Exception("Invalid integer!");
}
var_dump($int); // int(65535)
?>
```

#### `\u{` may cause errors

Due to the addition of the new [Unicode codepoint escape syntax](https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.unicode-codepoint-escape-syntax), strings containing a literal `\u{` followed by an invalid sequence will cause a fatal error. To avoid this, the leading backslash should be escaped.

### Removed functions

#### **call_user_method()** and **call_user_method_array()**

These functions were deprecated in PHP 4.1.0 in favour of [call_user_func()](https://www.php.net/manual/en/function.call-user-func.php) and [call_user_func_array()](https://www.php.net/manual/en/function.call-user-func-array.php). You may also want to consider using [variable functions](https://www.php.net/manual/en/functions.variable-functions.php) and/or the [`...`](https://www.php.net/manual/en/functions.arguments.php#functions.variable-arg-list) operator.

#### All ereg\* functions

All `ereg` functions were removed. [PCRE](https://www.php.net/manual/en/book.pcre.php) is a recommended alternative.

#### [mcrypt](https://www.php.net/manual/en/book.mcrypt.php) aliases

The deprecated **mcrypt_generic_end()** function has been removed in favour of [mcrypt_generic_deinit()](https://www.php.net/manual/en/function.mcrypt-generic-deinit.php).

Additionally, the deprecated **mcrypt_ecb()**, **mcrypt_cbc()**, **mcrypt_cfb()** and **mcrypt_ofb()** functions have been removed in favour of using [mcrypt_decrypt()](https://www.php.net/manual/en/function.mcrypt-decrypt.php) with the appropriate **`MCRYPT_MODE_*`** constant.

#### All ext/mysql functions

All [ext/mysql](https://www.php.net/manual/en/book.mysql.php) functions were removed. For details about choosing a different MySQL API, see [Choosing a MySQL API](https://www.php.net/manual/en/mysqlinfo.api.choosing.php).

#### All ext/mssql functions

All `ext/mssql` functions were removed.

- [PDO_SQLSRV](https://www.php.net/manual/en/ref.pdo-sqlsrv.php)
- [PDO_ODBC](https://www.php.net/manual/en/ref.pdo-odbc.php)
- [SQLSRV](https://www.php.net/manual/en/book.sqlsrv.php)
- [Unified ODBC API](https://www.php.net/manual/en/book.uodbc.php)

#### [intl](https://www.php.net/manual/en/book.intl.php) aliases

The deprecated **datefmt_set_timezone_id()** and **IntlDateFormatter::setTimeZoneID()** aliases have been removed in favour of [datefmt_set_timezone()](https://www.php.net/manual/en/intldateformatter.settimezone.php) and [IntlDateFormatter::setTimeZone()](https://www.php.net/manual/en/intldateformatter.settimezone.php), respectively.

#### **set_magic_quotes_runtime()**

**set_magic_quotes_runtime()**, along with its alias **magic_quotes_runtime()**, have been removed. They were deprecated in PHP 5.3.0, and became effectively non-functional with the removal of magic quotes in PHP 5.4.0.

#### **set_socket_blocking()**

The deprecated **set_socket_blocking()** alias has been removed in favour of [stream_set_blocking()](https://www.php.net/manual/en/function.stream-set-blocking.php).

#### [dl()](https://www.php.net/manual/en/function.dl.php) in PHP-FPM

[dl()](https://www.php.net/manual/en/function.dl.php) can no longer be used in PHP-FPM. It remains functional in the CLI and embed SAPIs.

#### [GD](https://www.php.net/manual/en/book.image.php) Type1 functions

Support for PostScript Type1 fonts has been removed from the GD extension, resulting in the removal of the following functions:

- **imagepsbbox()**

- **imagepsencodefont()**

- **imagepsextendfont()**

- **imagepsfreefont()**

- **imagepsloadfont()**

- **imagepsslantfont()**

- **imagepstext()**

Using TrueType fonts and their associated functions is recommended instead.

### Removed INI directives

#### Removed features

The following INI directives have been removed as their associated features have also been removed:

- `always_populate_raw_post_data`

- `asp_tags`

#### `xsl.security_prefs`

The `xsl.security_prefs` directive has been removed. Instead, the [XsltProcessor::setSecurityPrefs()](https://www.php.net/manual/en/xsltprocessor.setsecurityprefs.php) method should be called to control the security preferences on a per-processor basis.

### Other backward incompatible changes

#### New objects cannot be assigned by reference

The result of the [`new`](https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.new) statement can no longer be assigned to a variable by reference:

```
<?php
class C {}
$c =& new C;
?>
```

Output of the above example in PHP 5:

    Deprecated: Assigning the return value of new by reference is deprecated in /tmp/test.php on line 3

Output of the above example in PHP 7:

    Parse error: syntax error, unexpected 'new' (T_NEW) in /tmp/test.php on line 3

#### Invalid class, interface and trait names

The following names cannot be used to name classes, interfaces or traits:

- [bool](https://www.php.net/manual/en/language.types.boolean.php)

- [int](https://www.php.net/manual/en/language.types.integer.php)

- [float](https://www.php.net/manual/en/language.types.float.php)

- [string](https://www.php.net/manual/en/language.types.string.php)

- **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**

- **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)**

- **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**

Furthermore, the following names should not be used. Although they will not generate an error in PHP 7.0, they are reserved for future use and should be considered deprecated.

- [resource](https://www.php.net/manual/en/language.types.resource.php)

- [object](https://www.php.net/manual/en/language.types.object.php)

- [mixed](https://www.php.net/manual/en/language.types.mixed.php)

- numeric

#### ASP and script PHP tags removed

Support for using ASP and script tags to delimit PHP code has been removed. The affected tags are:

| Opening tag               | Closing tag |
|---------------------------|-------------|
| `<%`                      | `%>`        |
| `<%=`                     | `%>`        |
| `<script language="php">` | `</script>` |

**Removed ASP and script tags**

#### Calls from incompatible context removed

[Previously deprecated in PHP 5.6](https://www.php.net/manual/en/migration56.deprecated.php#migration56.deprecated.incompatible-context), static calls made to a non-static method with an incompatible context will now result in the called method having an undefined `$this` variable and a deprecation warning being issued.

```
<?php
class A {
    public function test() { var_dump($this); }
}

// Note: Does NOT extend A
class B {
    public function callNonStaticMethodOfA() { A::test(); }
}

(new B)->callNonStaticMethodOfA();
?>
```

Output of the above example in PHP 5.6:

    Deprecated: Non-static method A::test() should not be called statically, assuming $this from incompatible context in /tmp/test.php on line 8
    object(B)#1 (0) {
    }

Output of the above example in PHP 7:

    Deprecated: Non-static method A::test() should not be called statically in /tmp/test.php on line 8

    Notice: Undefined variable: this in /tmp/test.php on line 3
    NULL

#### [`yield`](https://www.php.net/manual/en/language.generators.syntax.php#control-structures.yield) is now a right associative operator

The [`yield`](https://www.php.net/manual/en/language.generators.syntax.php#control-structures.yield) construct no longer requires parentheses, and has been changed to a right associative operator with precedence between `print` and `=>`. This can result in changed behaviour:

```
<?php
echo yield -1;
// Was previously interpreted as
echo (yield) - 1;
// And is now interpreted as
echo yield (-1);

yield $foo or die;
// Was previously interpreted as
yield ($foo or die);
// And is now interpreted as
(yield $foo) or die;
?>
```

Parentheses can be used to disambiguate those cases.

#### Functions cannot have multiple parameters with the same name

It is no longer possible to define two or more function parameters with the same name. For example, the following function will trigger an **[`E_COMPILE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-compile-error)**:

```
<?php
function foo($a, $b, $unused, $unused) {
    //
}
?>
```

#### Functions inspecting arguments report the *current* parameter value

[func_get_arg()](https://www.php.net/manual/en/function.func-get-arg.php), [func_get_args()](https://www.php.net/manual/en/function.func-get-args.php), [debug_backtrace()](https://www.php.net/manual/en/function.debug-backtrace.php) and exception backtraces will no longer report the original value that was passed to a parameter, but will instead provide the current value (which might have been modified).

```
<?php
function foo($x) {
    $x++;
    var_dump(func_get_arg(0));
}
foo(1);?>
```

Output of the above example in PHP 5:

    1

Output of the above example in PHP 7:

    2

#### Switch statements cannot have multiple default blocks

It is no longer possible to define two or more default blocks in a switch statement. For example, the following switch statement will trigger an **[`E_COMPILE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-compile-error)**:

```
<?php
switch (1) {
    default:
    break;
    default:
    break;
}
?>
```

#### `$HTTP_RAW_POST_DATA` removed

`$HTTP_RAW_POST_DATA` is no longer available. The [`php://input`](https://www.php.net/manual/en/wrappers.php.php#wrappers.php.input) stream should be used instead.

#### `#` comments in INI files removed

Support for prefixing comments with `#` in INI files has been removed. `;` (semi-colon) should be used instead. This change applies to `php.ini`, as well as files handled by [parse_ini_file()](https://www.php.net/manual/en/function.parse-ini-file.php) and [parse_ini_string()](https://www.php.net/manual/en/function.parse-ini-string.php).

#### JSON extension replaced with JSOND

The JSON extension has been replaced with JSOND, causing three minor BC breaks. Firstly, a number must not end in a decimal point (i.e. `34.` must be changed to either `34.0` or `34`). Secondly, when using scientific notation, the `e` exponent must not immediately follow a decimal point (i.e. `3.e3` must be changed to either `3.0e3` or `3e3`). Finally, an empty string is no longer considered valid JSON.

#### Internal function failure on overflow

Previously, internal functions would silently truncate numbers produced from float-to-integer coercions when the float was too large to represent as an integer. Now, an E_WARNING will be emitted and **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** will be returned.

#### Fixes to custom session handler return values

Any predicate functions implemented by custom session handlers that return either **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** or `-1` will be fatal errors. If any value from these functions other than a boolean, `-1`, or `0` is returned, then it will fail and an E_WARNING will be emitted.

#### Sort order of equal elements

The internal sorting algorithm has been improved, what may result in different sort order of elements, which compare as equal, than before.

> **Note**:
>
> Don't rely on the order of elements which compare as equal; it might change anytime.

#### Misplaced break and continue statements

`break` and `continue` statements outside of a loop or `switch` control structure are now detected at compile-time instead of run-time as before, and trigger an **[`E_COMPILE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-compile-error)**.

#### Constant disallowed as break and continue argument

`break` and `continue` statements no longer allow their argument to be a constant, and trigger a **[`E_COMPILE_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-compile-error)**.

#### Mhash is not an extension anymore

The Mhash extension has been fully integrated into the [Hash](https://www.php.net/manual/en/book.hash.php) extension. Therefore, it is no longer possible to detect Mhash support with [extension_loaded()](https://www.php.net/manual/en/function.extension-loaded.php); use [function_exists()](https://www.php.net/manual/en/function.function-exists.php) instead. Furthermore, Mhash is no longer reported by [get_loaded_extensions()](https://www.php.net/manual/en/function.get-loaded-extensions.php) and related features.

#### declare(ticks)

The [declare(ticks)](https://www.php.net/manual/en/control-structures.declare.php#control-structures.declare.ticks) directive does no longer leak into different compilation units.

# [PHP 5.6](https://www.php.net/manual/en/migration56.incompatible.php)

## Backward incompatible changes

Although most existing PHP 5 code should work without changes, please take note of some backward incompatible changes:

### Array keys won't be overwritten when defining an array as a property of a class via an array literal

Previously, arrays declared as class properties which mixed explicit and implicit keys could have array elements silently overwritten if an explicit key was the same as a sequential implicit key. For example:

```
<?php
class C {
    const ONE = 1;
    public $array = [
        self::ONE => 'foo',
        'bar',
        'quux',
    ];
}

var_dump((new C)->array);
?>
```

Output of the above example in PHP 5.5:

    array(2) {
      [0]=>
      string(3) "bar"
      [1]=>
      string(4) "quux"
    }

Output of the above example in PHP 5.6:

    array(3) {
      [1]=>
      string(3) "foo"
      [2]=>
      string(3) "bar"
      [3]=>
      string(4) "quux"
    }

### [json_decode()](https://www.php.net/manual/en/function.json-decode.php) strictness

[json_decode()](https://www.php.net/manual/en/function.json-decode.php) now rejects non-lowercase variants of the JSON literals `true`, `false` and `null` at all times, as per the JSON specification, and sets [json_last_error()](https://www.php.net/manual/en/function.json-last-error.php) accordingly. Previously, inputs to [json_decode()](https://www.php.net/manual/en/function.json-decode.php) that consisted solely of one of these values in upper or mixed case were accepted.

This change will only affect cases where invalid JSON was being passed to [json_decode()](https://www.php.net/manual/en/function.json-decode.php): valid JSON input is unaffected and will continue to be parsed normally.

### Stream wrappers now verify peer certificates and host names by default when using SSL/TLS

All encrypted client streams now enable peer verification by default. By default, this will use OpenSSL's default CA bundle to verify the peer certificate. In most cases, no changes will need to be made to communicate with servers with valid SSL certificates, as distributors generally configure OpenSSL to use known good CA bundles.

The default CA bundle may be overridden on a global basis by setting either the openssl.cafile or openssl.capath configuration setting, or on a per request basis by using the [`cafile`](https://www.php.net/manual/en/context.ssl.php#context.ssl.cafile) or [`capath`](https://www.php.net/manual/en/context.ssl.php#context.ssl.capath) context options.

While not recommended in general, it is possible to disable peer certificate verification for a request by setting the [`verify_peer`](https://www.php.net/manual/en/context.ssl.php#context.ssl.verify-peer) context option to **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**, and to disable peer name validation by setting the [`verify_peer_name`](https://www.php.net/manual/en/context.ssl.php#context.ssl.verify-peer-name) context option to **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

### [GMP](https://www.php.net/manual/en/book.gmp.php) resources are now objects

[GMP](https://www.php.net/manual/en/book.gmp.php) resources are now objects. The functional API implemented in the GMP extension has not changed, and code should run unmodified unless it checks explicitly for a resource using [is_resource()](https://www.php.net/manual/en/function.is-resource.php) or similar.

### [Mcrypt](https://www.php.net/manual/en/book.mcrypt.php) functions now require valid keys and IVs

[mcrypt_encrypt()](https://www.php.net/manual/en/function.mcrypt-encrypt.php), [mcrypt_decrypt()](https://www.php.net/manual/en/function.mcrypt-decrypt.php), **mcrypt_cbc()**, **mcrypt_cfb()**, **mcrypt_ecb()**, [mcrypt_generic()](https://www.php.net/manual/en/function.mcrypt-generic.php) and **mcrypt_ofb()** will no longer accept keys or IVs with incorrect sizes, and block cipher modes that require IVs will now fail if an IV isn't provided.

### [cURL](https://www.php.net/manual/en/book.curl.php) file uploads

Uploads using the @file syntax now require CURLOPT_SAFE_UPLOAD to be set to **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**. [CURLFile](https://www.php.net/manual/en/class.curlfile.php) should be used instead.

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.incompatible.php)

## Backward Incompatible Changes

Although most existing PHP 5 code should work without changes, please take note of some backward incompatible changes:

### Windows XP and 2003 support dropped

Support for Windows XP and 2003 has been dropped. Windows builds of PHP now require Windows Vista or newer.

### Case insensitivity no longer locale specific

All case insensitive matching for function, class and constant names is now performed in a locale independent manner according to ASCII rules. This improves support for languages using the Latin alphabet with unusual collating rules, such as Turkish and Azeri.

This may cause issues for code that uses case insensitive matches for non-ASCII characters in multibyte character sets (including UTF-8), such as accented characters in many European languages. If you have a non-English, non-ASCII code base, then you will need to test that you are not inadvertently relying on this behaviour before deploying PHP 5.5 to production systems.

### [pack()](https://php-legacy-docs.zend.com/manual/php5/en/function.pack.html) and [unpack()](https://php-legacy-docs.zend.com/manual/php5/en/function.unpack.html) changes

Changes were made to [pack()](https://php-legacy-docs.zend.com/manual/php5/en/function.pack.html) and [unpack()](https://php-legacy-docs.zend.com/manual/php5/en/function.unpack.html) to make them more compatible with Perl:

- [pack()](https://php-legacy-docs.zend.com/manual/php5/en/function.pack.html) now supports the "Z" format code, which behaves identically to "a".
- [unpack()](https://php-legacy-docs.zend.com/manual/php5/en/function.unpack.html) now support the "Z" format code for NULL padded strings, and behaves as "a" did in previous versions: it will strip trailing NULL bytes.
- [unpack()](https://php-legacy-docs.zend.com/manual/php5/en/function.unpack.html) now keeps trailing NULL bytes when the "a" format code is used.
- [unpack()](https://php-legacy-docs.zend.com/manual/php5/en/function.unpack.html) now strips all trailing ASCII whitespace when the "A" format code is used.

Writing backward compatible code that uses the "a" format code with [unpack()](https://php-legacy-docs.zend.com/manual/php5/en/function.unpack.html) requires the use of [version_compare()](https://php-legacy-docs.zend.com/manual/php5/en/function.version-compare.html), due to the backward compatibility break.

For example:

    <?php
    // Old code:
    $data = unpack('a5', $packed);

    // New code:
    if (version_compare(PHP_VERSION, '5.5.0-dev', '>=')) {
      $data = unpack('Z5', $packed);
    } else {
      $data = unpack('a5', $packed);
    }
    ?>

### [json_encode()](https://php-legacy-docs.zend.com/manual/php5/en/function.json-encode.html) changes

When the `value` passed to [json_encode()](https://php-legacy-docs.zend.com/manual/php5/en/function.json-encode.html) triggers a JSON encoding error, **`FALSE`** is returned instead of partial output, unless `options` contains **`JSON_PARTIAL_OUTPUT_ON_ERROR`**. See [json_last_error()](https://php-legacy-docs.zend.com/manual/php5/en/function.json-last-error.html) for the full list of reasons that can cause JSON encoding to fail. One of the potential failure reasons is that `value` contains strings containing invalid UTF-8.

### `self`, `parent` and `static` are now always case insensitive

Prior to PHP 5.5, cases existed where the [self](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.paamayim-nekudotayim.html), [parent](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.paamayim-nekudotayim.html), and [static](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.late-static-bindings.html) keywords were treated in a case sensitive fashion. These have now been resolved, and these keywords are always handled case insensitively: `SELF::CONSTANT` is now treated identically to `self::CONSTANT`.

### PHP logo GUIDs removed

The GUIDs that previously resulted in PHP outputting various logos have been removed. This includes the removal of the functions to return those GUIDs. The removed functions are:

- [php_logo_guid()](https://php-legacy-docs.zend.com/manual/php5/en/function.php-logo-guid.html)
- **php_egg_logo_guid()**
- **php_real_logo_guid()**
- [zend_logo_guid()](https://php-legacy-docs.zend.com/manual/php5/en/function.zend-logo-guid.html)

### Internal execution changes

Extension authors should note that the **zend_execute()** function can no longer be overridden, and that numerous changes have been made to the `execute_data` struct and related function and method handling opcodes.

Most extension authors are unlikely to be affected, but those writing extensions that hook deeply into the Zend Engine should read [the notes on these changes](https://php-legacy-docs.zend.com/manual/php5/en/migration55.internals.html).

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.incompatible.php)

## Backward Incompatible Changes

Although most existing PHP 5 code should work without changes, please take note of some backward incompatible changes:

- [Safe mode](https://php-legacy-docs.zend.com/manual/php5/en/features.safe-mode.html) is no longer supported. Any applications that rely on safe mode may need adjustment, in terms of security.
- [Magic quotes](https://php-legacy-docs.zend.com/manual/php5/en/security.magicquotes.html) has been removed. Applications relying on this feature may need to be updated, to avoid security issues. [get_magic_quotes_gpc()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-magic-quotes-gpc.html) and [get_magic_quotes_runtime()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-magic-quotes-runtime.html) now always return **`FALSE`**. [set_magic_quotes_runtime()](https://php-legacy-docs.zend.com/manual/php5/en/function.set-magic-quotes-runtime.html) raises an **`E_CORE_ERROR`** level error on trying to enable [Magic quotes](https://php-legacy-docs.zend.com/manual/php5/en/security.magicquotes.html).
- The [register_globals](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.register-globals) and [register_long_arrays](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.register-long-arrays) `php.ini` directives have been removed.
- The mbstring.script_encoding directive has been removed. Use [zend.script_encoding](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend.script-encoding) instead.
- [Call-time pass by reference](https://php-legacy-docs.zend.com/manual/php5/en/language.references.pass.html) has been removed.
- The [break](https://php-legacy-docs.zend.com/manual/php5/en/control-structures.break.html) and [continue](https://php-legacy-docs.zend.com/manual/php5/en/control-structures.continue.html) statements no longer accept variable arguments (e.g., `break 1 + foo() * $bar;`). Static arguments still work, such as `break 2;`. As a side effect of this change `break 0;` and `continue 0;` are no longer allowed.
- The default character set for [htmlspecialchars()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlspecialchars.html), [htmlentities()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlentities.html) and [html_entity_decode()](https://php-legacy-docs.zend.com/manual/php5/en/function.html-entity-decode.html) is now `UTF-8`, instead of `ISO-8859-1`. Note that changing your output charset via the [default_charset](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.default-charset) configuration setting does not affect htmlspecialchars/htmlentities unless you are passing "" (an empty string) as the encoding parameter to your [htmlspecialchars()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlspecialchars.html)/[htmlentities()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlentities.html)/[html_entity_decode()](https://php-legacy-docs.zend.com/manual/php5/en/function.html-entity-decode.html) calls. Generally we do not recommend doing this because you should be able to change your output charset without affecting the runtime charset used by these functions. The safest approach is to explicitly set the charset on each call to [htmlspecialchars()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlspecialchars.html), [htmlentities()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlentities.html) and [html_entity_decode()](https://php-legacy-docs.zend.com/manual/php5/en/function.html-entity-decode.html).
- In the [date and time extension](https://php-legacy-docs.zend.com/manual/php5/en/book.datetime.html), the timezone can no longer be set using the TZ environment variable. Instead you have to specify a timezone using the [date.timezone](https://php-legacy-docs.zend.com/manual/php5/en/datetime.configuration.html#ini.date.timezone) `php.ini` option or [date_default_timezone_set()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-default-timezone-set.html) function. PHP will no longer attempt to guess the timezone, and will instead fall back to "UTC" and issue a **`E_WARNING`**.
- Non-numeric string offsets - e.g. `$a['foo']` where \$a is a string - now return false on [isset()](https://php-legacy-docs.zend.com/manual/php5/en/function.isset.html) and true on [empty()](https://php-legacy-docs.zend.com/manual/php5/en/function.empty.html), and produce a **`E_WARNING`** if you try to use them. Offsets of types double, bool and null produce a **`E_NOTICE`**. Numeric strings (e.g. `$a['2']`) still work as before. Note that offsets like `'12.3'` and `'5 foobar'` are considered non-numeric and produce a **`E_WARNING`**, but are converted to 12 and 5 respectively, for backward compatibility reasons. Note: Following code returns different result. \$str='abc';var_dump(isset(\$str\['x'\])); // false for PHP 5.4 or later, but true for 5.3 or less
- Converting an array to a string will now generate an **`E_NOTICE`** level error, but the result of the cast will still be the string `"Array"`.
- Turning **`NULL`**, **`FALSE`**, or an empty string into an object by adding a property will now emit an **`E_WARNING`** level error, instead of **`E_STRICT`**.
- Parameter names that shadow super globals now cause a fatal error. This prohibits code like `function foo($_GET, $_POST) {}`.
- The Salsa10 and Salsa20 [hash algorithms](https://php-legacy-docs.zend.com/manual/php5/en/book.hash.html) have been removed.
- The Tiger [hash algorithm](https://php-legacy-docs.zend.com/manual/php5/en/book.hash.html) now uses big-endian byte ordering. Please follow [this example](https://php-legacy-docs.zend.com/manual/php5/en/function.hash.html#function.hash.tiger-bc) to write code that is compatible with both PHP 5.3 and 5.4.
- [array_combine()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-combine.html) now returns `array()` instead of **`FALSE`** when two empty arrays are provided as parameters.
- If you use [htmlentities()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlentities.html) with asian character sets, it works like [htmlspecialchars()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlspecialchars.html) - this has always been the case in previous versions of PHP, but now an **`E_STRICT`** level error is emitted.
- The third parameter of [ob_start()](https://php-legacy-docs.zend.com/manual/php5/en/function.ob-start.html) has changed from [boolean](https://php-legacy-docs.zend.com/manual/php5/en/language.types.boolean.html) `erase` to [integer](https://php-legacy-docs.zend.com/manual/php5/en/language.types.integer.html) `flags`. Note that code that explicitly set `erase` to **`FALSE`** will no longer behave as expected in PHP 5.4: please follow [this example](https://php-legacy-docs.zend.com/manual/php5/en/function.ob-start.html#function.ob-start.flags-bc) to write code that is compatible with PHP 5.3 and 5.4.

The following keywords are now [reserved](https://php-legacy-docs.zend.com/manual/php5/en/reserved.html), and may not be used as names by functions, classes, etc.

- [trait](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.traits.html)
- [callable](https://php-legacy-docs.zend.com/manual/php5/en/language.types.callable.html)
- [insteadof](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.traits.html)

The following functions have been removed from PHP:

- [define_syslog_variables()](https://php-legacy-docs.zend.com/manual/php5/en/function.define-syslog-variables.html)
- [import_request_variables()](https://php-legacy-docs.zend.com/manual/php5/en/function.import-request-variables.html)
- [session_is_registered()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-is-registered.html), [session_register()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-register.html) and [session_unregister()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-unregister.html).
- The aliases [mysqli_bind_param()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysqli-bind-param.html), [mysqli_bind_result()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysqli-bind-result.html), [mysqli_client_encoding()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysqli-client-encoding.html), [mysqli_fetch()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysqli-fetch.html), [mysqli_param_count()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysqli-param-count.html), [mysqli_get_metadata()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysqli-get-metadata.html), [mysqli_send_long_data()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysqli-send-long-data.html), mysqli::client_encoding() and mysqli_stmt::stmt().

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.incompatible.php)

## Backward Incompatible Changes

Although most existing PHP 5 code should work without changes, please take note of some backward incompatible changes:

- The newer internal parameter parsing API has been applied across all the extensions bundled with PHP 5.3.x. This parameter parsing API causes functions to return **`NULL`** when passed incompatible parameters. There are some exceptions to this rule, such as the [get_class()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-class.html) function, which will continue to return **`FALSE`** on error.
- [clearstatcache()](https://php-legacy-docs.zend.com/manual/php5/en/function.clearstatcache.html) no longer clears the realpath cache by default.
- [realpath()](https://php-legacy-docs.zend.com/manual/php5/en/function.realpath.html) is now fully platform-independent. Consequence of this is that invalid relative paths such as `__FILE__ . "/../x"` do not work anymore.
- The [call_user_func()](https://php-legacy-docs.zend.com/manual/php5/en/function.call-user-func.html) family of functions now propagate `$this` even if the callee is a parent class.
- The array functions [natsort()](https://php-legacy-docs.zend.com/manual/php5/en/function.natsort.html), [natcasesort()](https://php-legacy-docs.zend.com/manual/php5/en/function.natcasesort.html), [usort()](https://php-legacy-docs.zend.com/manual/php5/en/function.usort.html), [uasort()](https://php-legacy-docs.zend.com/manual/php5/en/function.uasort.html), [uksort()](https://php-legacy-docs.zend.com/manual/php5/en/function.uksort.html), [array_flip()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-flip.html), and [array_unique()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-unique.html) no longer accept objects passed as arguments. To apply these functions to an object, cast the object to an array first.
- The behaviour of functions with by-reference parameters called by value has changed. Where previously the function would accept the by-value argument, a fatal error is now emitted. Any previous code passing constants or literals to functions expecting references, will need altering to assign the value to a variable before calling the function.
- The new mysqlnd library necessitates the use of MySQL 4.1's newer 41-byte password format. Continued use of the old 16-byte passwords will cause [mysql_connect()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysql-connect.html) and similar functions to emit the error, `"mysqlnd cannot connect to MySQL 4.1+ using old authentication."`
- The new mysqlnd library does not read mysql configuration files (my.cnf/my.ini), as the older libmysqlclient library does. If your code relies on settings in the configuration file, you can load it explicitly with the [mysqli_options()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.options.html) function. Note that this means the PDO specific constants **`PDO::MYSQL_ATTR_READ_DEFAULT_FILE`** and **`PDO::MYSQL_ATTR_READ_DEFAULT_GROUP`** are not defined if MySQL support in PDO is compiled with mysqlnd.
- The trailing / has been removed from the [SplFileInfo](https://php-legacy-docs.zend.com/manual/php5/en/class.splfileinfo.html) class and other related directory classes.
- The [\_\_toString()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.magic.html#object.tostring) magic method can no longer accept arguments.
- The magic methods [\_\_get()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.overloading.html#object.get), [\_\_set()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.overloading.html#object.set), [\_\_isset()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.overloading.html#object.isset), [\_\_unset()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.overloading.html#object.unset), and [\_\_call()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.overloading.html#object.call) must always be public and can no longer be static. Method signatures are now enforced.
- The [\_\_call()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.overloading.html#object.call) magic method is now invoked on access to private and protected methods.
- [func_get_arg()](https://php-legacy-docs.zend.com/manual/php5/en/function.func-get-arg.html), [func_get_args()](https://php-legacy-docs.zend.com/manual/php5/en/function.func-get-args.html) and [func_num_args()](https://php-legacy-docs.zend.com/manual/php5/en/function.func-num-args.html) can no longer be called from the outermost scope of a file that has been included by calling [include](https://php-legacy-docs.zend.com/manual/php5/en/function.include.html) or [require](https://php-legacy-docs.zend.com/manual/php5/en/function.require.html) from within a function in the calling file.
- An emulation layer for the MHASH extension to wrap around the Hash extension have been added. However not all the algorithms are covered, notable the s2k hashing algorithm. This means that s2k hashing is no longer available as of PHP 5.3.0.

The following keywords are now reserved and may not be used in function, class, etc. names.

- [goto](https://php-legacy-docs.zend.com/manual/php5/en/control-structures.goto.html)
- [namespace](https://php-legacy-docs.zend.com/manual/php5/en/language.namespaces.html)

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.incompatible.php)

## Backward Incompatible Changes

Although most existing PHP 5 code should work without changes, you should pay attention to the following backward incompatible changes:

- [getrusage()](https://php-legacy-docs.zend.com/manual/php5/en/function.getrusage.html) returns **`NULL`** when passed incompatible arguments as of PHP 5.2.1.

- [ZipArchive::setCommentName()](https://php-legacy-docs.zend.com/manual/php5/en/ziparchive.setcommentname.html) returns **`TRUE`** on success as of PHP 5.2.1.

- [ZipArchive::setCommentIndex()](https://php-legacy-docs.zend.com/manual/php5/en/ziparchive.setcommentindex.html) returns **`TRUE`** on success as of PHP 5.2.1.

- **SplFileObject::getFilename()** returns the filename, not relative/path/to/file, as of PHP 5.2.1.

- Changed priority of `PHPRC` environment variable on Win32 The `PHPRC` environment variable now takes priority over the path stored in the Windows registry.

- CLI SAPI no longer checks cwd for `php.ini` or the `php-cli.ini` file In PHP 5.1.x an undocumented feature was added that made the CLI binary check the current working directory for a PHP configuration file, potentially leading to unpredictable behavior if an unexpected configuration file were read. This functionality was removed in 5.2.0, and PHP will no longer search CWD for the presence of `php.ini` or `php-cli.ini` files. See also the [command line](https://php-legacy-docs.zend.com/manual/php5/en/features.commandline.html) section of the manual.

- Added a warning when performing modulus 0 operations In earlier versions of PHP, performing integer % 0 did not emit any warning messages, instead returning an unexpected return value of **`FALSE`**. As of PHP 5.2.0, this operation will emit an **`E_WARNING`**, as is the case in all other instances where division by zero is performed.

      <?php
      print 10 % 0;
      /* Warning:  Division by zero in filename on line n */
      ?>

- Changed [\_\_toString()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.magic.html#object.tostring) to be called wherever applicable. The magic method [\_\_toString()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.magic.html#object.tostring) will now be called in a string context, that is, anywhere an object is used as a string. The fallback of returning a string that contains the object identifier was dropped in PHP 5.2.0. It became problematic because an object identifier cannot be considered unique. This change will mean that your application is flawed if you have relied on the object identifier as a return value. An attempt to use that value as a string will now result in a catchable fatal error.

      <?php
      class foo {}
      $foo = new foo;
      print $foo;
      /* Catchable fatal error:  Object of class foo could
         not be converted to string in filename on line n */
      ?>

  Even with [\_\_toString()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.magic.html#object.tostring), objects cannot be used as array indices or keys. We may add built-in hash support for this at a later date, but as of PHP 5.2.x you will need to either provide your own hashing or use the new SPL function [spl_object_hash()](https://php-legacy-docs.zend.com/manual/php5/en/function.spl-object-hash.html). Exceptions can not be thrown from [\_\_toString()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.magic.html#object.tostring) methods.

      <?php
      class foo {
          public function __toString() {
              throw new Exception;
          }
      }

      try {
          print new foo;
          /* Fatal error:  Method foo::__toString() must
             not throw an exception in filename on line n */
      } catch(Exception $e) {}
      ?>

- Dropped abstract static class functions. Due to an oversight, PHP 5.0.x and 5.1.x allowed abstract static functions in classes. As of PHP 5.2.x, only interfaces can have them.

      <?php
      abstract class foo {
          abstract static function bar();
          /* Strict Standards:  Static function foo::bar()
             should not be abstract in filename on line n */
      }
      ?>

- [Oracle extension](https://php-legacy-docs.zend.com/manual/php5/en/ref.oci8.html) requires at least Oracle 10 on Windows.

- Added RFC2397 (`data:` stream) support. The introduction of the 'data' URL scheme has the potential to lead to a change of behavior under Windows. If you are working with a NTFS file system and making use of meta streams in your application, and if you just happen to be using a file with the name 'data:' that is accessed without any path information - it won't work any more. The fix is to use the 'file:' protocol when accessing it. See also [» RFC 2397](http://www.faqs.org/rfcs/rfc2397)

      <?php
      /* when allow_url_include is OFF (default) */
      include "data:;base64,PD9waHAgcGhwaW5mbygpOz8+";
      /* Warning:  include(): URL file-access is disabled
         in the server configuration in filename on line n */
      ?>

- Regression in `glob()` patterns In version 5.2.4 a security fix caused a regression for patterns of the form "/foo/\*/bar/\*". Since version 5.2.5 instead of raising a warning the `glob()` function will return **`FALSE`** when `openbase_dir` restrictions are violated.

# [PHP 5.0](https://php-legacy-docs.zend.com/manual/php5/en/migration5.incompatible.php)

## Backward Incompatible Changes

Although most existing PHP 4 code should work without changes, you should pay attention to the following backward incompatible changes:

- There are some [new reserved keywords](https://php-legacy-docs.zend.com/manual/php5/en/reserved.keywords.html).
- [strrpos()](https://php-legacy-docs.zend.com/manual/php5/en/function.strrpos.html) and [strripos()](https://php-legacy-docs.zend.com/manual/php5/en/function.strripos.html) now use the entire string as a needle.
- Illegal use of string offsets causes **`E_ERROR`** instead of **`E_WARNING`**. An example illegal use is: `$str = 'abc'; unset($str[0]);`.
- [array_merge()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-merge.html) was changed to accept only arrays. If a non-array variable is passed, a **`E_WARNING`** will be thrown for every such parameter. Be careful because your code may start emitting **`E_WARNING`** out of the blue.
- **`PATH_TRANSLATED`** server variable is no longer set implicitly under Apache2 SAPI in contrast to the situation in PHP 4, where it is set to the same value as the **`SCRIPT_FILENAME`** server variable when it is not populated by Apache. This change was made to comply with the [» CGI/1.1 specification](http://www.faqs.org/rfcs/rfc3875). Please refer to [» bug \#23610](https://bugs.php.net/23610) for further information, and see also the [`$_SERVER['PATH_TRANSLATED']`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.server.html) description in the manual. This issue also affects PHP versions \>= 4.3.2.
- The **`T_ML_COMMENT`** constant is no longer defined by the [Tokenizer](https://php-legacy-docs.zend.com/manual/php5/en/ref.tokenizer.html) extension. If error_reporting is set to **`E_ALL`**, PHP will generate a notice. Although the **`T_ML_COMMENT`** was never used at all, it was defined in PHP 4. In both PHP 4 and PHP 5 // and /\* \*/ are resolved as the **`T_COMMENT`** constant. However the PHPDoc style comments `/** */`, which starting PHP 5 are parsed by PHP, are recognized as **`T_DOC_COMMENT`**.
- [`$_SERVER`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.server.html) should be populated with `argc` and `argv` if [variables_order](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.variables-order) includes "S". If you have specifically configured your system to not create [`$_SERVER`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.server.html), then of course it shouldn't be there. The change was to always make `argc` and `argv` available in the CLI version regardless of the [variables_order](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.variables-order) setting. As in, the CLI version will now always populate the global [`$argc`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.argc.html) and [`$argv`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.argv.html) variables.
- An object with no properties is no longer considered "empty".
- In some cases classes must be declared before use. It only happens if some of the new features of PHP 5 (such as [interfaces](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.interfaces.html)) are used. Otherwise the behaviour is the old.
- [get_class()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-class.html), [get_parent_class()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-parent-class.html) and [get_class_methods()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-class-methods.html) now return the name of the classes/methods as they were declared (case-sensitive) which may lead to problems in older scripts that rely on the previous behaviour (the class/method name was always returned lowercased). A possible solution is to search for those functions in all your scripts and use [strtolower()](https://php-legacy-docs.zend.com/manual/php5/en/function.strtolower.html). This case sensitivity change also applies to the [magical predefined constants](https://php-legacy-docs.zend.com/manual/php5/en/language.constants.predefined.html) **`__CLASS__`**, **`__METHOD__`**, and **`__FUNCTION__`**. The values are returned exactly as they're declared (case-sensitive).
- [ip2long()](https://php-legacy-docs.zend.com/manual/php5/en/function.ip2long.html) now returns **`FALSE`** when an invalid IP address is passed as argument to the function, and no longer `-1`.
- If there are functions defined in the included file, they can be used in the main file independent if they are before [return](https://php-legacy-docs.zend.com/manual/php5/en/function.return.html) or after. If the file is included twice, PHP 5 issues fatal error because functions were already declared, while PHP 4 doesn't complain about it. It is recommended to use [include_once](https://php-legacy-docs.zend.com/manual/php5/en/function.include-once.html) instead of checking if the file was already included and conditionally return inside the included file.
- [include_once](https://php-legacy-docs.zend.com/manual/php5/en/function.include-once.html) and [require_once](https://php-legacy-docs.zend.com/manual/php5/en/function.require-once.html) first normalize the path of included file on Windows so that including A.php and a.php include the file just once.
- Passing an array to a function by value no longer resets the array's internal pointer for array accesses made within the function. In other words, in PHP 4 when you passed an array to a function, its internal pointer inside the function would be reset, while in PHP 5, when you pass an array to a function, its array pointer within the function will be wherever it was when the array was passed to the function.

**Example \#1 [strrpos()](https://php-legacy-docs.zend.com/manual/php5/en/function.strrpos.html) and [strripos()](https://php-legacy-docs.zend.com/manual/php5/en/function.strripos.html) now use the entire string as a needle**

    <?php
    var_dump(strrpos('ABCDEF','DEF')); //int(3)

    var_dump(strrpos('ABCDEF','DAF')); //bool(false)
    ?>

**Example \#2 An object with no properties is no longer considered "empty"**

    <?php
    class test { }
    $t = new test();

    var_dump(empty($t)); // echo bool(false)

    if ($t) {
        // Will be executed
    }
    ?>

**Example \#3 In some cases classes must be declared before used**

    <?php

    //works with no errors:
    $a = new a();
    class a {
    }


    //throws an error:
    $a = new b();

    interface c{
    }
    class b implements c {
    } 

    ?>
