# [New Features in PHP 8.6, 8.5, 8.4, 8.3, 8.2, 8.1, 8.0, 7.4, 7.3, 7.2, 7.1, 7.0, 5.6, 5.5, 5.4, 5.3](index.md)

# [PHP 8.6](https://www.php.net/manual/en/migration86.new-features.php)

## New Features

### PHP Core

#### Default values for readonly properties

[Readonly properties](https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties), including those of [readonly classes](https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.class.readonly), may now declare default values. The default value counts as the initialization of the property, so the property cannot be assigned again, not even from the constructor.

```
<?php
class Config
{
    public readonly int $timeout = 30;
}

$config = new Config();
var_dump($config->timeout); // int(30)
```

#### Reference assignment on WeakMap

It is now possible to use reference assignment on a [WeakMap](https://www.php.net/manual/en/class.weakmap.php) without the key needing to be present beforehand.

```
<?php
$obj = new stdClass();
$map = new WeakMap();
$count = 0;

// Previously: Error: "Object stdClass#1 not contained in WeakMap"
$map[$obj] = &$count;
$count++;

var_dump($map[$obj]); // int(1)
```

#### **\_\_debugInfo()** on enums

It is now possible to define the [\_\_debugInfo()](https://www.php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo) magic method on [enums](https://www.php.net/manual/en/language.enumerations.php). Previously, this resulted in a fatal error.

```
<?php
enum Suit: string
{
    case Hearts = 'H';
    case Spades = 'S';

    public function __debugInfo(): array
    {
        return ['suit' => $this->name, 'symbol' => $this->value];
    }
}

var_dump(Suit::Hearts);
```

The above example will output:

    enum(Suit::Hearts) (2) {
      ["suit"]=>
      string(6) "Hearts"
      ["symbol"]=>
      string(1) "H"
    }

#### `#[\Override]` for class constants

The [Override](https://www.php.net/manual/en/class.override.php) attribute can now be applied to class constants, including enum cases. As with methods and properties, a compile-time error is raised if no matching constant exists in a parent class or implemented interface.

```
<?php
interface HasVersion
{
    const VERSION = '1.0';
}

class Package implements HasVersion
{
    #[\Override]
    const VERSION = '2.0';

    // Fatal error: Package::NAME has #[\Override] attribute,
    // but no matching parent constant exists
    // #[\Override]
    // const NAME = 'package';
}
```

#### Partial function application

Added support for [partial function application](https://www.php.net/manual/en/functions.partial-application.php). A call in which one or more arguments are replaced by the `?` placeholder, or the remaining arguments by the `...` placeholder, creates a [Closure](https://www.php.net/manual/en/class.closure.php) that accepts the missing arguments.

```
<?php
function add(int $a, int $b, int $c = 0): int
{
    return $a + $b + $c;
}

// "?" replaces exactly one argument
$addOne = add(1, ?);
var_dump($addOne(5)); // int(6)

// "..." replaces all remaining arguments
$addToOne = add(1, ...);
var_dump($addToOne(2, 3)); // int(6)

// Works with any callable, including internal functions
$stripSpaces = str_replace(' ', '', ?);
var_dump($stripSpaces('a b c')); // string(3) "abc"
```

#### Mutating objects stored in constants

Objects stored in constants or class constants can now be mutated directly via `OBJ->prop = $val`.

```
<?php
const CONFIG = new stdClass();

// Previously: "Fatal error: Cannot use temporary expression in write context"
CONFIG->debug = true;

var_dump(CONFIG->debug); // bool(true)
```

#### Endianness modifiers for pack() and unpack()

[pack()](https://www.php.net/manual/en/function.pack.php) and [unpack()](https://www.php.net/manual/en/function.unpack.php) now accept the `<` (little-endian) and `>` (big-endian) modifiers after the `s`, `S`, `l`, `L`, `q` and `Q` integer format codes, and after the `f` and `d` float and double format codes.

```
<?php
echo bin2hex(pack('l>', 1)), PHP_EOL;   // Prints "00000001"
echo bin2hex(pack('l<', 1)), PHP_EOL;   // Prints "01000000"
echo bin2hex(pack('f>', 1.5)), PHP_EOL; // Prints "3fc00000"

var_dump(unpack('s>value', "\xff\xfe")); // ["value" => int(-2)]
```

### cURL

The array returned by [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) now includes a new `"size_delivered"` key, which indicates the total number of bytes passed to the download write callback. This value can also be obtained by passing **`CURLINFO_SIZE_DELIVERED`** as the `option` parameter. Requires libcurl 8.20.0 or later.

Added **`CURLOPT_SEEKFUNCTION`** to register a callback that repositions a streamed request body, so libcurl can rewind and resend it on a redirect, multi-pass authentication, or a retried reused connection instead of failing with **`CURLE_SEND_FAIL_REWIND`**. The callback receives the [CurlHandle](https://www.php.net/manual/en/class.curlhandle.php), offset and origin, and must return one of **`CURL_SEEKFUNC_OK`**, **`CURL_SEEKFUNC_FAIL`** or **`CURL_SEEKFUNC_CANTSEEK`**.

### Date

Added the [Time\Duration](https://www.php.net/manual/en/class.time-duration.php) class to represent a fixed length of elapsed time, such as a timeout, with nanosecond precision. Unlike [DateInterval](https://www.php.net/manual/en/class.dateinterval.php), it has no calendar units such as days or months, so its length is unambiguous.

Durations are immutable and can be compared with the comparison operators. The class provides:

- Factory methods such as [Time\Duration::fromSeconds()](https://www.php.net/manual/en/time-duration.fromseconds.php), [Time\Duration::fromMilliseconds()](https://www.php.net/manual/en/time-duration.frommilliseconds.php) and [Time\Duration::fromIso8601DurationString()](https://www.php.net/manual/en/time-duration.fromiso8601durationstring.php)
- Arithmetic with [Time\Duration::add()](https://www.php.net/manual/en/time-duration.add.php), [Time\Duration::sub()](https://www.php.net/manual/en/time-duration.sub.php), [Time\Duration::multiplyBy()](https://www.php.net/manual/en/time-duration.multiplyby.php) and [Time\Duration::divideBy()](https://www.php.net/manual/en/time-duration.divideby.php)
- [Time\Duration::negate()](https://www.php.net/manual/en/time-duration.negate.php) and [Time\Duration::absolute()](https://www.php.net/manual/en/time-duration.absolute.php) to change the sign
- [Time\Duration::compare()](https://www.php.net/manual/en/time-duration.compare.php) for use as a sorting callback

A [Time\TimeException](https://www.php.net/manual/en/class.time-timeexception.php) is thrown when a duration exceeds the representable range of roughly 292 years, or when an ISO 8601 duration string is invalid.

```
<?php
$timeout = \Time\Duration::fromSeconds(2)->add(\Time\Duration::fromMilliseconds(500));

printf("%d.%09d seconds\n", $timeout->seconds, $timeout->nanoseconds);
var_dump($timeout > \Time\Duration::fromSeconds(2));
```

The above example will output:

    2.500000000 seconds
    bool(true)

### FileInfo

[finfo_file()](https://www.php.net/manual/en/function.finfo-file.php) now works with remote streams.

### GMP

Added **gmp_powm_sec()** for side-channel quiet modular exponentiation. Requires GNU MP 5.0.0 or later; it is not available on official Windows builds using MPIR.

Added **gmp_prevprime()** to get the largest prime smaller than the given number. The optional `definitely_prime` output parameter indicates whether the returned number is definitely prime, as opposed to probably prime. A [ValueError](https://www.php.net/manual/en/class.valueerror.php) is thrown if no such prime exists. This function is only available when PHP is built against GNU MP 6.3.0 or later; it is not available on official Windows builds using MPIR.

### Intl

Added the static methods **IntlDatePatternGenerator::getSkeleton()** and **IntlDatePatternGenerator::getBaseSkeleton()** to generate the unique skeleton and base skeleton for a date/time pattern.

Added **Locale::getDisplayKeyword()** and **Locale::getDisplayKeywordValue()**, with the aliases **locale_get_display_keyword()** and **locale_get_display_keyword_value()**, respectively.

Added the **IntlNumberRangeFormatter** class to format an interval of two numbers with a given skeleton and locale. It is supported as of ICU 63. The collapse behavior is one of:

- **`IntlNumberRangeFormatter::COLLAPSE_AUTO`**
- **`IntlNumberRangeFormatter::COLLAPSE_NONE`**
- **`IntlNumberRangeFormatter::COLLAPSE_UNIT`**
- **`IntlNumberRangeFormatter::COLLAPSE_ALL`**

The identity fallback is one of:

- **`IntlNumberRangeFormatter::IDENTITY_FALLBACK_SINGLE_VALUE`**
- **`IntlNumberRangeFormatter::IDENTITY_FALLBACK_APPROXIMATELY_OR_SINGLE_VALUE`**
- **`IntlNumberRangeFormatter::IDENTITY_FALLBACK_APPROXIMATELY`**
- **`IntlNumberRangeFormatter::IDENTITY_FALLBACK_RANGE`**

Added **SpoofChecker::areBidiConfusable()** to check whether two strings are confusable for a given text direction, along with the **`SpoofChecker::LTR`** and **`SpoofChecker::RTL`** direction constants. It is supported as of ICU 74.

Added **SpoofChecker::getBidiSkeleton()** to generate a confusable skeleton for a given text direction. It is supported as of ICU 74.

Added **SpoofChecker::getSkeleton()** to generate a confusable skeleton for a given string.

### IO

Added a new polling API, consisting of:

- The **Io\Poll\Context** and **Io\Poll\Watcher** classes
- The **Io\Poll\Backend** and **Io\Poll\Event** enums
- The **Io\Poll\Handle** interface
- The **StreamPollHandle** class to watch streams

### JSON

Added extra information about the error location to the error messages returned by [json_last_error_msg()](https://www.php.net/manual/en/function.json-last-error-msg.php) and to the message of [JsonException](https://www.php.net/manual/en/class.jsonexception.php).

### OpenSSL

Added TLS session resumption support for streams. This allows saving and restoring client sessions across requests, implementing custom server-side session storage, and controlling session cache behavior, using the following new [SSL context](https://www.php.net/manual/en/context.ssl.php) options:

- `session_data`
- `session_new_cb`
- `session_cache`
- `session_cache_size`
- `session_timeout`
- `session_id_context`
- `session_get_cb`
- `session_remove_cb`
- `num_tickets`

Added TLS external PSK support for streams with the new [SSL context](https://www.php.net/manual/en/context.ssl.php) options `psk_client_cb` and `psk_server_cb`. This allows setting and receiving pre-shared keys.

Added TLS 1.3 early data (0-RTT) support for streams. Clients send early data with the `early_data` [SSL context](https://www.php.net/manual/en/context.ssl.php) option; servers accept it with `max_early_data` and receive it through the `early_data_cb` callback. The outcome is reported as `"accepted"`, `"rejected"` or `"not_sent"` in the `"early_data"` key of the `"crypto"` entry of the [stream_get_meta_data()](https://www.php.net/manual/en/function.stream-get-meta-data.php) array.

### PDO_PGSQL

Added **[`Pdo\Pgsql::ATTR_CHUNK_SIZE`](https://www.php.net/manual/en/class.pdo-pgsql.php#pdo-pgsql.constants.attr-chunk-size)**, the number of rows a statement fetches per chunk. A value of 1 or more enters the lazy fetch mode of `PDO::ATTR_PREFETCH => 0`. Setting **[`PDO::ATTR_PREFETCH`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-prefetch)** replaces the chunk size. Statements that are prepared with neither it nor **[`PDO::ATTR_PREFETCH`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-prefetch)** fall back to the value set on the connection. Requires libpq 17 or later.

### Phar

Overriding the [SplFileInfo::getMTime()](https://www.php.net/manual/en/splfileinfo.getmtime.php) and [SplFileInfo::getPathname()](https://www.php.net/manual/en/splfileinfo.getpathname.php) methods now influences the result of the [Phar::buildFromDirectory()](https://www.php.net/manual/en/phar.buildfromdirectory.php) and [Phar::buildFromIterator()](https://www.php.net/manual/en/phar.buildfromiterator.php) family of methods. This makes it possible to override the timestamp and names of files.

### SNMP

It is now possible to use `AES192`, `AES192C`, `AES256`, and `AES256C` as SNMPv3 security protocols if the underlying library supports them.

It is now possible to reset the MIB tree using the new **snmp_init_mib()** function.

Additional MIB parsing and output control functionality has been exposed via:

- **snmp_set_mib_option()**
- **snmp_set_output_option()**
- **snmp_set_string_output_format()**
- SNMP::\$numeric_index
- SNMP::\$numeric_timeticks
- SNMP::\$extended_index
- SNMP::\$dont_print_units
- SNMP::\$escape_quotes
- SNMP::\$print_hex_text
- **SNMP::setOidOutputFormat()**
- **SNMP::setStringOutputFormat()**

### SOAP

Added the `"keep_headers"` option to [SoapClient::\_\_construct()](https://www.php.net/manual/en/soapclient.construct.php) to specify which HTTP headers a [SoapClient](https://www.php.net/manual/en/class.soapclient.php) should keep when importing a WSDL from a host different from the original one. By default, the `Authorization`, `Proxy-Authorization`, and `Cookie` headers are redacted on such requests. The option accepts an array of header names to keep, for example `['keep_headers' => ['authorization']]`.

### Streams

Added a new stream errors API, consisting of:

- The [StreamError](https://www.php.net/manual/en/class.streamerror.php) and [StreamException](https://www.php.net/manual/en/class.streamexception.php) classes
- The [StreamErrorStore](https://www.php.net/manual/en/enum.streamerrorstore.php), [StreamErrorMode](https://www.php.net/manual/en/enum.streamerrormode.php), and [StreamErrorCode](https://www.php.net/manual/en/enum.streamerrorcode.php) enums
- The [stream_last_errors()](https://www.php.net/manual/en/function.stream-last-errors.php) and [stream_clear_errors()](https://www.php.net/manual/en/function.stream-clear-errors.php) functions

It is controlled using the `error_mode`, `error_store` and `error_handler` [stream context options](https://www.php.net/manual/en/context.stream.php). See [Stream Errors](https://www.php.net/manual/en/stream.errors.php) for an overview.

Added the `filter.max_filter_count` stream context option for [php://filter](https://www.php.net/manual/en/wrappers.php.php) URLs. When set, opening the stream fails with a warning if the URL would add more filters than the configured value. Negative values disable the check.

Added the [socket context](https://www.php.net/manual/en/context.socket.php) option `so_reuseaddr` that allows disabling address reuse (`SO_REUSEADDR`) and explicitly uses `SO_EXCLUSIVEADDRUSE` on Windows.

Added the [socket context](https://www.php.net/manual/en/context.socket.php) options `so_keepalive`, `tcp_keepidle`, `tcp_keepintvl` and `tcp_keepcnt` that allow setting socket keepalive options.

Added the [socket context](https://www.php.net/manual/en/context.socket.php) option `so_linger` that sets `SO_LINGER` on TCP sockets. A positive value enables lingering for that many seconds, zero or a negative value disables it. Values above 65535 are clamped as the linger time is limited to an unsigned short on some platforms.

Added the [socket context](https://www.php.net/manual/en/context.socket.php) options `so_rcvbuf` and `so_sndbuf` that set the socket receive and send buffer sizes in bytes (`SO_RCVBUF` and `SO_SNDBUF`) on TCP and UDP sockets. The value must be an integer between 1 and 2147483647, any other value makes the stream creation fail. The operating system may round, cap or otherwise adjust the requested size, and may stop sizing that buffer automatically, so the size read back can differ from the one requested.

Filtered streams can now be cast to file descriptors for use with [stream_select()](https://www.php.net/manual/en/function.stream-select.php).

Added the `"write_seek_mode"` filter parameter for the bz2, iconv, zlib, and [convert](https://www.php.net/manual/en/filters.convert.php) stream filters. This parameter must be set via an associative array where the key is `"write_seek_mode"` and the value is one of the following strings:

- `"preserve"`
- `"reset"`
- `"strict"`

### URI

Added **Uri\Rfc3986\Uri::getUriType()** and **Uri\WhatWg\Url::isSpecialScheme()**.

Added **Uri\Rfc3986\Uri::getHostType()** and **Uri\WhatWg\Url::getHostType()**.

Added the **Uri\Rfc3986\UriBuilder** and **Uri\WhatWg\UrlBuilder** classes.

Added **Uri\WhatWg\url_percent_encode()**.

# [PHP 8.5](https://www.php.net/manual/en/migration85.new-features.php)

## New Features

### PHP Core

#### Pipe Operator

Added the [pipe (`|>`) operator](https://www.php.net/manual/en/language.operators.functional.php).

```
<?php
$result = "Hello World" |> strlen(...);
print $result . PHP_EOL;  // Prints "11"
```

#### Closure in constant expressions

Added support for [Closures](https://www.php.net/manual/en/class.closure.php) and [first class callables](https://www.php.net/manual/en/functions.first_class_callable_syntax.php) in constant expressions. This includes:

- Attribute parameters.
- Default values of properties and parameters.
- Constants and Class Constants.

#### \#\[\NoDiscard\] attribute

Added the [NoDiscard](https://www.php.net/manual/en/class.nodiscard.php) attribute to indicate that a function's return value is important and should be consumed.

Also, added the `(void)` cast to indicate that not using a value is intentional. The `(void)` cast has no effect on the program's execution by itself, but it can be used to suppress warnings emitted by `#[\NoDiscard]` and possibly also diagnostics emitted by external IDEs or static analysis tools.

```
<?php

#[\NoDiscard]
function concat(string $a, string $b): string {
     return $a . $b;
}

// Warning: The return value of function concat() should either be used or
// intentionally ignored by casting it as (void) in xxx.php
concat("a", "b");

// No warning, because the return value is consumed by the assignment.
$results = concat("a", "b");

// No warning, because the (void) cast is used.
(void)concat("a", "b");
```

#### Attributes on Constants

Added support for attributes on compile-time non-class constants (e.g. `const MY_CONST = 1;` rather than `define('MY_CONST', 1);`).

The [Deprecated](https://www.php.net/manual/en/class.deprecated.php) attribute can now be used on constants.

#### `#[\DelayedTargetValidation]` attribute

The new [DelayedTargetValidation](https://www.php.net/manual/en/class.delayedtargetvalidation.php) attribute can be used to suppress compile-time errors from core (or extension) attributes that are used on invalid targets. These errors are instead reported at runtime if and when [ReflectionAttribute::newInstance()](https://www.php.net/manual/en/reflectionattribute.newinstance.php) is called.

#### `#[\Override]` for properties

[Override](https://www.php.net/manual/en/class.override.php) attribute can now be applied to properties.

#### Static Asymmetric Visibility

Added [asymmetric visibility](https://www.php.net/manual/en/language.oop5.visibility.php#language.oop5.visibility-members-aviz) support for static properties.

#### Backtraces for Fatal Errors

Fatal Errors (such as an exceeded maximum execution time) now include a backtrace.

#### Constructor promotion for final property

[Constructor property promotion](https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor.promotion) can now be used for final properties.

#### Casts in constant expressions

Added support for casts in constant expressions.

```
<?php
const T1 = (int) 0.3; // Previously: "Fatal error: Constant expression contains invalid operations"
print T1 . PHP_EOL;   // Prints "0"
```

#### Clone function

The [clone language construct](https://www.php.net/manual/en/language.oop5.cloning.php) is now a function and supports reassigning (readonly) properties during cloning via the new \$withProperties parameter.

### cURL

Added support for [share handles](https://www.php.net/manual/en/class.curlsharepersistenthandle.php) that are persisted across multiple PHP requests, safely allowing for more effective connection reuse.

Added support for **[`CURLINFO_USED_PROXY`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-used-proxy)** (libcurl \>= 8.7.0), **[`CURLINFO_HTTPAUTH_USED`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-httpauth-used)**, and **[`CURLINFO_PROXYAUTH_USED`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-proxyauth-used)** (libcurl \>= 8.12.0) to the [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) function. When [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) returns an array, the same information is available as `"used_proxy"`, `"httpauth_used"`, and `"proxyauth_used"` keys. **[`CURLINFO_USED_PROXY`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-used-proxy)** gets zero set if no proxy was used in the previous transfer or a non-zero value if a proxy was used. **[`CURLINFO_HTTPAUTH_USED`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-httpauth-used)** and **[`CURLINFO_PROXYAUTH_USED`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-proxyauth-used)** get bitmasks indicating the HTTP and proxy authentication methods that were used in the previous request. See **[`CURLAUTH_*`](https://www.php.net/manual/en/curl.constants.php#constant.curlauth-any)** constants for possible values.

Added **[`CURLOPT_INFILESIZE_LARGE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-infilesize-large)** Curl option, which is a safe replacement for **[`CURLOPT_INFILESIZE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-infilesize)**. On certain systems, **[`CURLOPT_INFILESIZE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-infilesize)** only accepts a 32-bit signed integer as the file size (2.0 GiB) even on 64-bit systems. **[`CURLOPT_INFILESIZE_LARGE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-infilesize-large)** accepts the largest integer value the system can handle.

Added **[`CURLFOLLOW_OBEYCODE`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-obeycode)**, **[`CURLFOLLOW_FIRSTONLY`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-firstonly)** and **[`CURLFOLLOW_ALL`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-all)** values for **[`CURLOPT_FOLLOWLOCATION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-followlocation)** [curl_setopt()](https://www.php.net/manual/en/function.curl-setopt.php) option. **[`CURLFOLLOW_OBEYCODE`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-obeycode)** to follow more strictly in regard to redirect if they are allowed. **[`CURLFOLLOW_FIRSTONLY`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-firstonly)** to follow only the first redirect thus if there is any follow up redirect, it won't go any further. **[`CURLFOLLOW_ALL`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-all)** is equivalent to setting **[`CURLOPT_FOLLOWLOCATION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-followlocation)** to true.

Added support for **[`CURLINFO_CONN_ID`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-conn-id)** (libcurl \>= 8.2.0) to the [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) function. This constant allows retrieving the unique ID of the connection used by a cURL transfer. It is primarily useful when connection reuse or connection pooling logic is needed in PHP-level applications. When [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) returns an array, this value is available as the `"conn_id"` key.

Added support for **[`CURLINFO_QUEUE_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-queue-time-t)** (libcurl \>= 8.6.0) to the [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) function. This constant allows retrieving the time (in microseconds) that the request spent in libcurl’s connection queue before it was sent. This value can also be retrieved by passing **[`CURLINFO_QUEUE_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-queue-time-t)** to the [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) `option` parameter.

Added support for **[`CURLOPT_SSL_SIGNATURE_ALGORITHMS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-ssl-signature-algorithms)** to specify the signature algorithms to use for TLS.

### DOM

Added [Dom\Element::\$outerHTML](https://www.php.net/manual/en/class.dom-element.php#dom-element.props.outerhtml).

Added \$children property to [Dom\ParentNode](https://www.php.net/manual/en/class.dom-parentnode.php) implementations.

### EXIF

Added support for `OffsetTime*` Exif tags.

Added support for HEIF/HEIC.

### Filter

Added new **[`FILTER_THROW_ON_FAILURE`](https://www.php.net/manual/en/filter.constants.flags.generic.php#constant.filter-throw-on-failure)** flag which can be passed to the filter functions and will force an exception to be triggered when validation fails. The new flag cannot be combined with **[`FILTER_NULL_ON_FAILURE`](https://www.php.net/manual/en/filter.constants.flags.generic.php#constant.filter-null-on-failure)**; trying to do so will result in a [ValueError](https://www.php.net/manual/en/class.valueerror.php) being thrown.

### Intl

Added class constants **[`NumberFormatter::CURRENCY_ISO`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.currency-iso)**, **[`NumberFormatter::CURRENCY_PLURAL`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.currency-plural)**, **[`NumberFormatter::CASH_CURRENCY`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.cash-currency)**, and **[`NumberFormatter::CURRENCY_STANDARD`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.currency-standard)** for various currency-related number formats.

Added [Locale::addLikelySubtags()](https://www.php.net/manual/en/locale.addlikelysubtags.php) and [Locale::minimizeSubtags()](https://www.php.net/manual/en/locale.minimizesubtags.php) to handle likely tags on a given locale.

Added [IntlListFormatter](https://www.php.net/manual/en/class.intllistformatter.php) class to format, order, and punctuate a list of items with a given locale, **[`IntlListFormatter::TYPE_AND`](https://www.php.net/manual/en/class.intllistformatter.php#intllistformatter.constants.type-and)**, **[`IntlListFormatter::TYPE_OR`](https://www.php.net/manual/en/class.intllistformatter.php#intllistformatter.constants.type-or)**, **[`IntlListFormatter::TYPE_UNITS`](https://www.php.net/manual/en/class.intllistformatter.php#intllistformatter.constants.type-units)** operands and **[`IntlListFormatter::WIDTH_WIDE`](https://www.php.net/manual/en/class.intllistformatter.php#intllistformatter.constants.width-wide)**, **[`IntlListFormatter::WIDTH_SHORT`](https://www.php.net/manual/en/class.intllistformatter.php#intllistformatter.constants.width-short)** and **[`IntlListFormatter::WIDTH_NARROW`](https://www.php.net/manual/en/class.intllistformatter.php#intllistformatter.constants.width-narrow)** widths. It is supported from icu 67.

### PDO_Sqlite

Added class constant **[`Pdo\Sqlite::ATTR_BUSY_STATEMENT`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.attr-busy-statement)**.

Added class constants **[`Pdo\Sqlite::ATTR_EXPLAIN_STATEMENT`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.attr-explain-statement)**, **[`Pdo\Sqlite::EXPLAIN_MODE_PREPARED`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.explain-mode-prepared)**, **[`Pdo\Sqlite::EXPLAIN_MODE_EXPLAIN`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.explain-mode-explain)**, **[`Pdo\Sqlite::EXPLAIN_MODE_EXPLAIN_QUERY_PLAN`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.explain-mode-explain-query-plan)**.

Added **[`Pdo\Sqlite::ATTR_TRANSACTION_MODE`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.attr-transaction-mode)** connection attribute with possible values **[`Pdo\Sqlite::TRANSACTION_MODE_DEFERRED`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.transaction-mode-deferred)**, **[`Pdo\Sqlite::TRANSACTION_MODE_IMMEDIATE`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.transaction-mode-immediate)**, and **[`Pdo\Sqlite::TRANSACTION_MODE_EXCLUSIVE`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.transaction-mode-exclusive)**, allowing to configure the transaction mode to use when calling beginTransaction().

### Session

[session_set_cookie_params()](https://www.php.net/manual/en/function.session-set-cookie-params.php), [session_get_cookie_params()](https://www.php.net/manual/en/function.session-get-cookie-params.php), and [session_start()](https://www.php.net/manual/en/function.session-start.php) now support partitioned cookies via the `"partitioned"` key.

### SOAP

Enumeration cases are now dumped in [SoapClient::\_\_getTypes()](https://www.php.net/manual/en/soapclient.gettypes.php).

Added support for Soap 1.2 Reason Text xml:lang attribute.

The signature of [SoapFault::\_\_construct()](https://www.php.net/manual/en/soapfault.construct.php) and [SoapServer::fault()](https://www.php.net/manual/en/soapserver.fault.php) therefore now have an optional `lang` parameter. This support solves compatibility with .NET SOAP clients.

### Standard

[mail()](https://www.php.net/manual/en/function.mail.php) now returns the actual sendmail error and detects if the sendmail process was terminated unexpectedly. In such cases, a warning is emitted and the function returns false. Previously, these errors were silently ignored. This change affects only the sendmail transport.

[getimagesize()](https://www.php.net/manual/en/function.getimagesize.php) now supports HEIF/HEIC images.

[getimagesize()](https://www.php.net/manual/en/function.getimagesize.php) now supports SVG images when ext-libxml is also loaded. Similarly, [image_type_to_extension()](https://www.php.net/manual/en/function.image-type-to-extension.php) and [image_type_to_mime_type()](https://www.php.net/manual/en/function.image-type-to-mime-type.php) now also handle IMAGETYPE_SVG.

The array returned by [getimagesize()](https://www.php.net/manual/en/function.getimagesize.php) now has two additional entries: `"width_unit"` and `"height_unit"` to indicate in which units the dimensions are expressed. These units are px by default. They are not necessarily the same (just to give one example: one may be cm and the other may be px).

[setcookie()](https://www.php.net/manual/en/function.setcookie.php) and [setrawcookie()](https://www.php.net/manual/en/function.setrawcookie.php) now support the `"partitioned"` key.

### URI

An always enabled uri extension is added that can be used for handling URIs and URLs according to RFC 3986 and WHATWG URL.

### XSL

The `namespace` argument of [XSLTProcessor::getParameter()](https://www.php.net/manual/en/xsltprocessor.getparameter.php), [XSLTProcessor::setParameter()](https://www.php.net/manual/en/xsltprocessor.setparameter.php) and [XSLTProcessor::removeParameter()](https://www.php.net/manual/en/xsltprocessor.removeparameter.php) now actually works instead of being treated as empty. This only works if the `name` argument does not use Clark notation and is not a QName because in those cases the namespace is taken from the namespace href or prefix respectively.

### Zlib

[flock()](https://www.php.net/manual/en/function.flock.php) is now supported on zlib streams. Previously, this always failed to perform any locking action.

# [PHP 8.4](https://www.php.net/manual/en/migration84.new-features.php)

## New Features

### PHP Core

#### Property Hooks

Object properties may now have additional logic associated with their `get` and `set` operations. Depending on the usage, that may or may not make the property virtual, that is, it has no backing value at all.

```
<?php
class Person
{
    // A "virtual" property. It cannot be set explicitly.
    public string $fullName {
        get => $this->firstName . ' ' . $this->lastName;
    }

    // All write operations go through this hook, and the result is what is written.
    // Read access happens normally.
    public string $firstName {
        set => ucfirst(strtolower($value));
    }

    // All write operations go through this hook, which has to write to the backing value itself.
    // Read access happens normally.
    public string $lastName {
        set {
            if (strlen($value) < 2) {
                throw new \InvalidArgumentException('Too short');
            }
            $this->lastName = $value;
        }
    }
}

$p = new Person();

$p->firstName = 'peter';
print $p->firstName; // Prints "Peter"
$p->lastName = 'Peterson';
print $p->fullName; // Prints "Peter Peterson"

$p->fullName = "Peter 'Pete' Peterson"; // Throws Error: "Property Person::$fullName is read-only"
```

#### Asymmetric Property Visibility

Object properties may now have their `set` visibility controlled separately from the `get` visibility.

```
<?php
class Example
{
    // The first visibility modifier controls the get-visibility, and the second modifier
    // controls the set-visibility. The get-visibility must not be narrower than set-visibility.
    public protected(set) string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
```

#### Lazy Objects

It is now possible to create objects whose initialization is deferred until they are accessed. Libraries and frameworks can leverage these lazy objects to defer fetching data or dependencies required for initialization.

```
<?php
class Example
{
    public function __construct(private int $data)
    {
    }

    // ...
}

$initializer = static function (Example $ghost): void {
    // Fetch data or dependencies
    $data = getData();
    // Initialize
    $ghost->__construct($data);
};

$reflector = new ReflectionClass(Example::class);
$object = $reflector->newLazyGhost($initializer);
```

#### `#[\Deprecated]` attribute

The new [Deprecated](https://www.php.net/manual/en/class.deprecated.php) attribute can be used to mark functions, methods, and class constants as deprecated. The behavior of functionality deprecated with this attribute matches the behavior of the existing deprecation mechanism for functionality provided by PHP itself. The only exception is that the emitted error code is **[`E_USER_DEPRECATED`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-user-deprecated)** instead of **[`E_DEPRECATED`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-deprecated)**.

Existing deprecations in functionality provided by PHP itself have been updated to use the attribute, improving the emitted error messages by including a short explanation.

#### Parsing RFC1867 (multipart) requests in non-POST HTTP requests

Added [request_parse_body()](https://www.php.net/manual/en/function.request-parse-body.php) function that allows parsing RFC1867 (multipart) requests in non-POST HTTP requests.

#### Chaining [`new`](https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.new) expressions without parentheses

New expressions with constructor arguments are now dereferencable, meaning they allow chaining method calls, property accesses, etc. without enclosing the expression in parentheses.

#### Improved Debugging Info for [WeakReference](https://www.php.net/manual/en/class.weakreference.php)

Getting the debug info for [WeakReference](https://www.php.net/manual/en/class.weakreference.php) will now also output the object it references, or **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** if the reference is no longer valid.

#### Improved Debugging Info for [Closure](https://www.php.net/manual/en/class.closure.php)

The output of **Closure::\_\_debugInfo()** now includes the name, file, and line of the [Closure](https://www.php.net/manual/en/class.closure.php).

#### Defining Identical Symbols in Different Namespace Blocks

Exiting a namespace now clears seen symbols. This allows using a symbol in a namespace block, even if a previous namespace block declared a symbol with the same name.

### cURL

[curl_version()](https://www.php.net/manual/en/function.curl-version.php) returns an additional `feature_list` value, which is an associative array of all known cURL features, and whether they are supported (**[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)**) or not (**[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**).

Added **[`CURL_HTTP_VERSION_3`](https://www.php.net/manual/en/curl.constants.php#constant.curl-http-version-3)** and **[`CURL_HTTP_VERSION_3ONLY`](https://www.php.net/manual/en/curl.constants.php#constant.curl-http-version-3only)** constants (available since libcurl 7.66 and 7.88) as available options for **[`CURLOPT_HTTP_VERSION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-http-version)**.

Added **[`CURLOPT_PREREQFUNCTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-prereqfunction)** as a cURL option that accepts a [callable](https://www.php.net/manual/en/language.types.callable.php) to be called after the connection is made, but before the request is sent. This callable must return either **[`CURL_PREREQFUNC_OK`](https://www.php.net/manual/en/curl.constants.php#constant.curl-prereqfunc-ok)** or **[`CURL_PREREQFUNC_ABORT`](https://www.php.net/manual/en/curl.constants.php#constant.curl-prereqfunc-abort)** to allow or abort the request.

Added **[`CURLOPT_SERVER_RESPONSE_TIMEOUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-server-response-timeout)**, which was formerly known as **[`CURLOPT_FTP_RESPONSE_TIMEOUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-ftp-response-timeout)**. Both constants hold the same value.

Added **[`CURLOPT_DEBUGFUNCTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-debugfunction)** as a cURL option that accepts a [callable](https://www.php.net/manual/en/language.types.callable.php) that gets called during the request lifetime with the [CurlHandle](https://www.php.net/manual/en/class.curlhandle.php) object, an integer containing the debug message type, and a string containing the debug message. The debug message type is one of the following constants:

- **[`CURLINFO_TEXT`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-text)**
- **[`CURLINFO_HEADER_IN`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-header-in)**
- **[`CURLINFO_HEADER_OUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-header-out)**
- **[`CURLINFO_DATA_IN`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-data-in)**
- **[`CURLINFO_DATA_OUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-data-out)**
- **[`CURLINFO_SSL_DATA_IN`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-ssl-data-in)**
- **[`CURLINFO_SSL_DATA_OUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-ssl-data-out)**

Once this option is set, **[`CURLINFO_HEADER_OUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-header-out)** must not be set because it uses the same libcurl functionality.

The [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) now returns an additional `posttransfer_time_us` key, containing the number of microseconds from the start until the last byte is sent. When a redirect is followed, the time from each request is added together. This value can also be retrieved by passing **[`CURLINFO_POSTTRANSFER_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-posttransfer-time-t)** to the [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php) `option` parameter. This requires libcurl 8.10.0 or later.

### DOM

Added the Dom namespace with new classes as counterparts to the existing DOM classes (e.g. [Dom\Node](https://www.php.net/manual/en/class.dom-node.php) is the new [DOMNode](https://www.php.net/manual/en/class.domnode.php)). These classes are compatible with HTML 5 and are WHATWG spec-compliant; solving long-standing bugs in the DOM extension. The old DOM classes remain available for backwards compatibility.

Added the [DOMNode::compareDocumentPosition()](https://www.php.net/manual/en/domnode.comparedocumentposition.php) with its associated constants:

- **[`DOMNode::DOCUMENT_POSITION_DISCONNECTED`](https://www.php.net/manual/en/class.domnode.php#domnode.constants.document-position-disconnected)**
- **[`DOMNode::DOCUMENT_POSITION_PRECEDING`](https://www.php.net/manual/en/class.domnode.php#domnode.constants.document-position-preceding)**
- **[`DOMNode::DOCUMENT_POSITION_FOLLOWING`](https://www.php.net/manual/en/class.domnode.php#domnode.constants.document-position-following)**
- **[`DOMNode::DOCUMENT_POSITION_CONTAINS`](https://www.php.net/manual/en/class.domnode.php#domnode.constants.document-position-contains)**
- **[`DOMNode::DOCUMENT_POSITION_CONTAINED_BY`](https://www.php.net/manual/en/class.domnode.php#domnode.constants.document-position-contained-by)**
- **[`DOMNode::DOCUMENT_POSITION_IMPLEMENTATION_SPECIFIC`](https://www.php.net/manual/en/class.domnode.php#domnode.constants.document-position-implementation-specific)**

It is now possible to pass any callable to [DOMXPath::registerPhpFunctions()](https://www.php.net/manual/en/domxpath.registerphpfunctions.php). Furthermore, with [DOMXPath::registerPhpFunctionNs()](https://www.php.net/manual/en/domxpath.registerphpfunctionns.php), callbacks can now be registered that will use native function call syntax rather than using `php:function('name')`.

### Intl

Added the **[`NumberFormatter::ROUND_HALFODD`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.round-halfodd)** to complement the existing **[`NumberFormatter::ROUND_HALFEVEN`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.round-halfeven)** functionality.

### OpenSSL

Added support for Curve25519 + Curve448 based keys. Specifically x25519, ed25519, x448 and ed448 fields are supported in [openssl_pkey_new()](https://www.php.net/manual/en/function.openssl-pkey-new.php), [openssl_pkey_get_details()](https://www.php.net/manual/en/function.openssl-pkey-get-details.php), [openssl_sign()](https://www.php.net/manual/en/function.openssl-sign.php), and [openssl_verify()](https://www.php.net/manual/en/function.openssl-verify.php) were extended to support those keys.

Implement PASSWORD_ARGON2 password hashing. Requires OpenSSL 3.2 and NTS build.

### PCRE

The bundled pcre2lib has been updated to version 10.44. As a consequence, LoongArch JIT support has been added, spaces are now allowed between braces in Perl-compatible items, and variable-length lookbehind assertions are now supported.

With pcre2lib version 10.44, the maximum length of named capture groups has changed from `32` to `128`.

Added support for the `r` (PCRE2_EXTRA_CASELESS_RESTRICT) modifier, as well as the `(?r)` mode modifier. When enabled along with the case-insensitive modifier (`i`), the expression locks out mixing of ASCII and non-ASCII characters.

### PDO

Added support for driver-specific subclasses in order to better support database-specific functionalities. The new classes are instantiatable either via calling the [PDO::connect()](https://www.php.net/manual/en/pdo.connect.php) method or by instantiating one of the driver-specific subclasses directly.

Added support for driver specific SQL parsers. When a driver-specific parser is not available, the default parser is used. The default parser supports:

- single and double-quoted literals, with doubling as escaping mechanism
- two-dashes and non-nested C-style comments

### PDO_MYSQL

Added a custom parser supporting:

- single and double-quoted literals, with doubling and backslash as escaping mechanism
- backtick literal identifiers and with doubling as escaping mechanism
- two dashes followed by at least 1 whitespace, non-nested C-style comments, and hash-comments

### PDO_PGSQL

Added a custom parser supporting:

- single and double-quoted literals, with doubling as escaping mechanism
- C-style "escape" string literals (`E'string'`)
- dollar-quoted string literals
- two-dashes and C-style comments (non-nested)
- support for `??` as escape sequence for the `?` operator

### PDO_SQLITE

Added a custom parser supporting:

- single, double-quoted, and backtick literals, with doubling as escaping mechanism
- square brackets quoting for identifiers
- two-dashes and C-style comments (non-nested)

### Phar

Added support for the Unix timestamp extension for Zip archives.

### Readline

Added ability to change the `.php_history` path through the `PHP_HISTFILE` environment variable.

### Reflection

[ReflectionAttribute](https://www.php.net/manual/en/class.reflectionattribute.php) now contains a name property to improve the debugging experience.

[ReflectionClassConstant::\_\_toString()](https://www.php.net/manual/en/reflectionclassconstant.tostring.php) and [ReflectionProperty::\_\_toString()](https://www.php.net/manual/en/reflectionproperty.tostring.php) now returns the attached doc comments.

Multiple new methods and constants which are related to the lazy objects feature have been added:

- [ReflectionClass::newLazyGhost()](https://www.php.net/manual/en/reflectionclass.newlazyghost.php)
- [ReflectionClass::newLazyProxy()](https://www.php.net/manual/en/reflectionclass.newlazyproxy.php)
- [ReflectionClass::resetAsLazyGhost()](https://www.php.net/manual/en/reflectionclass.resetaslazyghost.php)
- [ReflectionClass::resetAsLazyProxy()](https://www.php.net/manual/en/reflectionclass.resetaslazyproxy.php)
- [ReflectionClass::isUninitializedLazyObject()](https://www.php.net/manual/en/reflectionclass.isuninitializedlazyobject.php)
- [ReflectionClass::initializeLazyObject()](https://www.php.net/manual/en/reflectionclass.initializelazyobject.php)
- [ReflectionClass::markLazyObjectAsInitialized()](https://www.php.net/manual/en/reflectionclass.marklazyobjectasinitialized.php)
- [ReflectionClass::getLazyInitializer()](https://www.php.net/manual/en/reflectionclass.getlazyinitializer.php)
- [ReflectionProperty::skipLazyInitialization()](https://www.php.net/manual/en/reflectionproperty.skiplazyinitialization.php)
- [ReflectionProperty::setRawValueWithoutLazyInitialization()](https://www.php.net/manual/en/reflectionproperty.setrawvaluewithoutlazyinitialization.php)
- **[`ReflectionClass::SKIP_INITIALIZATION_ON_SERIALIZE`](https://www.php.net/manual/en/class.reflectionclass.php#reflectionclass.constants.skip-initialization-on-serialize)**
- **[`ReflectionClass::SKIP_DESTRUCTOR`](https://www.php.net/manual/en/class.reflectionclass.php#reflectionclass.constants.skip-destructor)**

### SOAP

Added support for clark notation for namespaces in class map. It is now possible to specify entries in a class map with clark notation to resolve a type with a specific namespace to a specific class. For example: `'{http://example.com}foo' => 'FooClass'`.

Instances of [DateTimeInterface](https://www.php.net/manual/en/class.datetimeinterface.php) that are passed to `xsd:datetime` or similar elements are now serialized as such instead of being serialized as an empty string.

Session persistence now works with a shared session module.

### Standard

Added a new [RoundingMode](https://www.php.net/manual/en/enum.roundingmode.php) enum with clearer naming and improved discoverability compared to the **[`PHP_ROUND_*`](https://www.php.net/manual/en/math.constants.php#constant.php-round-half-up)** constants. Moreover, four new rounding modes were added which are only available via the new [RoundingMode](https://www.php.net/manual/en/enum.roundingmode.php) enum.

### XSL

It is now possible to use parameters that contain both single and double quotes.

It is now possible to pass any callable to [XSLTProcessor::registerPhpFunctions()](https://www.php.net/manual/en/xsltprocessor.registerphpfunctions.php).

Added [XSLTProcessor::\$maxTemplateDepth](https://www.php.net/manual/en/class.xsltprocessor.php#xsltprocessor.props.maxtemplatedepth) and [XSLTProcessor::\$maxTemplateVars](https://www.php.net/manual/en/class.xsltprocessor.php#xsltprocessor.props.maxtemplatevars) to control the recursion depth of XSL template evaluation.

### Zip

Added the **[`ZipArchive::ER_TRUNCATED_ZIP`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.er-truncated-zip)** constant, which was added in libzip 1.11.

# [PHP 8.3](https://www.php.net/manual/en/migration83.new-features.php)

## New Features

### PHP Core

#### Readonly Amendments

Anonymous classes may now be marked as readonly.

Readonly properties can now be reinitialized during cloning.

#### Typed Class Constants

Class, interface, trait, and enum constants now support type declarations.

#### Closures created from magic methods

Closures created from magic methods can now accept named arguments.

#### The final modifier with a method from a trait

The final modifier may now be used when using a method from a trait.

#### Override Attribute

Added the \#\[\Override\] attribute to check that a method exists in a parent class or implemented interface.

#### Fetch class constant dynamically syntax

Class constants can now be accessed dynamically using the `C::{$name}` syntax.

#### Static variable Initializers

Static variable initializers can now contain arbitrary expressions.

#### Fallback value syntax for ini variables

php.ini now supports fallback/default value syntax.

```
<?php
/*
/path/to/user.ini contains the following settings:

listen = localhost:${DRUPAL_FPM_PORT:-9000}
*/

$user_ini = parse_ini_file('/path/to/user.ini');
echo $user_ini['listen']; // localhost:9000
```

### CLI

It is now possible to lint multiple files.

### DOM

Added properties [DOMElement::\$className](https://www.php.net/manual/en/class.domelement.php#domelement.props.classname) and [DOMElement::\$id](https://www.php.net/manual/en/class.domelement.php#domelement.props.id). These are not binary-safe at the moment because of underlying limitations of libxml2. This means that the property values will be cut off at a NUL byte.

Added properties [DOMNode::\$isConnected](https://www.php.net/manual/en/class.domnode.php#domnode.props.isconnected) and [DOMNameSpaceNode::\$isConnected](https://www.php.net/manual/en/class.domnamespacenode.php#domnamespacenode.props.isconnected).

Added properties [DOMNode::\$parentElement](https://www.php.net/manual/en/class.domnode.php#domnode.props.parentelement) and [DOMNameSpaceNode::\$parentElement](https://www.php.net/manual/en/class.domnamespacenode.php#domnamespacenode.props.parentelement).

### FFI

It is now possible to assign [FFI\CData](https://www.php.net/manual/en/class.ffi-cdata.php) to other FFI\CData. Meaning CData can now be assigned to structs and fields.

### Opcache

`opcache_get_status()['scripts'][n]['revalidate']` now contains a Unix timestamp of when the next revalidation of the scripts timestamp is due, dictated by the [opcache.revalidate_freq](https://www.php.net/manual/en/opcache.configuration.php#ini.opcache.revalidate-freq) INI directive.

### POSIX

[posix_getrlimit()](https://www.php.net/manual/en/function.posix-getrlimit.php) now takes an optional `resource` parameter to allow fetching a single resource limit.

[posix_isatty()](https://www.php.net/manual/en/function.posix-isatty.php) now raises type warnings for integers following the usual ZPP semantics.

[posix_ttyname()](https://www.php.net/manual/en/function.posix-ttyname.php) now raises type warnings for integers following the usual ZPP semantics and value warnings for invalid file descriptor integers.

### Streams

Streams can now emit the **[`STREAM_NOTIFY_COMPLETED`](https://www.php.net/manual/en/stream.constants.php#constant.stream-notify-completed)** notification. This was previously not implemented.

# [PHP 8.2](https://www.php.net/manual/en/migration82.new-features.php)

## New Features

### PHP Core

#### SensitiveParameter Attribute

Added the `#[\SensitiveParameter]` attribute to redact sensitive data in backtraces.

#### error_log_mode INI directive

The [error_log_mode](https://www.php.net/manual/en/errorfunc.configuration.php#ini.error-log-mode) INI directive has been added which allows setting the permissions for the error log file.

#### Enumerations properties in constant expressions

It is now possible to fetch properties of [Enumerations](https://www.php.net/manual/en/language.enumerations.php) in constant expressions.

#### Type System Improvements

It is now possible to use [null](https://www.php.net/manual/en/language.types.null.php) and [false](https://www.php.net/manual/en/language.types.singleton.php) as stand-alone types.

The [true](https://www.php.net/manual/en/language.types.singleton.php) type has been added.

It is now possible to combine intersection and union types. The type needs to be written in DNF.

#### Constants in Traits

It is now possible to define constants in traits.

#### Readonly Classes

Support for [readonly on classes](https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.class.readonly) has been added.

### cURL

Added the **[`CURLINFO_EFFECTIVE_METHOD`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-effective-method)** option, which returns the effective HTTP method in the return value of [curl_getinfo()](https://www.php.net/manual/en/function.curl-getinfo.php).

Exposed [multiple new constants](https://www.php.net/manual/en/migration82.constants.php#migration82.constants.curl) from libcurl 7.62 to 7.80.

Added the [curl_upkeep()](https://www.php.net/manual/en/function.curl_upkeep.php) function to perform any connection upkeep checks.

### DBA

The LMDB Driver now accepts the **[`DBA_LMDB_USE_SUB_DIR`](https://www.php.net/manual/en/dba.constants.php#constant.dba-lmdb-use-sub-dir)** or **[`DBA_LMDB_NO_SUB_DIR`](https://www.php.net/manual/en/dba.constants.php#constant.dba-lmdb-no-sub-dir)** flags to determine if it should create a subdirectory or not when creating a database file.

### OCI8

Added the [oci8.prefetch_lob_size](https://www.php.net/manual/en/oci8.configuration.php#ini.oci8.prefetch-lob-size) INI directive and [oci_set_prefetch_lob()](https://www.php.net/manual/en/function.oci-set-prefetch-lob.php) function to tune LOB query performance by reducing the number of round-trips between PHP and Oracle Databases when fetching LOBS. This is usable with Oracle Database 12.2 or later.

### OpenSSL

Added AEAD support for the chacha20-poly1305 algorithm.

### ODBC

Added the [odbc_connection_string_is_quoted()](https://www.php.net/manual/en/function.odbc-connection-string-is-quoted.php), [odbc_connection_string_should_quote()](https://www.php.net/manual/en/function.odbc-connection-string-should-quote.php), and [odbc_connection_string_quote()](https://www.php.net/manual/en/function.odbc-connection-string-quote.php) functions. These are primarily used behind the scenes in the ODBC and PDO_ODBC extensions, but are exposed to userland for easier unit testing, and for user applications and libraries to perform quoting themselves.

### PCRE

Added support for the `n` (NO_AUTO_CAPTURE) modifier, which makes simple `(xyz)` groups non-capturing. Only named groups like `(?<name>xyz)` are capturing. This only affects which groups are capturing, it is still possible to use numbered subpattern references, and the matches array will still contain numbered results.

### Random

This is a new extension which organises and consolidates existing implementations related to random number generators. New and better RNGs are available with scope issues eliminated.

# [PHP 8.1](https://www.php.net/manual/en/migration81.new-features.php)

## New Features

### PHP Core

#### Integer Octal Literal Prefix

Octal integers can now use an explicit `0o`/`0O` prefix in integer literals, similarly to binary and hexadecimal integer literals.

```
<?php
014;  // Non-prefix octal literal
0o14; // Prefixed octal literal
?>
```

#### Array Unpacking with String Keys

Added support for [array unpacking with strings keys](https://www.php.net/manual/en/language.types.array.php#language.types.array.unpacking).

```
<?php
$arr1 = [1, 'a' => 'b'];
$arr2 = [...$arr1, 'c' => 'd']; //[1, 'a' => 'b', 'c' => 'd']
?>
```

#### Named Argument After Argument Unpacking

It is now possible to specify named arguments after an argument unpack. e.g. foo(...\$args, named: \$arg).

#### full-path Key for File Uploads

File uploads now provide an additional `full_path` key, which contains the full path (rather than just the basename) of the uploaded file. This is intended for use in conjunction with "upload webkitdirectory".

#### Enumerations

Support for [Enumerations](https://www.php.net/manual/en/language.enumerations.php) has been added.

#### Fibers

Support for [Fibers](https://www.php.net/manual/en/language.fibers.php) has been added.

#### First Class Callable Syntax

Closures for callables can now be created using [the syntax `myFunc(...)`](https://www.php.net/manual/en/functions.first_class_callable_syntax.php), which is identical to `Closure::fromCallable('myFunc')`.

> **Note**:
>
> The `...` is part of the syntax, and not an omission.

#### Intersection Types

Support for [intersection types](https://www.php.net/manual/en/language.types.type-system.php#language.types.type-system.composite.intersection) has been added.

**Caution**

[Intersection types](https://www.php.net/manual/en/language.types.type-system.php#language.types.type-system.composite.intersection) cannot be used together with [union types](https://www.php.net/manual/en/language.types.declarations.php#language.types.declarations.composite.union)

#### Never type

A new return only type [never](https://www.php.net/manual/en/language.types.never.php) has been added. This indicates that a function either [exit()](https://www.php.net/manual/en/function.exit.php), throws an exception, or doesn't terminate.

#### [`new`](https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.new) in Initializers

It is now possible to use `new ClassName()` expressions as the default value of a parameter, static variable, global constant initializers, and as attribute arguments. Objects can also be passed to [define()](https://www.php.net/manual/en/function.define.php) now.

#### Readonly properties

Support for [readonly](https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties) has been added.

#### Final class constants

Added support for [the final modifier for class constants](https://www.php.net/manual/en/language.oop5.final.php#language.oop5.final.example.php81). Also, interface constants become overridable by default.

### CURL

Added the **[`CURLOPT_DOH_URL`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-doh-url)** option.

Added options for blob certificate when libcurl \>= 7.71.0:

- **[`CURLOPT_ISSUERCERT_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-issuercert-blob)**

- **[`CURLOPT_PROXY_ISSUERCERT`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-issuercert)**

- **[`CURLOPT_PROXY_ISSUERCERT_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-issuercert-blob)**

- **[`CURLOPT_PROXY_SSLCERT_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-sslcert-blob)**

- **[`CURLOPT_PROXY_SSLKEY_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-sslkey-blob)**

- **[`CURLOPT_SSLCERT_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-sslcert-blob)**

- **[`CURLOPT_SSLKEY_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-sslkey-blob)**

Added [CURLStringFile](https://www.php.net/manual/en/class.curlstringfile.php), which can be used to post a file from a [string](https://www.php.net/manual/en/language.types.string.php) rather than a file:

```
<?php
$file = new CURLStringFile($data, 'filename.txt', 'text/plain');
curl_setopt($curl, CURLOPT_POSTFIELDS, ['file' => $file]);
?>
```

### FPM

Added openmetrics status format. It can be used by Prometheus to fetch FPM metrics.

Added new pool option for the dynamic process manager called `pm.max_spawn_rate`. It allows to start a number of children at a faster rate when dynamic pm is selected. The default value is `32` which was the previous hard coded value.

### GD

Avif support is now available through [imagecreatefromavif()](https://www.php.net/manual/en/function.imagecreatefromavif.php) and [imageavif()](https://www.php.net/manual/en/function.imageavif.php), if libgd has been built with Avif support.

### Hash

The following functions [hash()](https://www.php.net/manual/en/function.hash.php), [hash_file()](https://www.php.net/manual/en/function.hash-file.php), and [hash_init()](https://www.php.net/manual/en/function.hash-init.php) now support an additional optional `options` argument, which can be used to pass algorithm specific data.

#### MurmurHash3

Added support for `MurmurHash3` with streaming support. The following variants are implemented:

- murmur3a, 32-bit hash

- murmur3c, 128-bit hash for x86

- murmur3f, 128-bit hash for x64

The initial hash state can be passed through the `seed` key in the `options` array, for example:

```
<?php
$h = hash("murmur3f", $data, options: ["seed" => 42]);
echo $h, "\n";
?>
```

A valid seed value is within the range from `0` to the platform defined **`UINT_MAX`**, usually `4294967295`.

#### xxHash

Added support for `xxHash`. The following variants are implemented:

- xxh32, 32-bit hash

- xxh64, 64-bit hash

- xxh3, 64-bit hash

- xxh128, 128-bit hash

The initial hash state can be passed through the `seed` key in the `options` array, for example:

```
<?php
$h = hash("xxh3", $data, options: ["seed" => 42]);
echo $h, "\n";
?>
```

Secret usage is supported through passing the `secret` key in the `options` array, too:

```
<?php
$h = hash("xxh3", $data, options: ["secret" => "at least 136 bytes long secret here"]);
echo $h, "\n";
?>
```

The quality of the custom secret is crucial for the quality of the resulting hash. It is highly recommended for the secret to use the best possible entropy.

### MySQLi

#### New INI directive `mysqli.local_infile_directory`

The [mysqli.local_infile_directory](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.local-infile-directory) INI directive has been added, which can be used to specify a directory from which files are allowed to be loaded. It is only meaningful if [mysqli.allow_local_infile](https://www.php.net/manual/en/mysqli.configuration.php#ini.mysqli.allow-local-infile) is not enabled, as all directories are allowed in that case.

#### Binding parameters in execute

It is now possible to bind parameters by passing them as an array to [mysqli_stmt::execute()](https://www.php.net/manual/en/mysqli-stmt.execute.php). All values will be bound as strings. Only list arrays are allowed. This new feature is not available when MySQLi is compiled with libmysqlclient.

```
<?php
$stmt = $mysqli->prepare('INSERT INTO users(id, name) VALUES(?,?)');
$stmt->execute([1, $username]);
?>
```

#### New method [mysqli_result::fetch_column()](https://www.php.net/manual/en/mysqli-result.fetch-column.php)

[mysqli_result::fetch_column()](https://www.php.net/manual/en/mysqli-result.fetch-column.php) has been added to allow fetching a single scalar value from the result set. The new method accepts an optional 0-based `column` parameter of type [int](https://www.php.net/manual/en/language.types.integer.php) specifying which column to fetch from.

```
<?php
$result = $mysqli->query('SELECT username FROM users WHERE id = 123');
echo $result->fetch_column();
?>
```

### PDO

The **[`PDO::MYSQL_ATTR_LOCAL_INFILE_DIRECTORY`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-local-infile-directory)** attribute has been added, which can be used to specify a directory from which files are allowed to be loaded. It is only meaningful if **[`PDO::MYSQL_ATTR_LOCAL_INFILE`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-local-infile)** is not enabled, as all directories are allowed in that case.

### PDO_SQLite

SQLite's `"file:"` DSN syntax is now supported, which allows specifying additional flags. This feature is not available if open_basedir is set.

```
<?php
new PDO('sqlite:file:path/to/sqlite.db?mode=ro')
?>
```

### POSIX

Added **[`POSIX_RLIMIT_KQUEUES`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-kqueues)** and **[`POSIX_RLIMIT_NPTS`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-npts)**. These rlimits are only available on FreeBSD.

### Standard

[fputcsv()](https://www.php.net/manual/en/function.fputcsv.php) now accepts a new `eol` argument which allows to define a custom End of Line sequence, the default remains the same and is `"\n"`.

### SPL

[SplFileObject::fputcsv()](https://www.php.net/manual/en/splfileobject.fputcsv.php) now accepts a new `eol` argument which allows to define a custom End of Line sequence, the default remains the same and is `"\n"`.

# [PHP 8.0](https://www.php.net/manual/en/migration80.new-features.php)

## New Features

### PHP Core

#### Named Arguments

Support for [Named Arguments](https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments) has been added.

#### Attributes

Support for [Attributes](https://www.php.net/manual/en/language.attributes.php) has been added.

#### Constructor Property Promotion

Support for [constructor property promotion](https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor.promotion) (declaring properties in the constructor signature) has been added.

#### Union Types

Support for [union types](https://www.php.net/manual/en/language.types.declarations.php#language.types.declarations.composite.union) has been added.

#### Match Expression

Support for [`match` expressions](https://www.php.net/manual/en/control-structures.match.php) has been added.

#### Nullsafe Operator

Support for the [nullsafe operator](https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.nullsafe) (`?->`) has been added.

#### Other new Features

- The [WeakMap](https://www.php.net/manual/en/class.weakmap.php) class has been added.

- The [ValueError](https://www.php.net/manual/en/class.valueerror.php) class has been added.

- Any number of function parameters may now be replaced by a variadic argument, as long as the types are compatible. For example, the following code is now allowed:

  ```
  <?php
  class A {
       public function method(int $many, string $parameters, $here) {}
  }
  class B extends A {
       public function method(...$everything) {}
  }
  ?>
  ```

- static (as in "late static binding") can now be used as a return type:

  ```
  <?php
  class Test {
       public function create(): static {
            return new static();
       }
  }
  ?>
  ```

- It is now possible to fetch the class name of an object using `$object::class`. The result is the same as `get_class($object)`.

- [`new`](https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.new) and [`instanceof`](https://www.php.net/manual/en/language.operators.type.php) can now be used with arbitrary expressions, using `new (expression)(...$args)` and `$obj instanceof (expression)`.

- Some consistency fixes to variable syntax have been applied, for example writing `Foo::BAR::$baz` is now allowed.

- Added [Stringable](https://www.php.net/manual/en/class.stringable.php) interface, which is automatically implemented if a class defines a [\_\_toString()](https://www.php.net/manual/en/language.oop5.magic.php#object.tostring) method.

- Traits can now define abstract private methods. Such methods must be implemented by the class using the trait.

- `throw` can now be used as an expression. That allows usages like:

  ```
  <?php
  $fn = fn() => throw new Exception('Exception in arrow function');
  $user = $session->user ?? throw new Exception('Must have user');
  ```

- An optional trailing comma is now allowed in parameter lists.

  ```
  <?php
  function functionWithLongSignature(
      Type1 $parameter1,
      Type2 $parameter2, // <-- This comma is now allowed.
  ) {
  }
  ```

- It is now possible to write `catch (Exception)` to catch an exception without storing it in a variable.

- Support for [mixed](https://www.php.net/manual/en/language.types.mixed.php) type has been added.

- Private methods declared on a parent class no longer enforce any inheritance rules on the methods of a child class (with the exception of final private constructors). The following example illustrates which restrictions have been removed:

  ```
  <?php
  class ParentClass {
      private function method1() {}
      private function method2() {}
      private static function method3() {}
      // Throws a warning, as "final" no longer has an effect:
      private final function method4() {}
  }
  class ChildClass extends ParentClass {
      // All of the following are now allowed, even though the modifiers aren't
      // the same as for the private methods in the parent class.
      public abstract function method1() {}
      public static function method2() {}
      public function method3() {}
      public function method4() {}
  }
  ?>
  ```

- [get_resource_id()](https://www.php.net/manual/en/function.get-resource-id.php) has been added, which returns the same value as `(int) $resource`. It provides the same functionality under a clearer API.

- The [InternalIterator](https://www.php.net/manual/en/class.internaliterator.php) has been added.

### Date and Time

- [DateTime::createFromInterface()](https://www.php.net/manual/en/datetime.createfrominterface.php) and [DateTimeImmutable::createFromInterface()](https://www.php.net/manual/en/datetimeimmutable.createfrominterface.php) have been added.

- The DateTime format specifier `p` has been added, which is the same as `P` but returns `Z` rather than `+00:00` for UTC.

### DOM

[DOMParentNode](https://www.php.net/manual/en/class.domparentnode.php) and [DOMChildNode](https://www.php.net/manual/en/class.domchildnode.php) with new traversal and manipulation APIs have been added.

### Filter

**[`FILTER_VALIDATE_BOOL`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-validate-bool)** has been added as an alias for **[`FILTER_VALIDATE_BOOLEAN`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-validate-boolean)**. The new name is preferred, as it uses the canonical type name.

### Enchant

[enchant_dict_add()](https://www.php.net/manual/en/function.enchant-dict-add.php), [enchant_dict_is_added()](https://www.php.net/manual/en/function.enchant-dict-is-added.php), and **[`LIBENCHANT_VERSION`](https://www.php.net/manual/en/enchant.constants.php#constant.libenchant-version)** have been added.

### FPM

Added a new option `pm.status_listen` that allows getting the status from different endpoint (e.g. port or UDS file) which is useful for getting the status when all children are busy with serving long running requests.

### Hash

[HashContext](https://www.php.net/manual/en/class.hashcontext.php) objects can now be serialized.

### Internationalization Functions

The **[`IntlDateFormatter::RELATIVE_FULL`](https://www.php.net/manual/en/class.intldateformatter.php#intldateformatter.constants.relative-full)**, **[`IntlDateFormatter::RELATIVE_LONG`](https://www.php.net/manual/en/class.intldateformatter.php#intldateformatter.constants.relative-long)**, **[`IntlDateFormatter::RELATIVE_MEDIUM`](https://www.php.net/manual/en/class.intldateformatter.php#intldateformatter.constants.relative-medium)**, and **[`IntlDateFormatter::RELATIVE_SHORT`](https://www.php.net/manual/en/class.intldateformatter.php#intldateformatter.constants.relative-short)** constants have been added.

### LDAP

[ldap_count_references()](https://www.php.net/manual/en/function.ldap-count-references.php) has been added, which returns the number of reference messages in a search result.

### OPcache

If the opcache.record_warnings ini setting is enabled, OPcache will record compile-time warnings and replay them on the next include, even if it is served from cache.

### OpenSSL

Added Cryptographic Message Syntax (CMS) ([» RFC 5652](https://datatracker.ietf.org/doc/html/rfc5652)) support composed of functions for encryption, decryption, signing, verifying and reading. The API is similar to the API for PKCS \#7 functions with an addition of new encoding constants: **[`OPENSSL_ENCODING_DER`](https://www.php.net/manual/en/openssl.constants.other.php#constant.openssl-encoding-der)**, **[`OPENSSL_ENCODING_SMIME`](https://www.php.net/manual/en/openssl.constants.other.php#constant.openssl-encoding-smime)** and **[`OPENSSL_ENCODING_PEM`](https://www.php.net/manual/en/openssl.constants.other.php#constant.openssl-encoding-pem)**:

- [openssl_cms_encrypt()](https://www.php.net/manual/en/function.openssl-cms-encrypt.php) encrypts the message in the file with the certificates and outputs the result to the supplied file.
- [openssl_cms_decrypt()](https://www.php.net/manual/en/function.openssl-cms-decrypt.php) that decrypts the S/MIME message in the file and outputs the results to the supplied file.
- [openssl_cms_read()](https://www.php.net/manual/en/function.openssl-cms-read.php) that exports the CMS file to an array of PEM certificates.
- [openssl_cms_sign()](https://www.php.net/manual/en/function.openssl-cms-sign.php) that signs the MIME message in the file with a cert and key and output the result to the supplied file.
- [openssl_cms_verify()](https://www.php.net/manual/en/function.openssl-cms-verify.php) that verifies that the data block is intact, the signer is who they say they are, and returns the certs of the signers.

### Regular Expressions (Perl-Compatible)

[preg_last_error_msg()](https://www.php.net/manual/en/function.preg-last-error-msg.php) has been added, which returns a human-readable message for the last PCRE error. It complements [preg_last_error()](https://www.php.net/manual/en/function.preg-last-error.php), which returns an integer enum value instead.

### Reflection

- The following methods can now return information about default values of parameters of internal functions:

  - [ReflectionParameter::isDefaultValueAvailable()](https://www.php.net/manual/en/reflectionparameter.isdefaultvalueavailable.php)
  - [ReflectionParameter::getDefaultValue()](https://www.php.net/manual/en/reflectionparameter.getdefaultvalue.php)
  - [ReflectionParameter::isDefaultValueConstant()](https://www.php.net/manual/en/reflectionparameter.isdefaultvalueconstant.php)
  - [ReflectionParameter::getDefaultValueConstantName()](https://www.php.net/manual/en/reflectionparameter.getdefaultvalueconstantname.php)

### SQLite3

[SQLite3::setAuthorizer()](https://www.php.net/manual/en/sqlite3.setauthorizer.php) and respective class constants have been added to set a userland callback that will be used to authorize or not an action on the database.

### Standard Library

- [str_contains()](https://www.php.net/manual/en/function.str-contains.php), [str_starts_with()](https://www.php.net/manual/en/function.str-starts-with.php) and [str_ends_with()](https://www.php.net/manual/en/function.str-ends-with.php) have been added, which check whether `haystack` contains, starts with or ends with `needle`, respectively.

- [fdiv()](https://www.php.net/manual/en/function.fdiv.php) has been added, which performs a floating-point division under IEEE 754 semantics. Division by zero is considered well-defined and will return one of `Inf`, `-Inf` or `NaN`.

- [get_debug_type()](https://www.php.net/manual/en/function.get-debug-type.php) has been added, which returns a type useful for error messages. Unlike [gettype()](https://www.php.net/manual/en/function.gettype.php), it uses canonical type names, returns class names for objects, and indicates the resource type for resources.

- [printf()](https://www.php.net/manual/en/function.printf.php) and friends now support the `%h` and `%H` format specifiers. These are the same as `%g` and `%G`, but always use `"."` as the decimal separator, rather than determining it through the **[`LC_NUMERIC`](https://www.php.net/manual/en/string.constants.php#constant.lc-numeric)** locale.

- [printf()](https://www.php.net/manual/en/function.printf.php) and friends now support using `"*"` as width or precision, in which case the width/precision is passed as an argument to printf. This also allows using precision `-1` with `%g`, `%G`, `%h` and `%H`. For example, the following code can be used to reproduce PHP's default floating point formatting:

  ```
  <?php
  printf("%.*H", (int) ini_get("precision"), $float);
  printf("%.*H", (int) ini_get("serialize_precision"), $float);
  ?>
  ```

- [proc_open()](https://www.php.net/manual/en/function.proc-open.php) now supports pseudo-terminal (PTY) descriptors. The following attaches `stdin`, `stdout` and `stderr` to the same PTY:

  ```
  <?php
  $proc = proc_open($command, [['pty'], ['pty'], ['pty']], $pipes);
  ?>
  ```

- [proc_open()](https://www.php.net/manual/en/function.proc-open.php) now supports socket pair descriptors. The following attaches a distinct socket pair to `stdin`, `stdout` and `stderr`:

  ```
  <?php
  $proc = proc_open($command, [['socket'], ['socket'], ['socket']], $pipes);
  ?>
  ```

  Unlike pipes, sockets do not suffer from blocking I/O issues on Windows. However, not all programs may work correctly with stdio sockets.

- Sorting functions are now stable, which means that equal-comparing elements will retain their original order.

- [array_diff()](https://www.php.net/manual/en/function.array-diff.php), [array_intersect()](https://www.php.net/manual/en/function.array-intersect.php) and their variations can now be used with a single array as argument. This means that usages like the following are now possible:

  ```
  <?php
  // OK even if $excludes is empty:
  array_diff($array, ...$excludes);
  // OK even if $arrays only contains a single array:
  array_intersect(...$arrays);
  ?>
  ```

- The `flag` parameter of [ob_implicit_flush()](https://www.php.net/manual/en/function.ob-implicit-flush.php) was changed to accept a [bool](https://www.php.net/manual/en/language.types.boolean.php) rather than an [int](https://www.php.net/manual/en/language.types.integer.php).

### Tokenizer

[PhpToken](https://www.php.net/manual/en/class.phptoken.php) adds an object-based interface to the tokenizer. It provides a more uniform and ergonomic representation, while being more memory efficient and faster.

### Zip

- The Zip extension has been updated to version 1.19.1.

- New [ZipArchive::setMtimeName()](https://www.php.net/manual/en/ziparchive.setmtimename.php) and [ZipArchive::setMtimeIndex()](https://www.php.net/manual/en/ziparchive.setmtimeindex.php) to set the modification time of an entry.

- New [ZipArchive::registerProgressCallback()](https://www.php.net/manual/en/ziparchive.registerprogresscallback.php) to provide updates during archive close.

- New [ZipArchive::registerCancelCallback()](https://www.php.net/manual/en/ziparchive.registercancelcallback.php) to allow cancellation during archive close.

- New [ZipArchive::replaceFile()](https://www.php.net/manual/en/ziparchive.replacefile.php) to replace an entry content.

- New [ZipArchive::isCompressionMethodSupported()](https://www.php.net/manual/en/ziparchive.iscompressionmethoddupported.php) to check optional compression features.

- New [ZipArchive::isEncryptionMethodSupported()](https://www.php.net/manual/en/ziparchive.isencryptionmethoddupported.php) to check optional encryption features.

- The `ZipArchive::lastId` property to get the index value of the last added entry has been added.

- Errors can now be checked after an archive has been closed using the `ZipArchive::status` and `ZipArchive::statusSys` properties, or the [ZipArchive::getStatusString()](https://www.php.net/manual/en/ziparchive.getstatusstring.php) method.

- The `'remove_path'` option of [ZipArchive::addGlob()](https://www.php.net/manual/en/ziparchive.addglob.php) and [ZipArchive::addPattern()](https://www.php.net/manual/en/ziparchive.addpattern.php) is now treated as an arbitrary string prefix (for consistency with the `'add_path'` option), whereas formerly it was treated as a directory name.

- Optional compression / encryption features are now listed in phpinfo.

# [PHP 7.4](https://www.php.net/manual/en/migration74.new-features.php)

## New Features

### PHP Core

#### Typed properties

Class properties now support type declarations.

```
<?php
class User {
    public int $id;
    public string $name;
}
?>
```

The above example will enforce that `$user->id` can only be assigned [int](https://www.php.net/manual/en/language.types.integer.php) values and `$user->name` can only be assigned [string](https://www.php.net/manual/en/language.types.string.php) values.

#### Arrow functions

[Arrow functions](https://www.php.net/manual/en/functions.arrow.php) provide a shorthand syntax for defining functions with implicit by-value scope binding.

```
<?php
$factor = 10;
$nums = array_map(fn($n) => $n * $factor, [1, 2, 3, 4]);
// $nums = array(10, 20, 30, 40);
?>
```

#### Limited return type covariance and argument type contravariance

The following code will now work:

```
<?php
class A {}
class B extends A {}

class Producer {
    public function method(): A {}
}
class ChildProducer extends Producer {
    public function method(): B {}
}
?>
```

Full variance support is only available if autoloading is used. Inside a single file only non-cyclic type references are possible, because all classes need to be available before they are referenced.

```
<?php

/**
 * These classes satisfy the LSP requirements, because C is a subtype of A.
 * However, at the time class B is declared, class C is not yet available
 */
class A
{
    public function method(): A {}
}

class B extends A
{
    // Fatal error: Could not check compatibility between B::method():C and
    // A::method(): A, because class C is not available
    public function method(): C {}
}

class C extends B {}

?>
```

#### Null coalescing assignment operator

```
<?php
$array['key'] ??= computeDefault();
// is roughly equivalent to
if (!isset($array['key'])) {
    $array['key'] = computeDefault();
}
?>
```

#### Unpacking inside arrays

```
<?php
$parts = ['apple', 'pear'];
$fruits = ['banana', 'orange', ...$parts, 'watermelon'];
// ['banana', 'orange', 'apple', 'pear', 'watermelon'];
?>
```

#### Numeric literal separator

Numeric literals can contain underscores between digits.

```
<?php
6.674_083e-11; // float
299_792_458;   // decimal
0xCAFE_F00D;   // hexadecimal
0b0101_1111;   // binary
?>
```

#### Weak references

[Weak references](https://www.php.net/manual/en/class.weakreference.php) allow the programmer to retain a reference to an object that does not prevent the object from being destroyed.

#### Allow exceptions from \_\_toString()

Throwing exceptions from [\_\_toString()](https://www.php.net/manual/en/language.oop5.magic.php#object.tostring) is now permitted. Previously this resulted in a fatal error. Existing recoverable fatal errors in string conversions have been converted to [Error](https://www.php.net/manual/en/class.error.php) exceptions.

### CURL

[CURLFile](https://www.php.net/manual/en/class.curlfile.php) now supports stream wrappers in addition to plain file names, if the extension has been built against libcurl \>= 7.56.0.

### Filter

The **[`FILTER_VALIDATE_FLOAT`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-validate-float)** filter now supports the `min_range` and `max_range` options, with the same semantics as **[`FILTER_VALIDATE_INT`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-validate-int)**.

### FFI

FFI is a new extension, which provides a simple way to call native functions, access native variables, and create/access data structures defined in C libraries.

### GD

Added the **[`IMG_FILTER_SCATTER`](https://www.php.net/manual/en/image.constants.php#constant.img-filter-scatter)** image filter to apply a scatter filter to images.

### Hash

Added `crc32c` hash using Castagnoli's polynomial. This CRC32 variant is used by storage systems, such as iSCSI, SCTP, Btrfs and ext4.

### Multibyte String

Added the [mb_str_split()](https://www.php.net/manual/en/function.mb-str-split.php) function, which provides the same functionality as [str_split()](https://www.php.net/manual/en/function.str-split.php), but operating on code points rather than bytes.

### OPcache

[Support for preloading code](https://www.php.net/manual/en/opcache.preloading.php) has been added.

### Regular Expressions (Perl-Compatible)

The [preg_replace_callback()](https://www.php.net/manual/en/function.preg-replace-callback.php) and [preg_replace_callback_array()](https://www.php.net/manual/en/function.preg-replace-callback-array.php) functions now accept an additional `flags` argument, with support for the **[`PREG_OFFSET_CAPTURE`](https://www.php.net/manual/en/pcre.constants.php#constant.preg-offset-capture)** and **[`PREG_UNMATCHED_AS_NULL`](https://www.php.net/manual/en/pcre.constants.php#constant.preg-unmatched-as-null)** flags. This influences the format of the matches array passed to the callback function.

### PDO

The username and password can now be specified as part of the PDO DSN for the mysql, mssql, sybase, dblib, firebird and oci drivers. Previously this was only supported by the pgsql driver. If a username/password is specified both in the constructor and the DSN, the constructor takes precedence.

It is now possible to escape question marks in SQL queries to avoid them being interpreted as parameter placeholders. Writing `??` allows sending a single question mark to the database and e.g. use the PostgreSQL JSON key exists (`?`) operator.

### PDO_OCI

[PDOStatement::getColumnMeta()](https://www.php.net/manual/en/pdostatement.getcolumnmeta.php) is now available.

### PDO_SQLite

`PDOStatement::getAttribute(PDO::SQLITE_ATTR_READONLY_STATEMENT)` allows checking whether the statement is read-only, i.e. if it doesn't modify the database.

`PDO::setAttribute(PDO::SQLITE_ATTR_EXTENDED_RESULT_CODES, true)` enables the use of SQLite3 extended result codes in [PDO::errorInfo()](https://www.php.net/manual/en/pdo.errorinfo.php) and [PDOStatement::errorInfo()](https://www.php.net/manual/en/pdostatement.errorinfo.php).

### SQLite3

Added [SQLite3::lastExtendedErrorCode()](https://www.php.net/manual/en/sqlite3.lastextendederrorcode.php) to fetch the last extended result code.

Added `SQLite3::enableExtendedResultCodes($enable = true)`, which will make [SQLite3::lastErrorCode()](https://www.php.net/manual/en/sqlite3.lasterrorcode.php) return extended result codes.

### Standard

#### strip_tags() with array of tag names

[strip_tags()](https://www.php.net/manual/en/function.strip-tags.php) now also accepts an array of allowed tags: instead of `strip_tags($str, '<a><p>')` you can now write `strip_tags($str, ['a', 'p'])`.

#### Custom object serialization

A new mechanism for custom object serialization has been added, which uses two new magic methods: `__serialize` and `__unserialize`.

```
<?php
// Returns array containing all the necessary state of the object.
public function __serialize(): array
{
}

// Restores the object state from the given data array.
public function __unserialize(array $data): void
{
}
?>
```

The new serialization mechanism supersedes the [Serializable](https://www.php.net/manual/en/class.serializable.php) interface, which will be deprecated in the future.

#### Array merge functions without arguments

[array_merge()](https://www.php.net/manual/en/function.array-merge.php) and [array_merge_recursive()](https://www.php.net/manual/en/function.array-merge-recursive.php) may now be called without any arguments, in which case they will return an empty array. This is useful in conjunction with the spread operator, e.g. `array_merge(...$arrays)`.

#### [proc_open()](https://www.php.net/manual/en/function.proc-open.php) function

[proc_open()](https://www.php.net/manual/en/function.proc-open.php) now accepts an array instead of a string for the command. In this case the process will be opened directly (without going through a shell) and PHP will take care of any necessary argument escaping.

```
<?php
proc_open(['php', '-r', 'echo "Hello World\n";'], $descriptors, $pipes);
?>
```

[proc_open()](https://www.php.net/manual/en/function.proc-open.php) now supports `redirect` and `null` descriptors.

```
<?php
// Like 2>&1 on the shell
proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['redirect', 1]], $pipes);
// Like 2>/dev/null or 2>nul on the shell
proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['null']], $pipes);
?>
```

#### argon2i(d) without libargon

[password_hash()](https://www.php.net/manual/en/function.password-hash.php) now has the argon2i and argon2id implementations from the sodium extension when PHP is built without libargon.

# [PHP 7.3](https://www.php.net/manual/en/migration73.new-features.php)

## New Features

### PHP Core

#### More Flexible Heredoc and Nowdoc Syntax

The closing marker for doc strings is no longer required to be followed by a semicolon or newline. Additionally the closing marker may be indented, in which case the indentation will be stripped from all lines in the doc string.

#### Array Destructuring supports Reference Assignments

Array destructuring now supports reference assignments using the syntax `[&$a, [$b, &$c]] = $d`. The same is also supported for [list()](https://www.php.net/manual/en/function.list.php).

#### Instanceof Operator accepts Literals

`instanceof` now allows literals as the first operand, in which case the result is always **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

#### CompileError Exception instead of some Compilation Errors

A new [CompileError](https://www.php.net/manual/en/class.compileerror.php) exception has been added, from which [ParseError](https://www.php.net/manual/en/class.parseerror.php) inherits. A small number of compilation errors will now throw a [CompileError](https://www.php.net/manual/en/class.compileerror.php) instead of generating a fatal error. Currently this only affects compilation errors that may be thrown by [token_get_all()](https://www.php.net/manual/en/function.token-get-all.php) in **[`TOKEN_PARSE`](https://www.php.net/manual/en/tokenizer.constants.php#constant.token-parse)** mode, but more errors may be converted in the future.

#### Trailing Commas are allowed in Calls

Trailing commas in function and method calls are now allowed.

#### Argon2id Support

The **--with-password-argon2\[=dir\]** configure argument now provides support for both Argon2i and Argon2id hashes in the [password_hash()](https://www.php.net/manual/en/function.password-hash.php), [password_verify()](https://www.php.net/manual/en/function.password-verify.php), [password_get_info()](https://www.php.net/manual/en/function.password-get-info.php), and [password_needs_rehash()](https://www.php.net/manual/en/function.password-needs-rehash.php) functions. Passwords may be hashed and verified using the **[`PASSWORD_ARGON2ID`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2id)** constant. Support for both Argon2i and Argon2id in the **password\_\*()** functions now requires PHP be linked against libargon2 reference library ≥ 20161029.

### FastCGI Process Manager

New options have been added to customize the FPM logging:

`log_limit`  
This global option can be used for setting the log limit for the logged line which allows to log messages longer than 1024 characters without wrapping. It also fixes various wrapping issues.

`log_buffering`  
This global option allows an experimental logging without extra buffering.

`decorate_workers_output`  
This pool option allows to disable the output decoration for workers output when `catch_workers_output` is enabled.

### BC Math Functions

[bcscale()](https://www.php.net/manual/en/function.bcscale.php) can now also be used as getter to retrieve the current scale in use.

### Lightweight Directory Access Protocol

Full support for LDAP Controls has been added to the [LDAP](https://www.php.net/manual/en/book.ldap.php) querying functions and [ldap_parse_result()](https://www.php.net/manual/en/function.ldap-parse-result.php):

- A `$controls` parameter to send controls to the server in [ldap_add()](https://www.php.net/manual/en/function.ldap-add.php), [ldap_mod_replace()](https://www.php.net/manual/en/function.ldap-mod-replace.php), [ldap_mod_add()](https://www.php.net/manual/en/function.ldap-mod-add.php), [ldap_mod_del()](https://www.php.net/manual/en/function.ldap-mod-del.php), [ldap_rename()](https://www.php.net/manual/en/function.ldap-rename.php), [ldap_compare()](https://www.php.net/manual/en/function.ldap-compare.php), [ldap_delete()](https://www.php.net/manual/en/function.ldap-delete.php), [ldap_modify_batch()](https://www.php.net/manual/en/function.ldap-modify-batch.php), [ldap_search()](https://www.php.net/manual/en/function.ldap-search.php), [ldap_list()](https://www.php.net/manual/en/function.ldap-list.php) and [ldap_read()](https://www.php.net/manual/en/function.ldap-read.php) has been added.

- The out parameter `$controls` to get controls from the server in [ldap_parse_result()](https://www.php.net/manual/en/function.ldap-parse-result.php) has been added.

- Support for **[`LDAP_OPT_SERVER_CONTROLS`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-server-controls)** and **[`LDAP_OPT_CLIENT_CONTROLS`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-client-controls)** in [ldap_get_option()](https://www.php.net/manual/en/function.ldap-get-option.php) and [ldap_set_option()](https://www.php.net/manual/en/function.ldap-set-option.php) has been fixed.

### Multibyte String Functions

#### Full Case-Mapping and Case-Folding Support

Support for full case-mapping and case-folding has been added. Unlike simple case-mapping, full case-mapping may change the length of the string. For example:

```
<?php
mb_strtoupper("Straße");
// Produces STRAßE on PHP 7.2
// Produces STRASSE on PHP 7.3
?>
```

The different casing mapping and folding modes are available through [mb_convert_case()](https://www.php.net/manual/en/function.mb-convert-case.php):

- **[`MB_CASE_LOWER`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-lower)** (used by [mb_strtolower()](https://www.php.net/manual/en/function.mb-strtolower.php))

- **[`MB_CASE_UPPER`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-upper)** (used by [mb_strtoupper()](https://www.php.net/manual/en/function.mb-strtoupper.php))

- **[`MB_CASE_TITLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-title)**

- **[`MB_CASE_FOLD`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-fold)**

- **[`MB_CASE_LOWER_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-lower-simple)**

- **[`MB_CASE_UPPER_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-upper-simple)**

- **[`MB_CASE_TITLE_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-title-simple)**

- **[`MB_CASE_FOLD_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-fold-simple)** (used by case-insensitive operations)

Only unconditional, language agnostic full case-mapping is performed.

#### Case-Insensitive String Operations use Case-Folding

Case-insensitive string operations now use case-folding instead of case- mapping during comparisons. This means that more characters will be considered (case insensitively) equal now.

#### MB_CASE_TITLE performs Title-Case Conversion

[mb_convert_case()](https://www.php.net/manual/en/function.mb-convert-case.php) with **[`MB_CASE_TITLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-title)** now performs title-case conversion based on the Cased and CaseIgnorable derived Unicode properties. In particular this also improves handling of quotes and apostrophes.

#### Unicode 11 Support

The [Multibyte String](https://www.php.net/manual/en/book.mbstring.php) data tables have been updated for Unicode 11.

#### Long String Support

The [Multibyte String Functions](https://www.php.net/manual/en/ref.mbstring.php) now correctly support strings larger than 2GB.

#### Performance Improvements

Performance of the [Multibyte String](https://www.php.net/manual/en/book.mbstring.php) extension has been significantly improved across the board. The largest improvements are in case conversion functions.

#### Named Captures Support

The `mb_ereg_*` functions now support named captures. Matching functions like [mb_ereg()](https://www.php.net/manual/en/function.mb-ereg.php) will now return named captures both using their group number and their name, similar to PCRE:

```
<?php
mb_ereg('(?<word>\w+)', '国', $matches);
// => [0 => "国", 1 => "国", "word" => "国"];
?>
```

Additionally, [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php) now supports the `\k<>` and `\k''` notations to reference named captures in the replacement string:

```
<?php
mb_ereg_replace('\s*(?<word>\w+)\s*', "_\k<word>_\k'word'_", ' foo ');
// => "_foo_foo_"
?>
```

`\k<>` and `\k''` can also be used for numbered references, which also works with group numbers greater than 9.

### Readline

Support for the `completion_append_character` and `completion_suppress_append` options has been added to [readline_info()](https://www.php.net/manual/en/function.readline-info.php). These options are only available if PHP is linked against libreadline (rather than libedit).

# [PHP 7.2](https://www.php.net/manual/en/migration72.new-features.php)

## New features

### New object type

A new type, [object](https://www.php.net/manual/en/language.types.object.php), has been introduced that can be used for (contravariant) parameter typing and (covariant) return typing of any objects.

```
<?php

function test(object $obj) : object
{
    return new SplQueue();
}

test(new stdClass());
```

### Extension loading by name

Shared extensions no longer require their file extension (`.so` for Unix or `.dll` for Windows) to be specified. This is enabled in the php.ini file, as well as in the [dl()](https://www.php.net/manual/en/function.dl.php) function.

### Abstract method overriding

Abstract methods can now be overridden when an abstract class extends another abstract class.

```
<?php

abstract class A
{
    abstract function test(string $s);
}
abstract class B extends A
{
    // overridden - still maintaining contravariance for parameters and covariance for return
    abstract function test($s) : int;
}
```

### [Sodium](https://www.php.net/manual/en/book.sodium.php) is now a core extension

The modern Sodium cryptography library has now become a core extension in PHP.

For a complete function reference, see the [Sodium](https://www.php.net/manual/en/book.sodium.php) chapter.

### Password hashing with Argon2

Argon2 has been added to the [password hashing API](https://www.php.net/manual/en/book.password.php), where the following constants have been exposed:

- **[`PASSWORD_ARGON2I`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2i)**

- **[`PASSWORD_ARGON2_DEFAULT_MEMORY_COST`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2-default-memory-cost)**

- **[`PASSWORD_ARGON2_DEFAULT_TIME_COST`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2-default-time-cost)**

- **[`PASSWORD_ARGON2_DEFAULT_THREADS`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2-default-threads)**

### Extended string types for [PDO](https://www.php.net/manual/en/book.pdo.php)

PDO's string type has been extended to support the national character type when emulating prepares. This has been done with the following constants:

- **[`PDO::PARAM_STR_NATL`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.param-str-natl)**

- **[`PDO::PARAM_STR_CHAR`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.param-str-char)**

- **[`PDO::ATTR_DEFAULT_STR_PARAM`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-default-str-param)**

These constants are utilised by bitwise `OR`'ing them with **[`PDO::PARAM_STR`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.param-str)**:

```
<?php

$db->quote('über', PDO::PARAM_STR | PDO::PARAM_STR_NATL);
```

### Additional emulated prepares debugging information for [PDO](https://www.php.net/manual/en/book.pdo.php)

The [PDOStatement::debugDumpParams()](https://www.php.net/manual/en/pdostatement.debugdumpparams.php) method has been updated to include the SQL being sent to the DB, where the full, raw query (including the replaced placeholders with their bound values) will be shown. This has been added to aid with debugging emulated prepares (and so it will only be available when emulated prepares are turned on).

### Support for extended operations in [LDAP](https://www.php.net/manual/en/book.ldap.php)

Support for EXOP has been added to the LDAP extension. This has been done by exposing the following functions and constants:

- [ldap_parse_exop()](https://www.php.net/manual/en/function.ldap-parse-exop.php)

- [ldap_exop()](https://www.php.net/manual/en/function.ldap-exop.php)

- [ldap_exop_passwd()](https://www.php.net/manual/en/function.ldap-exop-passwd.php)

- [ldap_exop_whoami()](https://www.php.net/manual/en/function.ldap-exop-whoami.php)

- **[`LDAP_EXOP_START_TLS`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-start-tls)**

- **[`LDAP_EXOP_MODIFY_PASSWD`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-modify-passwd)**

- **[`LDAP_EXOP_REFRESH`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-refresh)**

- **[`LDAP_EXOP_WHO_AM_I`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-who-am-i)**

- **[`LDAP_EXOP_TURN`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-turn)**

### Address Information additions to the [Sockets](https://www.php.net/manual/en/book.sockets.php) extension

The sockets extension now has the ability to lookup address information, as well as connect to it, bind to it, and explain it. The following four functions have been added for this:

- [socket_addrinfo_lookup()](https://www.php.net/manual/en/function.socket-addrinfo-lookup.php)

- [socket_addrinfo_connect()](https://www.php.net/manual/en/function.socket-addrinfo-connect.php)

- [socket_addrinfo_bind()](https://www.php.net/manual/en/function.socket-addrinfo-bind.php)

- [socket_addrinfo_explain()](https://www.php.net/manual/en/function.socket-addrinfo-explain.php)

### Parameter type widening

Parameter types from overridden methods and from interface implementations may now be omitted. This is still in compliance with LSP, since parameters types are contravariant.

```
<?php

interface A
{
    public function Test(array $input);
}

class B implements A
{
    public function Test($input){} // type omitted for $input
}
```

### Allow a trailing comma for grouped namespaces

A trailing comma can now be added to the group-use syntax introduced in PHP 7.0.

```
<?php

use Foo\Bar\{
    Foo,
    Bar,
    Baz,
};
```

### [proc_nice()](https://www.php.net/manual/en/function.proc-nice.php) support on Windows

The [proc_nice()](https://www.php.net/manual/en/function.proc-nice.php) function is now supported on Windows.

### [pack()](https://www.php.net/manual/en/function.pack.php) and [unpack()](https://www.php.net/manual/en/function.unpack.php) endian support

The [pack()](https://www.php.net/manual/en/function.pack.php) and [unpack()](https://www.php.net/manual/en/function.unpack.php) functions now support float and double in both little and big endian.

### Enhancements to the [EXIF](https://www.php.net/manual/en/book.exif.php) extension

The EXIF extension has been updated to support a much larger range of formats. This means that their format specific tags are now properly translated when parsing images with the [exif_read_data()](https://www.php.net/manual/en/function.exif-read-data.php) function. The following new formats are now supported:

- Samsung

- DJI

- Panasonic

- Sony

- Pentax

- Minolta

- Sigma/Foveon

- AGFA

- Kyocera

- Ricoh

- Epson

The EXIF functions [exif_read_data()](https://www.php.net/manual/en/function.exif-read-data.php) and [exif_thumbnail()](https://www.php.net/manual/en/function.exif-thumbnail.php) now support passing streams as their first argument.

### New features in [PCRE](https://www.php.net/manual/en/book.pcre.php)

- The `J` modifier for setting PCRE_DUPNAMES has been added.

### [SQLite3](https://www.php.net/manual/en/book.sqlite3.php) allows writing BLOBs

[SQLite3::openBlob()](https://www.php.net/manual/en/sqlite3.openblob.php) now allows to open BLOB fields in write mode; formerly only read mode was supported.

### [Oracle OCI8](https://www.php.net/manual/en/book.oci8.php) Transparent Application Failover Callbacks

Support for [Oracle Database Transparent Application Failover (TAF) callbacks](https://www.php.net/manual/en/oci8.taf.php) has been added. TAF allows PHP OCI8 applications to automatically reconnect to a preconfigured database when a connection is broken. The new TAF callback support allows PHP applications to monitor and control reconnection during failover.

### Enhancements to the [ZIP](https://www.php.net/manual/en/book.zip.php) extension

Read and write support for encrypted archives has been added (requires libzip 1.2.0).

The [ZipArchive](https://www.php.net/manual/en/class.ziparchive.php) class now implements the [Countable](https://www.php.net/manual/en/class.countable.php) interface.

The `zip://` stream now accepts a `'password'` context option.

# [PHP 7.1](https://www.php.net/manual/en/migration71.new-features.php)

## New features

### Nullable types

Type declarations for parameters and return values can now be marked as nullable by prefixing the type name with a question mark. This signifies that as well as the specified type, **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** can be passed as an argument, or returned as a value, respectively.

```
<?php

function testReturnA(): ?string
{
    return 'elePHPant';
}

var_dump(testReturnA());

function testReturnB(): ?string
{
    return null;
}

var_dump(testReturnB());

function test(?string $name)
{
    var_dump($name);
}

test('elePHPant');
test(null);
test();
```

The above example will output:

    string(9) "elePHPant"
    NULL
    string(9) "elePHPant"
    NULL
    Fatal error: Uncaught ArgumentCountError: Too few arguments to function test(), 0 passed in...

### Void functions

A [void](https://www.php.net/manual/en/language.types.void.php) return type has been introduced. Functions declared with void as their return type must either omit their return statement altogether, or use an empty return statement. **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** is not a valid return value for a void function.

```
<?php
function swap(&$left, &$right): void
{
    if ($left === $right) {
        return;
    }

    $tmp = $left;
    $left = $right;
    $right = $tmp;
}

$a = 1;
$b = 2;
var_dump(swap($a, $b), $a, $b);
```

The above example will output:

    null
    int(2)
    int(1)

Attempting to use a void function's return value simply evaluates to **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**, with no warnings emitted. The reason for this is because warnings would implicate the use of generic higher order functions.

### Symmetric array destructuring

The shorthand array syntax (`[]`) may now be used to destructure arrays for assignments (including within `foreach`), as an alternative to the existing [list()](https://www.php.net/manual/en/function.list.php) syntax, which is still supported.

```
<?php
$data = [
    [1, 'Tom'],
    [2, 'Fred'],
];

// list() style
list($id1, $name1) = $data[0];

// [] style
[$id1, $name1] = $data[0];

// list() style
foreach ($data as list($id, $name)) {
    // logic here with $id and $name
}

// [] style
foreach ($data as [$id, $name]) {
    // logic here with $id and $name
}
```

### Class constant visibility

Support for specifying the visibility of class constants has been added.

```
<?php
class ConstDemo
{
    const PUBLIC_CONST_A = 1;
    public const PUBLIC_CONST_B = 2;
    protected const PROTECTED_CONST = 3;
    private const PRIVATE_CONST = 4;
}
```

### [iterable](https://www.php.net/manual/en/language.types.iterable.php) pseudo-type

A new pseudo-type (similar to [callable](https://www.php.net/manual/en/language.types.callable.php)) called [iterable](https://www.php.net/manual/en/language.types.iterable.php) has been introduced. It may be used in parameter and return types, where it accepts either arrays or objects that implement the [Traversable](https://www.php.net/manual/en/class.traversable.php) interface. With respect to subtyping, parameter types of child classes may broaden a parent's declaration of [array](https://www.php.net/manual/en/language.types.array.php) or [Traversable](https://www.php.net/manual/en/class.traversable.php) to [iterable](https://www.php.net/manual/en/language.types.iterable.php). With return types, child classes may narrow a parent's return type of [iterable](https://www.php.net/manual/en/language.types.iterable.php) to [array](https://www.php.net/manual/en/language.types.array.php) or an object that implements [Traversable](https://www.php.net/manual/en/class.traversable.php).

```
<?php
function iterator(iterable $iter)
{
    foreach ($iter as $val) {
        //
    }
}
```

### Multi catch exception handling

Multiple exceptions per catch block may now be specified using the pipe character (`|`). This is useful for when different exceptions from different class hierarchies are handled the same.

```
<?php
try {
    // some code
} catch (FirstException | SecondException $e) {
    // handle first and second exceptions
}
```

### Support for keys in [list()](https://www.php.net/manual/en/function.list.php)

You can now specify keys in [list()](https://www.php.net/manual/en/function.list.php), or its new shorthand `[]` syntax. This enables destructuring of arrays with non-integer or non-sequential keys.

```
<?php
$data = [
    ["id" => 1, "name" => 'Tom'],
    ["id" => 2, "name" => 'Fred'],
];

// list() style
list("id" => $id1, "name" => $name1) = $data[0];

// [] style
["id" => $id1, "name" => $name1] = $data[0];

// list() style
foreach ($data as list("id" => $id, "name" => $name)) {
    // logic here with $id and $name
}

// [] style
foreach ($data as ["id" => $id, "name" => $name]) {
    // logic here with $id and $name
}
```

### Support for negative string offsets

Support for negative string offsets has been added to the [string manipulation functions](https://www.php.net/manual/en/book.strings.php) accepting offsets, as well as to [string indexing](https://www.php.net/manual/en/language.types.string.php#language.types.string.substr) with `[]` or `{}`. In such cases, a negative offset is interpreted as being an offset from the end of the string.

```
<?php
var_dump("abcdef"[-2]);
var_dump(strpos("aabbcc", "b", -3));
```

The above example will output:

    string (1) "e"
    int(3)

Negative string and array offsets are now also supported in the simple variable parsing syntax inside of strings.

```
<?php
$string = 'bar';
echo "The last character of '$string' is '$string[-1]'.\n";
?>
```

The above example will output:

    The last character of 'bar' is 'r'.

### Support for AEAD in ext/openssl

Support for AEAD (modes GCM and CCM) have been added by extending the [openssl_encrypt()](https://www.php.net/manual/en/function.openssl-encrypt.php) and [openssl_decrypt()](https://www.php.net/manual/en/function.openssl-decrypt.php) functions with additional parameters.

### Convert callables to [Closure](https://www.php.net/manual/en/class.closure.php)s with [Closure::fromCallable()](https://www.php.net/manual/en/closure.fromcallable.php)

A new static method has been introduced to the [Closure](https://www.php.net/manual/en/class.closure.php) class to allow for [callable](https://www.php.net/manual/en/language.types.callable.php)s to be easily converted into [Closure](https://www.php.net/manual/en/class.closure.php) objects.

```
<?php
class Test
{
    public function exposeFunction()
    {
        return Closure::fromCallable([$this, 'privateFunction']);
    }

    private function privateFunction($param)
    {
        var_dump($param);
    }
}

$privFunc = (new Test)->exposeFunction();
$privFunc('some value');
```

The above example will output:

    string(10) "some value"

### Asynchronous signal handling

A new function called [pcntl_async_signals()](https://www.php.net/manual/en/function.pcntl-async-signals.php) has been introduced to enable asynchronous signal handling without using ticks (which introduce a lot of overhead).

```
<?php
pcntl_async_signals(true); // turn on async signals

pcntl_signal(SIGHUP,  function($sig) {
    echo "SIGHUP\n";
});

posix_kill(posix_getpid(), SIGHUP);
```

The above example will output:

    SIGHUP

### HTTP/2 server push support in ext/curl

Support for server push has been added to the CURL extension (requires version 7.46 and above). This can be leveraged through the [curl_multi_setopt()](https://www.php.net/manual/en/function.curl-multi-setopt.php) function with the new **[`CURLMOPT_PUSHFUNCTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlmopt-pushfunction)** constant. The constants **[`CURL_PUSH_OK`](https://www.php.net/manual/en/curl.constants.php#constant.curl-push-ok)** and **[`CURL_PUSH_DENY`](https://www.php.net/manual/en/curl.constants.php#constant.curl-push-deny)** have also been added so that the execution of the server push callback can either be approved or denied.

### Stream Context Options

The [tcp_nodelay](https://www.php.net/manual/en/context.socket.php#context.socket.tcp_nodelay) stream context option has been added.

# [PHP 7.0](https://www.php.net/manual/en/migration70.new-features.php)

## New features

### Scalar type declarations

Scalar [type declarations](https://www.php.net/manual/en/language.types.declarations.php) come in two flavours: coercive (default) and strict. The following types for parameters can now be enforced (either coercively or strictly): strings ([string](https://www.php.net/manual/en/language.types.string.php)), integers (`int`), floating-point numbers ([float](https://www.php.net/manual/en/language.types.float.php)), and booleans (`bool`). They augment the other types introduced in PHP 5: class names, interfaces, [array](https://www.php.net/manual/en/language.types.array.php) and [callable](https://www.php.net/manual/en/language.types.callable.php).

```
<?php
// Coercive mode
function sumOfInts(int ...$ints)
{
    return array_sum($ints);
}

var_dump(sumOfInts(2, '3', 4.1));
```

The above example will output:

    int(9)

To enable strict mode, a single [`declare`](https://www.php.net/manual/en/control-structures.declare.php) directive must be placed at the top of the file. This means that the strictness of typing for scalars is configured on a per-file basis. This directive not only affects the type declarations of parameters, but also a function's return type (see [return type declarations](https://www.php.net/manual/en/language.types.declarations.php), built-in PHP functions, and functions from loaded extensions.

Full documentation and examples of scalar type declarations can be found in the [type declaration](https://www.php.net/manual/en/language.types.declarations.php) reference.

### Return type declarations

PHP 7 adds support for [return type declarations](https://www.php.net/manual/en/language.types.declarations.php). Similarly to [argument type declarations](https://www.php.net/manual/en/language.types.declarations.php), return type declarations specify the type of the value that will be returned from a function. The same [types](https://www.php.net/manual/en/language.types.declarations.php) are available for return type declarations as are available for argument type declarations.

```
<?php

function arraysSum(array ...$arrays): array
{
    return array_map(function(array $array): int {
        return array_sum($array);
    }, $arrays);
}

print_r(arraysSum([1,2,3], [4,5,6], [7,8,9]));
```

The above example will output:

    Array
    (
        [0] => 6
        [1] => 15
        [2] => 24
    )

Full documentation and examples of return type declarations can be found in the [return type declarations](https://www.php.net/manual/en/language.types.declarations.php). reference.

### Null coalescing operator

The null coalescing operator (`??`) has been added as syntactic sugar for the common case of needing to use a ternary in conjunction with [isset()](https://www.php.net/manual/en/function.isset.php). It returns its first operand if it exists and is not **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**; otherwise it returns its second operand.

```
<?php
// Fetches the value of $_GET['user'] and returns 'nobody'
// if it does not exist.
$username = $_GET['user'] ?? 'nobody';
// This is equivalent to:
$username = isset($_GET['user']) ? $_GET['user'] : 'nobody';

// Coalescing can be chained: this will return the first
// defined value out of $_GET['user'], $_POST['user'], and
// 'nobody'.
$username = $_GET['user'] ?? $_POST['user'] ?? 'nobody';
?>
```

### Spaceship operator

The spaceship operator is used for comparing two expressions. It returns -1, 0 or 1 when `$a` is respectively less than, equal to, or greater than `$b`. Comparisons are performed according to PHP's usual [type comparison rules](https://www.php.net/manual/en/types.comparisons.php).

```
<?php
// Integers
echo 1 <=> 1; // 0
echo 1 <=> 2; // -1
echo 2 <=> 1; // 1

// Floats
echo 1.5 <=> 1.5; // 0
echo 1.5 <=> 2.5; // -1
echo 2.5 <=> 1.5; // 1
 
// Strings
echo "a" <=> "a"; // 0
echo "a" <=> "b"; // -1
echo "b" <=> "a"; // 1
?>
```

### Constant arrays using [define()](https://www.php.net/manual/en/function.define.php)

[Array](https://www.php.net/manual/en/language.types.array.php) constants can now be defined with [define()](https://www.php.net/manual/en/function.define.php). In PHP 5.6, they could only be defined with [`const`](https://www.php.net/manual/en/language.constants.syntax.php).

```
<?php
define('ANIMALS', [
    'dog',
    'cat',
    'bird'
]);

echo ANIMALS[1]; // outputs "cat"
?>
```

### Anonymous classes

Support for anonymous classes has been added via `new class`. These can be used in place of full class definitions for throwaway objects:

```
<?php
interface Logger {
    public function log(string $msg);
}

class Application {
    private $logger;

    public function getLogger(): Logger {
         return $this->logger;
    }

    public function setLogger(Logger $logger) {
         $this->logger = $logger;
    }
}

$app = new Application;
$app->setLogger(new class implements Logger {
    public function log(string $msg) {
        echo $msg;
    }
});

var_dump($app->getLogger());
?>
```

The above example will output:

    object(class@anonymous)#2 (0) {
    }

Full documentation can be found in the [anonymous class reference](https://www.php.net/manual/en/language.oop5.anonymous.php).

### Unicode codepoint escape syntax

This takes a Unicode codepoint in hexadecimal form, and outputs that codepoint in UTF-8 to a double-quoted string or a heredoc. Any valid codepoint is accepted, with leading 0's being optional.

```
<?php

echo "\u{aa}", PHP_EOL;
echo "\u{0000aa}", PHP_EOL;

echo "\u{9999}", PHP_EOL;

echo <<<EOT
\u{01f418}
EOT;

?>
```

The above example will output:

    ª
    ª (same as before but with optional leading 0's)
    香

### [Closure::call()](https://www.php.net/manual/en/closure.call.php)

[Closure::call()](https://www.php.net/manual/en/closure.call.php) is a more performant, shorthand way of temporarily binding an object scope to a closure and invoking it.

```
<?php
class A {private $x = 1;}

// Pre PHP 7 code
$getX = function() {return $this->x;};
$getXCB = $getX->bindTo(new A, 'A'); // intermediate closure
echo $getXCB();

// PHP 7+ code
$getX = function() {return $this->x;};
echo $getX->call(new A);
```

The above example will output:

    1
    1

### Filtered [unserialize()](https://www.php.net/manual/en/function.unserialize.php)

This feature seeks to provide better security when unserializing objects on untrusted data. It prevents possible code injections by enabling the developer to whitelist classes that can be unserialized.

```
<?php

// converts all objects into __PHP_Incomplete_Class object
$data = unserialize($foo, ["allowed_classes" => false]);

// converts all objects into __PHP_Incomplete_Class object except those of MyClass and MyClass2
$data = unserialize($foo, ["allowed_classes" => ["MyClass", "MyClass2"]]);

// default behaviour (same as omitting the second argument) that accepts all classes
$data = unserialize($foo, ["allowed_classes" => true]);
```

### [IntlChar](https://www.php.net/manual/en/class.intlchar.php)

The new [IntlChar](https://www.php.net/manual/en/class.intlchar.php) class seeks to expose additional ICU functionality. The class itself defines a number of static methods and constants that can be used to manipulate unicode characters.

```
<?php

printf('%x', IntlChar::CODEPOINT_MAX);
echo IntlChar::charName('@');
var_dump(IntlChar::ispunct('!'));
```

The above example will output:

    10ffff
    COMMERCIAL AT
    bool(true)

In order to use this class, the [Intl](https://www.php.net/manual/en/book.intl.php) extension must be installed.

### Expectations

Expectations are a backwards compatible enhancement to the older [assert()](https://www.php.net/manual/en/function.assert.php) function. They allow for zero-cost assertions in production code, and provide the ability to throw custom exceptions when the assertion fails.

While the old API continues to be maintained for compatibility, [assert()](https://www.php.net/manual/en/function.assert.php) is now a language construct, allowing the first parameter to be an expression rather than just a [string](https://www.php.net/manual/en/language.types.string.php) to be evaluated or a [bool](https://www.php.net/manual/en/language.types.boolean.php) value to be tested.

```
<?php
ini_set('assert.exception', 1);

class CustomError extends AssertionError {}

assert(false, new CustomError('Some error message'));
?>
```

The above example will output:

    Fatal error: Uncaught CustomError: Some error message

Full details on this feature, including how to configure it in both development and production environments, can be found on the manual page of the [assert()](https://www.php.net/manual/en/function.assert.php) language construct.

### Group `use` declarations

Classes, functions and constants being imported from the same [`namespace`](https://www.php.net/manual/en/language.namespaces.definition.php) can now be grouped together in a single [`use`](https://www.php.net/manual/en/language.namespaces.importing.php) statement.

```
<?php
// Pre PHP 7 code
use some\namespace\ClassA;
use some\namespace\ClassB;
use some\namespace\ClassC as C;

use function some\namespace\fn_a;
use function some\namespace\fn_b;
use function some\namespace\fn_c;

use const some\namespace\ConstA;
use const some\namespace\ConstB;
use const some\namespace\ConstC;

// PHP 7+ code
use some\namespace\{ClassA, ClassB, ClassC as C};
use function some\namespace\{fn_a, fn_b, fn_c};
use const some\namespace\{ConstA, ConstB, ConstC};
?>
```

### Generator Return Expressions

This feature builds upon the generator functionality introduced into PHP 5.5. It enables for a `return` statement to be used within a generator to enable for a final expression to be returned (return by reference is not allowed). This value can be fetched using the new `Generator::getReturn()` method, which may only be used once the generator has finished yielding values.

```
<?php

$gen = (function() {
    yield 1;
    yield 2;

    return 3;
})();

foreach ($gen as $val) {
    echo $val, PHP_EOL;
}

echo $gen->getReturn(), PHP_EOL;
```

The above example will output:

    1
    2
    3

Being able to explicitly return a final value from a generator is a handy ability to have. This is because it enables for a final value to be returned by a generator (from perhaps some form of coroutine computation) that can be specifically handled by the client code executing the generator. This is far simpler than forcing the client code to firstly check whether the final value has been yielded, and then if so, to handle that value specifically.

### Generator delegation

Generators can now delegate to another generator, [Traversable](https://www.php.net/manual/en/class.traversable.php) object or [array](https://www.php.net/manual/en/language.types.array.php) automatically, without needing to write boilerplate in the outermost generator by using the [`yield from`](https://www.php.net/manual/en/language.generators.syntax.php#control-structures.yield.from) construct.

```
<?php
function gen()
{
    yield 1;
    yield 2;
    yield from gen2();
}

function gen2()
{
    yield 3;
    yield 4;
}

foreach (gen() as $val)
{
    echo $val, PHP_EOL;
}
?>
```

The above example will output:

    1
    2
    3
    4

### Integer division with [intdiv()](https://www.php.net/manual/en/function.intdiv.php)

The new [intdiv()](https://www.php.net/manual/en/function.intdiv.php) function performs an integer division of its operands and returns it.

```
<?php
var_dump(intdiv(10, 3));
?>
```

The above example will output:

    int(3)

### Session options

[session_start()](https://www.php.net/manual/en/function.session-start.php) now accepts an [array](https://www.php.net/manual/en/language.types.array.php) of options that override the [session configuration directives](https://www.php.net/manual/en/session.configuration.php) normally set in php.ini.

These options have also been expanded to support [session.lazy_write](https://www.php.net/manual/en/session.configuration.php#ini.session.lazy-write), which is on by default and causes PHP to only overwrite any session file if the session data has changed, and `read_and_close`, which is an option that can only be passed to [session_start()](https://www.php.net/manual/en/function.session-start.php) to indicate that the session data should be read and then the session should immediately be closed unchanged.

For example, to set [session.cache_limiter](https://www.php.net/manual/en/session.configuration.php#ini.session.cache-limiter) to `private` and immediately close the session after reading it:

```
<?php
session_start([
    'cache_limiter' => 'private',
    'read_and_close' => true,
]);
?>
```

### [preg_replace_callback_array()](https://www.php.net/manual/en/function.preg-replace-callback-array.php)

The new [preg_replace_callback_array()](https://www.php.net/manual/en/function.preg-replace-callback-array.php) function enables code to be written more cleanly when using the [preg_replace_callback()](https://www.php.net/manual/en/function.preg-replace-callback.php) function. Prior to PHP 7, callbacks that needed to be executed per regular expression required the callback function to be polluted with lots of branching.

Now, callbacks can be registered to each regular expression using an associative array, where the key is a regular expression and the value is a callback.

### CSPRNG Functions

Two new functions have been added to generate cryptographically secure integers and strings in a cross platform way: [random_bytes()](https://www.php.net/manual/en/function.random-bytes.php) and [random_int()](https://www.php.net/manual/en/function.random-int.php).

### [list()](https://www.php.net/manual/en/function.list.php) can always unpack objects implementing [ArrayAccess](https://www.php.net/manual/en/class.arrayaccess.php)

Previously, [list()](https://www.php.net/manual/en/function.list.php) was not guaranteed to operate correctly with objects implementing [ArrayAccess](https://www.php.net/manual/en/class.arrayaccess.php). This has been fixed.

### Other Features

- Class member access on cloning has been added, e.g. `(clone $foo)->bar()`.

# [PHP 5.6](https://www.php.net/manual/en/migration56.new-features.php)

## New features

### Constant expressions

It is now possible to provide a scalar expression involving numeric and string literals and/or constants in contexts where PHP previously expected a static value, such as constant and property declarations and default function arguments.

```
<?php
const ONE = 1;
const TWO = ONE * 2;

class C {
    const THREE = TWO + 1;
    const ONE_THIRD = ONE / self::THREE;
    const SENTENCE = 'The value of THREE is '.self::THREE;

    public function f($a = ONE + self::THREE) {
        return $a;
    }
}

echo (new C)->f()."\n";
echo C::SENTENCE;
?>
```

The above example will output:

    4
    The value of THREE is 3

It is also now possible to define a constant [array](https://www.php.net/manual/en/language.types.array.php) using the `const` keyword:

```
<?php
const ARR = ['a', 'b'];

echo ARR[0];
?>
```

The above example will output:

    a

### Variadic functions via `...`

[Variadic functions](https://www.php.net/manual/en/functions.arguments.php#functions.variable-arg-list) can now be implemented using the `...` operator, instead of relying on [func_get_args()](https://www.php.net/manual/en/function.func-get-args.php).

```
<?php
function f($req, $opt = null, ...$params) {
    // $params is an array containing the remaining arguments.
    printf('$req: %d; $opt: %d; number of params: %d'."\n",
           $req, $opt, count($params));
}

f(1);
f(1, 2);
f(1, 2, 3);
f(1, 2, 3, 4);
f(1, 2, 3, 4, 5);
?>
```

The above example will output:

    $req: 1; $opt: 0; number of params: 0
    $req: 1; $opt: 2; number of params: 0
    $req: 1; $opt: 2; number of params: 1
    $req: 1; $opt: 2; number of params: 2
    $req: 1; $opt: 2; number of params: 3

### Argument unpacking via `...`

[Arrays](https://www.php.net/manual/en/language.types.array.php) and [Traversable](https://www.php.net/manual/en/class.traversable.php) objects can be unpacked into argument lists when calling functions by using the `...` operator. This is also known as the splat operator in other languages, including Ruby.

```
<?php
function add($a, $b, $c) {
    return $a + $b + $c;
}

$operators = [2, 3];
echo add(1, ...$operators);
?>
```

The above example will output:

    6

### Exponentiation via `**`

A right associative `**` operator has been added to support exponentiation, along with a `**=` shorthand assignment operator.

```
<?php
printf("2 ** 3 ==      %d\n", 2 ** 3);
printf("2 ** 3 ** 2 == %d\n", 2 ** 3 ** 2);

$a = 2;
$a **= 3;
printf("a ==           %d\n", $a);
?>
```

The above example will output:

    2 ** 3 ==      8
    2 ** 3 ** 2 == 512
    a ==           8

### `use function` and `use const`

The [`use`](https://www.php.net/manual/en/language.namespaces.importing.php) operator has been extended to support importing functions and constants in addition to classes. This is achieved via the `use function` and `use const` constructs, respectively.

```
<?php
namespace Name\Space {
    const FOO = 42;
    function f() { echo __FUNCTION__."\n"; }
}

namespace {
    use const Name\Space\FOO;
    use function Name\Space\f;

    echo FOO."\n";
    f();
}
?>
```

The above example will output:

    42
    Name\Space\f

### phpdbg

PHP now includes an interactive debugger called phpdbg implemented as a SAPI module. For more information, please visit the [phpdbg documentation](https://www.php.net/manual/en/book.phpdbg.php).

### Default character encoding

[default_charset](https://www.php.net/manual/en/ini.core.php#ini.default-charset) is now used as the default character set for the [htmlentities()](https://www.php.net/manual/en/function.htmlentities.php), [html_entity_decode()](https://www.php.net/manual/en/function.html-entity-decode.php) and [htmlspecialchars()](https://www.php.net/manual/en/function.htmlspecialchars.php) functions. Note that if the (now deprecated) iconv and mbstring encoding settings are set, they will take precedence over default_charset for iconv and mbstring functions, respectively.

The default value for this setting is `UTF-8`.

### [`php://input`](https://www.php.net/manual/en/wrappers.php.php#wrappers.php.input) is reusable

[`php://input`](https://www.php.net/manual/en/wrappers.php.php#wrappers.php.input) may now be reopened and read as many times as required. This work has also resulted in a major reduction in the amount of memory required to deal with POST data.

### Large file uploads

Files larger than 2 gigabytes in size are now accepted.

### [GMP](https://www.php.net/manual/en/book.gmp.php) supports operator overloading

[GMP](https://www.php.net/manual/en/book.gmp.php) objects now support operator overloading and casting to scalar types. This allows for more expressive code using GMP:

```
<?php
$a = gmp_init(42);
$b = gmp_init(17);

if (version_compare(PHP_VERSION, '5.6', '<')) {
    echo gmp_intval(gmp_add($a, $b)), PHP_EOL;
    echo gmp_intval(gmp_add($a, 17)), PHP_EOL;
    echo gmp_intval(gmp_add(42, $b)), PHP_EOL;
} else {
    echo $a + $b, PHP_EOL;
    echo $a + 17, PHP_EOL;
    echo 42 + $b, PHP_EOL;
}
?>
```

The above example will output:

    59
    59
    59

### [hash_equals()](https://www.php.net/manual/en/function.hash-equals.php) for timing attack safe string comparison

The [hash_equals()](https://www.php.net/manual/en/function.hash-equals.php) function has been added to compare two strings in constant time. This should be used to mitigate timing attacks; for instance, when testing [crypt()](https://www.php.net/manual/en/function.crypt.php) password hashes (assuming that you are unable to use [password_hash()](https://www.php.net/manual/en/function.password-hash.php) and [password_verify()](https://www.php.net/manual/en/function.password-verify.php), which aren't susceptible to timing attacks).

```
<?php
$expected  = crypt('12345', '$2a$07$usesomesillystringforsalt$');
$correct   = crypt('12345', '$2a$07$usesomesillystringforsalt$');
$incorrect = crypt('1234',  '$2a$07$usesomesillystringforsalt$');

var_dump(hash_equals($expected, $correct));
var_dump(hash_equals($expected, $incorrect));
?>
```

The above example will output:

    bool(true)
    bool(false)

### `__debugInfo()`

The [\_\_debugInfo()](https://www.php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo) magic method has been added to allow objects to change the properties and values that are shown when the object is output using [var_dump()](https://www.php.net/manual/en/function.var-dump.php).

```
<?php
class C {
    private $prop;

    public function __construct($val) {
        $this->prop = $val;
    }

    public function __debugInfo() {
        return [
            'propSquared' => $this->prop ** 2,
        ];
    }
}

var_dump(new C(42));
?>
```

The above example will output:

    object(C)#1 (1) {
      ["propSquared"]=>
      int(1764)
    }

### gost-crypto hash algorithm

The `gost-crypto` hash algorithm has been added. This implements the GOST hash function using the CryptoPro S-box tables as specified by [» RFC 4357, section 11.2](https://datatracker.ietf.org/doc/html/rfc4357).

### SSL/TLS improvements

A wide range of improvements have been made to the SSL/TLS support in PHP 5.6. These include [enabling peer verification by default](https://www.php.net/manual/en/migration56.incompatible.php#migration56.incompatible.peer-verification), supporting certificate fingerprint matching, mitigating against TLS renegotiation attacks, and many new [SSL context options](https://www.php.net/manual/en/context.ssl.php) to allow more fine grained control over protocol and verification settings when using encrypted streams.

These changes are described in more detail in the [OpenSSL changes in PHP 5.6.x](https://www.php.net/manual/en/migration56.openssl.php) section of this migration guide.

### [pgsql](https://www.php.net/manual/en/book.pgsql.php) async support

The [pgsql](https://www.php.net/manual/en/book.pgsql.php) extension now supports asynchronous connections and queries, thereby enabling non-blocking behaviour when interacting with PostgreSQL databases. Asynchronous connections may be established via the **[`PGSQL_CONNECT_ASYNC`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-connect-async)** constant, and the new [pg_connect_poll()](https://www.php.net/manual/en/function.pg-connect-poll.php), [pg_socket()](https://www.php.net/manual/en/function.pg-socket.php), [pg_consume_input()](https://www.php.net/manual/en/function.pg-consume-input.php) and [pg_flush()](https://www.php.net/manual/en/function.pg-flush.php) functions may be used to handle asynchronous connections and queries.

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.new-features.php)

## New features

### [Generators](https://php-legacy-docs.zend.com/manual/php5/en/language.generators.html) added

Support for [generators](https://php-legacy-docs.zend.com/manual/php5/en/language.generators.html) has been added via the **yield** keyword. Generators provide an easy way to implement simple iterators without the overhead or complexity of implementing a class that implements the [Iterator](https://php-legacy-docs.zend.com/manual/php5/en/class.iterator.html) interface.

A simple example that reimplements the [range()](https://php-legacy-docs.zend.com/manual/php5/en/function.range.html) function as a generator (at least for positive `step` values):

    <?php
    function xrange($start, $limit, $step = 1) {
        for ($i = $start; $i <= $limit; $i += $step) {
            yield $i;
        }
    }

    echo 'Single digit odd numbers: ';

    /*
     * Note that an array is never created or returned,
     * which saves memory.
     */
    foreach (xrange(1, 9, 2) as $number) {
        echo "$number ";
    }

    echo "\n";
    ?>

The above example will output:

    Single digit odd numbers: 1 3 5 7 9 

### [`finally`](https://php-legacy-docs.zend.com/manual/php5/en/language.exceptions.html#language.exceptions.finally) keyword added

[`try`](https://php-legacy-docs.zend.com/manual/php5/en/language.exceptions.html)-[`catch`](https://php-legacy-docs.zend.com/manual/php5/en/language.exceptions.html#language.exceptions.catch) blocks now support a [`finally`](https://php-legacy-docs.zend.com/manual/php5/en/language.exceptions.html#language.exceptions.finally) block for code that should be run regardless of whether an exception has been thrown or not.

### New password hashing API

A [new password hashing API](https://php-legacy-docs.zend.com/manual/php5/en/book.password.html) that makes it easier to securely hash and manage passwords using the same underlying library as [crypt()](https://php-legacy-docs.zend.com/manual/php5/en/function.crypt.html) in PHP has been added. See the documentation for [password_hash()](https://php-legacy-docs.zend.com/manual/php5/en/function.password-hash.html) for more detail.

### [`foreach`](https://php-legacy-docs.zend.com/manual/php5/en/control-structures.foreach.html) now supports [list()](https://php-legacy-docs.zend.com/manual/php5/en/function.list.html)

The [foreach](https://php-legacy-docs.zend.com/manual/php5/en/control-structures.foreach.html) control structure now supports unpacking nested arrays into separate variables via the [list()](https://php-legacy-docs.zend.com/manual/php5/en/function.list.html) construct. For example:

    <?php
    $array = [
        [1, 2],
        [3, 4],
    ];

    foreach ($array as list($a, $b)) {
        echo "A: $a; B: $b\n";
    }
    ?>

The above example will output:

    A: 1; B: 2
    A: 3; B: 4

Further documentation is available on the [foreach](https://php-legacy-docs.zend.com/manual/php5/en/control-structures.foreach.html#control-structures.foreach.list) manual page.

### [empty()](https://php-legacy-docs.zend.com/manual/php5/en/function.empty.html) supports arbitrary expressions

Passing an arbitrary expression instead of a variable to [empty()](https://php-legacy-docs.zend.com/manual/php5/en/function.empty.html) is now supported. For example:

    <?php
    function always_false() {
        return false;
    }

    if (empty(always_false())) {
        echo "This will be printed.\n";
    }

    if (empty(true)) {
        echo "This will not be printed.\n";
    }
    ?>

The above example will output:

    This will be printed.

### [array](https://php-legacy-docs.zend.com/manual/php5/en/language.types.array.html) and [string](https://php-legacy-docs.zend.com/manual/php5/en/language.types.string.html) literal dereferencing

[Array](https://php-legacy-docs.zend.com/manual/php5/en/language.types.array.html) and [string](https://php-legacy-docs.zend.com/manual/php5/en/language.types.string.html) literals can now be dereferenced directly to access individual elements and characters:

    <?php
    echo 'Array dereferencing: ';
    echo [1, 2, 3][0];
    echo "\n";

    echo 'String dereferencing: ';
    echo 'PHP'[0];
    echo "\n";
    ?>

The above example will output:

    Array dereferencing: 1
    String dereferencing: P

### Class name resolution via [::class](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.basic.html#language.oop5.basic.class.class)

It is possible to use `ClassName::class` to get a fully qualified name of class `ClassName`. For example:

    <?php
    namespace Name\Space;
    class ClassName {}

    echo ClassName::class;

    echo "\n";
    ?>

The above example will output:

    Name\Space\ClassName

### [OPcache](https://php-legacy-docs.zend.com/manual/php5/en/book.opcache.html) extension added

The Zend Optimiser+ opcode cache has been added to PHP as the new [OPcache extension](https://php-legacy-docs.zend.com/manual/php5/en/book.opcache.html). OPcache improves PHP performance by storing precompiled script bytecode in shared memory, thereby removing the need for PHP to load and parse scripts on each request. See [the installation instructions](https://php-legacy-docs.zend.com/manual/php5/en/opcache.installation.html) for more detail on enabling and using OPcache.

### [`foreach`](https://php-legacy-docs.zend.com/manual/php5/en/control-structures.foreach.html) now supports non-scalar keys

[foreach](https://php-legacy-docs.zend.com/manual/php5/en/control-structures.foreach.html) now supports keys of any type. While non-scalar keys cannot occur in native PHP arrays, it is possible for [Iterator::key()](https://php-legacy-docs.zend.com/manual/php5/en/iterator.key.html) to return a value of any type, and this will now be handled correctly.

### Apache 2.4 handler supported on Windows

The Apache 2.4 handler SAPI is now supported on Windows.

### Improvements to GD

Various improvements have been made to the GD extension, these include:

- Flipping support using the new [imageflip()](https://php-legacy-docs.zend.com/manual/php5/en/function.imageflip.html) function.
- Advanced cropping support using the [imagecrop()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagecrop.html) & [imagecropauto()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagecropauto.html) functions.

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.new-features.php)

## New features

PHP 5.4.0 offers a wide range of new features:

- Support for [traits](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.traits.html) has been added.
- Short array syntax has been added, e.g. `$a = [1, 2, 3, 4];` or `$a = ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4];`.
- Function array dereferencing has been added, e.g. `foo()[0]`.
- [Closures](https://php-legacy-docs.zend.com/manual/php5/en/functions.anonymous.html) now support `$this`.
- `<?=` is now always available, regardless of the [short_open_tag](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.short-open-tag) `php.ini` option.
- Class member access on instantiation has been added, e.g. `(new Foo)->bar()`.
- `Class::{expr}()` syntax is now supported.
- Binary number format has been added, e.g. `0b001001101`.
- Improved parse error messages and improved incompatible arguments warnings.
- The session extension can now track the [upload progress](https://php-legacy-docs.zend.com/manual/php5/en/session.upload-progress.html) of files.
- Built-in development [web server in CLI mode](https://php-legacy-docs.zend.com/manual/php5/en/features.commandline.webserver.html).
- The GD extension now supports reading and writing of WebP images via [imagecreatefromwebp()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagecreatefromwebp.html) and [imagewebp()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagewebp.html), respectively.

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.new-features.php)

## New features

PHP 5.3.0 offers a wide range of new features:

- Support for [namespaces](https://php-legacy-docs.zend.com/manual/php5/en/language.namespaces.html) has been added.

- Support for [Late Static Bindings](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.late-static-bindings.html) has been added.

- Support for [jump labels](https://php-legacy-docs.zend.com/manual/php5/en/control-structures.goto.html) (limited goto) has been added.

- Support for native [Closures](https://php-legacy-docs.zend.com/manual/php5/en/functions.anonymous.html) (Lambda/Anonymous functions) has been added.

- There are two new magic methods, [\_\_callStatic()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.overloading.html#object.callstatic) and [\_\_invoke()](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.magic.html#object.invoke).

- [Nowdoc](https://php-legacy-docs.zend.com/manual/php5/en/language.types.string.html#language.types.string.syntax.nowdoc) syntax is now supported, similar to [Heredoc](https://php-legacy-docs.zend.com/manual/php5/en/language.types.string.html#language.types.string.syntax.heredoc) syntax, but with single quotes.

- It is now possible to use [Heredoc](https://php-legacy-docs.zend.com/manual/php5/en/language.types.string.html#language.types.string.syntax.heredoc)s to initialize static variables and class properties/constants.

- [Heredoc](https://php-legacy-docs.zend.com/manual/php5/en/language.types.string.html#language.types.string.syntax.heredoc)s may now be declared using double quotes, complementing the [Nowdoc](https://php-legacy-docs.zend.com/manual/php5/en/language.types.string.html#language.types.string.syntax.nowdoc) syntax.

- [Constants](https://php-legacy-docs.zend.com/manual/php5/en/language.constants.syntax.html) can now be declared outside a class using the `const` keyword.

- The [ternary](https://php-legacy-docs.zend.com/manual/php5/en/language.operators.comparison.html#language.operators.comparison.ternary) operator now has a shorthand form: `?:`.

- The HTTP stream wrapper now considers all status codes from 200 to 399 to be successful.

- Dynamic access to static methods is now possible:

      <?php
      class C {
         public static $foo = 123;
      }

      $a = "C";
      echo $a::$foo;
      ?>

  The above example will output:

      123

- [Exceptions](https://php-legacy-docs.zend.com/manual/php5/en/language.exceptions.html) can now be nested:

      <?php
      class MyCustomException extends Exception {}

      try {
          throw new MyCustomException("Exceptional", 112);
      } catch (Exception $e) {
          /* Note the use of the third parameter to pass $e
           * into the RuntimeException. */
          throw new RuntimeException("Rethrowing", 911, $e);
      }
      ?>

- A [garbage collector](https://php-legacy-docs.zend.com/manual/php5/en/features.gc.html) for circular references has been added, and is enabled by default.

- The [mail()](https://php-legacy-docs.zend.com/manual/php5/en/function.mail.html) function now supports logging of sent email via the [mail.log](https://php-legacy-docs.zend.com/manual/php5/en/mail.configuration.html#ini.mail.log) configuration directive. (Note: This only applies to email sent through this function.)
