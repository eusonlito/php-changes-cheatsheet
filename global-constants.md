# [New Global Constants in PHP 5.5, 5.4, 5.3, 5.2](index.md)

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.global-constants.php)

## New Global Constants

### [GD](https://php-legacy-docs.zend.com/manual/php5/en/book.image.html)

- **`IMG_AFFINE_TRANSLATE`**
- **`IMG_AFFINE_SCALE`**
- **`IMG_AFFINE_ROTATE`**
- **`IMG_AFFINE_SHEAR_HORIZONTAL`**
- **`IMG_AFFINE_SHEAR_VERTICAL`**
- **`IMG_CROP_DEFAULT`**
- **`IMG_CROP_TRANSPARENT`**
- **`IMG_CROP_BLACK`**
- **`IMG_CROP_WHITE`**
- **`IMG_CROP_SIDES`**
- **`IMG_FLIP_BOTH`**
- **`IMG_FLIP_HORIZONTAL`**
- **`IMG_FLIP_VERTICAL`**
- **`IMG_BELL`**
- **`IMG_BESSEL`**
- **`IMG_BICUBIC`**
- **`IMG_BICUBIC_FIXED`**
- **`IMG_BLACKMAN`**
- **`IMG_BOX`**
- **`IMG_BSPLINE`**
- **`IMG_CATMULLROM`**
- **`IMG_GAUSSIAN`**
- **`IMG_GENERALIZED_CUBIC`**
- **`IMG_HERMITE`**
- **`IMG_HAMMING`**
- **`IMG_HANNING`**
- **`IMG_MITCHELL`**
- **`IMG_POWER`**
- **`IMG_QUADRATIC`**
- **`IMG_SINC`**
- **`IMG_NEAREST_NEIGHBOUR`**
- **`IMG_WEIGHTED4`**
- **`IMG_TRIANGLE`**

### [JSON](https://php-legacy-docs.zend.com/manual/php5/en/book.json.html)

