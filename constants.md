# [New Global Constants in PHP 8.6, 8.5, 8.4, 8.3, 8.2, 8.1, 7.4, 7.3, 7.2, 7.1, 7.0, 5.6](index.md)

# [PHP 8.6](https://www.php.net/manual/en/migration86.constants.php)

## New Global Constants

### Core

- **`ARRAY_FILTER_USE_VALUE`**
- **`STREAM_CRYPTO_STATUS_NONE`**
- **`STREAM_CRYPTO_STATUS_WANT_READ`**
- **`STREAM_CRYPTO_STATUS_WANT_WRITE`**

### cURL

- **`CURLINFO_SIZE_DELIVERED`** (libcurl \>= 8.20.0)
- **`CURLOPT_SEEKFUNCTION`**
- **`CURL_SEEKFUNC_OK`**
- **`CURL_SEEKFUNC_FAIL`**
- **`CURL_SEEKFUNC_CANTSEEK`**
- **`CURL_READFUNC_ABORT`**

### MySQLi

- **`MYSQLI_OPT_COMPRESS`**

### OpenSSL

- **`OPENSSL_RSA_PSS_SALTLEN_DIGEST`**
- **`OPENSSL_RSA_PSS_SALTLEN_AUTO`**
- **`OPENSSL_RSA_PSS_SALTLEN_MAX`**

### Sockets

- **`TCP_USER_TIMEOUT`** (Linux only)
- **`AF_UNSPEC`**
- **`EAI_BADFLAGS`**
- **`EAI_NONAME`**
- **`EAI_AGAIN`**
- **`EAI_FAIL`**
- **`EAI_NODATA`**
- **`EAI_FAMILY`**
- **`EAI_SOCKTYPE`**
- **`EAI_SERVICE`**
- **`EAI_ADDRFAMILY`**
- **`EAI_SYSTEM`**
- **`EAI_OVERFLOW`**
- **`EAI_INPROGRESS`**
- **`EAI_CANCELED`**
- **`EAI_NOTCANCELED`**
- **`EAI_ALLDONE`**
- **`EAI_INTR`**
- **`EAI_IDN_ENCODE`**
- **`SO_DETACH_REUSEPORT_BPF`** (Linux only)

### Sodium

- **`SODIUM_CRYPTO_IPCRYPT_BYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_KEYBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_ND_KEYBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_ND_TWEAKBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_ND_INPUTBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_ND_OUTPUTBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_NDX_KEYBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_NDX_TWEAKBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_NDX_INPUTBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_NDX_OUTPUTBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_PFX_KEYBYTES`**
- **`SODIUM_CRYPTO_IPCRYPT_PFX_BYTES`**
- **`SODIUM_CRYPTO_XOF_SHAKE128_BLOCKBYTES`**
- **`SODIUM_CRYPTO_XOF_SHAKE128_STATEBYTES`**
- **`SODIUM_CRYPTO_XOF_SHAKE256_BLOCKBYTES`**
- **`SODIUM_CRYPTO_XOF_SHAKE256_STATEBYTES`**
- **`SODIUM_CRYPTO_XOF_TURBOSHAKE128_BLOCKBYTES`**
- **`SODIUM_CRYPTO_XOF_TURBOSHAKE128_STATEBYTES`**
- **`SODIUM_CRYPTO_XOF_TURBOSHAKE256_BLOCKBYTES`**
- **`SODIUM_CRYPTO_XOF_TURBOSHAKE256_STATEBYTES`**
- **`SODIUM_CRYPTO_KEM_PUBLICKEYBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_SECRETKEYBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_CIPHERTEXTBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_SHAREDSECRETBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_SEEDBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_KEYPAIRBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_MLKEM768_PUBLICKEYBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_MLKEM768_SECRETKEYBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_MLKEM768_CIPHERTEXTBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_MLKEM768_SHAREDSECRETBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_MLKEM768_SEEDBYTES`** (libsodium \>= 1.0.22)
- **`SODIUM_CRYPTO_KEM_MLKEM768_KEYPAIRBYTES`** (libsodium \>= 1.0.22)

# [PHP 8.5](https://www.php.net/manual/en/migration85.constants.php)

## New Global Constants

### Core

