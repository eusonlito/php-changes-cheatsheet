# [New Functions in PHP 8.6, 8.5, 8.4, 8.3, 8.2, 8.1, 7.4, 7.3, 7.2, 7.1, 7.0, 5.6, 5.5, 5.4, 5.3, 5.2, 5.0](index.md)

# [PHP 8.6](https://www.php.net/manual/en/migration86.new-functions.php)

## New Functions

### Core

- [clamp()](https://www.php.net/manual/en/function.clamp.php) returns the given value if in range, else returns the nearest bound.
- [stream_last_errors()](https://www.php.net/manual/en/function.stream-last-errors.php)
- [stream_clear_errors()](https://www.php.net/manual/en/function.stream-clear-errors.php)
- **stream_socket_get_crypto_status()**

### GMP

- **gmp_powm_sec()**
- **gmp_prevprime()**

### Intl

- **grapheme_strrev()**
- **IntlDatePatternGenerator::getSkeleton()**
- **IntlDatePatternGenerator::getBaseSkeleton()**
- **Locale::getDisplayKeyword()**
- **locale_get_display_keyword()**
- **Locale::getDisplayKeywordValue()**
- **locale_get_display_keyword_value()**
- **SpoofChecker::areBidiConfusable()**
- **SpoofChecker::getBidiSkeleton()**
- **SpoofChecker::getSkeleton()**

### MySQLi

- [mysqli::quote_string()](https://www.php.net/manual/en/mysqli.quote-string.php)
- [mysqli_quote_string()](https://www.php.net/manual/en/mysqli.quote-string.php)

### Reflection

- **ReflectionAttribute::inNamespace()**
- **ReflectionAttribute::getNamespaceName()**
- **ReflectionAttribute::getShortName()**
- **ReflectionConstant::inNamespace()**
- **ReflectionParameter::getDocComment()**
- [ReflectionProperty::isReadable()](https://www.php.net/manual/en/reflectionproperty.isreadable.php)
- [ReflectionProperty::isWritable()](https://www.php.net/manual/en/reflectionproperty.iswritable.php)

### SNMP

- **snmp_init_mib()**
- **snmp_set_mib_option()**
- **snmp_set_output_option()**
- **snmp_set_string_output_format()**
- **SNMP::setOidOutputFormat()**
- **SNMP::setStringOutputFormat()**

### Sodium

- **sodium_crypto_ipcrypt_keygen()**
- **sodium_crypto_ipcrypt_encrypt()**
- **sodium_crypto_ipcrypt_decrypt()**
- **sodium_crypto_ipcrypt_nd_keygen()**
- **sodium_crypto_ipcrypt_nd_encrypt()**
- **sodium_crypto_ipcrypt_nd_decrypt()**
- **sodium_crypto_ipcrypt_ndx_keygen()**
- **sodium_crypto_ipcrypt_ndx_encrypt()**
- **sodium_crypto_ipcrypt_ndx_decrypt()**
- **sodium_crypto_ipcrypt_pfx_keygen()**
- **sodium_crypto_ipcrypt_pfx_encrypt()**
- **sodium_crypto_ipcrypt_pfx_decrypt()**
- **sodium_bin2ip()**
- **sodium_ip2bin()**
- **sodium_crypto_xof_shake128()**
- **sodium_crypto_xof_shake128_init()**
- **sodium_crypto_xof_shake128_update()**
- **sodium_crypto_xof_shake128_squeeze()**
- **sodium_crypto_xof_shake256()**
- **sodium_crypto_xof_shake256_init()**
- **sodium_crypto_xof_shake256_update()**
- **sodium_crypto_xof_shake256_squeeze()**
- **sodium_crypto_xof_turboshake128()**
- **sodium_crypto_xof_turboshake128_init()**
- **sodium_crypto_xof_turboshake128_update()**
- **sodium_crypto_xof_turboshake128_squeeze()**
- **sodium_crypto_xof_turboshake256()**
- **sodium_crypto_xof_turboshake256_init()**
- **sodium_crypto_xof_turboshake256_update()**
- **sodium_crypto_xof_turboshake256_squeeze()**

The following functions expose the X-Wing KEM (hybrid ML-KEM768+X25519, libsodium's recommended KEM). They are available when PHP is built against libsodium 1.0.22 or later.

- **sodium_crypto_kem_keypair()**
- **sodium_crypto_kem_seed_keypair()**
- **sodium_crypto_kem_secretkey()**
- **sodium_crypto_kem_publickey()**
- **sodium_crypto_kem_enc()**
- **sodium_crypto_kem_dec()**

The following functions expose the ML-KEM768 (FIPS 203) KEM. They are available when PHP is built against libsodium 1.0.22 or later.

- **sodium_crypto_kem_mlkem768_keypair()**
- **sodium_crypto_kem_mlkem768_seed_keypair()**
- **sodium_crypto_kem_mlkem768_secretkey()**
- **sodium_crypto_kem_mlkem768_publickey()**
- **sodium_crypto_kem_mlkem768_enc()**
- **sodium_crypto_kem_mlkem768_dec()**

### URI

- **Uri\Rfc3986\Uri::getUriType()**
- **Uri\WhatWg\Url::isSpecialScheme()**
- **Uri\Rfc3986\Uri::getHostType()**
- **Uri\WhatWg\Url::getHostType()**
- **Uri\WhatWg\url_percent_encode()**

### Zip

- **ZipArchive::openString()**
- **ZipArchive::closeString()**

# [PHP 8.5](https://www.php.net/manual/en/migration85.new-functions.php)

## New Functions

### Core

- [get_error_handler()](https://www.php.net/manual/en/function.get-error-handler.php)
- [get_exception_handler()](https://www.php.net/manual/en/function.get-exception-handler.php)
- [Closure::getCurrent()](https://www.php.net/manual/en/closure.getcurrent.php)

### Curl

- [curl_multi_get_handles()](https://www.php.net/manual/en/function.curl-multi-get-handles.php)
- [curl_share_init_persistent()](https://www.php.net/manual/en/function.curl-share-init-persistent.php)

### DOM

- [Dom\Element::getElementsByClassName()](https://www.php.net/manual/en/dom-element.getelementsbyclassname.php)
- [Dom\Element::insertAdjacentHTML()](https://www.php.net/manual/en/dom-element.insertadjacenthtml.php)

### Enchant

- [enchant_dict_remove_from_session()](https://www.php.net/manual/en/function.enchant-dict-remove-from-session.php)
- [enchant_dict_remove()](https://www.php.net/manual/en/function.enchant-dict-remove.php)

### Intl

- [Locale::isRightToLeft()](https://www.php.net/manual/en/locale.isrighttoleft.php)
- [locale_is_right_to_left()](https://www.php.net/manual/en/locale.isrighttoleft.php)
- [grapheme_levenshtein()](https://www.php.net/manual/en/function.grapheme-levenshtein.php)

### Opcache

- [opcache_is_script_cached_in_file_cache()](https://www.php.net/manual/en/function.opcache-is-script-cached-in-file-cache.php)

### PDO_SQLITE

- [Pdo\Sqlite::setAuthorizer()](https://www.php.net/manual/en/pdo-sqlite.setauthorizer.php)

### PGSQL

- [pg_close_stmt()](https://www.php.net/manual/en/function.pg-close-stmt.php)

### Reflection

- [ReflectionConstant::getFileName()](https://www.php.net/manual/en/reflectionconstant.getfilename.php)
- [ReflectionConstant::getExtension()](https://www.php.net/manual/en/reflectionconstant.getextension.php)
- [ReflectionConstant::getExtensionName()](https://www.php.net/manual/en/reflectionconstant.getextensionname.php)
- [ReflectionConstant::getAttributes()](https://www.php.net/manual/en/reflectionconstant.getattributes.php)
- [ReflectionProperty::getMangledName()](https://www.php.net/manual/en/reflectionproperty.getmangledname.php)

### Sqlite

- [Sqlite3Stmt::busy()](https://www.php.net/manual/en/sqlite3stmt.busy.php)

### Standard

- [array_first()](https://www.php.net/manual/en/function.array-first.php)
- [array_last()](https://www.php.net/manual/en/function.array-last.php)

# [PHP 8.4](https://www.php.net/manual/en/migration84.new-functions.php)

## New Functions

### Core

- [request_parse_body()](https://www.php.net/manual/en/function.request-parse-body.php)

### BCMath

- [bcceil()](https://www.php.net/manual/en/function.bcceil.php)
- [bcdivmod()](https://www.php.net/manual/en/function.bcdivmod.php)
- [bcfloor()](https://www.php.net/manual/en/function.bcfloor.php)
- [bcround()](https://www.php.net/manual/en/function.bcround.php)

### Date

- [DateTime::createFromTimestamp()](https://www.php.net/manual/en/datetime.createfromtimestamp.php)
- [DateTime::getMicrosecond()](https://www.php.net/manual/en/datetimeinterface.getmicrosecond.php)
- [DateTime::setMicrosecond()](https://www.php.net/manual/en/datetime.setmicrosecond.php)
- [DateTimeImmutable::createFromTimestamp()](https://www.php.net/manual/en/datetimeimmutable.createfromtimestamp.php)
- [DateTimeImmutable::getMicrosecond()](https://www.php.net/manual/en/datetimeinterface.getmicrosecond.php)
- [DateTimeImmutable::setMicrosecond()](https://www.php.net/manual/en/datetimeimmutable.setmicrosecond.php)

### DOM

- [DOMNode::compareDocumentPosition()](https://www.php.net/manual/en/domnode.comparedocumentposition.php)
- [DOMXPath::registerPhpFunctionNS()](https://www.php.net/manual/en/domxpath.registerphpfunctionns.php)
- [DOMXPath::quote()](https://www.php.net/manual/en/domxpath.quote.php)

### Hash

- [HashContext::\_\_debugInfo()](https://www.php.net/manual/en/hashcontext.debuginfo.php)

### Intl

- [IntlTimeZone::getIanaID()](https://www.php.net/manual/en/intltimezone.getianaid.php)
- [intltz_get_iana_id()](https://www.php.net/manual/en/intltimezone.getianaid.php)
- [IntlDateFormatter::parseToCalendar()](https://www.php.net/manual/en/intldateformatter.parsetocalendar.php)
- [Spoofchecker::setAllowedChars()](https://www.php.net/manual/en/spoofchecker.setallowedchars.php)
- [grapheme_str_split()](https://www.php.net/manual/en/function.grapheme-str-split.php)

### MBString

- [mb_trim()](https://www.php.net/manual/en/function.mb-trim.php)
- [mb_ltrim()](https://www.php.net/manual/en/function.mb-ltrim.php)
- [mb_rtrim()](https://www.php.net/manual/en/function.mb-rtrim.php)
- [mb_ucfirst()](https://www.php.net/manual/en/function.mb-ucfirst.php)
- [mb_lcfirst()](https://www.php.net/manual/en/function.mb-lcfirst.php)

### Opcache

- [opcache_jit_blacklist()](https://www.php.net/manual/en/function.opcache-jit-blacklist.php)

### PCNTL

- [pcntl_getcpu()](https://www.php.net/manual/en/function.pcntl-getcpu.php)
- [pcntl_getcpuaffinity()](https://www.php.net/manual/en/function.pcntl-getcpuaffinity.php)
- [pcntl_getqos_class()](https://www.php.net/manual/en/function.pcntl-getqos-class.php)
- [pcntl_setns()](https://www.php.net/manual/en/function.pcntl-setns.php)
- [pcntl_setqos_class()](https://www.php.net/manual/en/function.pcntl-setqos-class.php)
- [pcntl_waitid()](https://www.php.net/manual/en/function.pcntl-waitid.php)

### PDO_PGSQL

- [Pdo\Pgsql::setNoticeCallback()](https://www.php.net/manual/en/pdo-pgsql.setnoticecallback.php)

### PGSQL

- [pg_change_password()](https://www.php.net/manual/en/function.pg-change-password.php)
- [pg_jit()](https://www.php.net/manual/en/function.pg-jit.php)
- [pg_put_copy_data()](https://www.php.net/manual/en/function.pg-put-copy-data.php)
- [pg_put_copy_end()](https://www.php.net/manual/en/function.pg-put-copy-end.php)
- [pg_result_memory_size()](https://www.php.net/manual/en/function.pg-result-memory-size.php)
- [pg_set_chunked_rows_size()](https://www.php.net/manual/en/function.pg-set-chunked-rows-size.php)
- [pg_socket_poll()](https://www.php.net/manual/en/function.pg-socket-poll.php)

### Reflection

The following methods relate to the new lazy object feature:

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

&nbsp;

- [ReflectionClassConstant::isDeprecated()](https://www.php.net/manual/en/reflectionclassconstant.isdeprecated.php)
- [ReflectionGenerator::isClosed()](https://www.php.net/manual/en/reflectiongenerator.isclosed.php)
- [ReflectionProperty::isDynamic()](https://www.php.net/manual/en/reflectionproperty.isdynamic.php)

### Sodium

- sodium_crypto_aead_aegis128l\_\*
- sodium_crypto_aead_aegis256\_\*

### SPL

- [SplObjectStorage::seek()](https://www.php.net/manual/en/splobjectstorage.seek.php)

### SOAP

- [SoapServer::\_\_getLastResponse()](https://www.php.net/manual/en/soapserver.getlastresponse.php)

### Standard

- [http_get_last_response_headers()](https://www.php.net/manual/en/function.http-get-last-response-headers.php)
- [http_clear_last_response_headers()](https://www.php.net/manual/en/function.http-clear-last-response-headers.php)
- [fpow()](https://www.php.net/manual/en/function.fpow.php)
- [array_all()](https://www.php.net/manual/en/function.array-all.php)
- [array_any()](https://www.php.net/manual/en/function.array-any.php)
- [array_find()](https://www.php.net/manual/en/function.array-find.php)
- [array_find_key()](https://www.php.net/manual/en/function.array-find-key.php)

### Tidy

- [tidyNode::getNextSibling()](https://www.php.net/manual/en/tidynode.getnextsibling.php)
- [tidyNode::getPreviousSibling()](https://www.php.net/manual/en/tidynode.getprevioussibling.php)

### XMLReader

- [XMLReader::fromStream()](https://www.php.net/manual/en/xmlreader.fromstream.php)
- [XMLReader::fromUri()](https://www.php.net/manual/en/xmlreader.fromuri.php)
- [XMLReader::fromString()](https://www.php.net/manual/en/xmlreader.fromstring.php)

### XMLWriter

- [XMLWriter::toStream()](https://www.php.net/manual/en/xmlwriter.tostream.php)
- [XMLWriter::toUri()](https://www.php.net/manual/en/xmlwriter.touri.php)
- [XMLWriter::toMemory()](https://www.php.net/manual/en/xmlwriter.tomemory.php)

### XSL

- [XSLTProcessor::registerPhpFunctionNS()](https://www.php.net/manual/en/xsltprocessor.registerphpfunctionns.php)

# [PHP 8.3](https://www.php.net/manual/en/migration83.new-functions.php)

## New Functions

### Date

- [DatePeriod::createFromISO8601String()](https://www.php.net/manual/en/dateperiod.createfromiso8601string.php)

### DOM

- [DOMElement::getAttributeNames()](https://www.php.net/manual/en/domelement.getattributenames.php)
- [DOMElement::insertAdjacentElement()](https://www.php.net/manual/en/domelement.insertadjacentelement.php)
- [DOMElement::insertAdjacentText()](https://www.php.net/manual/en/domelement.insertadjacenttext.php)
- [DOMElement::toggleAttribute()](https://www.php.net/manual/en/domelement.toggleattribute.php)
- [DOMNode::contains()](https://www.php.net/manual/en/domnode.contains.php)
- [DOMNode::getRootNode()](https://www.php.net/manual/en/domnode.getrootnode.php)
- [DOMNode::isEqualNode()](https://www.php.net/manual/en/domnode.isequalnode.php)
- [DOMParentNode::replaceChildren()](https://www.php.net/manual/en/domparentnode.replacechildren.php)

### Intl

- [IntlCalendar::setDate()](https://www.php.net/manual/en/intlcalendar.setdate.php)
- [IntlCalendar::setDateTime()](https://www.php.net/manual/en/intlcalendar.setdatetime.php)
- [IntlGregorianCalendar::createFromDate()](https://www.php.net/manual/en/intlgregoriancalendar.createfromdate.php)
- [IntlGregorianCalendar::createFromDateTime()](https://www.php.net/manual/en/intlgregoriancalendar.createfromdatetime.php)

### JSON

- [json_validate()](https://www.php.net/manual/en/function.json-validate.php)

### LDAP

- [ldap_connect_wallet()](https://www.php.net/manual/en/function.ldap-connect-wallet.php)
- [ldap_exop_sync()](https://www.php.net/manual/en/function.ldap-exop-sync.php)

### MBString

- [mb_str_pad()](https://www.php.net/manual/en/function.mb-str-pad.php)

### Posix

- [posix_sysconf()](https://www.php.net/manual/en/function.posix-sysconf.php)
- [posix_pathconf()](https://www.php.net/manual/en/function.posix-pathconf.php)
- [posix_fpathconf()](https://www.php.net/manual/en/function.posix-fpathconf.php)
- [posix_eaccess()](https://www.php.net/manual/en/function.posix-eaccess.php)

### PostgreSQL

- [pg_set_error_context_visibility()](https://www.php.net/manual/en/function.pg-set-error-context-visibility.php) (libpq \>= 9.6)

### Random

- [Random\Randomizer::getBytesFromString()](https://www.php.net/manual/en/random-randomizer.getbytesfromstring.php)
- [Random\Randomizer::nextFloat()](https://www.php.net/manual/en/random-randomizer.nextfloat.php)
- [Random\Randomizer::getFloat()](https://www.php.net/manual/en/random-randomizer.getfloat.php)

### Reflection

- [ReflectionMethod::createFromMethodName()](https://www.php.net/manual/en/reflectionmethod.createfrommethodname.php)

### Sockets

- [socket_atmark()](https://www.php.net/manual/en/function.socket-atmark.php)

### Standard

- [str_increment()](https://www.php.net/manual/en/function.str-increment.php)
- [str_decrement()](https://www.php.net/manual/en/function.str-decrement.php)
- [stream_context_set_options()](https://www.php.net/manual/en/function.stream-context-set-options.php)

### Zip

- [ZipArchive::getArchiveFlag()](https://www.php.net/manual/en/ziparchive.getarchiveflag.php)

# [PHP 8.2](https://www.php.net/manual/en/migration82.new-functions.php)

## New Functions

### cURL

- [curl_upkeep()](https://www.php.net/manual/en/function.curl_upkeep.php)

### IMAP

- [imap_is_open()](https://www.php.net/manual/en/function.imap-is-open.php) (as of PHP 8.2.1)

### MySQLi

- [mysqli_execute_query()](https://www.php.net/manual/en/mysqli.execute-query.php)

### ODBC

- [odbc_connection_string_is_quoted()](https://www.php.net/manual/en/function.odbc-connection-string-is-quoted.php)
- [odbc_connection_string_should_quote()](https://www.php.net/manual/en/function.odbc-connection-string-should-quote.php)
- [odbc_connection_string_quote()](https://www.php.net/manual/en/function.odbc-connection-string-quote.php)

### OpenSSL

- [openssl_cipher_key_length()](https://www.php.net/manual/en/function.openssl-cipher-key-length.php)

### Reflection

- [ReflectionFunction::isAnonymous()](https://www.php.net/manual/en/reflectionfunction.isanonymous.php)
- [ReflectionMethod::hasPrototype()](https://www.php.net/manual/en/reflectionmethod.hasprototype.php)

### Sodium

#### XChaCha20

- [sodium_crypto_stream_xchacha20_xor_ic()](https://www.php.net/manual/en/function.sodium-crypto-stream-xchacha20-xor-ic.php)

### Standard

- [memory_reset_peak_usage()](https://www.php.net/manual/en/function.memory-reset-peak-usage.php)
- [ini_parse_quantity()](https://www.php.net/manual/en/function.ini-parse-quantity.php)

### XML

- [libxml_get_external_entity_loader()](https://www.php.net/manual/en/function.libxml-get-external-entity-loader.php)

# [PHP 8.1](https://www.php.net/manual/en/migration81.new-functions.php)

## New Functions

### PHP Core

- [array_is_list()](https://www.php.net/manual/en/function.array-is-list.php)

### GD

- [imagecreatefromavif()](https://www.php.net/manual/en/function.imagecreatefromavif.php)

- [imageavif()](https://www.php.net/manual/en/function.imageavif.php)

### MySQLi

- [mysqli_result::fetch_column()](https://www.php.net/manual/en/mysqli-result.fetch-column.php)

- [mysqli_fetch_column()](https://www.php.net/manual/en/mysqli-result.fetch-column.php)

### Process Control

- [pcntl_rfork()](https://www.php.net/manual/en/function.pcntl-rfork.php)

### Reflection

- [ReflectionFunctionAbstract::getClosureUsedVariables()](https://www.php.net/manual/en/reflectionfunctionabstract.getclosureusedvariables.php)

### Standard

- [fsync()](https://www.php.net/manual/en/function.fsync.php)

- [fdatasync()](https://www.php.net/manual/en/function.fdatasync.php)

### Sodium

#### XChaCha20

- [sodium_crypto_stream_xchacha20()](https://www.php.net/manual/en/function.sodium-crypto-stream-xchacha20.php)

- [sodium_crypto_stream_xchacha20_keygen()](https://www.php.net/manual/en/function.sodium-crypto-stream-xchacha20-keygen.php)

- [sodium_crypto_stream_xchacha20_xor()](https://www.php.net/manual/en/function.sodium-crypto-stream-xchacha20-xor.php)

#### Ristretto255

Ristretto255 functions are available as of libsodium 1.0.18.

- [sodium_crypto_core_ristretto255_add()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-add.php)

- [sodium_crypto_core_ristretto255_from_hash()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-from-hash.php)

- [sodium_crypto_core_ristretto255_is_valid_point()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-is-valid-point.php)

- [sodium_crypto_core_ristretto255_random()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-random.php)

- [sodium_crypto_core_ristretto255_scalar_add()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-add.php)

- [sodium_crypto_core_ristretto255_scalar_complement()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-complement.php)

- [sodium_crypto_core_ristretto255_scalar_invert()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-invert.php)

- [sodium_crypto_core_ristretto255_scalar_mul()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-mul.php)

- [sodium_crypto_core_ristretto255_scalar_negate()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-negate.php)

- [sodium_crypto_core_ristretto255_scalar_random()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-random.php)

- [sodium_crypto_core_ristretto255_scalar_reduce()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-reduce.php)

- [sodium_crypto_core_ristretto255_scalar_sub()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-sub.php)

- [sodium_crypto_core_ristretto255_sub()](https://www.php.net/manual/en/function.sodium-crypto-core-ristretto255-sub.php)

- [sodium_crypto_scalarmult_ristretto255()](https://www.php.net/manual/en/function.sodium-crypto-scalarmult-ristretto255.php)

- [sodium_crypto_scalarmult_ristretto255_base()](https://www.php.net/manual/en/function.sodium-crypto-scalarmult-ristretto255-base.php)

# [PHP 7.4](https://www.php.net/manual/en/migration74.new-functions.php)

## New Functions

### PHP Core

- [get_mangled_object_vars()](https://www.php.net/manual/en/function.get-mangled-object-vars.php)

- [password_algos()](https://www.php.net/manual/en/function.password-algos.php)

- [sapi_windows_set_ctrl_handler()](https://www.php.net/manual/en/function.sapi-windows-set-ctrl-handler.php)

### GD

- [imagecreatefromtga()](https://www.php.net/manual/en/function.imagecreatefromtga.php)

### Multibyte String

- [mb_str_split()](https://www.php.net/manual/en/function.mb-str-split.php)

### OpenSSL

- [openssl_x509_verify()](https://www.php.net/manual/en/function.openssl-x509-verify.php)

### Process Control

- [pcntl_unshare()](https://www.php.net/manual/en/function.pcntl-unshare.php)

### SQLite3

- [SQLite3::backup()](https://www.php.net/manual/en/sqlite3.backup.php)

- [SQLite3Stmt::getSQL()](https://www.php.net/manual/en/sqlite3stmt.getsql.php)

# [PHP 7.3](https://www.php.net/manual/en/migration73.new-functions.php)

## New Functions

### PHP Core

- [array_key_first()](https://www.php.net/manual/en/function.array-key-first.php)

- [array_key_last()](https://www.php.net/manual/en/function.array-key-last.php)

- [gc_status()](https://www.php.net/manual/en/function.gc-status.php)

- [hrtime()](https://www.php.net/manual/en/function.hrtime.php)

- [is_countable()](https://www.php.net/manual/en/function.is-countable.php)

- [net_get_interfaces()](https://www.php.net/manual/en/function.net-get-interfaces.php)

### FastCGI Process Manager

- [fpm_get_status()](https://www.php.net/manual/en/function.fpm-get-status.php)

### Date and Time

- [DateTime::createFromImmutable()](https://www.php.net/manual/en/datetime.createfromimmutable.php)

### GNU Multiple Precision

- [gmp_binomial()](https://www.php.net/manual/en/function.gmp-binomial.php)

- [gmp_kronecker()](https://www.php.net/manual/en/function.gmp-kronecker.php)

- [gmp_lcm()](https://www.php.net/manual/en/function.gmp-lcm.php)

- [gmp_perfect_power()](https://www.php.net/manual/en/function.gmp-perfect-power.php)

### Internationalization Functions

- [Normalizer::getRawDecomposition()](https://www.php.net/manual/en/normalizer.getrawdecomposition.php)

- [normalizer_get_raw_decomposition()](https://www.php.net/manual/en/normalizer.getrawdecomposition.php)

- [Spoofchecker::setRestrictionLevel()](https://www.php.net/manual/en/spoofchecker.setrestrictionlevel.php)

### Lightweight Directory Access Protocol

- [ldap_add_ext()](https://www.php.net/manual/en/function.ldap-add-ext.php)

- [ldap_bind_ext()](https://www.php.net/manual/en/function.ldap-bind-ext.php)

- [ldap_delete_ext()](https://www.php.net/manual/en/function.ldap-delete-ext.php)

- [ldap_exop_refresh()](https://www.php.net/manual/en/function.ldap-exop-refresh.php)

- [ldap_mod_add_ext()](https://www.php.net/manual/en/function.ldap-mod_add-ext.php)

- [ldap_mod_replace_ext()](https://www.php.net/manual/en/function.ldap-mod_replace-ext.php)

- [ldap_mod_del_ext()](https://www.php.net/manual/en/function.ldap-mod_del-ext.php)

- [ldap_rename_ext()](https://www.php.net/manual/en/function.ldap-rename-ext.php)

### OpenSSL

- [openssl_pkey_derive()](https://www.php.net/manual/en/function.openssl-pkey-derive.php)

### Sockets

- [socket_wsaprotocol_info_export()](https://www.php.net/manual/en/function.socket-wsaprotocol-info-export.php)

- [socket_wsaprotocol_info_import()](https://www.php.net/manual/en/function.socket-wsaprotocol-info-import.php)

- [socket_wsaprotocol_info_release()](https://www.php.net/manual/en/function.socket-wsaprotocol-info-release.php)

# [PHP 7.2](https://www.php.net/manual/en/migration72.new-functions.php)

## New functions

### PHP Core

- [stream_isatty()](https://www.php.net/manual/en/function.stream-isatty.php)

- [sapi_windows_vt100_support()](https://www.php.net/manual/en/function.sapi-windows-vt100-support.php)

### [SPL](https://www.php.net/manual/en/book.spl.php)

- [spl_object_id()](https://www.php.net/manual/en/function.spl-object-id.php)

### [DOM](https://www.php.net/manual/en/book.dom.php)

- [DomNodeList::count()](https://www.php.net/manual/en/domnodelist.count.php)

- [DOMNamedNodeMap::count()](https://www.php.net/manual/en/domnamednodemap.count.php)

### [FTP](https://www.php.net/manual/en/book.ftp.php)

- [ftp_append()](https://www.php.net/manual/en/function.ftp-append.php)

### [GD](https://www.php.net/manual/en/book.image.php)

- [imagesetclip()](https://www.php.net/manual/en/function.imagesetclip.php)

- [imagegetclip()](https://www.php.net/manual/en/function.imagegetclip.php)

- [imageopenpolygon()](https://www.php.net/manual/en/function.imageopenpolygon.php)

- [imageresolution()](https://www.php.net/manual/en/function.imageresolution.php)

- [imagecreatefrombmp()](https://www.php.net/manual/en/function.imagecreatefrombmp.php)

- [imagebmp()](https://www.php.net/manual/en/function.imagebmp.php)

### [Hash](https://www.php.net/manual/en/book.hash.php)

- [hash_hmac_algos()](https://www.php.net/manual/en/function.hash-hmac-algos.php)

### [LDAP](https://www.php.net/manual/en/book.ldap.php)

- [ldap_parse_exop()](https://www.php.net/manual/en/function.ldap-parse-exop.php)

- [ldap_exop()](https://www.php.net/manual/en/function.ldap-exop.php)

- [ldap_exop_passwd()](https://www.php.net/manual/en/function.ldap-exop-passwd.php)

- [ldap_exop_whoami()](https://www.php.net/manual/en/function.ldap-exop-whoami.php)

### [Multibyte String](https://www.php.net/manual/en/book.mbstring.php)

- [mb_chr()](https://www.php.net/manual/en/function.mb-chr.php)

- [mb_ord()](https://www.php.net/manual/en/function.mb-ord.php)

- [mb_scrub()](https://www.php.net/manual/en/function.mb-scrub.php)

### [Oracle OCI8](https://www.php.net/manual/en/book.oci8.php)

- [oci_register_taf_callback()](https://www.php.net/manual/en/function.oci-register-taf-callback.php)

- [oci_unregister_taf_callback()](https://www.php.net/manual/en/function.oci-unregister-taf-callback.php)

### [Sockets](https://www.php.net/manual/en/book.sockets.php)

- [socket_addrinfo_lookup()](https://www.php.net/manual/en/function.socket-addrinfo-lookup.php)

- [socket_addrinfo_connect()](https://www.php.net/manual/en/function.socket-addrinfo-connect.php)

- [socket_addrinfo_bind()](https://www.php.net/manual/en/function.socket-addrinfo-bind.php)

- [socket_addrinfo_explain()](https://www.php.net/manual/en/function.socket-addrinfo-explain.php)

### [Sodium](https://www.php.net/manual/en/book.sodium.php)

- [sodium_add()](https://www.php.net/manual/en/function.sodium-add.php)

- [sodium_bin2hex()](https://www.php.net/manual/en/function.sodium-bin2hex.php)

- [sodium_compare()](https://www.php.net/manual/en/function.sodium-compare.php)

- [sodium_crypto_aead_aes256gcm_decrypt()](https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-decrypt.php)

- [sodium_crypto_aead_aes256gcm_encrypt()](https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-encrypt.php)

- [sodium_crypto_aead_aes256gcm_is_available()](https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-is-available.php)

- [sodium_crypto_aead_aes256gcm_keygen()](https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-keygen.php)

- [sodium_crypto_aead_chacha20poly1305_decrypt()](https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-decrypt.php)

- [sodium_crypto_aead_chacha20poly1305_encrypt()](https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-encrypt.php)

- [sodium_crypto_aead_chacha20poly1305_ietf_decrypt()](https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-decrypt.php)

- [sodium_crypto_aead_chacha20poly1305_ietf_encrypt()](https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-encrypt.php)

- [sodium_crypto_aead_chacha20poly1305_ietf_keygen()](https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-keygen.php)

- [sodium_crypto_aead_chacha20poly1305_keygen()](https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-keygen.php)

- [sodium_crypto_auth_keygen()](https://www.php.net/manual/en/function.sodium-crypto-auth-keygen.php)

- [sodium_crypto_auth_verify()](https://www.php.net/manual/en/function.sodium-crypto-auth-verify.php)

- [sodium_crypto_auth()](https://www.php.net/manual/en/function.sodium-crypto-auth.php)

- [sodium_crypto_box_keypair_from_secretkey_and_publickey()](https://www.php.net/manual/en/function.sodium-crypto-box-keypair-from-secretkey-and-publickey.php)

- [sodium_crypto_box_keypair()](https://www.php.net/manual/en/function.sodium-crypto-box-keypair.php)

- [sodium_crypto_box_open()](https://www.php.net/manual/en/function.sodium-crypto-box-open.php)

- [sodium_crypto_box_publickey_from_secretkey()](https://www.php.net/manual/en/function.sodium-crypto-box-publickey-from-secretkey.php)

- [sodium_crypto_box_publickey()](https://www.php.net/manual/en/function.sodium-crypto-box-publickey.php)

- [sodium_crypto_box_seal_open()](https://www.php.net/manual/en/function.sodium-crypto-box-seal-open.php)

- [sodium_crypto_box_seal()](https://www.php.net/manual/en/function.sodium-crypto-box-seal.php)

- [sodium_crypto_box_secretkey()](https://www.php.net/manual/en/function.sodium-crypto-box-secretkey.php)

- [sodium_crypto_box_seed_keypair()](https://www.php.net/manual/en/function.sodium-crypto-box-seed-keypair.php)

- [sodium_crypto_box()](https://www.php.net/manual/en/function.sodium-crypto-box.php)

- [sodium_crypto_generichash_final()](https://www.php.net/manual/en/function.sodium-crypto-generichash-final.php)

- [sodium_crypto_generichash_init()](https://www.php.net/manual/en/function.sodium-crypto-generichash-init.php)

- [sodium_crypto_generichash_keygen()](https://www.php.net/manual/en/function.sodium-crypto-generichash-keygen.php)

- [sodium_crypto_generichash_update()](https://www.php.net/manual/en/function.sodium-crypto-generichash-update.php)

- [sodium_crypto_generichash()](https://www.php.net/manual/en/function.sodium-crypto-generichash.php)

- [sodium_crypto_kdf_derive_from_key()](https://www.php.net/manual/en/function.sodium-crypto-kdf-derive-from-key.php)

- [sodium_crypto_kdf_keygen()](https://www.php.net/manual/en/function.sodium-crypto-kdf-keygen.php)

- [sodium_crypto_kx_client_session_keys()](https://www.php.net/manual/en/function.sodium-crypto-kx-client-session-keys.php)

- [sodium_crypto_kx_keypair()](https://www.php.net/manual/en/function.sodium-crypto-kx-keypair.php)

- [sodium_crypto_kx_publickey()](https://www.php.net/manual/en/function.sodium-crypto-kx-publickey.php)

- [sodium_crypto_kx_secretkey()](https://www.php.net/manual/en/function.sodium-crypto-kx-secretkey.php)

- [sodium_crypto_kx_seed_keypair()](https://www.php.net/manual/en/function.sodium-crypto-kx-seed-keypair.php)

- [sodium_crypto_kx_server_session_keys()](https://www.php.net/manual/en/function.sodium-crypto-kx-server-session-keys.php)

- [sodium_crypto_pwhash_scryptsalsa208sha256_str_verify()](https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256-str-verify.php)

- [sodium_crypto_pwhash_scryptsalsa208sha256_str()](https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256-str.php)

- [sodium_crypto_pwhash_scryptsalsa208sha256()](https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256.php)

- [sodium_crypto_pwhash_str_verify()](https://www.php.net/manual/en/function.sodium-crypto-pwhash-str-verify.php)

- [sodium_crypto_pwhash_str()](https://www.php.net/manual/en/function.sodium-crypto-pwhash-str.php)

- [sodium_crypto_pwhash()](https://www.php.net/manual/en/function.sodium-crypto-pwhash.php)

- [sodium_crypto_scalarmult_base()](https://www.php.net/manual/en/function.sodium-crypto-scalarmult-base.php)

- [sodium_crypto_scalarmult()](https://www.php.net/manual/en/function.sodium-crypto-scalarmult.php)

- [sodium_crypto_secretbox_keygen()](https://www.php.net/manual/en/function.sodium-crypto-secretbox-keygen.php)

- [sodium_crypto_secretbox_open()](https://www.php.net/manual/en/function.sodium-crypto-secretbox-open.php)

- [sodium_crypto_secretbox()](https://www.php.net/manual/en/function.sodium-crypto-secretbox.php)

- [sodium_crypto_shorthash_keygen()](https://www.php.net/manual/en/function.sodium-crypto-shorthash-keygen.php)

- [sodium_crypto_shorthash()](https://www.php.net/manual/en/function.sodium-crypto-shorthash.php)

- [sodium_crypto_sign_detached()](https://www.php.net/manual/en/function.sodium-crypto-sign-detached.php)

- [sodium_crypto_sign_ed25519_pk_to_curve25519()](https://www.php.net/manual/en/function.sodium-crypto-sign-ed25519-pk-to-curve25519.php)

- [sodium_crypto_sign_ed25519_sk_to_curve25519()](https://www.php.net/manual/en/function.sodium-crypto-sign-ed25519-sk-to-curve25519.php)

- [sodium_crypto_sign_keypair_from_secretkey_and_publickey()](https://www.php.net/manual/en/function.sodium-crypto-sign-keypair-from-secretkey-and-publickey.php)

- [sodium_crypto_sign_keypair()](https://www.php.net/manual/en/function.sodium-crypto-sign-keypair.php)

- [sodium_crypto_sign_open()](https://www.php.net/manual/en/function.sodium-crypto-sign-open.php)

- [sodium_crypto_sign_publickey_from_secretkey()](https://www.php.net/manual/en/function.sodium-crypto-sign-publickey-from-secretkey.php)

- [sodium_crypto_sign_publickey()](https://www.php.net/manual/en/function.sodium-crypto-sign-publickey.php)

- [sodium_crypto_sign_secretkey()](https://www.php.net/manual/en/function.sodium-crypto-sign-secretkey.php)

- [sodium_crypto_sign_seed_keypair()](https://www.php.net/manual/en/function.sodium-crypto-sign-seed-keypair.php)

- [sodium_crypto_sign_verify_detached()](https://www.php.net/manual/en/function.sodium-crypto-sign-verify-detached.php)

- [sodium_crypto_sign()](https://www.php.net/manual/en/function.sodium-crypto-sign.php)

- [sodium_crypto_stream_keygen()](https://www.php.net/manual/en/function.sodium-crypto-stream-keygen.php)

- [sodium_crypto_stream_xor()](https://www.php.net/manual/en/function.sodium-crypto-stream-xor.php)

- [sodium_crypto_stream()](https://www.php.net/manual/en/function.sodium-crypto-stream.php)

- [sodium_hex2bin()](https://www.php.net/manual/en/function.sodium-hex2bin.php)

- [sodium_increment()](https://www.php.net/manual/en/function.sodium-increment.php)

- [sodium_memcmp()](https://www.php.net/manual/en/function.sodium-memcmp.php)

- [sodium_memzero()](https://www.php.net/manual/en/function.sodium-memzero.php)

- [sodium_pad()](https://www.php.net/manual/en/function.sodium-pad.php)

- [sodium_unpad()](https://www.php.net/manual/en/function.sodium-unpad.php)

### [ZIP](https://www.php.net/manual/en/book.zip.php)

- [ZipArchive::count()](https://www.php.net/manual/en/ziparchive.count.php)

- [ZipArchive::setEncryptionName()](https://www.php.net/manual/en/ziparchive.setencryptionname.php)

- [ZipArchive::setEncryptionIndex()](https://www.php.net/manual/en/ziparchive.setencryptionindex.php)

# [PHP 7.1](https://www.php.net/manual/en/migration71.new-functions.php)

## New functions

### PHP Core

- [sapi_windows_cp_get()](https://www.php.net/manual/en/function.sapi-windows-cp-get.php)

- [sapi_windows_cp_set()](https://www.php.net/manual/en/function.sapi-windows-cp-set.php)

- [sapi_windows_cp_conv()](https://www.php.net/manual/en/function.sapi-windows-cp-conv.php)

- [sapi_windows_cp_is_utf8()](https://www.php.net/manual/en/function.sapi-windows-cp-is-utf8.php)

### [Closure](https://www.php.net/manual/en/class.closure.php)

- [Closure::fromCallable()](https://www.php.net/manual/en/closure.fromcallable.php)

### [CURL](https://www.php.net/manual/en/book.curl.php)

- [curl_multi_errno()](https://www.php.net/manual/en/function.curl-multi-errno.php)

- [curl_share_errno()](https://www.php.net/manual/en/function.curl-share-errno.php)

- [curl_share_strerror()](https://www.php.net/manual/en/function.curl-share-strerror.php)

### [OpenSSL](https://www.php.net/manual/en/book.openssl.php)

- [openssl_get_curve_names()](https://www.php.net/manual/en/function.openssl-get-curve-names.php)

### [Session](https://www.php.net/manual/en/book.session.php)

- [session_create_id()](https://www.php.net/manual/en/function.session-create-id.php)

- [session_gc()](https://www.php.net/manual/en/function.session-gc.php)

### [SPL](https://www.php.net/manual/en/book.spl.php)

- [is_iterable()](https://www.php.net/manual/en/function.is-iterable.php)

### [PCNTL](https://www.php.net/manual/en/book.pcntl.php)

- [pcntl_async_signals()](https://www.php.net/manual/en/function.pcntl-async-signals.php)

- [pcntl_signal_get_handler()](https://www.php.net/manual/en/function.pcntl-signal-get-handler.php)

# [PHP 7.0](https://www.php.net/manual/en/migration70.new-functions.php)

## New functions

### [Closure](https://www.php.net/manual/en/class.closure.php)

- [Closure::call()](https://www.php.net/manual/en/closure.call.php)

### CSPRNG

- [random_bytes()](https://www.php.net/manual/en/function.random-bytes.php)

- [random_int()](https://www.php.net/manual/en/function.random-int.php)

### [Error Handling and Logging](https://www.php.net/manual/en/book.errorfunc.php)

- [error_clear_last()](https://www.php.net/manual/en/function.error-clear-last.php)

### [Generator](https://www.php.net/manual/en/class.generator.php)

- [Generator::getReturn()](https://www.php.net/manual/en/generator.getreturn.php)

### [GNU Multiple Precision](https://www.php.net/manual/en/book.gmp.php)

- [gmp_random_seed()](https://www.php.net/manual/en/function.gmp-random-seed.php)

### [Math](https://www.php.net/manual/en/book.math.php)

- [intdiv()](https://www.php.net/manual/en/function.intdiv.php)

### [PCRE](https://www.php.net/manual/en/book.pcre.php)

- [preg_replace_callback_array()](https://www.php.net/manual/en/function.preg-replace-callback-array.php)

### [PHP Options/Info](https://www.php.net/manual/en/book.info.php)

- [gc_mem_caches()](https://www.php.net/manual/en/function.gc-mem-caches.php)

- [get_resources()](https://www.php.net/manual/en/function.get-resources.php)

### [POSIX](https://www.php.net/manual/en/book.posix.php)

- [posix_setrlimit()](https://www.php.net/manual/en/function.posix-setrlimit.php)

### [Reflection](https://www.php.net/manual/en/book.reflection.php)

- [ReflectionParameter::getType()](https://www.php.net/manual/en/reflectionparameter.gettype.php)

- [ReflectionParameter::hasType()](https://www.php.net/manual/en/reflectionparameter.hastype.php)

- [ReflectionFunctionAbstract::getReturnType()](https://www.php.net/manual/en/reflectionfunctionabstract.getreturntype.php)

- [ReflectionFunctionAbstract::hasReturnType()](https://www.php.net/manual/en/reflectionfunctionabstract.hasreturntype.php)

### [Zip](https://www.php.net/manual/en/book.zip.php)

- [ZipArchive::setCompressionIndex()](https://www.php.net/manual/en/ziparchive.setcompressionindex.php)

- [ZipArchive::setCompressionName()](https://www.php.net/manual/en/ziparchive.setcompressionname.php)

### [Zlib Compression](https://www.php.net/manual/en/book.zlib.php)

- [inflate_add()](https://www.php.net/manual/en/function.inflate-add.php)

- [deflate_add()](https://www.php.net/manual/en/function.deflate-add.php)

- [inflate_init()](https://www.php.net/manual/en/function.inflate-init.php)

- [deflate_init()](https://www.php.net/manual/en/function.deflate-init.php)

# [PHP 5.6](https://www.php.net/manual/en/migration56.new-functions.php)

## New functions

### [Date and Time](https://www.php.net/manual/en/book.datetime.php)

- [DateTimeImmutable::createFromMutable()](https://www.php.net/manual/en/datetimeimmutable.createfrommutable.php)

### [GMP](https://www.php.net/manual/en/book.gmp.php)

- [gmp_root()](https://www.php.net/manual/en/function.gmp-root.php)

- [gmp_rootrem()](https://www.php.net/manual/en/function.gmp-rootrem.php)

### [Hash](https://www.php.net/manual/en/book.hash.php)

- [hash_equals()](https://www.php.net/manual/en/function.hash-equals.php)

### [LDAP](https://www.php.net/manual/en/book.ldap.php)

- [ldap_escape()](https://www.php.net/manual/en/function.ldap-escape.php)

- [ldap_modify_batch()](https://www.php.net/manual/en/function.ldap-modify-batch.php)

### [MySQLi](https://www.php.net/manual/en/book.mysqli.php)

- [mysqli_get_links_stats()](https://www.php.net/manual/en/function.mysqli-get-links-stats.php)

### [OCI8](https://www.php.net/manual/en/book.oci8.php)

- [oci_get_implicit_resultset()](https://www.php.net/manual/en/function.oci-get-implicit-resultset.php)

### [OpenSSL](https://www.php.net/manual/en/book.openssl.php)

- [openssl_get_cert_locations()](https://www.php.net/manual/en/function.openssl-get-cert-locations.php)

- [openssl_x509_fingerprint()](https://www.php.net/manual/en/function.openssl-x509-fingerprint.php)

- [openssl_spki_new()](https://www.php.net/manual/en/function.openssl-spki-new.php)

- [openssl_spki_verify()](https://www.php.net/manual/en/function.openssl-spki-verify.php)

- [openssl_spki_export_challenge()](https://www.php.net/manual/en/function.openssl-spki-export-challenge.php)

- [openssl_spki_export()](https://www.php.net/manual/en/function.openssl-spki-export.php)

### [PostgreSQL](https://www.php.net/manual/en/book.pgsql.php)

- [pg_connect_poll()](https://www.php.net/manual/en/function.pg-connect-poll.php)

- [pg_consume_input()](https://www.php.net/manual/en/function.pg-consume-input.php)

- [pg_flush()](https://www.php.net/manual/en/function.pg-flush.php)

- [pg_socket()](https://www.php.net/manual/en/function.pg-socket.php)

### [PDO_PGSQL](https://www.php.net/manual/en/ref.pdo-pgsql.php)

- [PDO::pgsqlGetNotify()](https://www.php.net/manual/en/pdo.pgsqlgetnotify.php)

- [PDO::pgsqlGetPid()](https://www.php.net/manual/en/pdo.pgsqlgetpid.php)

### [Session](https://www.php.net/manual/en/book.session.php)

- [session_abort()](https://www.php.net/manual/en/function.session-abort.php)

- [session_reset()](https://www.php.net/manual/en/function.session-reset.php)

### [Zip](https://www.php.net/manual/en/book.zip.php)

- [ZipArchive::setPassword()](https://www.php.net/manual/en/ziparchive.setpassword.php)

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.new-functions.php)

## New Functions

### PHP Core

- [array_column()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-column.html)
- [boolval()](https://php-legacy-docs.zend.com/manual/php5/en/function.boolval.html)
- [json_last_error_msg()](https://php-legacy-docs.zend.com/manual/php5/en/function.json-last-error-msg.html)
- [password_get_info()](https://php-legacy-docs.zend.com/manual/php5/en/function.password-get-info.html)
- [password_hash()](https://php-legacy-docs.zend.com/manual/php5/en/function.password-hash.html)
- [password_needs_rehash()](https://php-legacy-docs.zend.com/manual/php5/en/function.password-needs-rehash.html)
- [password_verify()](https://php-legacy-docs.zend.com/manual/php5/en/function.password-verify.html)

### [Hash](https://php-legacy-docs.zend.com/manual/php5/en/book.hash.html)

- [hash_pbkdf2()](https://php-legacy-docs.zend.com/manual/php5/en/function.hash-pbkdf2.html)

### [OpenSSL](https://php-legacy-docs.zend.com/manual/php5/en/book.openssl.html)

- [openssl_pbkdf2()](https://php-legacy-docs.zend.com/manual/php5/en/function.openssl-pbkdf2.html)

### [cURL](https://php-legacy-docs.zend.com/manual/php5/en/book.curl.html)

- [curl_escape()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-escape.html)
- [curl_file_create()](https://php-legacy-docs.zend.com/manual/php5/en/curlfile.construct.html)
- [curl_multi_setopt()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-multi-setopt.html)
- [curl_multi_strerror()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-multi-strerror.html)
- [curl_pause()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-pause.html)
- [curl_reset()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-reset.html)
- [curl_share_close()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-share-close.html)
- [curl_share_init()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-share-init.html)
- [curl_share_setopt()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-share-setopt.html)
- [curl_strerror()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-strerror.html)
- [curl_unescape()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-unescape.html)

### [GD](https://php-legacy-docs.zend.com/manual/php5/en/book.image.html)

- [imageaffinematrixconcat()](https://php-legacy-docs.zend.com/manual/php5/en/function.imageaffinematrixconcat.html)
- [imageaffinematrixget()](https://php-legacy-docs.zend.com/manual/php5/en/function.imageaffinematrixget.html)
- [imagecrop()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagecrop.html)
- [imagecropauto()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagecropauto.html)
- [imageflip()](https://php-legacy-docs.zend.com/manual/php5/en/function.imageflip.html)
- [imagepalettetotruecolor()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagepalettetotruecolor.html)
- [imagescale()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagescale.html)

### [MySQLi](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html)

- [mysqli_begin_transaction()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.begin-transaction.html)
- [mysqli_release_savepoint()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.release-savepoint.html)
- [mysqli_savepoint()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.savepoint.html)

### [PostgreSQL](https://php-legacy-docs.zend.com/manual/php5/en/book.pgsql.html)

- [pg_escape_literal()](https://php-legacy-docs.zend.com/manual/php5/en/function.pg-escape-literal.html)
- [pg_escape_identifier()](https://php-legacy-docs.zend.com/manual/php5/en/function.pg-escape-identifier.html)

### [Sockets](https://php-legacy-docs.zend.com/manual/php5/en/book.sockets.html)

- [socket_sendmsg()](https://php-legacy-docs.zend.com/manual/php5/en/function.socket-sendmsg.html)
- [socket_recvmsg()](https://php-legacy-docs.zend.com/manual/php5/en/function.socket-recvmsg.html)
- [socket_cmsg_space()](https://php-legacy-docs.zend.com/manual/php5/en/function.socket-cmsg-space.html)

### [CLI](https://php-legacy-docs.zend.com/manual/php5/en/features.commandline.html)

- [cli_get_process_title()](https://php-legacy-docs.zend.com/manual/php5/en/function.cli-get-process-title.html)
- [cli_set_process_title()](https://php-legacy-docs.zend.com/manual/php5/en/function.cli-set-process-title.html)

### [Intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html)

- [datefmt_format_object()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.formatobject.html)
- [datefmt_get_calendar_object()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.getcalendarobject.html)
- [datefmt_get_timezone()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.gettimezone.html)
- [datefmt_set_timezone()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.settimezone.html)
- [datefmt_get_calendar_object()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.getcalendarobject.html)
- **intlcal_create_instance()**
- **intlcal_get_keyword_values_for_locale()**
- **intlcal_get_now()**
- **intlcal_get_available_locales()**
- **intlcal_get()**
- **intlcal_get_time()**
- **intlcal_set_time()**
- **intlcal_add()**
- **intlcal_set_time_zone()**
- **intlcal_after()**
- **intlcal_before()**
- **intlcal_set()**
- **intlcal_roll()**
- **intlcal_clear()**
- **intlcal_field_difference()**
- **intlcal_get_actual_maximum()**
- **intlcal_get_actual_minimum()**
- **intlcal_get_day_of_week_type()**
- **intlcal_get_first_day_of_week()**
- **intlcal_get_greatest_minimum()**
- **intlcal_get_least_maximum()**
- **intlcal_get_locale()**
- **intlcal_get_maximum()**
- **intlcal_get_minimal_days_in_first_week()**
- **intlcal_get_minimum()**
- **intlcal_get_time_zone()**
- **intlcal_get_type()**
- **intlcal_get_weekend_transition()**
- **intlcal_in_daylight_time()**
- **intlcal_is_equivalent_to()**
- **intlcal_is_lenient()**
- **intlcal_is_set()**
- **intlcal_is_weekend()**
- **intlcal_set_first_day_of_week()**
- **intlcal_set_lenient()**
- **intlcal_equals()**
- **intlcal_get_repeated_wall_time_option()**
- **intlcal_get_skipped_wall_time_option()**
- **intlcal_set_repeated_wall_time_option()**
- **intlcal_set_skipped_wall_time_option()**
- **intlcal_from_date_time()**
- **intlcal_to_date_time()**
- [intlcal_get_error_code()](https://php-legacy-docs.zend.com/manual/php5/en/intlcalendar.geterrorcode.html)
- [intlcal_get_error_message()](https://php-legacy-docs.zend.com/manual/php5/en/intlcalendar.geterrormessage.html)
- **intlgregcal_create_instance()**
- **intlgregcal_set_gregorian_change()**
- **intlgregcal_get_gregorian_change()**
- **intlgregcal_is_leap_year()**
- **intltz_create_time_zone()**
- **intltz_create_default()**
- **intltz_get_id()**
- **intltz_get_gmt()**
- **intltz_get_unknown()**
- **intltz_create_enumeration()**
- **intltz_count_equivalent_ids()**
- **intltz_create_time_zone_id_enumeration()**
- **intltz_get_canonical_id()**
- **intltz_get_region()**
- **intltz_get_tz_data_version()**
- **intltz_get_equivalent_id()**
- **intltz_use_daylight_time()**
- **intltz_get_offset()**
- **intltz_get_raw_offset()**
- **intltz_has_same_rules()**
- **intltz_get_display_name()**
- **intltz_get_dst_savings()**
- **intltz_from_date_time_zone()**
- **intltz_to_date_time_zone()**
- [intltz_get_error_code()](https://php-legacy-docs.zend.com/manual/php5/en/intltimezone.geterrorcode.html)
- [intltz_get_error_message()](https://php-legacy-docs.zend.com/manual/php5/en/intltimezone.geterrormessage.html)

### [SPL](https://php-legacy-docs.zend.com/manual/php5/en/book.spl.html)

- [SplFixedArray::\_\_wakeup()](https://php-legacy-docs.zend.com/manual/php5/en/splfixedarray.wakeup.html)

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.functions.php)

## New Functions

PHP 5.4 introduced some new functions:

PHP Core:

- [hex2bin()](https://php-legacy-docs.zend.com/manual/php5/en/function.hex2bin.html)
- [http_response_code()](https://php-legacy-docs.zend.com/manual/php5/en/function.http-response-code.html)
- [get_declared_traits()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-declared-traits.html)
- [getimagesizefromstring()](https://php-legacy-docs.zend.com/manual/php5/en/function.getimagesizefromstring.html)
- [stream_set_chunk_size()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-set-chunk-size.html)
- [socket_import_stream()](https://php-legacy-docs.zend.com/manual/php5/en/function.socket-import-stream.html)
- [trait_exists()](https://php-legacy-docs.zend.com/manual/php5/en/function.trait-exists.html)
- [header_register_callback()](https://php-legacy-docs.zend.com/manual/php5/en/function.header-register-callback.html)

[SPL:](https://php-legacy-docs.zend.com/manual/php5/en/book.spl.html)

- [class_uses()](https://php-legacy-docs.zend.com/manual/php5/en/function.class-uses.html)

[Session:](https://php-legacy-docs.zend.com/manual/php5/en/book.session.html)

- [session_status()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-status.html)
- [session_register_shutdown()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-register-shutdown.html)

[Mysqli:](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html)

- [mysqli_error_list()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.error-list.html)
- [mysqli_stmt_error_list()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli-stmt.error-list.html)

[Libxml:](https://php-legacy-docs.zend.com/manual/php5/en/book.libxml.html)

- [libxml_set_external_entity_loader()](https://php-legacy-docs.zend.com/manual/php5/en/function.libxml-set-external-entity-loader.html)

[LDAP:](https://php-legacy-docs.zend.com/manual/php5/en/book.ldap.html)

- [ldap_control_paged_result()](https://php-legacy-docs.zend.com/manual/php5/en/function.ldap-control-paged-result.html)
- [ldap_control_paged_result_response()](https://php-legacy-docs.zend.com/manual/php5/en/function.ldap-control-paged-result-response.html)

[Intl:](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html)

- [transliterator_create()](https://php-legacy-docs.zend.com/manual/php5/en/transliterator.create.html)
- [transliterator_create_from_rules()](https://php-legacy-docs.zend.com/manual/php5/en/transliterator.createfromrules.html)
- [transliterator_create_inverse()](https://php-legacy-docs.zend.com/manual/php5/en/transliterator.createinverse.html)
- [transliterator_get_error_code()](https://php-legacy-docs.zend.com/manual/php5/en/transliterator.geterrorcode.html)
- [transliterator_get_error_message()](https://php-legacy-docs.zend.com/manual/php5/en/transliterator.geterrormessage.html)
- [transliterator_list_ids()](https://php-legacy-docs.zend.com/manual/php5/en/transliterator.listids.html)
- [transliterator_transliterate()](https://php-legacy-docs.zend.com/manual/php5/en/transliterator.transliterate.html)

[Zlib:](https://php-legacy-docs.zend.com/manual/php5/en/book.zlib.html)

- [zlib_decode()](https://php-legacy-docs.zend.com/manual/php5/en/function.zlib-decode.html)
- [zlib_encode()](https://php-legacy-docs.zend.com/manual/php5/en/function.zlib-encode.html)

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.functions.php)

## New Functions

PHP 5.3 introduced some new functions:

PHP Core:

- [array_replace()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-replace.html) - Replaces elements from passed arrays into one array.
- [array_replace_recursive()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-replace-recursive.html) - Recursively replaces elements from passed arrays into one array.
- [class_alias()](https://php-legacy-docs.zend.com/manual/php5/en/function.class-alias.html) - Creates an alias for a user defined class.
- [forward_static_call()](https://php-legacy-docs.zend.com/manual/php5/en/function.forward-static-call.html) - Call a user function from a method context.
- [forward_static_call_array()](https://php-legacy-docs.zend.com/manual/php5/en/function.forward-static-call-array.html) - Call a user function from a method context, with the arguments contained in an array.
- [gc_collect_cycles()](https://php-legacy-docs.zend.com/manual/php5/en/function.gc-collect-cycles.html) - Forces collection of any existing garbage cycles.
- [gc_disable()](https://php-legacy-docs.zend.com/manual/php5/en/function.gc-disable.html) - Deactivates the circular reference collector.
- [gc_enable()](https://php-legacy-docs.zend.com/manual/php5/en/function.gc-enable.html) - Activates the circular reference collector.
- [gc_enabled()](https://php-legacy-docs.zend.com/manual/php5/en/function.gc-enabled.html) - Returns the status of the circular reference collector.
- [get_called_class()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-called-class.html) - Return the name of the class a static method is called in.
- [gethostname()](https://php-legacy-docs.zend.com/manual/php5/en/function.gethostname.html) - Return the current host name for the local machine.
- [header_remove()](https://php-legacy-docs.zend.com/manual/php5/en/function.header-remove.html) - Removes an HTTP header previously set using the [header()](https://php-legacy-docs.zend.com/manual/php5/en/function.header.html) function.
- [lcfirst()](https://php-legacy-docs.zend.com/manual/php5/en/function.lcfirst.html) - Make a string's first character lowercase.
- [parse_ini_string()](https://php-legacy-docs.zend.com/manual/php5/en/function.parse-ini-string.html) - Parse a configuration string.
- [quoted_printable_encode()](https://php-legacy-docs.zend.com/manual/php5/en/function.quoted-printable-encode.html) - Convert an 8 bit string to a quoted-printable string.
- [str_getcsv()](https://php-legacy-docs.zend.com/manual/php5/en/function.str-getcsv.html) - Parse a CSV string into an array.
- [stream_context_set_default()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-context-set-default.html) - Set the default stream context.
- [stream_supports_lock()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-supports-lock.html) - Return **`TRUE`** if the stream supports locking.
- [stream_context_get_params()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-context-get-params.html) - Retrieve parameters from a stream context.
- [streamWrapper::stream_cast()](https://php-legacy-docs.zend.com/manual/php5/en/streamwrapper.stream-cast.html) - Retrieve the underlying stream resource.
- [streamWrapper::stream_set_option()](https://php-legacy-docs.zend.com/manual/php5/en/streamwrapper.stream-set-option.html) - Change stream options

[Date/Time](https://php-legacy-docs.zend.com/manual/php5/en/book.datetime.html):

- [date_add()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-add.html) - Adds an amount of days, months, years, hours, minutes and seconds to a [DateTime](https://php-legacy-docs.zend.com/manual/php5/en/class.datetime.html) object.
- [date_create_from_format()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-create-from-format.html) - Returns a new [DateTime](https://php-legacy-docs.zend.com/manual/php5/en/class.datetime.html) object formatted according to the given format.
- [date_diff()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-diff.html) - Returns the difference between two [DateTime](https://php-legacy-docs.zend.com/manual/php5/en/class.datetime.html) objects.
- [date_get_last_errors()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-get-last-errors.html) - Returns the warnings and errors from the last date/time operation.
- [date_parse_from_format()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-parse-from-format.html) - Get information about a given date.
- [date_sub()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-sub.html) - Subtracts an amount of days, months, years, hours, minutes and seconds from a [DateTime](https://php-legacy-docs.zend.com/manual/php5/en/class.datetime.html) object.
- [timezone_version_get()](https://php-legacy-docs.zend.com/manual/php5/en/function.timezone-version-get.html) - Returns the version of the timezonedb.

[GMP](https://php-legacy-docs.zend.com/manual/php5/en/book.gmp.html):

- [gmp_testbit()](https://php-legacy-docs.zend.com/manual/php5/en/function.gmp-testbit.html) - Tests whether a bit is set.

[Hash](https://php-legacy-docs.zend.com/manual/php5/en/book.hash.html):

- [hash_copy()](https://php-legacy-docs.zend.com/manual/php5/en/function.hash-copy.html) - Copy hashing context.

[IMAP](https://php-legacy-docs.zend.com/manual/php5/en/book.imap.html):

- [imap_gc()](https://php-legacy-docs.zend.com/manual/php5/en/function.imap-gc.html) - Clears IMAP cache.
- [imap_utf8_to_mutf7()](https://php-legacy-docs.zend.com/manual/php5/en/function.imap-utf8-to-mutf7.html) - Encode a UTF-8 string to modified UTF-7.
- [imap_mutf7_to_utf8()](https://php-legacy-docs.zend.com/manual/php5/en/function.imap-mutf7-to-utf8.html) - Decode a modified UTF-7 string to UTF-8.

[JSON](https://php-legacy-docs.zend.com/manual/php5/en/book.json.html):

- [json_last_error()](https://php-legacy-docs.zend.com/manual/php5/en/function.json-last-error.html) - Returns the last JSON error that occurred.

[MySQL Improved](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html):

- [mysqli_fetch_all()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli-result.fetch-all.html) - Fetches all result rows as an associative array, a numeric array, or both.
- [mysqli_get_connection_stats()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.get-connection-stats.html) - Returns statistics about the client connection.
- [mysqli_poll()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.poll.html) - Poll connections.
- [mysqli_reap_async_query()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.reap-async-query.html) - Get result from async query.

[OpenSSL](https://php-legacy-docs.zend.com/manual/php5/en/book.openssl.html):

- [openssl_random_pseudo_bytes()](https://php-legacy-docs.zend.com/manual/php5/en/function.openssl-random-pseudo-bytes.html) - Returns a string of the given length specified, filled with pseudo-random bytes.

[PCNTL](https://php-legacy-docs.zend.com/manual/php5/en/book.pcntl.html):

- [pcntl_signal_dispatch()](https://php-legacy-docs.zend.com/manual/php5/en/function.pcntl-signal-dispatch.html) - Calls signal handlers for pending signals.
- [pcntl_sigprocmask()](https://php-legacy-docs.zend.com/manual/php5/en/function.pcntl-sigprocmask.html) - Sets and retrieves blocked signals.
- [pcntl_sigtimedwait()](https://php-legacy-docs.zend.com/manual/php5/en/function.pcntl-sigtimedwait.html) - Wait for signals with a timeout.
- [pcntl_sigwaitinfo()](https://php-legacy-docs.zend.com/manual/php5/en/function.pcntl-sigwaitinfo.html) - Wait for signals.

[PCRE](https://php-legacy-docs.zend.com/manual/php5/en/book.pcre.html):

- [preg_filter()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-filter.html) - Perform a regular expression search and replace, returning only results which matched the pattern.

[Semaphore](https://php-legacy-docs.zend.com/manual/php5/en/book.sem.html):

- [msg_queue_exists()](https://php-legacy-docs.zend.com/manual/php5/en/function.msg-queue-exists.html) - Check whether a message queue exists.
- [shm_has_var()](https://php-legacy-docs.zend.com/manual/php5/en/function.shm-has-var.html) - Checks whether a specific key exists inside a shared memory segment.

The following functions are now natively implemented, making them available on all operating systems which can run PHP:

- [acosh()](https://php-legacy-docs.zend.com/manual/php5/en/function.acosh.html)
- [asinh()](https://php-legacy-docs.zend.com/manual/php5/en/function.asinh.html)
- [atanh()](https://php-legacy-docs.zend.com/manual/php5/en/function.atanh.html)
- [expm1()](https://php-legacy-docs.zend.com/manual/php5/en/function.expm1.html)
- [log1p()](https://php-legacy-docs.zend.com/manual/php5/en/function.log1p.html)

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.functions.php)

## New Functions

PHP 5.2.x introduced some new functions:

PHP Core:

- [array_fill_keys()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-fill-keys.html) - Create an array using the elements of the first parameter as keys, each initialized to `val`
- [error_get_last()](https://php-legacy-docs.zend.com/manual/php5/en/function.error-get-last.html) - Get the last occurred error as associative array. Returns **`NULL`** if there hasn't been an error yet
- [image_type_to_extension()](https://php-legacy-docs.zend.com/manual/php5/en/function.image-type-to-extension.html) - Get file extension for image-type returned by [getimagesize()](https://php-legacy-docs.zend.com/manual/php5/en/function.getimagesize.html), [exif_read_data()](https://php-legacy-docs.zend.com/manual/php5/en/function.exif-read-data.html), [exif_thumbnail()](https://php-legacy-docs.zend.com/manual/php5/en/function.exif-thumbnail.html), [exif_imagetype()](https://php-legacy-docs.zend.com/manual/php5/en/function.exif-imagetype.html)
- [memory_get_peak_usage()](https://php-legacy-docs.zend.com/manual/php5/en/function.memory-get-peak-usage.html) - Returns the peak allocated by PHP memory
- [sys_get_temp_dir()](https://php-legacy-docs.zend.com/manual/php5/en/function.sys-get-temp-dir.html) - Returns directory path used for temporary files. (Added in 5.2.1)
- [timezone_abbreviations_list()](https://php-legacy-docs.zend.com/manual/php5/en/function.timezone-abbreviations-list.html) - Returns associative array containing DST, offset and the timezone name
- [timezone_identifiers_list()](https://php-legacy-docs.zend.com/manual/php5/en/function.timezone-identifiers-list.html) - Returns numerically indexed array with all timezone identifiers
- [timezone_name_from_abbr()](https://php-legacy-docs.zend.com/manual/php5/en/function.timezone-name-from-abbr.html) - Returns the timezone name from abbreviation
- [stream_socket_shutdown()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-socket-shutdown.html) - Causes all or part of a full-duplex connection on the socket associated with stream to be shut down. As of PHP 5.2.1.

[Image](https://php-legacy-docs.zend.com/manual/php5/en/ref.image.html):

- [imagegrabscreen()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagegrabscreen.html) - Grabs a screenshot of the whole screen. As of PHP 5.2.2.
- [imagegrabwindow()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagegrabwindow.html) - Captures a window. As of PHP 5.2.2.

[libXML](https://php-legacy-docs.zend.com/manual/php5/en/book.libxml.html):

- [libxml_disable_entity_loader()](https://php-legacy-docs.zend.com/manual/php5/en/function.libxml-disable-entity-loader.html) - Disable the ability to load external entities. As of PHP 5.2.11.

[mbstring](https://php-legacy-docs.zend.com/manual/php5/en/ref.mbstring.html):

- [mb_stripos()](https://php-legacy-docs.zend.com/manual/php5/en/function.mb-stripos.html) - Finds position of first occurrence of a string within another, case insensitive
- [mb_stristr()](https://php-legacy-docs.zend.com/manual/php5/en/function.mb-stristr.html) - Finds first occurrence of a string within another, case insensitive
- [mb_strrchr()](https://php-legacy-docs.zend.com/manual/php5/en/function.mb-strrchr.html) - Finds the last occurrence of a character in a string within another
- [mb_strrichr()](https://php-legacy-docs.zend.com/manual/php5/en/function.mb-strrichr.html) - Finds the last occurrence of a character in a string within another, case insensitive
- [mb_strripos()](https://php-legacy-docs.zend.com/manual/php5/en/function.mb-strripos.html) - Finds position of last occurrence of a string within another, case insensitive
- [mb_strstr()](https://php-legacy-docs.zend.com/manual/php5/en/function.mb-strstr.html) - Finds first occurrence of a string within another

[ming](https://php-legacy-docs.zend.com/manual/php5/en/ref.ming.html) (As of PHP 5.2.1):

- void ming_setSWFCompression(int num) - Sets output compression
- void swfmovie::namedanchor(string name) - Creates anchor
- void swfmovie::protect(\[string password\]) - Protects

[openssl](https://php-legacy-docs.zend.com/manual/php5/en/ref.openssl.html):

- [openssl_csr_get_public_key()](https://php-legacy-docs.zend.com/manual/php5/en/function.openssl-csr-get-public-key.html) - Extracts public key from a CERT and prepares it for use
- [openssl_csr_get_subject()](https://php-legacy-docs.zend.com/manual/php5/en/function.openssl-csr-get-subject.html) - Returns the subject of a CERT
- [openssl_pkey_get_details()](https://php-legacy-docs.zend.com/manual/php5/en/function.openssl-pkey-get-details.html) - Returns an array with the key details (bits, pkey, type)

[spl](https://php-legacy-docs.zend.com/manual/php5/en/ref.spl.html):

- [spl_object_hash()](https://php-legacy-docs.zend.com/manual/php5/en/function.spl-object-hash.html) - Return hash id for given object
- int iterator_apply(Traversable it, mixed function \[, mixed params\]) - Calls a function for every element in an iterator

[pcre](https://php-legacy-docs.zend.com/manual/php5/en/ref.pcre.html):

- [preg_last_error()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-last-error.html) - Returns the error code of the last regex execution

[pgsql](https://php-legacy-docs.zend.com/manual/php5/en/ref.pgsql.html):

- [pg_field_table()](https://php-legacy-docs.zend.com/manual/php5/en/function.pg-field-table.html) - Returns the name of the table field belongs to, or table's oid if `oid_only` is **`TRUE`**

[posix](https://php-legacy-docs.zend.com/manual/php5/en/ref.posix.html):

- [posix_initgroups()](https://php-legacy-docs.zend.com/manual/php5/en/function.posix-initgroups.html) - Calculate the group access list for the user specified in name

[gmp](https://php-legacy-docs.zend.com/manual/php5/en/ref.gmp.html):

- [gmp_nextprime()](https://php-legacy-docs.zend.com/manual/php5/en/function.gmp-nextprime.html) - Finds next prime number

[xmlwriter](https://php-legacy-docs.zend.com/manual/php5/en/ref.xmlwriter.html):

- [xmlwriter_full_end_element()](https://php-legacy-docs.zend.com/manual/php5/en/function.xmlwriter-full-end-element.html) - End current element - returns **`FALSE`** on error
- [xmlwriter_write_raw()](https://php-legacy-docs.zend.com/manual/php5/en/function.xmlwriter-write-raw.html) - Write text - returns **`FALSE`** on error
- [xmlwriter_start_dtd_entity()](https://php-legacy-docs.zend.com/manual/php5/en/function.xmlwriter-start-dtd-entity.html) - Create start DTD Entity - returns **`FALSE`** on error
- [xmlwriter_end_dtd_entity()](https://php-legacy-docs.zend.com/manual/php5/en/function.xmlwriter-end-dtd-entity.html) - End current DTD Entity - returns **`FALSE`** on error
- [xmlwriter_write_dtd_entity()](https://php-legacy-docs.zend.com/manual/php5/en/function.xmlwriter-write-dtd-entity.html) - Write full DTD Entity tag - returns **`FALSE`** on error

# [PHP 5.0](https://php-legacy-docs.zend.com/manual/php5/en/migration5.functions.php)

## New Functions

In PHP 5 there are some new functions. Here is the list of them:

[Arrays](https://php-legacy-docs.zend.com/manual/php5/en/ref.array.html):

- [array_combine()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-combine.html) - Creates an array by using one array for keys and another for its values
- [array_diff_uassoc()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-diff-uassoc.html) - Computes the difference of arrays with additional index check which is performed by a user supplied callback function
- [array_udiff()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-udiff.html) - Computes the difference of arrays by using a callback function for data comparison
- [array_udiff_assoc()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-udiff-assoc.html) - Computes the difference of arrays with additional index check. The data is compared by using a callback function
- [array_udiff_uassoc()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-udiff-uassoc.html) - Computes the difference of arrays with additional index check. The data is compared by using a callback function. The index check is done by a callback function also
- [array_walk_recursive()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-walk-recursive.html) - Apply a user function recursively to every member of an array
- [array_uintersect_assoc()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-uintersect-assoc.html) - Computes the intersection of arrays with additional index check. The data is compared by using a callback function
- [array_uintersect_uassoc()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-uintersect-uassoc.html) - Computes the intersection of arrays with additional index check. Both the data and the indexes are compared by using separate callback functions
- [array_uintersect()](https://php-legacy-docs.zend.com/manual/php5/en/function.array-uintersect.html) - Computes the intersection of arrays. The data is compared by using a callback function

[InterBase](https://php-legacy-docs.zend.com/manual/php5/en/ref.ibase.html):

- [ibase_affected_rows()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-affected-rows.html) - Return the number of rows that were affected by the previous query
- [ibase_backup()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-backup.html) - Initiates a backup task in the service manager and returns immediately
- [ibase_commit_ret()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-commit-ret.html) - Commit a transaction without closing it
- [ibase_db_info()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-db-info.html) - Request statistics about a database
- [ibase_drop_db()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-drop-db.html) - Drops a database
- [ibase_errcode()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-errcode.html) - Return an error code
- [ibase_free_event_handler()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-free-event-handler.html) - Cancels a registered event handler
- [ibase_gen_id()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-gen-id.html) - Increments the named generator and returns its new value
- [ibase_maintain_db()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-maintain-db.html) - Execute a maintenance command on the database server
- [ibase_name_result()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-name-result.html) - Assigns a name to a result set
- [ibase_num_params()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-num-params.html) - Return the number of parameters in a prepared query
- [ibase_param_info()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-param-info.html) - Return information about a parameter in a prepared query
- [ibase_restore()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-restore.html) - Initiates a restore task in the service manager and returns immediately
- [ibase_rollback_ret()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-rollback-ret.html) - Rollback transaction and retain the transaction context
- [ibase_server_info()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-server-info.html) - Request statistics about a database server
- [ibase_service_attach()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-service-attach.html) - Connect to the service manager
- [ibase_service_detach()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-service-detach.html) - Disconnect from the service manager
- [ibase_set_event_handler()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-set-event-handler.html) - Register a callback function to be called when events are posted
- [ibase_wait_event()](https://php-legacy-docs.zend.com/manual/php5/en/function.ibase-wait-event.html) - Wait for an event to be posted by the database

[iconv](https://php-legacy-docs.zend.com/manual/php5/en/ref.iconv.html):

- [iconv_mime_decode()](https://php-legacy-docs.zend.com/manual/php5/en/function.iconv-mime-decode.html) - Decodes a MIME header field
- [iconv_mime_decode_headers()](https://php-legacy-docs.zend.com/manual/php5/en/function.iconv-mime-decode-headers.html) - Decodes multiple MIME header fields at once
- [iconv_mime_encode()](https://php-legacy-docs.zend.com/manual/php5/en/function.iconv-mime-encode.html) - Composes a MIME header field
- [iconv_strlen()](https://php-legacy-docs.zend.com/manual/php5/en/function.iconv-strlen.html) - Returns the character count of string
- [iconv_strpos()](https://php-legacy-docs.zend.com/manual/php5/en/function.iconv-strpos.html) - Finds position of first occurrence of a needle within a haystack
- [iconv_strrpos()](https://php-legacy-docs.zend.com/manual/php5/en/function.iconv-strrpos.html) - Finds the last occurrence of a needle within a haystack
- [iconv_substr()](https://php-legacy-docs.zend.com/manual/php5/en/function.iconv-substr.html) - Cut out part of a string

[Streams](https://php-legacy-docs.zend.com/manual/php5/en/ref.stream.html):

- [stream_copy_to_stream()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-copy-to-stream.html) - Copies data from one stream to another
- [stream_get_line()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-get-line.html) - Gets line from stream resource up to a given delimiter
- [stream_socket_accept()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-socket-accept.html) - Accept a connection on a socket created by [stream_socket_server()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-socket-server.html)
- [stream_socket_client()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-socket-client.html) - Open Internet or Unix domain socket connection
- [stream_socket_get_name()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-socket-get-name.html) - Retrieve the name of the local or remote sockets
- [stream_socket_recvfrom()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-socket-recvfrom.html) - Receives data from a socket, connected or not
- [stream_socket_sendto()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-socket-sendto.html) - Sends a message to a socket, whether it is connected or not
- [stream_socket_server()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-socket-server.html) - Create an Internet or Unix domain server socket

[Date and time related](https://php-legacy-docs.zend.com/manual/php5/en/ref.datetime.html):

- [idate()](https://php-legacy-docs.zend.com/manual/php5/en/function.idate.html) - Format a local time/date as integer
- [date_sunset()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-sunset.html) - Time of sunset for a given day and location
- [date_sunrise()](https://php-legacy-docs.zend.com/manual/php5/en/function.date-sunrise.html) - Time of sunrise for a given day and location
- [time_nanosleep()](https://php-legacy-docs.zend.com/manual/php5/en/function.time-nanosleep.html) - Delay for a number of seconds and nanoseconds

[Strings](https://php-legacy-docs.zend.com/manual/php5/en/ref.strings.html):

- [str_split()](https://php-legacy-docs.zend.com/manual/php5/en/function.str-split.html) - Convert a string to an array
- [strpbrk()](https://php-legacy-docs.zend.com/manual/php5/en/function.strpbrk.html) - Search a string for any of a set of characters
- [substr_compare()](https://php-legacy-docs.zend.com/manual/php5/en/function.substr-compare.html) - Binary safe optionally case insensitive comparison of two strings from an offset, up to length characters

Other:

- [convert_uudecode()](https://php-legacy-docs.zend.com/manual/php5/en/function.convert-uudecode.html) - decode a uuencoded string
- [convert_uuencode()](https://php-legacy-docs.zend.com/manual/php5/en/function.convert-uuencode.html) - uuencode a string
- [curl_copy_handle()](https://php-legacy-docs.zend.com/manual/php5/en/function.curl-copy-handle.html) - Copy a cURL handle along with all of its preferences
- [dba_key_split()](https://php-legacy-docs.zend.com/manual/php5/en/function.dba-key-split.html) - Splits a key in string representation into array representation
- [dbase_get_header_info()](https://php-legacy-docs.zend.com/manual/php5/en/function.dbase-get-header-info.html) - Get the header info of a dBase database
- [dbx_fetch_row()](https://php-legacy-docs.zend.com/manual/php5/en/function.dbx-fetch-row.html) - Fetches rows from a query-result that had the **`DBX_RESULT_UNBUFFERED`** flag set
- [fbsql_set_password()](https://php-legacy-docs.zend.com/manual/php5/en/function.fbsql-set-password.html) - Change the password for a given user
- [file_put_contents()](https://php-legacy-docs.zend.com/manual/php5/en/function.file-put-contents.html) - Write a string to a file
- [ftp_alloc()](https://php-legacy-docs.zend.com/manual/php5/en/function.ftp-alloc.html) - Allocates space for a file to be uploaded
- [get_declared_interfaces()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-declared-interfaces.html) - Returns an array of all declared interfaces
- [get_headers()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-headers.html) - Fetches all the headers sent by the server in response to a HTTP request
- [headers_list()](https://php-legacy-docs.zend.com/manual/php5/en/function.headers-list.html) - Returns a list of response headers sent (or ready to send)
- [http_build_query()](https://php-legacy-docs.zend.com/manual/php5/en/function.http-build-query.html) - Generate URL-encoded query string
- [image_type_to_extension()](https://php-legacy-docs.zend.com/manual/php5/en/function.image-type-to-extension.html) - Get file extension for image-type returned by [getimagesize()](https://php-legacy-docs.zend.com/manual/php5/en/function.getimagesize.html), [exif_read_data()](https://php-legacy-docs.zend.com/manual/php5/en/function.exif-read-data.html), [exif_thumbnail()](https://php-legacy-docs.zend.com/manual/php5/en/function.exif-thumbnail.html), [exif_imagetype()](https://php-legacy-docs.zend.com/manual/php5/en/function.exif-imagetype.html)
- [imagefilter()](https://php-legacy-docs.zend.com/manual/php5/en/function.imagefilter.html) - Applies a filter to an image using custom arguments
- [imap_getacl()](https://php-legacy-docs.zend.com/manual/php5/en/function.imap-getacl.html) - Gets the ACL for a given mailbox
- [ldap_sasl_bind()](https://php-legacy-docs.zend.com/manual/php5/en/function.ldap-sasl-bind.html) - Bind to LDAP directory using SASL
- [mb_list_encodings()](https://php-legacy-docs.zend.com/manual/php5/en/function.mb-list-encodings.html) - Returns an array of all supported encodings
- [pcntl_getpriority()](https://php-legacy-docs.zend.com/manual/php5/en/function.pcntl-getpriority.html) - Get the priority of any process
- [pcntl_wait()](https://php-legacy-docs.zend.com/manual/php5/en/function.pcntl-wait.html) - Waits on or returns the status of a forked child as defined by the `waitpid()` system call
- [pg_version()](https://php-legacy-docs.zend.com/manual/php5/en/function.pg-version.html) - Returns an array with client, protocol and server version (when available)
- [php_check_syntax()](https://php-legacy-docs.zend.com/manual/php5/en/function.php-check-syntax.html) - Check the syntax of the specified file
- [php_strip_whitespace()](https://php-legacy-docs.zend.com/manual/php5/en/function.php-strip-whitespace.html) - Return source with stripped comments and whitespace
- [proc_nice()](https://php-legacy-docs.zend.com/manual/php5/en/function.proc-nice.html) - Change the priority of the current process
- [pspell_config_data_dir()](https://php-legacy-docs.zend.com/manual/php5/en/function.pspell-config-data-dir.html) - Change location of language data files
- [pspell_config_dict_dir()](https://php-legacy-docs.zend.com/manual/php5/en/function.pspell-config-dict-dir.html) - Change location of the main word list
- [setrawcookie()](https://php-legacy-docs.zend.com/manual/php5/en/function.setrawcookie.html) - Send a cookie without URL-encoding the value
- [scandir()](https://php-legacy-docs.zend.com/manual/php5/en/function.scandir.html) - List files and directories inside the specified path
- [snmp_read_mib()](https://php-legacy-docs.zend.com/manual/php5/en/function.snmp-read-mib.html) - Reads and parses a MIB file into the active MIB tree
- [sqlite_fetch_column_types()](https://php-legacy-docs.zend.com/manual/php5/en/function.sqlite-fetch-column-types.html) - Return an array of column types from a particular table

> **Note**:
>
> The [Tidy](https://php-legacy-docs.zend.com/manual/php5/en/ref.tidy.html) extension has also changed its API completely.