- [**`JSON_ERROR_RECURSION`**](https://php-legacy-docs.zend.com/manual/php5/en/json.constants.html#constant.json-error-recursion)
- [**`JSON_ERROR_INF_OR_NAN`**](https://php-legacy-docs.zend.com/manual/php5/en/json.constants.html#constant.json-error-inf-or-nan)
- [**`JSON_ERROR_UNSUPPORTED_TYPE`**](https://php-legacy-docs.zend.com/manual/php5/en/json.constants.html#constant.json-error-unsupported-type)
- [**`JSON_PARTIAL_OUTPUT_ON_ERROR`**](https://php-legacy-docs.zend.com/manual/php5/en/json.constants.html#constant.json-partial-output-on-error)

### [MySQLi](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html)

The **`MYSQLI_SERVER_PUBLIC_KEY`** option has been added for use with [mysqli_options()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.options.html).

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.global-constants.php)

## New Global Constants

PHP Core:

- **`ENT_DISALLOWED`**
- **`ENT_HTML401`**
- **`ENT_HTML5`**
- **`ENT_SUBSTITUTE`**
- **`ENT_XML1`**
- **`ENT_XHTML`**
- **`IPPROTO_IP`**
- **`IPPROTO_IPV6`**
- **`IPV6_MULTICAST_HOPS`**
- **`IPV6_MULTICAST_IF`**
- **`IPV6_MULTICAST_LOOP`**
- **`IP_MULTICAST_IF`**
- **`IP_MULTICAST_LOOP`**
- **`IP_MULTICAST_TTL`**
- **`MCAST_JOIN_GROUP`**
- **`MCAST_LEAVE_GROUP`**
- **`MCAST_BLOCK_SOURCE`**
- **`MCAST_UNBLOCK_SOURCE`**
- **`MCAST_JOIN_SOURCE_GROUP`**
- **`MCAST_LEAVE_SOURCE_GROUP`**

[Curl](https://php-legacy-docs.zend.com/manual/php5/en/book.curl.html):

- **`CURLOPT_MAX_RECV_SPEED_LARGE`**
- **`CURLOPT_MAX_SEND_SPEED_LARGE`**

[LibXML](https://php-legacy-docs.zend.com/manual/php5/en/book.libxml.html):

- **`LIBXML_HTML_NODEFDTD`**
- **`LIBXML_HTML_NOIMPLIED`**
- **`LIBXML_PEDANTIC`**

[OpenSSL](https://php-legacy-docs.zend.com/manual/php5/en/book.openssl.html):

- **`OPENSSL_CIPHER_AES_128_CBC`**
- **`OPENSSL_CIPHER_AES_192_CBC`**
- **`OPENSSL_CIPHER_AES_256_CBC`**
- **`OPENSSL_RAW_DATA`**
- **`OPENSSL_ZERO_PADDING`**

[Output buffering](https://php-legacy-docs.zend.com/manual/php5/en/book.outcontrol.html):

- **`PHP_OUTPUT_HANDLER_CLEAN`**
- **`PHP_OUTPUT_HANDLER_CLEANABLE`**
- **`PHP_OUTPUT_HANDLER_DISABLED`**
- **`PHP_OUTPUT_HANDLER_FINAL`**
- **`PHP_OUTPUT_HANDLER_FLUSH`**
- **`PHP_OUTPUT_HANDLER_FLUSHABLE`**
- **`PHP_OUTPUT_HANDLER_REMOVABLE`**
- **`PHP_OUTPUT_HANDLER_STARTED`**
- **`PHP_OUTPUT_HANDLER_STDFLAGS`**
- **`PHP_OUTPUT_HANDLER_WRITE`**

[Sessions](https://php-legacy-docs.zend.com/manual/php5/en/book.session.html):

- **`PHP_SESSION_ACTIVE`**
- **`PHP_SESSION_DISABLED`**
- **`PHP_SESSION_NONE`**

[Streams](https://php-legacy-docs.zend.com/manual/php5/en/book.stream.html):

- **`STREAM_META_ACCESS`**
- **`STREAM_META_GROUP`**
- **`STREAM_META_GROUP_NAME`**
- **`STREAM_META_OWNER`**
- **`STREAM_META_OWNER_NAME`**
- **`STREAM_META_TOUCH`**

[Zlib](https://php-legacy-docs.zend.com/manual/php5/en/book.zlib.html):

- **`ZLIB_ENCODING_DEFLATE`**
- **`ZLIB_ENCODING_GZIP`**
- **`ZLIB_ENCODING_RAW`**

[Intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html):

- **`U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR`**
- **`IDNA_CHECK_BIDI`**
- **`IDNA_CHECK_CONTEXTJ`**
- **`IDNA_NONTRANSITIONAL_TO_ASCII`**
- **`IDNA_NONTRANSITIONAL_TO_UNICODE`**
- **`INTL_IDNA_VARIANT_2003`**
- **`INTL_IDNA_VARIANT_UTS46`**
- **`IDNA_ERROR_EMPTY_LABEL`**
- **`IDNA_ERROR_LABEL_TOO_LONG`**
- **`IDNA_ERROR_DOMAIN_NAME_TOO_LONG`**
- **`IDNA_ERROR_LEADING_HYPHEN`**
- **`IDNA_ERROR_TRAILING_HYPHEN`**
- **`IDNA_ERROR_HYPHEN_3_4`**
- **`IDNA_ERROR_LEADING_COMBINING_MARK`**
- **`IDNA_ERROR_DISALLOWED`**
- **`IDNA_ERROR_PUNYCODE`**
- **`IDNA_ERROR_LABEL_HAS_DOT`**
- **`IDNA_ERROR_INVALID_ACE_LABEL`**
- **`IDNA_ERROR_BIDI`**
- **`IDNA_ERROR_CONTEXTJ`**

[Json](https://php-legacy-docs.zend.com/manual/php5/en/book.json.html):

- **`JSON_PRETTY_PRINT`**
- **`JSON_UNESCAPED_SLASHES`**
- **`JSON_NUMERIC_CHECK`**
- **`JSON_UNESCAPED_UNICODE`**
- **`JSON_BIGINT_AS_STRING`**

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.global-constants.php)

## New Global Constants

PHP Core:

- **`__DIR__`**
- **`__NAMESPACE__`**
- **`E_DEPRECATED`**
- **`E_USER_DEPRECATED`**
- **`INI_SCANNER_NORMAL`**
- **`INI_SCANNER_RAW`**
- **`PHP_MAXPATHLEN`**
- **`PHP_WINDOWS_NT_DOMAIN_CONTROLLER`**
- **`PHP_WINDOWS_NT_SERVER`**
- **`PHP_WINDOWS_NT_WORKSTATION`**
- **`PHP_WINDOWS_VERSION_BUILD`**
- **`PHP_WINDOWS_VERSION_MAJOR`**
- **`PHP_WINDOWS_VERSION_MINOR`**
- **`PHP_WINDOWS_VERSION_PLATFORM`**
- **`PHP_WINDOWS_VERSION_PRODUCTTYPE`**
- **`PHP_WINDOWS_VERSION_SP_MAJOR`**
- **`PHP_WINDOWS_VERSION_SP_MINOR`**
- **`PHP_WINDOWS_VERSION_SUITEMASK`**

[cURL](https://php-legacy-docs.zend.com/manual/php5/en/book.curl.html):

- **`CURLOPT_PROGRESSFUNCTION`**

[GD](https://php-legacy-docs.zend.com/manual/php5/en/book.image.html):

- **`IMG_FILTER_PIXELATE`**

[JSON](https://php-legacy-docs.zend.com/manual/php5/en/book.json.html):

- **`JSON_ERROR_CTRL_CHAR`**
- **`JSON_ERROR_DEPTH`**
- **`JSON_ERROR_NONE`**
- **`JSON_ERROR_STATE_MISMATCH`**
- **`JSON_ERROR_SYNTAX`**
- **`JSON_FORCE_OBJECT`**
- **`JSON_HEX_TAG`**
- **`JSON_HEX_AMP`**
- **`JSON_HEX_APOS`**
- **`JSON_HEX_QUOT`**

[LDAP](https://php-legacy-docs.zend.com/manual/php5/en/book.ldap.html):

- **`LDAP_OPT_NETWORK_TIMEOUT`**

[libxml](https://php-legacy-docs.zend.com/manual/php5/en/book.libxml.html):

- **`LIBXML_LOADED_VERSION `**

[PCRE](https://php-legacy-docs.zend.com/manual/php5/en/book.pcre.html):

- **`PREG_BAD_UTF8_OFFSET_ERROR`**

[PCNTL](https://php-legacy-docs.zend.com/manual/php5/en/book.pcntl.html):

- **`BUS_ADRALN`**
- **`BUS_ADRERR`**
- **`BUS_OBJERR`**
- **`CLD_CONTIUNED`**
- **`CLD_DUMPED`**
- **`CLD_EXITED`**
- **`CLD_KILLED`**
- **`CLD_STOPPED`**
- **`CLD_TRAPPED`**
- **`FPE_FLTDIV`**
- **`FPE_FLTINV`**
- **`FPE_FLTOVF`**
- **`FPE_FLTRES`**
- **`FPE_FLTSUB`**
- **`FPE_FLTUND`**
- **`FPE_INTDIV`**
- **`FPE_INTOVF`**
- **`ILL_BADSTK`**
- **`ILL_COPROC`**
- **`ILL_ILLADR`**
- **`ILL_ILLOPC`**
- **`ILL_ILLOPN`**
- **`ILL_ILLTRP`**
- **`ILL_PRVOPC`**
- **`ILL_PRVREG`**
- **`POLL_ERR`**
- **`POLL_HUP`**
- **`POLL_IN`**
- **`POLL_MSG`**
- **`POLL_OUT`**
- **`POLL_PRI`**
- **`SEGV_ACCERR`**
- **`SEGV_MAPERR`**
- **`SI_ASYNCIO`**
- **`SI_KERNEL`**
- **`SI_MESGQ`**
- **`SI_NOINFO`**
- **`SI_QUEUE`**
- **`SI_SIGIO`**
- **`SI_TIMER`**
- **`SI_TKILL`**
- **`SI_USER`**
- **`SIG_BLOCK`**
- **`SIG_SETMASK`**
- **`SIG_UNBLOCK`**
- **`TRAP_BRKPT`**
- **`TRAP_TRACE`**

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.global-constants.php)

## New Global Constants

PHP Core:

- **`M_EULER`**
- **`M_LNPI`**
- **`M_SQRT3`**
- **`M_SQRTPI`**
- **`PATHINFO_FILENAME`**
- **`PREG_BACKTRACK_LIMIT_ERROR`**
- **`PREG_BAD_UTF8_ERROR`**
- **`PREG_INTERNAL_ERROR`**
- **`PREG_NO_ERROR`**
- **`PREG_RECURSION_LIMIT_ERROR`**
- **`UPLOAD_ERR_EXTENSION`**
- **`STREAM_SHUT_RD`**
- **`STREAM_SHUT_WR`**
- **`STREAM_SHUT_RDWR`**

[curl](https://php-legacy-docs.zend.com/manual/php5/en/ref.curl.html):

- **`CURLE_FILESIZE_EXCEEDED`**
- **`CURLE_FTP_SSL_FAILED`**
- **`CURLE_LDAP_INVALID_URL`**
- **`CURLFTPAUTH_DEFAULT`**
- **`CURLFTPAUTH_SSL`**
- **`CURLFTPAUTH_TLS`**
- **`CURLFTPSSL_ALL`**
- **`CURLFTPSSL_CONTROL`**
- **`CURLFTPSSL_NONE`**
- **`CURLFTPSSL_TRY`**
- **`CURLOPT_FTP_SSL`**
- **`CURLOPT_FTPSSLAUTH`**
- **`CURLOPT_TCP_NODELAY`** Added in PHP 5.2.1.
- **`CURLOPT_TIMEOUT_MS`** Added in PHP 5.2.3
- **`CURLOPT_CONNECTTIMEOUT_MS`** Added in PHP 5.2.3

[GMP](https://php-legacy-docs.zend.com/manual/php5/en/ref.gmp.html):

- **`GMP_VERSION`** Added in PHP 5.2.2.

[ming](https://php-legacy-docs.zend.com/manual/php5/en/ref.ming.html):

- **`SWFTEXTFIELD_USEFONT`**
- **`SWFTEXTFIELD_AUTOSIZE`**
- **`SWF_SOUND_NOT_COMPRESSED`**
- **`SWF_SOUND_ADPCM_COMPRESSED`**
- **`SWF_SOUND_MP3_COMPRESSED`**
- **`SWF_SOUND_NOT_COMPRESSED_LE`**
- **`SWF_SOUND_NELLY_COMPRESSED`**
- **`SWF_SOUND_5KHZ`**
- **`SWF_SOUND_11KHZ`**
- **`SWF_SOUND_22KHZ`**
- **`SWF_SOUND_44KHZ`**
- **`SWF_SOUND_8BITS`**
- **`SWF_SOUND_16BITS`**
- **`SWF_SOUND_MONO`**
- **`SWF_SOUND_STEREO`**

[openssl](https://php-legacy-docs.zend.com/manual/php5/en/ref.openssl.html):

- **`OPENSSL_VERSION_NUMBER`**
- **`OPENSSL_VERSION_TEXT`**

[snmp](https://php-legacy-docs.zend.com/manual/php5/en/ref.snmp.html):

- **`SNMP_OID_OUTPUT_FULL`**
- **`SNMP_OID_OUTPUT_NUMERIC`**

[Semaphore](https://php-legacy-docs.zend.com/manual/php5/en/ref.sem.html):

- **`MSG_EAGAIN`**
- **`MSG_ENOMSG`**
