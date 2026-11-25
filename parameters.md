# [Changed Functions in PHP 5.4, 5.3, 5.2](index.md)

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.parameters.php)

## Changed Functions

Several functions were given new, optional parameters in PHP 5.4:

PHP Core:

- Added the optional `limit` parameter to [debug_backtrace()](https://php-legacy-docs.zend.com/manual/php5/en/function.debug-backtrace.html) and [debug_print_backtrace()](https://php-legacy-docs.zend.com/manual/php5/en/function.debug-print-backtrace.html), to limit the amount of stack frames returned.
- [is_link()](https://php-legacy-docs.zend.com/manual/php5/en/function.is-link.html) now works properly for symbolic links on Windows Vista or later. Earlier systems do not support symbolic links.
- [parse_url()](https://php-legacy-docs.zend.com/manual/php5/en/function.parse-url.html) now recognizes the host when a scheme is omitted, and a leading component separator is present. As of PHP 5.4.7.

OpenSSL:

- Added a no padding option to the [openssl_encrypt()](https://php-legacy-docs.zend.com/manual/php5/en/function.openssl-encrypt.html) and [openssl_decrypt()](https://php-legacy-docs.zend.com/manual/php5/en/function.openssl-decrypt.html) functions.

Intl:

- [idn_to_ascii()](https://php-legacy-docs.zend.com/manual/php5/en/function.idn-to-ascii.html) and [idn_to_utf8()](https://php-legacy-docs.zend.com/manual/php5/en/function.idn-to-utf8.html) now take two extra parameters, one indicating the variant (IDNA 2003 or UTS \#46) and another, passed by reference, to return details about the operation in case UTS \#46 is chosen.

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.parameters.php)

## New Parameters

Several functions were given new, optional parameters in PHP 5.3:

PHP Core:

- [clearstatcache()](https://php-legacy-docs.zend.com/manual/php5/en/function.clearstatcache.html) - Added `clear_realpath_cache` and `filename`.
- [copy()](https://php-legacy-docs.zend.com/manual/php5/en/function.copy.html) - Added a stream context parameter, `context`.
- [fgetcsv()](https://php-legacy-docs.zend.com/manual/php5/en/function.fgetcsv.html) - Added `escape`.
- [ini_get_all()](https://php-legacy-docs.zend.com/manual/php5/en/function.ini-get-all.html) - Added `details`.
- [nl2br()](https://php-legacy-docs.zend.com/manual/php5/en/function.nl2br.html) - Added `is_xhtml`.
- [parse_ini_file()](https://php-legacy-docs.zend.com/manual/php5/en/function.parse-ini-file.html) - Added `scanner_mode`.
- [round()](https://php-legacy-docs.zend.com/manual/php5/en/function.round.html) - Added `mode`.
- [stream_context_create()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-context-create.html) - Added `params`.
- [strstr()](https://php-legacy-docs.zend.com/manual/php5/en/function.strstr.html) and [stristr()](https://php-legacy-docs.zend.com/manual/php5/en/function.stristr.html) - Added `before_needle`.

[json](https://php-legacy-docs.zend.com/manual/php5/en/book.json.html):

- [json_encode()](https://php-legacy-docs.zend.com/manual/php5/en/function.json-encode.html) - Added `options`.
- [json_decode()](https://php-legacy-docs.zend.com/manual/php5/en/function.json-decode.html) - Added `depth`.

[Streams](https://php-legacy-docs.zend.com/manual/php5/en/book.stream.html):

- [stream_select()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-select.html), [stream_set_blocking()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-set-blocking.html), [stream_set_timeout()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-set-timeout.html), and [stream_set_write_buffer()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-set-write-buffer.html) now work with user-space stream wrappers.

[sybase_ct](https://php-legacy-docs.zend.com/manual/php5/en/book.sybase.html):

- [sybase_connect()](https://php-legacy-docs.zend.com/manual/php5/en/function.sybase-connect.html) - Added `new`.

New method parameters in PHP 5.3.0:

PHP Core:

- [Exception::\_\_construct()](https://php-legacy-docs.zend.com/manual/php5/en/exception.construct.html) - Added `previous`.

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.parameters.php)

## New Parameters

Some functions were given new, optional, parameters in PHP 5.2.x:

PHP Core:

- [htmlentities()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlentities.html) - added `double_encode` in PHP 5.2.3.
- [htmlspecialchars()](https://php-legacy-docs.zend.com/manual/php5/en/function.htmlspecialchars.html) - added `double_encode` in PHP 5.2.3.
- [base64_decode()](https://php-legacy-docs.zend.com/manual/php5/en/function.base64-decode.html) - added `strict`
- [setcookie()](https://php-legacy-docs.zend.com/manual/php5/en/function.setcookie.html) - added `httponly`
- [setrawcookie()](https://php-legacy-docs.zend.com/manual/php5/en/function.setrawcookie.html) - added `httponly`
- [session_set_cookie_params()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-set-cookie-params.html) - added `httponly`
- [memory_get_usage()](https://php-legacy-docs.zend.com/manual/php5/en/function.memory-get-usage.html) - added `real_usage`
- [get_loaded_extensions()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-loaded-extensions.html) - added `zend_extensions` in PHP 5.2.4

[curl](https://php-legacy-docs.zend.com/manual/php5/en/ref.curl.html):

- [curl_multi_info_read()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-multi-info-read.html) - added `msgs_in_queue`

[datetime](https://php-legacy-docs.zend.com/manual/php5/en/ref.datetime.html)

- [date()](https://php-legacy-docs.zend.com/manual/php5/en/function.date.html) - added "u" (milliseconds) format character in PHP 5.2.2

[imap](https://php-legacy-docs.zend.com/manual/php5/en/ref.imap.html):

- [imap_open()](https://php-legacy-docs.zend.com/manual/php5/en/function.imap-open.html) - added `n_retries`
- [imap_reopen()](https://php-legacy-docs.zend.com/manual/php5/en/function.imap-reopen.html) - added `n_retries`

[mbstring](https://php-legacy-docs.zend.com/manual/php5/en/ref.mbstring.html):

- [mb_strrpos()](https://php-legacy-docs.zend.com/manual/php5/en/function.mb-strrpos.html) - added `offset`

  **Warning**

  The `offset` parameter was put in the position the `encoding` parameter used to be. Backward compatibility has been provided by allowing `encoding` to be specified as the third parameter. Using this backward compatibility mode is not recommended because it will be removed in a future release of PHP.

[ming](https://php-legacy-docs.zend.com/manual/php5/en/ref.ming.html):

- [SWFMovie::streamMP3()](https://php-legacy-docs.zend.com/manual/php5/en/swfmovie.streammp3.html) - added `skip` in PHP 5.2.1

[openssl](https://php-legacy-docs.zend.com/manual/php5/en/ref.openssl.html):

- [openssl_verify()](https://php-legacy-docs.zend.com/manual/php5/en/function.openssl-verify.html) - added `signature_algo`

[pgsql](https://php-legacy-docs.zend.com/manual/php5/en/ref.pgsql.html):

- [pg_escape_bytea()](https://php-legacy-docs.zend.com/manual/php5/en/function.pg-escape-bytea.html) - added `connection`
- [pg_escape_string()](https://php-legacy-docs.zend.com/manual/php5/en/function.pg-escape-string.html) - added `connection`

[simplexml](https://php-legacy-docs.zend.com/manual/php5/en/ref.simplexml.html):

- [SimpleXMLElement::\_\_construct()](https://php-legacy-docs.zend.com/manual/php5/en/simplexmlelement.construct.html) - added `is_prefix`
- [SimpleXMLElement::attributes()](https://php-legacy-docs.zend.com/manual/php5/en/simplexmlelement.attributes.html) - added `is_prefix`
- [SimpleXMLElement::children()](https://php-legacy-docs.zend.com/manual/php5/en/simplexmlelement.children.html) - added `is_prefix`
- [simplexml_load_file()](https://php-legacy-docs.zend.com/manual/php5/en/function.simplexml-load-file.html) - added `is_prefix`
- [simplexml_load_string()](https://php-legacy-docs.zend.com/manual/php5/en/function.simplexml-load-string.html) - added `is_prefix`

[spl](https://php-legacy-docs.zend.com/manual/php5/en/ref.spl.html):

- array iterator_to_array(Traversable it \[, bool use_keys = true\]) - added `use_keys` in PHP 5.2.1

[xmlreader](https://php-legacy-docs.zend.com/manual/php5/en/book.xmlreader.html):

- [XMLReader::open()](https://php-legacy-docs.zend.com/manual/php5/en/xmlreader.open.html) - added `encoding` and `options`
- [XMLReader::XML()](https://php-legacy-docs.zend.com/manual/php5/en/xmlreader.xml.html) - added `encoding` and `options`

[XMLWriter](https://php-legacy-docs.zend.com/manual/php5/en/ref.xmlwriter.html):

- [xmlwriter_write_element()](https://php-legacy-docs.zend.com/manual/php5/en/function.xmlwriter-write-element.html) - the `content` became optional in PHP 5.2.3
- [xmlwriter_write_element_ns()](https://php-legacy-docs.zend.com/manual/php5/en/function.xmlwriter-write-element-ns.html) - the `content` became optional in PHP 5.2.3