- **[`PHP_BUILD_DATE`](https://www.php.net/manual/en/reserved.constants.php#constant.php-build-date)**
- **[`PHP_BUILD_PROVIDER`](https://www.php.net/manual/en/reserved.constants.php#constant.php-build-provider)**

### cURL

- **[`CURLINFO_USED_PROXY`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-used-proxy)**
- **[`CURLINFO_HTTPAUTH_USED`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-httpauth-used)**
- **[`CURLINFO_PROXYAUTH_USED`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-proxyauth-used)**
- **[`CURLINFO_CONN_ID`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-conn-id)**
- **[`CURLINFO_QUEUE_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-queue-time-t)**
- **[`CURLOPT_INFILESIZE_LARGE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-infilesize-large)**
- **[`CURLFOLLOW_ALL`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-all)**
- **[`CURLFOLLOW_OBEYCODE`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-obeycode)**
- **[`CURLFOLLOW_FIRSTONLY`](https://www.php.net/manual/en/curl.constants.php#constant.curlfollow-firstonly)**

### Filter

- **[`FILTER_THROW_ON_FAILURE`](https://www.php.net/manual/en/filter.constants.flags.generic.php#constant.filter-throw-on-failure)**

### Intl

- **`DECIMAL_COMPACT_SHORT`**
- **`DECIMAL_COMPACT_LONG`**

### OpenSSL

- **[`OPENSSL_PKCS1_PSS_PADDING`](https://www.php.net/manual/en/openssl.padding.php#constant.openssl-pkcs1-pss-padding)**
- **[`PKCS7_NOSMIMECAP`](https://www.php.net/manual/en/openssl.pkcs7.flags.php#constant.pkcs7-nosmimecap)**
- **[`PKCS7_CRLFEOL`](https://www.php.net/manual/en/openssl.pkcs7.flags.php#constant.pkcs7-crlfeol)**
- **[`PKCS7_NOCRL`](https://www.php.net/manual/en/openssl.pkcs7.flags.php#constant.pkcs7-nocrl)**
- **[`PKCS7_NO_DUAL_CONTENT`](https://www.php.net/manual/en/openssl.pkcs7.flags.php#constant.pkcs7-no-dual-content)**

### POSIX

- **[`POSIX_SC_OPEN_MAX`](https://www.php.net/manual/en/posix.constants.sysconf.php#constant.posix-sc-open-max)**

### Sockets

- **[`IPPROTO_ICMP`](https://www.php.net/manual/en/sockets.constants.php#constant.ipproto-icmp)**
- **[`IPPROTO_ICMPV6`](https://www.php.net/manual/en/sockets.constants.php#constant.ipproto-icmpv6)**
- **[`TCP_FUNCTION_BLK`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-function-blk)** (FreeBSD only)
- **[`TCP_FUNCTION_ALIAS`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-function-alias)** (FreeBSD only)
- **[`TCP_REUSPORT_LB_NUMA`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-reusport-lb-numa)** (FreeBSD only)
- **[`TCP_REUSPORT_LB_NUMA_NODOM`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-reusport-lb-numa-nodom)** (FreeBSD only)
- **[`TCP_REUSPORT_LB_NUMA_CURDOM`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-reusport-lb-numa-curdom)** (FreeBSD only)
- **[`TCP_BBR_ALGORITHM`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-bbr-algorithm)** (FreeBSD only)
- **[`AF_PACKET`](https://www.php.net/manual/en/sockets.constants.php#constant.af-packet)** (Linux only)
- **[`IP_BINDANY`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-bindany)** (FreeBSD/NetBSD/OpenBSD only)
- **[`SO_BUSY_POLL`](https://www.php.net/manual/en/sockets.constants.php#constant.so-busy-poll)** (Linux only)
- **[`UDP_SEGMENT`](https://www.php.net/manual/en/sockets.constants.php#constant.udp-segment)** (Linux only)
- **[`SHUT_RD`](https://www.php.net/manual/en/sockets.constants.php#constant.shut-rd)**
- **[`SHUT_WR`](https://www.php.net/manual/en/sockets.constants.php#constant.shut-wr)**
- **[`SHUT_RDWR`](https://www.php.net/manual/en/sockets.constants.php#constant.shut-rdwr)**

### Tokenizer

- **[`T_VOID_CAST`](https://www.php.net/manual/en/tokens.php#constant.t-void-cast)**
- **[`T_PIPE`](https://www.php.net/manual/en/tokens.php#constant.t-pipe)**

### Standard

- **[`IMAGETYPE_HEIF`](https://www.php.net/manual/en/image.constants.php#constant.imagetype-heif)**
- **[`IMAGETYPE_SVG`](https://www.php.net/manual/en/image.constants.php#constant.imagetype-svg)** when libxml is loaded.

# [PHP 8.4](https://www.php.net/manual/en/migration84.constants.php)

## New Global Constants

### Core

- **[`PHP_OUTPUT_HANDLER_PROCESSED`](https://www.php.net/manual/en/outcontrol.constants.php#constant.php-output-handler-processed)**
- **[`PHP_SBINDIR`](https://www.php.net/manual/en/reserved.constants.php#constant.php-sbindir)**

### cURL

- **[`CURL_HTTP_VERSION_3`](https://www.php.net/manual/en/curl.constants.php#constant.curl-http-version-3)**
- **[`CURL_HTTP_VERSION_3ONLY`](https://www.php.net/manual/en/curl.constants.php#constant.curl-http-version-3only)**
- **[`CURLOPT_TCP_KEEPCNT`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-tcp-keepcnt)**
- **[`CURLOPT_PREREQFUNCTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-prereqfunction)**
- **[`CURL_PREREQFUNC_OK`](https://www.php.net/manual/en/curl.constants.php#constant.curl-prereqfunc-ok)**
- **[`CURL_PREREQFUNC_ABORT`](https://www.php.net/manual/en/curl.constants.php#constant.curl-prereqfunc-abort)**
- **[`CURLOPT_SERVER_RESPONSE_TIMEOUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-server-response-timeout)**
- **[`CURLOPT_DEBUGFUNCTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-debugfunction)**
- **[`CURLINFO_TEXT`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-text)**
- **[`CURLINFO_HEADER_IN`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-header-in)**
- **[`CURLINFO_DATA_IN`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-data-in)**
- **[`CURLINFO_DATA_OUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-data-out)**
- **[`CURLINFO_SSL_DATA_OUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-ssl-data-out)**
- **[`CURLINFO_SSL_DATA_IN`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-ssl-data-in)**
- **[`CURLINFO_POSTTRANSFER_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-posttransfer-time-t)**

### Intl

- **`PATTERN`** ([IntlDateFormatter](https://www.php.net/manual/en/class.intldateformatter.php))
- **`PROPERTY_IDS_UNARY_OPERATOR`** ([IntlChar](https://www.php.net/manual/en/class.intlchar.php))
- **`PROPERTY_ID_COMPAT_MATH_START`**
- **`PROPERTY_ID_COMPAT_MATH_CONTINUE`**

### LDAP

- **[`LDAP_OPT_X_TLS_PROTOCOL_MAX`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-protocol-max)**
- **[`LDAP_OPT_X_TLS_PROTOCOL_TLS1_3`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-protocol-tls1-3)**

### libxml

- **[`LIBXML_RECOVER`](https://www.php.net/manual/en/libxml.constants.php#constant.libxml-recover)**
- **[`LIBXML_NO_XXE`](https://www.php.net/manual/en/libxml.constants.php#constant.libxml-no-xxe)**. This is used together with **[`LIBXML_NOENT`](https://www.php.net/manual/en/libxml.constants.php#constant.libxml-noent)** when entity substitution should be performed, while disallowing external entity loading. This constant is available as of libxml2 2.13.

### MySQLi

- **[`MYSQLI_TYPE_VECTOR`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-type-vector)**

### OpenSSL

- **[`X509_PURPOSE_OCSP_HELPER`](https://www.php.net/manual/en/openssl.purpose-check.php#constant.x509-purpose-ocsp-helper)**
- **[`X509_PURPOSE_TIMESTAMP_SIGN`](https://www.php.net/manual/en/openssl.purpose-check.php#constant.x509-purpose-timestamp-sign)**

### PCNTL

- **[`SIGCKPT`](https://www.php.net/manual/en/pcntl.constants.php#constant.sigckpt)** (DragonFlyBSD only)
- **[`SIGCKPTEXIT`](https://www.php.net/manual/en/pcntl.constants.php#constant.sigckptexit)** (DragonFlyBSD only)
- **[`WEXITED`](https://www.php.net/manual/en/pcntl.constants.php#constant.wexited)**
- **[`WSTOPPED`](https://www.php.net/manual/en/pcntl.constants.php#constant.wstopped)**
- **[`WNOWAIT`](https://www.php.net/manual/en/pcntl.constants.php#constant.wnowait)**
- **[`P_ALL`](https://www.php.net/manual/en/pcntl.constants.php#constant.p-all)**
- **[`P_PID`](https://www.php.net/manual/en/pcntl.constants.php#constant.p-pid)**
- **[`P_PGID`](https://www.php.net/manual/en/pcntl.constants.php#constant.p-pgid)**
- **[`P_PIDFD`](https://www.php.net/manual/en/pcntl.constants.php#constant.p-pidfd)** (Linux only)
- **[`P_UID`](https://www.php.net/manual/en/pcntl.constants.php#constant.p-uid)** (NetBSD/FreeBSD only)
- **[`P_GID`](https://www.php.net/manual/en/pcntl.constants.php#constant.p-gid)** (NetBSD/FreeBSD only)
- **[`P_SID`](https://www.php.net/manual/en/pcntl.constants.php#constant.p-sid)** (NetBSD/FreeBSD only)
- **[`P_JAILID`](https://www.php.net/manual/en/pcntl.constants.php#constant.p-jailid)** (FreeBSD only)

### PGSQL

- **[`PGSQL_TUPLES_CHUNK`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-tuples-chunk)**

### POSIX

- **[`POSIX_SC_CHILD_MAX`](https://www.php.net/manual/en/posix.constants.sysconf.php#constant.posix-sc-child-max)**
- **[`POSIX_SC_CLK_TCK`](https://www.php.net/manual/en/posix.constants.sysconf.php#constant.posix-sc-clk-tck)**

### Sockets

The following socket options are now defined if they are supported:

- **[`SO_EXCLUSIVEADDRUSE`](https://www.php.net/manual/en/sockets.constants.php#constant.so-exclusiveaddruse)** (Windows only)
- **[`SOCK_CONN_DGRAM`](https://www.php.net/manual/en/sockets.constants.php#constant.sock-conn-dgram)** (NetBSD only)
- **[`SOCK_DCCP`](https://www.php.net/manual/en/sockets.constants.php#constant.sock-dccp)** (NetBSD only)
- **[`TCP_SYNCNT`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-syncnt)** (Linux only)
- **[`SO_EXCLBIND`](https://www.php.net/manual/en/sockets.constants.php#constant.so-exclbind)** (Solaris/Illumos only)
- **[`SO_NOSIGPIPE`](https://www.php.net/manual/en/sockets.constants.php#constant.so-nosigpipe)** (macOS and FreeBSD)
- **[`SO_LINGER_SEC`](https://www.php.net/manual/en/sockets.constants.php#constant.so-linger-sec)** (macOS only)
- **[`IP_PORTRANGE`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-portrange)** (FreeBSD/NetBSD/OpenBSD only)
- **[`IP_PORTRANGE_DEFAULT`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-portrange-default)** (FreeBSD/NetBSD/OpenBSD only)
- **[`IP_PORTRANGE_HIGH`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-portrange-high)** (FreeBSD/NetBSD/OpenBSD only)
- **[`IP_PORTRANGE_LOW`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-portrange-low)** (FreeBSD/NetBSD/OpenBSD only)
- **[`SOCK_NONBLOCK`](https://www.php.net/manual/en/sockets.constants.php#constant.sock-nonblock)**
- **[`SOCK_CLOEXEC`](https://www.php.net/manual/en/sockets.constants.php#constant.sock-cloexec)**
- **[`SO_BINDTOIFINDEX`](https://www.php.net/manual/en/sockets.constants.php#constant.so-bindtoifindex)**

### Sodium

- **[`SODIUM_CRYPTO_AEAD_AEGIS128L_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aegis128l-keybytes)**
- **[`SODIUM_CRYPTO_AEAD_AEGIS128L_NSECBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aegis128l-nsecbytes)**
- **[`SODIUM_CRYPTO_AEAD_AEGIS128L_NPUBBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aegis128l-npubbytes)**
- **[`SODIUM_CRYPTO_AEAD_AEGIS128L_ABYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aegis128l-abytes)**
- **[`SODIUM_CRYPTO_AEAD_AEGIS256_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aegis256-keybytes)**
- **[`SODIUM_CRYPTO_AEAD_AEGIS256_NSECBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aegis256-nsecbytes)**
- **[`SODIUM_CRYPTO_AEAD_AEGIS256_NPUBBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aegis256-npubbytes)**
- **[`SODIUM_CRYPTO_AEAD_AEGIS256_ABYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aegis256-abytes)**

### Tokenizer

- **[`T_PUBLIC_SET`](https://www.php.net/manual/en/tokens.php#constant.t-public-set)**
- **[`T_PROTECTED_SET`](https://www.php.net/manual/en/tokens.php#constant.t-protected-set)**
- **[`T_PRIVATE_SET`](https://www.php.net/manual/en/tokens.php#constant.t-private-set)**

### XML

- **[`XML_OPTION_PARSE_HUGE`](https://www.php.net/manual/en/xml.constants.php#constant.xml-option-parse-huge)** which allows parsing large inputs with [xml_parse()](https://www.php.net/manual/en/function.xml-parse.php) and [xml_parse_into_struct()](https://www.php.net/manual/en/function.xml-parse-into-struct.php).

# [PHP 8.3](https://www.php.net/manual/en/migration83.constants.php)

## New Global Constants

### cURL

- **[`CURLINFO_CAPATH`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-capath)** (libcurl \>= 7.84.0)

- **[`CURLINFO_CAINFO`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-cainfo)** (libcurl \>= 7.84.0)

- **[`CURLOPT_MIME_OPTIONS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-mime-options)** (libcurl \>= 7.81.0)

- **[`CURLMIMEOPT_FORMESCAPE`](https://www.php.net/manual/en/curl.constants.php#constant.curlmimeopt-formescape)** (libcurl \>= 7.81.0)

- **[`CURLOPT_WS_OPTIONS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-ws-options)** (libcurl \>= 7.86.0)

- **[`CURLWS_RAW_MODE`](https://www.php.net/manual/en/curl.constants.php#constant.curlws-raw-mode)** (libcurl \>= 7.86.0)

- **[`CURLOPT_SSH_HOSTKEYFUNCTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-ssh-hostkeyfunction)** (libcurl \>= 7.84.0)

- **[`CURLOPT_PROTOCOLS_STR`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-protocols-str)** (libcurl \>= 7.85.0)

- **[`CURLOPT_REDIR_PROTOCOLS_STR`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-redir-protocols-str)** (libcurl \>= 7.85.0)

- **[`CURLOPT_CA_CACHE_TIMEOUT`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-ca-cache-timeout)** (libcurl \>= 7.87.0)

- **[`CURLOPT_QUICK_EXIT`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-quick-exit)** (libcurl \>= 7.87.0)

- **[`CURLKHMATCH_OK`](https://www.php.net/manual/en/curl.constants.php#constant.curlkhmatch-ok)** (libcurl \>= 7.19.6)

- **[`CURLKHMATCH_MISMATCH`](https://www.php.net/manual/en/curl.constants.php#constant.curlkhmatch-mismatch)** (libcurl \>= 7.19.6)

- **[`CURLKHMATCH_MISSING`](https://www.php.net/manual/en/curl.constants.php#constant.curlkhmatch-missing)** (libcurl \>= 7.19.6)

- **[`CURLKHMATCH_LAST`](https://www.php.net/manual/en/curl.constants.php#constant.curlkhmatch-last)** (libcurl \>= 7.19.6)

### Intl

- **`MIXED_NUMBERS`** ([Spoofchecker](https://www.php.net/manual/en/class.spoofchecker.php))

- **`HIDDEN_OVERLAY`** ([Spoofchecker](https://www.php.net/manual/en/class.spoofchecker.php))

### OpenSSL

- **[`OPENSSL_CMS_OLDMIMETYPE`](https://www.php.net/manual/en/openssl.cms.flags.php#constant.openssl-cms-oldmimetype)**

- **[`PKCS7_NOOLDMIMETYPE`](https://www.php.net/manual/en/openssl.pkcs7.flags.php#constant.pkcs7-nooldmimetype)**

### PCNTL

- **[`SIGINFO`](https://www.php.net/manual/en/pcntl.constants.php#constant.siginfo)**

### PDO_ODBC

- **[`PDO_ODBC_TYPE`](https://www.php.net/manual/en/ref.pdo-odbc.php#constant.pdo-odbc-type)**

### Posix

- **[`POSIX_SC_ARG_MAX`](https://www.php.net/manual/en/posix.constants.sysconf.php#constant.posix-sc-arg-max)**

- **[`POSIX_SC_PAGESIZE`](https://www.php.net/manual/en/posix.constants.sysconf.php#constant.posix-sc-pagesize)**

- **[`POSIX_SC_NPROCESSORS_CONF`](https://www.php.net/manual/en/posix.constants.sysconf.php#constant.posix-sc-nprocessors-conf)**

- **[`POSIX_SC_NPROCESSORS_ONLN`](https://www.php.net/manual/en/posix.constants.sysconf.php#constant.posix-sc-nprocessors-onln)**

- **[`POSIX_PC_LINK_MAX`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-link-max)**

- **[`POSIX_PC_MAX_CANON`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-max-canon)**

- **[`POSIX_PC_MAX_INPUT`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-max-input)**

- **[`POSIX_PC_NAME_MAX`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-name-max)**

- **[`POSIX_PC_PATH_MAX`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-path-max)**

- **[`POSIX_PC_PIPE_BUF`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-pipe-buf)**

- **[`POSIX_PC_CHOWN_RESTRICTED`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-chown-restricted)**

- **[`POSIX_PC_NO_TRUNC`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-no-trunc)**

- **[`POSIX_PC_ALLOC_SIZE_MIN`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-alloc-size-min)**

- **[`POSIX_PC_SYMLINK_MAX`](https://www.php.net/manual/en/posix.constants.pathconf.php#constant.posix-pc-symlink-max)**

### Sockets

The following socket options are now defined if they are supported:

- **[`SO_ATTACH_REUSEPORT_CBPF`](https://www.php.net/manual/en/sockets.constants.php#constant.so-attach-reuseport-cbpf)** (Linux)

- **[`SO_DETACH_BPF`](https://www.php.net/manual/en/sockets.constants.php#constant.so-detach-bpf)** (Linux)

- **[`SO_DETACH_FILTER`](https://www.php.net/manual/en/sockets.constants.php#constant.so-detach-filter)** (Linux)

- **[`TCP_QUICKACK`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-quickack)** (Linux)

- **[`IP_DONTFRAG`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-dontfrag)** (FreeBSD)

- **[`IP_MTU_DISCOVER`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-mtu-discover)** (Linux)

- **[`IP_PMTUDISC_DO`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-pmtudisc-do)** (Linux)

- **[`IP_PMTUDISC_DONT`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-pmtudisc-dont)** (Linux)

- **[`IP_PMTUDISC_WANT`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-pmtudisc-want)** (Linux)

- **[`IP_PMTUDISC_PROBE`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-pmtudisc-probe)** (Linux)

- **[`IP_PMTUDISC_INTERFACE`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-pmtudisc-interface)** (Linux)

- **[`IP_PMTUDISC_OMIT`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-pmtudisc-omit)** (Linux)

- **[`AF_DIVERT`](https://www.php.net/manual/en/sockets.constants.php#constant.af-divert)** (FreeBSD)

- **[`SOL_UDPLITE`](https://www.php.net/manual/en/sockets.constants.php#constant.sol-udplite)**

- **[`UDPLITE_RECV_CSCOV`](https://www.php.net/manual/en/sockets.constants.php#constant.udplite-recv-cscov)**

- **[`UDPLITE_SEND_CSCOV`](https://www.php.net/manual/en/sockets.constants.php#constant.udplite-send-cscov)**

- **[`SO_RERROR`](https://www.php.net/manual/en/sockets.constants.php#constant.so-rerror)** (NetBSD)

- **[`SO_ZEROIZE`](https://www.php.net/manual/en/sockets.constants.php#constant.so-zeroize)** (OpenBSD)

- **[`SO_SPLICE`](https://www.php.net/manual/en/sockets.constants.php#constant.so-splice)** (OpenBSD)

- **[`TCP_REPAIR`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-repair)** (Linux)

- **[`SO_REUSEPORT_LB`](https://www.php.net/manual/en/sockets.constants.php#constant.so-reuseport-lb)** (FreeBSD)

- **[`IP_BIND_ADDRESS_NO_PORT`](https://www.php.net/manual/en/sockets.constants.php#constant.ip-bind-address-no-port)** (Linux)

### Zip

- **[`ZipArchive::ER_DATA_LENGTH`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.er-data-length)** (libzip \>= 1.10)

- **[`ZipArchive::ER_NOT_ALLOWED`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.er-not-allowed)** (libzip \>= 1.10)

- **[`ZipArchive::AFL_RDONLY`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.afl-rdonly)** (libzip \>= 1.10)

- **[`ZipArchive::AFL_IS_TORRENTZIP`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.afl-is-torrentzip)** (libzip \>= 1.10)

- **[`ZipArchive::AFL_WANT_TORRENTZIP`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.afl-want-torrentzip)** (libzip \>= 1.10)

- **[`ZipArchive::AFL_CREATE_OR_KEEP_FILE_FOR_EMPTY_ARCHIVE`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.afl-create-or-keep-file-for-empty-archive)** (libzip \>= 1.10)

- **[`ZipArchive::FL_OPEN_FILE_NOW`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.fl-open-file-now)**

- **[`ZipArchive::LENGTH_TO_END`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.length-to-end)** as default value for [ZipArchive::addFile()](https://www.php.net/manual/en/ziparchive.addfile.php) and [ZipArchive::replaceFile()](https://www.php.net/manual/en/ziparchive.replacefile.php)

- **[`ZipArchive::LENGTH_UNCHECKED`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.length-unchecked)** (libzip \>= 1.10)

# [PHP 8.2](https://www.php.net/manual/en/migration82.constants.php)

## New Global Constants

### COM

- **[`DISP_E_PARAMNOTFOUND`](https://www.php.net/manual/en/com.constants.php#constant.disp-e-paramnotfound)**

- **[`LOCALE_NEUTRAL`](https://www.php.net/manual/en/com.constants.php#constant.locale-neutral)**

### cURL

- **[`CURLALTSVC_H1`](https://www.php.net/manual/en/curl.constants.php#constant.curlaltsvc-h1)** (libcurl \>= 7.64.1)

- **[`CURLALTSVC_H2`](https://www.php.net/manual/en/curl.constants.php#constant.curlaltsvc-h2)** (libcurl \>= 7.64.1)

- **[`CURLALTSVC_H3`](https://www.php.net/manual/en/curl.constants.php#constant.curlaltsvc-h3)** (libcurl \>= 7.64.1)

- **[`CURLALTSVC_READONLYFILE`](https://www.php.net/manual/en/curl.constants.php#constant.curlaltsvc-readonlyfile)** (libcurl \>= 7.64.1)

- **[`CURLAUTH_AWS_SIGV4`](https://www.php.net/manual/en/curl.constants.php#constant.curlauth-aws-sigv4)** (libcurl \>= 7.75.0)

- **[`CURLE_PROXY`](https://www.php.net/manual/en/curl.constants.php#constant.curle-proxy)** (libcurl \>= 7.73.0)

- **[`CURLFTPMETHOD_DEFAULT`](https://www.php.net/manual/en/curl.constants.php#constant.curlftpmethod-default)**

- **[`CURLHSTS_ENABLE`](https://www.php.net/manual/en/curl.constants.php#constant.curlhsts-enable)** (libcurl \>= 7.74.0)

- **[`CURLHSTS_READONLYFILE`](https://www.php.net/manual/en/curl.constants.php#constant.curlhsts-readonlyfile)** (libcurl \>= 7.74.0)

- **[`CURLINFO_PROXY_ERROR`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-proxy-error)** (libcurl \>= 7.73.0)

- **[`CURLINFO_REFERER`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-referer)** (libcurl \>= 7.76.0)

- **[`CURLINFO_RETRY_AFTER`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-retry-after)** (libcurl \>= 7.66.0)

- **[`CURLMOPT_MAX_CONCURRENT_STREAMS`](https://www.php.net/manual/en/curl.constants.php#constant.curlmopt-max-concurrent-streams)** (libcurl \>= 7.67.0)

- **[`CURLOPT_ALTSVC_CTRL`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-altsvc-ctrl)** (libcurl \>= 7.64.1)

- **[`CURLOPT_ALTSVC`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-altsvc)** (libcurl \>= 7.64.1)

- **[`CURLOPT_AWS_SIGV4`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-aws-sigv4)** (libcurl \>= 7.75.0)

- **[`CURLOPT_CAINFO_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-cainfo-blob)** (libcurl \>= 7.77.0)

- **[`CURLOPT_DOH_SSL_VERIFYHOST`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-doh-ssl-verifyhost)** (libcurl \>= 7.76.0)

- **[`CURLOPT_DOH_SSL_VERIFYPEER`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-doh-ssl-verifypeer)** (libcurl \>= 7.76.0)

- **[`CURLOPT_DOH_SSL_VERIFYSTATUS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-doh-ssl-verifystatus)** (libcurl \>= 7.76.0)

- **[`CURLOPT_HSTS_CTRL`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-hsts-ctrl)** (libcurl \>= 7.74.0)

- **[`CURLOPT_HSTS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-hsts)** (libcurl \>= 7.74.0)

- **[`CURLOPT_MAIL_RCPT_ALLLOWFAILS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-mail-rcpt-alllowfails)** (libcurl \>= 7.69.0)

- **[`CURLOPT_MAXAGE_CONN`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-maxage-conn)** (libcurl \>= 7.65.0)

- **[`CURLOPT_MAXFILESIZE_LARGE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-maxfilesize-large)**

- **[`CURLOPT_MAXLIFETIME_CONN`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-maxlifetime-conn)** (libcurl \>= 7.80.0)

- **[`CURLOPT_PROXY_CAINFO_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-cainfo-blob)** (libcurl \>= 7.77.0)

- **[`CURLOPT_SASL_AUTHZID`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-sasl-authzid)** (libcurl \>= 7.66.0)

- **[`CURLOPT_SSH_HOST_PUBLIC_KEY_SHA256`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-ssh-host-public-key-sha256)** (libcurl \>= 7.80.0)

- **[`CURLOPT_SSL_EC_CURVES`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-ssl-ec-curves)** (libcurl \>= 7.73.0)

- **[`CURLOPT_UPKEEP_INTERVAL_MS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-upkeep-interval-ms)** (libcurl \>= 7.62.0)

- **[`CURLOPT_UPLOAD_BUFFERSIZE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-upload-buffersize)** (libcurl \>= 7.62.0)

- **[`CURLOPT_XFERINFOFUNCTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-xferinfofunction)** (libcurl \>= 7.32.0)

- **[`CURLPROTO_MQTT`](https://www.php.net/manual/en/curl.constants.php#constant.curlproto-mqtt)** (libcurl \>= 7.71.0)

- **[`CURLPX_BAD_ADDRESS_TYPE`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-bad-address-type)** (libcurl \>= 7.73.0)

- **[`CURLPX_BAD_VERSION`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-bad-version)** (libcurl \>= 7.73.0)

- **[`CURLPX_CLOSED`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-closed)** (libcurl \>= 7.73.0)

- **[`CURLPX_GSSAPI`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-gssapi)** (libcurl \>= 7.73.0)

- **[`CURLPX_GSSAPI_PERMSG`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-gssapi-permsg)** (libcurl \>= 7.73.0)

- **[`CURLPX_GSSAPI_PROTECTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-gssapi-protection)** (libcurl \>= 7.73.0)

- **[`CURLPX_IDENTD_DIFFER`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-identd-differ)** (libcurl \>= 7.73.0)

- **[`CURLPX_IDENTD`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-identd)** (libcurl \>= 7.73.0)

- **[`CURLPX_LONG_HOSTNAME`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-long-hostname)** (libcurl \>= 7.73.0)

- **[`CURLPX_LONG_PASSWD`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-long-passwd)** (libcurl \>= 7.73.0)

- **[`CURLPX_LONG_USER`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-long-user)** (libcurl \>= 7.73.0)

- **[`CURLPX_NO_AUTH`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-no-auth)** (libcurl \>= 7.73.0)

- **[`CURLPX_OK`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-ok)** (libcurl \>= 7.73.0)

- **[`CURLPX_RECV_ADDRESS`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-recv-address)** (libcurl \>= 7.73.0)

- **[`CURLPX_RECV_AUTH`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-recv-auth)** (libcurl \>= 7.73.0)

- **[`CURLPX_RECV_CONNECT`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-recv-connect)** (libcurl \>= 7.73.0)

- **[`CURLPX_RECV_REQACK`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-recv-reqack)** (libcurl \>= 7.73.0)

- **[`CURLPX_REPLY_ADDRESS_TYPE_NOT_SUPPORTED`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-reply-address-type-not-supported)** (libcurl \>= 7.73.0)

- **[`CURLPX_REPLY_COMMAND_NOT_SUPPORTED`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-reply-command-not-supported)** (libcurl \>= 7.73.0)

- **[`CURLPX_REPLY_CONNECTION_REFUSED`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-reply-connection-refused)** (libcurl \>= 7.73.0)

- **[`CURLPX_REPLY_GENERAL_SERVER_FAILURE`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-reply-general-server-failure)** (libcurl \>= 7.73.0)

- **[`CURLPX_REPLY_HOST_UNREACHABLE`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-reply-host-unreachable)** (libcurl \>= 7.73.0)

- **[`CURLPX_REPLY_NETWORK_UNREACHABLE`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-reply-network-unreachable)** (libcurl \>= 7.73.0)

- **[`CURLPX_REPLY_NOT_ALLOWED`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-reply-not-allowed)** (libcurl \>= 7.73.0)

- **[`CURLPX_REPLY_TTL_EXPIRED`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-reply-ttl-expired)** (libcurl \>= 7.73.0)

- **[`CURLPX_REPLY_UNASSIGNED`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-reply-unassigned)** (libcurl \>= 7.73.0)

- **[`CURLPX_REQUEST_FAILED`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-request-failed)** (libcurl \>= 7.73.0)

- **[`CURLPX_RESOLVE_HOST`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-resolve-host)** (libcurl \>= 7.73.0)

- **[`CURLPX_SEND_AUTH`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-send-auth)** (libcurl \>= 7.73.0)

- **[`CURLPX_SEND_CONNECT`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-send-connect)** (libcurl \>= 7.73.0)

- **[`CURLPX_SEND_REQUEST`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-send-request)** (libcurl \>= 7.73.0)

- **[`CURLPX_UNKNOWN_FAIL`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-unknown-fail)** (libcurl \>= 7.73.0)

- **[`CURLPX_UNKNOWN_MODE`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-unknown-mode)** (libcurl \>= 7.73.0)

- **[`CURLPX_USER_REJECTED`](https://www.php.net/manual/en/curl.constants.php#constant.curlpx-user-rejected)** (libcurl \>= 7.73.0)

- **[`CURLSSLOPT_AUTO_CLIENT_CERT`](https://www.php.net/manual/en/curl.constants.php#constant.curlsslopt-auto-client-cert)** (libcurl \>= 7.77.0)

- **[`CURLSSLOPT_NATIVE_CA`](https://www.php.net/manual/en/curl.constants.php#constant.curlsslopt-native-ca)** (libcurl \>= 7.71.0)

- **[`CURLSSLOPT_NO_PARTIALCHAIN`](https://www.php.net/manual/en/curl.constants.php#constant.curlsslopt-no-partialchain)** (libcurl \>= 7.68.0)

- **[`CURLSSLOPT_REVOKE_BEST_EFFORT`](https://www.php.net/manual/en/curl.constants.php#constant.curlsslopt-revoke-best-effort)** (libcurl \>= 7.70.0)

- **[`CURL_VERSION_GSASL`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-gsasl)** (libcurl \>= 7.76.0)

- **[`CURL_VERSION_HSTS`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-hsts)** (libcurl \>= 7.74.0)

- **[`CURL_VERSION_HTTP3`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-http3)** (libcurl \>= 7.66.0)

- **[`CURL_VERSION_UNICODE`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-unicode)** (libcurl \>= 7.72.0)

- **[`CURL_VERSION_ZSTD`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-zstd)** (libcurl \>= 7.72.0)

### DBA

- **[`DBA_LMDB_USE_SUB_DIR`](https://www.php.net/manual/en/dba.constants.php#constant.dba-lmdb-use-sub-dir)**

- **[`DBA_LMDB_NO_SUB_DIR`](https://www.php.net/manual/en/dba.constants.php#constant.dba-lmdb-no-sub-dir)**

### Filter

- **[`FILTER_FLAG_GLOBAL_RANGE`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-flag-global-range)**

### Sockets

The following socket options are now defined if they are supported:

- **[`SO_INCOMING_CPU`](https://www.php.net/manual/en/sockets.constants.php#constant.so-incoming-cpu)**

- **[`SO_MEMINFO`](https://www.php.net/manual/en/sockets.constants.php#constant.so-meminfo)**

- **[`SO_RTABLE`](https://www.php.net/manual/en/sockets.constants.php#constant.so-rtable)** (OpenBSD)

- **[`TCP_KEEPALIVE`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-keepalive)** (MacOS)

- **[`TCP_KEEPCNT`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-keepcnt)** (Linux, others)

- **[`TCP_KEEPIDLE`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-keepidle)** (Linux, others)

- **[`TCP_KEEPINTVL`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-keepintvl)** (Linux, others)

- **[`TCP_NOTSENT_LOWAT`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-notsent-lowat)**

- **[`LOCAL_CREDS_PERSISTENT`](https://www.php.net/manual/en/sockets.constants.php#constant.local-creds-persistent)** (FreeBSD)

- **[`SCM_CREDS2`](https://www.php.net/manual/en/sockets.constants.php#constant.scm-creds2)** (FreeBSD)

- **[`LOCAL_CREDS`](https://www.php.net/manual/en/sockets.constants.php#constant.local-creds)** (NetBSD)

- **[`SO_BPF_EXTENSIONS`](https://www.php.net/manual/en/sockets.constants.php#constant.so-bpf-extensions)**

- **[`SO_SETFIB`](https://www.php.net/manual/en/sockets.constants.php#constant.so-setfib)**

- **[`TCP_CONGESTION`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-congestion)** (Linux, FreeBSD)

- **[`SO_ZEROCOPY`](https://www.php.net/manual/en/sockets.constants.php#constant.so-zerocopy)** (Linux)

- **[`MSG_ZEROCOPY`](https://www.php.net/manual/en/sockets.constants.php#constant.msg-zerocopy)** (Linux)

# [PHP 8.1](https://www.php.net/manual/en/migration81.constants.php)

## New Global Constants

### cURL

- **[`CURLOPT_DOH_URL`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-doh-url)**

- **[`CURLOPT_ISSUERCERT_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-issuercert-blob)**

- **[`CURLOPT_PROXY_ISSUERCERT`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-issuercert)**

- **[`CURLOPT_PROXY_ISSUERCERT_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-issuercert-blob)**

- **[`CURLOPT_PROXY_SSLCERT_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-sslcert-blob)**

- **[`CURLOPT_PROXY_SSLKEY_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-sslkey-blob)**

- **[`CURLOPT_SSLCERT_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-sslcert-blob)**

- **[`CURLOPT_SSLKEY_BLOB`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-sslkey-blob)**

### GD

- **[`IMG_AVIF`](https://www.php.net/manual/en/image.constants.php#constant.img-avif)**

- **[`IMG_WEBP_LOSSLESS`](https://www.php.net/manual/en/image.constants.php#constant.img-webp-lossless)**

### MySQLi

- **[`MYSQLI_REFRESH_REPLICA`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-refresh-replica)**

  This constant has been added as a replacement for **[`MYSQLI_REFRESH_SLAVE`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-refresh-slave)**, in line with an upstream change in MySQL. The old constant is still available for backwards-compatibility reasons, but may be deprecated/removed in the future.

### PCNTL

- **[`PRIO_DARWIN_BG`](https://www.php.net/manual/en/pcntl.constants.php#constant.prio-darwin-bg)**

- **[`PRIO_DARWIN_THREAD`](https://www.php.net/manual/en/pcntl.constants.php#constant.prio-darwin-thread)**

### POSIX

- **[`POSIX_RLIMIT_KQUEUES`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-kqueues)**

- **[`POSIX_RLIMIT_NPTS`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-npts)**

### Sockets

The following socket options are now defined if they are supported:

- **[`SO_ACCEPTFILTER`](https://www.php.net/manual/en/sockets.constants.php#constant.so-acceptfilter)**

- **[`SO_DONTTRUNC`](https://www.php.net/manual/en/sockets.constants.php#constant.so-donttrunc)**

- **[`SO_WANTMORE`](https://www.php.net/manual/en/sockets.constants.php#constant.so-wantmore)**

- **[`SO_MARK`](https://www.php.net/manual/en/sockets.constants.php#constant.so-mark)**

- **[`TCP_DEFER_ACCEPT`](https://www.php.net/manual/en/sockets.constants.php#constant.tcp-defer-accept)**

### Sodium

- **[`SODIUM_CRYPTO_STREAM_XCHACHA20_NONCEBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-stream-xchacha20-noncebytes)**

- **[`SODIUM_CRYPTO_STREAM_XCHACHA20_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-stream-xchacha20-keybytes)**

- **[`SODIUM_CRYPTO_SCALARMULT_RISTRETTO255_BYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-scalarmult-ristretto255-bytes)**

- **[`SODIUM_CRYPTO_SCALARMULT_RISTRETTO255_SCALARBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-scalarmult-ristretto255-scalarbytes)**

- **[`SODIUM_CRYPTO_CORE_RISTRETTO255_BYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-core-ristretto255-bytes)**

- **[`SODIUM_CRYPTO_CORE_RISTRETTO255_HASHBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-core-ristretto255-hashbytes)**

- **[`SODIUM_CRYPTO_CORE_RISTRETTO255_SCALARBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-core-ristretto255-scalarbytes)**

- **[`SODIUM_CRYPTO_CORE_RISTRETTO255_NONREDUCEDSCALARBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-core-ristretto255-nonreducedscalarbytes)**

### Standard

- **[`IMAGETYPE_AVIF`](https://www.php.net/manual/en/image.constants.php#constant.imagetype-avif)**

### Tokenizer

- **[`T_READONLY`](https://www.php.net/manual/en/tokens.php#constant.t-readonly)**

# [PHP 7.4](https://www.php.net/manual/en/migration74.constants.php)

## New Global Constants

### PHP Core

- **[`PHP_WINDOWS_EVENT_CTRL_C`](https://www.php.net/manual/en/reserved.constants.php#constant.php-windows-event-ctrl-c)**

- **[`PHP_WINDOWS_EVENT_CTRL_BREAK`](https://www.php.net/manual/en/reserved.constants.php#constant.php-windows-event-ctrl-break)**

### Multibyte String

- **[`MB_ONIGURUMA_VERSION`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-oniguruma-version)**

### Sockets

Added the following FreeBSD-specific socket options:

- **[`SO_LABEL`](https://www.php.net/manual/en/sockets.constants.php#constant.so-label)**

- **[`SO_PEERLABEL`](https://www.php.net/manual/en/sockets.constants.php#constant.so-peerlabel)**

- **[`SO_LISTENQLIMIT`](https://www.php.net/manual/en/sockets.constants.php#constant.so-listenqlimit)**

- **[`SO_LISTENQLEN`](https://www.php.net/manual/en/sockets.constants.php#constant.so-listenqlen)**

- **[`SO_USER_COOKIE`](https://www.php.net/manual/en/sockets.constants.php#constant.so-user-cookie)**

### Tidy

- **[`TIDY_TAG_ARTICLE`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-article)**

- **[`TIDY_TAG_ASIDE`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-aside)**

- **[`TIDY_TAG_AUDIO`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-audio)**

- **[`TIDY_TAG_BDI`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-bdi)**

- **[`TIDY_TAG_CANVAS`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-canvas)**

- **[`TIDY_TAG_COMMAND`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-command)**

- **[`TIDY_TAG_DATALIST`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-datalist)**

- **[`TIDY_TAG_DETAILS`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-details)**

- **[`TIDY_TAG_DIALOG`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-dialog)**

- **[`TIDY_TAG_FIGCAPTION`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-figcaption)**

- **[`TIDY_TAG_FIGURE`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-figure)**

- **[`TIDY_TAG_FOOTER`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-footer)**

- **[`TIDY_TAG_HEADER`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-header)**

- **[`TIDY_TAG_HGROUP`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-hgroup)**

- **[`TIDY_TAG_MAIN`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-main)**

- **[`TIDY_TAG_MARK`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-mark)**

- **[`TIDY_TAG_MENUITEM`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-menuitem)**

- **[`TIDY_TAG_METER`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-meter)**

- **[`TIDY_TAG_NAV`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-nav)**

- **[`TIDY_TAG_OUTPUT`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-output)**

- **[`TIDY_TAG_PROGRESS`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-progress)**

- **[`TIDY_TAG_SECTION`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-section)**

- **[`TIDY_TAG_SOURCE`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-source)**

- **[`TIDY_TAG_SUMMARY`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-summary)**

- **[`TIDY_TAG_TEMPLATE`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-template)**

- **[`TIDY_TAG_TIME`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-time)**

- **[`TIDY_TAG_TRACK`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-track)**

- **[`TIDY_TAG_VIDEO`](https://www.php.net/manual/en/tidy.constants.php#constant.tidy-tag-video)**

# [PHP 7.3](https://www.php.net/manual/en/migration73.constants.php)

## New Global Constants

### PHP Core

- **[`PASSWORD_ARGON2ID`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2id)**

### Client URL Library

- **[`CURLAUTH_BEARER`](https://www.php.net/manual/en/curl.constants.php#constant.curlauth-bearer)**

- **[`CURLAUTH_GSSAPI`](https://www.php.net/manual/en/curl.constants.php#constant.curlauth-gssapi)**

- **[`CURLE_WEIRD_SERVER_REPLY`](https://www.php.net/manual/en/curl.constants.php#constant.curle-weird-server-reply)**

- **[`CURLINFO_APPCONNECT_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-appconnect-time-t)**

- **[`CURLINFO_CONNECT_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-connect-time-t)**

- **[`CURLINFO_CONTENT_LENGTH_DOWNLOAD_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-content-length-download-t)**

- **[`CURLINFO_CONTENT_LENGTH_UPLOAD_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-content-length-upload-t)**

- **[`CURLINFO_FILETIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-filetime-t)**

- **[`CURLINFO_HTTP_VERSION`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-http-version)**

- **[`CURLINFO_NAMELOOKUP_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-namelookup-time-t)**

- **[`CURLINFO_PRETRANSFER_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-pretransfer-time-t)**

- **[`CURLINFO_PROTOCOL`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-protocol)**

- **[`CURLINFO_PROXY_SSL_VERIFYRESULT`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-proxy-ssl-verifyresult)**

- **[`CURLINFO_REDIRECT_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-redirect-time-t)**

- **[`CURLINFO_SCHEME`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-scheme)**

- **[`CURLINFO_SIZE_DOWNLOAD_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-size-download-t)**

- **[`CURLINFO_SIZE_UPLOAD_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-size-upload-t)**

- **[`CURLINFO_SPEED_DOWNLOAD_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-speed-download-t)**

- **[`CURLINFO_SPEED_UPLOAD_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-speed-upload-t)**

- **[`CURLINFO_STARTTRANSFER_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-starttransfer-time-t)**

- **[`CURLINFO_TOTAL_TIME_T`](https://www.php.net/manual/en/curl.constants.php#constant.curlinfo-total-time-t)**

- **[`CURL_LOCK_DATA_CONNECT`](https://www.php.net/manual/en/curl.constants.php#constant.curl-lock-data-connect)**

- **[`CURL_LOCK_DATA_PSL`](https://www.php.net/manual/en/curl.constants.php#constant.curl-lock-data-psl)**

- **[`CURL_MAX_READ_SIZE`](https://www.php.net/manual/en/curl.constants.php#constant.curl-max-read-size)**

- **[`CURLOPT_ABSTRACT_UNIX_SOCKET`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-abstract-unix-socket)**

- **[`CURLOPT_DISALLOW_USERNAME_IN_URL`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-disallow-username-in-url)**

- **[`CURLOPT_DNS_SHUFFLE_ADDRESSES`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-dns-shuffle-addresses)**

- **[`CURLOPT_HAPPY_EYEBALLS_TIMEOUT_MS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-happy-eyeballs-timeout-ms)**

- **[`CURLOPT_HAPROXYPROTOCOL`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-haproxyprotocol)**

- **[`CURLOPT_KEEP_SENDING_ON_ERROR`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-keep-sending-on-error)**

- **[`CURLOPT_PRE_PROXY`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-pre-proxy)**

- **[`CURLOPT_PROXY_CAINFO`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-cainfo)**

- **[`CURLOPT_PROXY_CAPATH`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-capath)**

- **[`CURLOPT_PROXY_CRLFILE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-crlfile)**

- **[`CURLOPT_PROXY_KEYPASSWD`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-keypasswd)**

- **[`CURLOPT_PROXY_PINNEDPUBLICKEY`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-pinnedpublickey)**

- **[`CURLOPT_PROXY_SSLCERT`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-sslcert)**

- **[`CURLOPT_PROXY_SSLCERTTYPE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-sslcerttype)**

- **[`CURLOPT_PROXY_SSL_CIPHER_LIST`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-ssl-cipher-list)**

- **[`CURLOPT_PROXY_SSLKEY`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-sslkey)**

- **[`CURLOPT_PROXY_SSLKEYTYPE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-sslkeytype)**

- **[`CURLOPT_PROXY_SSL_OPTIONS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-ssl-options)**

- **[`CURLOPT_PROXY_SSL_VERIFYHOST`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-ssl-verifyhost)**

- **[`CURLOPT_PROXY_SSL_VERIFYPEER`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-ssl-verifypeer)**

- **[`CURLOPT_PROXY_SSLVERSION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-sslversion)**

- **[`CURLOPT_PROXY_TLS13_CIPHERS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-tls13-ciphers)**

- **[`CURLOPT_PROXY_TLSAUTH_PASSWORD`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-tlsauth-password)**

- **[`CURLOPT_PROXY_TLSAUTH_TYPE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-tlsauth-type)**

- **[`CURLOPT_PROXY_TLSAUTH_USERNAME`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-proxy-tlsauth-username)**

- **[`CURLOPT_REQUEST_TARGET`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-request-target)**

- **[`CURLOPT_SOCKS5_AUTH`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-socks5-auth)**

- **[`CURLOPT_SSH_COMPRESSION`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-ssh-compression)**

- **[`CURLOPT_SUPPRESS_CONNECT_HEADERS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-suppress-connect-headers)**

- **[`CURLOPT_TIMEVALUE_LARGE`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-timevalue-large)**

- **[`CURLOPT_TLS13_CIPHERS`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-tls13-ciphers)**

- **[`CURLPROXY_HTTPS`](https://www.php.net/manual/en/curl.constants.php#constant.curlproxy-https)**

- **[`CURLSSH_AUTH_GSSAPI`](https://www.php.net/manual/en/curl.constants.php#constant.curlssh-auth-gssapi)**

- **[`CURL_SSLVERSION_MAX_DEFAULT`](https://www.php.net/manual/en/curl.constants.php#constant.curl-sslversion-max-default)**

- **[`CURL_SSLVERSION_MAX_NONE`](https://www.php.net/manual/en/curl.constants.php#constant.curl-sslversion-max-none)**

- **[`CURL_SSLVERSION_MAX_TLSv1_0`](https://www.php.net/manual/en/curl.constants.php#constant.curl-sslversion-max-tlsv1-0)**

- **[`CURL_SSLVERSION_MAX_TLSv1_1`](https://www.php.net/manual/en/curl.constants.php#constant.curl-sslversion-max-tlsv1-1)**

- **[`CURL_SSLVERSION_MAX_TLSv1_2`](https://www.php.net/manual/en/curl.constants.php#constant.curl-sslversion-max-tlsv1-2)**

- **[`CURL_SSLVERSION_MAX_TLSv1_3`](https://www.php.net/manual/en/curl.constants.php#constant.curl-sslversion-max-tlsv1-3)**

- **[`CURL_SSLVERSION_TLSv1_3`](https://www.php.net/manual/en/curl.constants.php#constant.curl-sslversion-tlsv1-3)**

- **[`CURL_VERSION_ALTSVC`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-altsvc)** (as of PHP 7.3.6)

- **[`CURL_VERSION_ASYNCHDNS`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-asynchdns)**

- **[`CURL_VERSION_BROTLI`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-brotli)**

- **[`CURL_VERSION_CONV`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-conv)**

- **[`CURL_VERSION_CURLDEBUG`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-curldebug)** (as of PHP 7.3.6)

- **[`CURL_VERSION_DEBUG`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-debug)**

- **[`CURL_VERSION_GSSAPI`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-gssapi)**

- **[`CURL_VERSION_GSSNEGOTIATE`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-gssnegotiate)**

- **[`CURL_VERSION_HTTPS_PROXY`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-https-proxy)**

- **[`CURL_VERSION_IDN`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-idn)**

- **[`CURL_VERSION_LARGEFILE`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-largefile)**

- **[`CURL_VERSION_MULTI_SSL`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-multi-ssl)**

- **[`CURL_VERSION_NTLM`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-ntlm)**

- **[`CURL_VERSION_NTLM_WB`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-ntlm-wb)**

- **[`CURL_VERSION_PSL`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-psl)** (as of PHP 7.3.6)

- **[`CURL_VERSION_SPNEGO`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-spnego)**

- **[`CURL_VERSION_SSPI`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-sspi)**

- **[`CURL_VERSION_TLSAUTH_SRP`](https://www.php.net/manual/en/curl.constants.php#constant.curl-version-tlsauth-srp)**

### Data Filtering

- **[`FILTER_SANITIZE_ADD_SLASHES`](https://www.php.net/manual/en/filter.constants.sanitization.php#constant.filter-sanitize-add-slashes)**

### JavaScript Object Notation

- **[`JSON_THROW_ON_ERROR`](https://www.php.net/manual/en/json.constants.php#constant.json-throw-on-error)**

### Lightweight Directory Access Protocol

- **[`LDAP_CONTROL_ASSERT`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-assert)**

- **[`LDAP_CONTROL_MANAGEDSAIT`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-managedsait)**

- **[`LDAP_CONTROL_PROXY_AUTHZ`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-proxy-authz)**

- **[`LDAP_CONTROL_SUBENTRIES`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-subentries)**

- **[`LDAP_CONTROL_VALUESRETURNFILTER`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-valuesreturnfilter)**

- **[`LDAP_CONTROL_PRE_READ`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-pre-read)**

- **[`LDAP_CONTROL_POST_READ`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-post-read)**

- **[`LDAP_CONTROL_SORTREQUEST`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-sortrequest)**

- **[`LDAP_CONTROL_SORTRESPONSE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-sortresponse)**

- **[`LDAP_CONTROL_PAGEDRESULTS`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-pagedresults)**

- **[`LDAP_CONTROL_AUTHZID_REQUEST`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-authzid-request)**

- **[`LDAP_CONTROL_AUTHZID_RESPONSE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-authzid-response)**

- **[`LDAP_CONTROL_SYNC`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-sync)**

- **[`LDAP_CONTROL_SYNC_STATE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-sync-state)**

- **[`LDAP_CONTROL_SYNC_DONE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-sync-done)**

- **[`LDAP_CONTROL_DONTUSECOPY`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-dontusecopy)**

- **[`LDAP_CONTROL_PASSWORDPOLICYREQUEST`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-passwordpolicyrequest)**

- **[`LDAP_CONTROL_PASSWORDPOLICYRESPONSE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-passwordpolicyresponse)**

- **[`LDAP_CONTROL_X_INCREMENTAL_VALUES`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-x-incremental-values)**

- **[`LDAP_CONTROL_X_DOMAIN_SCOPE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-x-domain-scope)**

- **[`LDAP_CONTROL_X_PERMISSIVE_MODIFY`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-x-permissive-modify)**

- **[`LDAP_CONTROL_X_SEARCH_OPTIONS`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-x-search-options)**

- **[`LDAP_CONTROL_X_TREE_DELETE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-x-tree-delete)**

- **[`LDAP_CONTROL_X_EXTENDED_DN`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-x-extended-dn)**

- **[`LDAP_CONTROL_VLVREQUEST`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-vlvrequest)**

- **[`LDAP_CONTROL_VLVRESPONSE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-control-vlvresponse)**

### Multibyte String

- **[`MB_CASE_FOLD`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-fold)**

- **[`MB_CASE_LOWER_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-lower-simple)**

- **[`MB_CASE_UPPER_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-upper-simple)**

- **[`MB_CASE_TITLE_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-title-simple)**

- **[`MB_CASE_FOLD_SIMPLE`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-case-fold-simple)**

### OpenSSL

- **[`STREAM_CRYPTO_PROTO_SSLv3`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-proto-sslv3)**

- **[`STREAM_CRYPTO_PROTO_TLSv1_0`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-proto-tlsv1-0)**

- **[`STREAM_CRYPTO_PROTO_TLSv1_1`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-proto-tlsv1-1)**

- **[`STREAM_CRYPTO_PROTO_TLSv1_2`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-proto-tlsv1-2)**

### PostgreSQL

- **[`PGSQL_DIAG_SCHEMA_NAME`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-diag-schema-name)**

- **[`PGSQL_DIAG_TABLE_NAME`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-diag-table-name)**

- **[`PGSQL_DIAG_COLUMN_NAME`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-diag-column-name)**

- **[`PGSQL_DIAG_DATATYPE_NAME`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-diag-datatype-name)**

- **[`PGSQL_DIAG_CONSTRAINT_NAME`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-diag-constraint-name)**

- **[`PGSQL_DIAG_SEVERITY_NONLOCALIZED`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-diag-severity-nonlocalized)**

# [PHP 7.2](https://www.php.net/manual/en/migration72.constants.php)

## New global constants

### PHP Core

- [**[`PHP_FLOAT_DIG`](https://www.php.net/manual/en/reserved.constants.php#constant.php-float-dig)**](https://www.php.net/manual/en/reserved.constants.php#constant.php-float-dig)

- [**[`PHP_FLOAT_EPSILON`](https://www.php.net/manual/en/reserved.constants.php#constant.php-float-epsilon)**](https://www.php.net/manual/en/reserved.constants.php#constant.php-float-epsilon)

- [**[`PHP_FLOAT_MIN`](https://www.php.net/manual/en/reserved.constants.php#constant.php-float-min)**](https://www.php.net/manual/en/reserved.constants.php#constant.php-float-min)

- [**[`PHP_FLOAT_MAX`](https://www.php.net/manual/en/reserved.constants.php#constant.php-float-max)**](https://www.php.net/manual/en/reserved.constants.php#constant.php-float-max)

- [**[`PHP_OS_FAMILY`](https://www.php.net/manual/en/reserved.constants.php#constant.php-os-family)**](https://www.php.net/manual/en/reserved.constants.php#constant.php-os-family)

### [File Information](https://www.php.net/manual/en/book.fileinfo.php)

- [**[`FILEINFO_EXTENSION`](https://www.php.net/manual/en/fileinfo.constants.php#constant.fileinfo-extension)**](https://www.php.net/manual/en/fileinfo.constants.php#constant.fileinfo-extension)

### [JSON](https://www.php.net/manual/en/book.json.php)

- **[`JSON_INVALID_UTF8_IGNORE`](https://www.php.net/manual/en/json.constants.php#constant.json-invalid-utf8-ignore)**

- **[`JSON_INVALID_UTF8_SUBSTITUTE`](https://www.php.net/manual/en/json.constants.php#constant.json-invalid-utf8-substitute)**

### [GD](https://www.php.net/manual/en/book.image.php)

- [**[`IMG_EFFECT_MULTIPLY`](https://www.php.net/manual/en/image.constants.php#constant.img-effect-multiply)**](https://www.php.net/manual/en/image.constants.php#constant.img-effect-multiply)

- [**[`IMG_BMP`](https://www.php.net/manual/en/image.constants.php#constant.img-bmp)**](https://www.php.net/manual/en/image.constants.php#constant.img-bmp)

### [LDAP](https://www.php.net/manual/en/book.ldap.php)

- [**[`LDAP_EXOP_START_TLS`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-start-tls)**](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-start-tls)

- [**[`LDAP_EXOP_MODIFY_PASSWD`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-modify-passwd)**](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-modify-passwd)

- [**[`LDAP_EXOP_REFRESH`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-refresh)**](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-refresh)

- [**[`LDAP_EXOP_WHO_AM_I`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-who-am-i)**](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-who-am-i)

- [**[`LDAP_EXOP_TURN`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-turn)**](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-exop-turn)

### [Password Hashing](https://www.php.net/manual/en/book.password.php)

- [**[`PASSWORD_ARGON2I`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2i)**](https://www.php.net/manual/en/password.constants.php#constant.password-argon2i)

- [**[`PASSWORD_ARGON2_DEFAULT_MEMORY_COST`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2-default-memory-cost)**](https://www.php.net/manual/en/password.constants.php#constant.password-argon2-default-memory-cost)

- [**[`PASSWORD_ARGON2_DEFAULT_TIME_COST`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2-default-time-cost)**](https://www.php.net/manual/en/password.constants.php#constant.password-argon2-default-time-cost)

- [**[`PASSWORD_ARGON2_DEFAULT_THREADS`](https://www.php.net/manual/en/password.constants.php#constant.password-argon2-default-threads)**](https://www.php.net/manual/en/password.constants.php#constant.password-argon2-default-threads)

### [PCRE](https://www.php.net/manual/en/book.pcre.php)

- **[`PREG_UNMATCHED_AS_NULL`](https://www.php.net/manual/en/pcre.constants.php#constant.preg-unmatched-as-null)**

### [PDO](https://www.php.net/manual/en/book.pdo.php)

- [**[`PDO::PARAM_STR_NATL`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.param-str-natl)**](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.param-str-natl)

- [**[`PDO::PARAM_STR_CHAR`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.param-str-char)**](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.param-str-char)

- [**[`PDO::ATTR_DEFAULT_STR_PARAM`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-default-str-param)**](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-default-str-param)

### [Sodium](https://www.php.net/manual/en/book.sodium.php)

- [**[`SODIUM_LIBRARY_VERSION`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-library-version)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-library-version)

- [**[`SODIUM_LIBRARY_MAJOR_VERSION`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-library-major-version)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-library-major-version)

- [**[`SODIUM_LIBRARY_MINOR_VERSION`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-library-minor-version)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-library-minor-version)

- [**[`SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aes256gcm-keybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aes256gcm-keybytes)

- [**[`SODIUM_CRYPTO_AEAD_AES256GCM_NSECBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aes256gcm-nsecbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aes256gcm-nsecbytes)

- [**[`SODIUM_CRYPTO_AEAD_AES256GCM_NPUBBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aes256gcm-npubbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aes256gcm-npubbytes)

- [**[`SODIUM_CRYPTO_AEAD_AES256GCM_ABYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aes256gcm-abytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-aes256gcm-abytes)

- [**[`SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-keybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-keybytes)

- [**[`SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_NSECBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-nsecbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-nsecbytes)

- [**[`SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_NPUBBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-npubbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-npubbytes)

- [**[`SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_ABYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-abytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-abytes)

- [**[`SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-ietf-keybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-ietf-keybytes)

- [**[`SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NSECBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-ietf-nsecbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-ietf-nsecbytes)

- [**[`SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-ietf-npubbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-ietf-npubbytes)

- [**[`SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_ABYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-ietf-abytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-aead-chacha20poly1305-ietf-abytes)

- [**[`SODIUM_CRYPTO_AUTH_BYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-auth-bytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-auth-bytes)

- [**[`SODIUM_CRYPTO_AUTH_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-auth-keybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-auth-keybytes)

- [**[`SODIUM_CRYPTO_BOX_SEALBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-sealbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-sealbytes)

- [**[`SODIUM_CRYPTO_BOX_SECRETKEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-secretkeybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-secretkeybytes)

- [**[`SODIUM_CRYPTO_BOX_PUBLICKEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-publickeybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-publickeybytes)

- [**[`SODIUM_CRYPTO_BOX_KEYPAIRBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-keypairbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-keypairbytes)

- [**[`SODIUM_CRYPTO_BOX_MACBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-macbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-macbytes)

- [**[`SODIUM_CRYPTO_BOX_NONCEBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-noncebytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-noncebytes)

- [**[`SODIUM_CRYPTO_BOX_SEEDBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-seedbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-box-seedbytes)

- [**[`SODIUM_CRYPTO_KDF_BYTES_MIN`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kdf-bytes-min)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kdf-bytes-min)

- [**[`SODIUM_CRYPTO_KDF_BYTES_MAX`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kdf-bytes-max)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kdf-bytes-max)

- [**[`SODIUM_CRYPTO_KDF_CONTEXTBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kdf-contextbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kdf-contextbytes)

- [**[`SODIUM_CRYPTO_KDF_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kdf-keybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kdf-keybytes)

- [**[`SODIUM_CRYPTO_KX_SEEDBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-seedbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-seedbytes)

- [**[`SODIUM_CRYPTO_KX_SESSIONKEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-sessionkeybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-sessionkeybytes)

- [**[`SODIUM_CRYPTO_KX_PUBLICKEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-publickeybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-publickeybytes)

- [**[`SODIUM_CRYPTO_KX_SECRETKEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-secretkeybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-secretkeybytes)

- [**[`SODIUM_CRYPTO_KX_KEYPAIRBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-keypairbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-kx-keypairbytes)

- [**[`SODIUM_CRYPTO_GENERICHASH_BYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-bytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-bytes)

- [**[`SODIUM_CRYPTO_GENERICHASH_BYTES_MIN`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-bytes-min)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-bytes-min)

- [**[`SODIUM_CRYPTO_GENERICHASH_BYTES_MAX`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-bytes-max)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-bytes-max)

- [**[`SODIUM_CRYPTO_GENERICHASH_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-keybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-keybytes)

- [**[`SODIUM_CRYPTO_GENERICHASH_KEYBYTES_MIN`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-keybytes-min)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-keybytes-min)

- [**[`SODIUM_CRYPTO_GENERICHASH_KEYBYTES_MAX`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-keybytes-max)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-generichash-keybytes-max)

- [**[`SODIUM_CRYPTO_PWHASH_ALG_ARGON2I13`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-alg-argon2i13)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-alg-argon2i13)

- [**[`SODIUM_CRYPTO_PWHASH_ALG_DEFAULT`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-alg-default)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-alg-default)

- [**[`SODIUM_CRYPTO_PWHASH_SALTBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-saltbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-saltbytes)

- [**[`SODIUM_CRYPTO_PWHASH_STRPREFIX`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-strprefix)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-strprefix)

- [**[`SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-opslimit-interactive)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-opslimit-interactive)

- [**[`SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-memlimit-interactive)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-memlimit-interactive)

- [**[`SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-opslimit-moderate)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-opslimit-moderate)

- [**[`SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-memlimit-moderate)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-memlimit-moderate)

- [**[`SODIUM_CRYPTO_PWHASH_OPSLIMIT_SENSITIVE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-opslimit-sensitive)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-opslimit-sensitive)

- [**[`SODIUM_CRYPTO_PWHASH_MEMLIMIT_SENSITIVE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-memlimit-sensitive)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-memlimit-sensitive)

- [**[`SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_SALTBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-saltbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-saltbytes)

- [**[`SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_STRPREFIX`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-strprefix)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-strprefix)

- [**[`SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_INTERACTIVE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-opslimit-interactive)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-opslimit-interactive)

- [**[`SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_INTERACTIVE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-memlimit-interactive)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-memlimit-interactive)

- [**[`SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_SENSITIVE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-opslimit-sensitive)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-opslimit-sensitive)

- [**[`SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_SENSITIVE`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-memlimit-sensitive)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-pwhash-scryptsalsa208sha256-memlimit-sensitive)

- [**[`SODIUM_CRYPTO_SCALARMULT_BYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-scalarmult-bytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-scalarmult-bytes)

- [**[`SODIUM_CRYPTO_SCALARMULT_SCALARBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-scalarmult-scalarbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-scalarmult-scalarbytes)

- [**[`SODIUM_CRYPTO_SHORTHASH_BYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-shorthash-bytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-shorthash-bytes)

- [**[`SODIUM_CRYPTO_SHORTHASH_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-shorthash-keybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-shorthash-keybytes)

- [**[`SODIUM_CRYPTO_SECRETBOX_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-secretbox-keybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-secretbox-keybytes)

- [**[`SODIUM_CRYPTO_SECRETBOX_MACBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-secretbox-macbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-secretbox-macbytes)

- [**[`SODIUM_CRYPTO_SECRETBOX_NONCEBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-secretbox-noncebytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-secretbox-noncebytes)

- [**[`SODIUM_CRYPTO_SIGN_BYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-bytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-bytes)

- [**[`SODIUM_CRYPTO_SIGN_SEEDBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-seedbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-seedbytes)

- [**[`SODIUM_CRYPTO_SIGN_PUBLICKEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-publickeybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-publickeybytes)

- [**[`SODIUM_CRYPTO_SIGN_SECRETKEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-secretkeybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-secretkeybytes)

- [**[`SODIUM_CRYPTO_SIGN_KEYPAIRBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-keypairbytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-sign-keypairbytes)

- [**[`SODIUM_CRYPTO_STREAM_NONCEBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-stream-noncebytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-stream-noncebytes)

- [**[`SODIUM_CRYPTO_STREAM_KEYBYTES`](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-stream-keybytes)**](https://www.php.net/manual/en/sodium.constants.php#constant.sodium-crypto-stream-keybytes)

### [Zip](https://www.php.net/manual/en/book.zip.php)

- [**[`ZipArchive::EM_NONE`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.em-none)**](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.em-none)

- [**[`ZipArchive::EM_AES_128`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.em-aes-128)**](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.em-aes-128)

- [**[`ZipArchive::EM_AES_192`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.em-aes-192)**](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.em-aes-192)

- [**[`ZipArchive::EM_AES_256`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.em-aes-256)**](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.em-aes-256)

# [PHP 7.1](https://www.php.net/manual/en/migration71.constants.php)

## New global constants

### [Core Predefined Constants](https://www.php.net/manual/en/reserved.constants.php)

- **[`PHP_FD_SETSIZE`](https://www.php.net/manual/en/reserved.constants.php#constant.php-fd-setsize)**

### [CURL](https://www.php.net/manual/en/book.curl.php)

- **[`CURLMOPT_PUSHFUNCTION`](https://www.php.net/manual/en/curl.constants.php#constant.curlmopt-pushfunction)**

- **[`CURL_PUSH_OK`](https://www.php.net/manual/en/curl.constants.php#constant.curl-push-ok)**

- **[`CURL_PUSH_DENY`](https://www.php.net/manual/en/curl.constants.php#constant.curl-push-deny)**

### [Data Filtering](https://www.php.net/manual/en/book.filter.php)

- **[`FILTER_FLAG_EMAIL_UNICODE`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-flag-email-unicode)**

### [Image Processing and GD](https://www.php.net/manual/en/book.image.php)

- **[`IMAGETYPE_WEBP`](https://www.php.net/manual/en/image.constants.php#constant.imagetype-webp)**

### [JSON](https://www.php.net/manual/en/book.json.php)

- **[`JSON_UNESCAPED_LINE_TERMINATORS`](https://www.php.net/manual/en/json.constants.php#constant.json-unescaped-line-terminators)**

### [LDAP](https://www.php.net/manual/en/book.ldap.php)

- **[`LDAP_OPT_X_SASL_NOCANON`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-sasl-nocanon)**

- **[`LDAP_OPT_X_SASL_USERNAME`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-sasl-username)**

- **[`LDAP_OPT_X_TLS_CACERTDIR`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-cacertdir)**

- **[`LDAP_OPT_X_TLS_CACERTFILE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-cacertfile)**

- **[`LDAP_OPT_X_TLS_CERTFILE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-certfile)**

- **[`LDAP_OPT_X_TLS_CIPHER_SUITE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-cipher-suite)**

- **[`LDAP_OPT_X_TLS_KEYFILE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-keyfile)**

- **[`LDAP_OPT_X_TLS_RANDOM_FILE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-random-file)**

- **[`LDAP_OPT_X_TLS_CRLCHECK`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-crlcheck)**

- **[`LDAP_OPT_X_TLS_CRL_NONE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-crl-none)**

- **[`LDAP_OPT_X_TLS_CRL_PEER`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-crl-peer)**

- **[`LDAP_OPT_X_TLS_CRL_ALL`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-crl-all)**

- **[`LDAP_OPT_X_TLS_DHFILE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-dhfile)**

- **[`LDAP_OPT_X_TLS_CRLFILE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-crlfile)**

- **[`LDAP_OPT_X_TLS_PROTOCOL_MIN`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-protocol-min)**

- **[`LDAP_OPT_X_TLS_PROTOCOL_SSL2`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-protocol-ssl2)**

- **[`LDAP_OPT_X_TLS_PROTOCOL_SSL3`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-protocol-ssl3)**

- **[`LDAP_OPT_X_TLS_PROTOCOL_TLS1_0`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-protocol-tls1-0)**

- **[`LDAP_OPT_X_TLS_PROTOCOL_TLS1_1`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-protocol-tls1-1)**

- **[`LDAP_OPT_X_TLS_PROTOCOL_TLS1_2`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-protocol-tls1-2)**

- **[`LDAP_OPT_X_TLS_PACKAGE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-tls-package)**

- **[`LDAP_OPT_X_KEEPALIVE_IDLE`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-keepalive-idle)**

- **[`LDAP_OPT_X_KEEPALIVE_PROBES`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-keepalive-probes)**

- **[`LDAP_OPT_X_KEEPALIVE_INTERVAL`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-opt-x-keepalive-interval)**

### [PostgreSQL](https://www.php.net/manual/en/book.pgsql.php)

- **[`PGSQL_NOTICE_LAST`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-notice-last)**

- **[`PGSQL_NOTICE_ALL`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-notice-all)**

- **[`PGSQL_NOTICE_CLEAR`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-notice-clear)**

### [SPL](https://www.php.net/manual/en/book.spl.php)

- **[`MT_RAND_PHP`](https://www.php.net/manual/en/random.constants.php#constant.mt-rand-php)**

# [PHP 7.0](https://www.php.net/manual/en/migration70.constants.php)

## New Global Constants

### [Core Predefined Constants](https://www.php.net/manual/en/reserved.constants.php)

- **[`PHP_INT_MIN`](https://www.php.net/manual/en/reserved.constants.php#constant.php-int-min)**

### [GD](https://www.php.net/manual/en/book.image.php)

- **[`IMG_WEBP`](https://www.php.net/manual/en/image.constants.php#constant.img-webp)** (as of PHP 7.0.10)

### [JSON](https://www.php.net/manual/en/book.json.php)

- **[`JSON_ERROR_INVALID_PROPERTY_NAME`](https://www.php.net/manual/en/json.constants.php#constant.json-error-invalid-property-name)**

- **[`JSON_ERROR_UTF16`](https://www.php.net/manual/en/json.constants.php#constant.json-error-utf16)**

### [LibXML](https://www.php.net/manual/en/book.libxml.php)

- **[`LIBXML_BIGLINES`](https://www.php.net/manual/en/libxml.constants.php#constant.libxml-biglines)**

### [PCRE](https://www.php.net/manual/en/book.pcre.php)

- **[`PREG_JIT_STACKLIMIT_ERROR`](https://www.php.net/manual/en/pcre.constants.php#constant.preg-jit-stacklimit-error)**

### [POSIX](https://www.php.net/manual/en/book.posix.php)

- **[`POSIX_RLIMIT_AS`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-as)**

- **[`POSIX_RLIMIT_CORE`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-core)**

- **[`POSIX_RLIMIT_CPU`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-cpu)**

- **[`POSIX_RLIMIT_DATA`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-data)**

- **[`POSIX_RLIMIT_FSIZE`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-fsize)**

- **[`POSIX_RLIMIT_LOCKS`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-locks)**

- **[`POSIX_RLIMIT_MEMLOCK`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-memlock)**

- **[`POSIX_RLIMIT_MSGQUEUE`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-msgqueue)**

- **[`POSIX_RLIMIT_NICE`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-nice)**

- **[`POSIX_RLIMIT_NOFILE`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-nofile)**

- **[`POSIX_RLIMIT_NPROC`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-nproc)**

- **[`POSIX_RLIMIT_RSS`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-rss)**

- **[`POSIX_RLIMIT_RTPRIO`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-rtprio)**

- **[`POSIX_RLIMIT_RTTIME`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-rttime)**

- **[`POSIX_RLIMIT_SIGPENDING`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-sigpending)**

- **[`POSIX_RLIMIT_STACK`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-stack)**

- **[`POSIX_RLIMIT_INFINITY`](https://www.php.net/manual/en/posix.constants.setrlimit.php#constant.posix-rlimit-infinity)**

### [Zlib](https://www.php.net/manual/en/book.zlib.php)

- **[`ZLIB_ENCODING_RAW`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-encoding-raw)**

- **[`ZLIB_ENCODING_DEFLATE`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-encoding-deflate)**

- **[`ZLIB_ENCODING_GZIP`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-encoding-gzip)**

- **[`ZLIB_FILTERED`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-filtered)**

- **[`ZLIB_HUFFMAN_ONLY`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-huffman-only)**

- **[`ZLIB_FIXED`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-fixed)**

- **[`ZLIB_RLE`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-rle)**

- **[`ZLIB_DEFAULT_STRATEGY`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-default-strategy)**

- **[`ZLIB_BLOCK`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-block)**

- **[`ZLIB_FINISH`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-finish)**

- **[`ZLIB_FULL_FLUSH`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-full-flush)**

- **[`ZLIB_NO_FLUSH`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-no-flush)**

- **[`ZLIB_PARTIAL_FLUSH`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-partial-flush)**

- **[`ZLIB_SYNC_FLUSH`](https://www.php.net/manual/en/zlib.constants.php#constant.zlib-sync-flush)**

# [PHP 5.6](https://www.php.net/manual/en/migration56.constants.php)

## New global constants

### [GD](https://www.php.net/manual/en/book.image.php)

- **[`IMG_WEBP`](https://www.php.net/manual/en/image.constants.php#constant.img-webp)** (as of PHP 5.6.25)

### [LDAP](https://www.php.net/manual/en/book.ldap.php)

- **[`LDAP_ESCAPE_DN`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-escape-dn)**

- **[`LDAP_ESCAPE_FILTER`](https://www.php.net/manual/en/ldap.constants.php#constant.ldap-escape-filter)**

### [OpenSSL](https://www.php.net/manual/en/book.openssl.php)

- **[`OPENSSL_DEFAULT_STREAM_CIPHERS`](https://www.php.net/manual/en/openssl.ciphers.php#constant.openssl-default-stream-ciphers)**

- **[`STREAM_CRYPTO_METHOD_ANY_CLIENT`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-method-any-client)**

- **[`STREAM_CRYPTO_METHOD_ANY_SERVER`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-method-any-server)**

- **[`STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-method-tlsv1-0-client)**

- **[`STREAM_CRYPTO_METHOD_TLSv1_0_SERVER`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-method-tlsv1-0-server)**

- **[`STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-method-tlsv1-1-client)**

- **[`STREAM_CRYPTO_METHOD_TLSv1_1_SERVER`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-method-tlsv1-1-server)**

- **[`STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-method-tlsv1-2-client)**

- **[`STREAM_CRYPTO_METHOD_TLSv1_2_SERVER`](https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-method-tlsv1-2-server)**

### [PostgreSQL](https://www.php.net/manual/en/book.pgsql.php)

- **[`PGSQL_CONNECT_ASYNC`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-connect-async)**

- **[`PGSQL_CONNECTION_AUTH_OK`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-connection-auth-ok)**

- **[`PGSQL_CONNECTION_AWAITING_RESPONSE`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-connection-awaiting-response)**

- **[`PGSQL_CONNECTION_MADE`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-connection-made)**

- **[`PGSQL_CONNECTION_SETENV`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-connection-setenv)**

- **[`PGSQL_CONNECTION_SSL_STARTUP`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-connection-ssl-startup)**

- **[`PGSQL_CONNECTION_STARTED`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-connection-started)**

- **[`PGSQL_DML_ESCAPE`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-dml-escape)**

- **[`PGSQL_POLLING_ACTIVE`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-polling-active)**

- **[`PGSQL_POLLING_FAILED`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-polling-failed)**

- **[`PGSQL_POLLING_OK`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-polling-ok)**

- **[`PGSQL_POLLING_READING`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-polling-reading)**

- **[`PGSQL_POLLING_WRITING`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-polling-writing)**
