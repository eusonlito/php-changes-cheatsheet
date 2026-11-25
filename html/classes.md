# [New Classes and Interfaces in PHP 8.6, 8.5, 8.4, 8.3, 8.1, 8.0, 7.4, 7.0, 5.5, 5.4, 5.3, 5.2](index.md)

# [PHP 8.6](https://www.php.net/manual/en/migration86.new-classes.php)

## New Classes and Interfaces

### Core

- [SortDirection](https://www.php.net/manual/en/enum.sortdirection.php)
- [StreamError](https://www.php.net/manual/en/class.streamerror.php)
- [StreamException](https://www.php.net/manual/en/class.streamexception.php)
- [StreamErrorStore](https://www.php.net/manual/en/enum.streamerrorstore.php)
- [StreamErrorMode](https://www.php.net/manual/en/enum.streamerrormode.php)
- [StreamErrorCode](https://www.php.net/manual/en/enum.streamerrorcode.php)
- **Io\IoException**
- **Io\Poll\Context**
- **Io\Poll\Watcher**
- **Io\Poll\Backend**
- **Io\Poll\Event**
- **Io\Poll\Handle**
- **Io\Poll\PollException**
- **Io\Poll\FailedPollOperationException**
- **Io\Poll\FailedContextInitializationException**
- **Io\Poll\FailedHandleAddException**
- **Io\Poll\FailedWatcherModificationException**
- **Io\Poll\FailedPollWaitException**
- **Io\Poll\BackendUnavailableException**
- **Io\Poll\InactiveWatcherException**
- **Io\Poll\HandleAlreadyWatchedException**
- **Io\Poll\InvalidHandleException**
- **StreamPollHandle**

### Date

- [Time\Duration](https://www.php.net/manual/en/class.time-duration.php)
- [Time\TimeException](https://www.php.net/manual/en/class.time-timeexception.php)

### Intl

- **IntlNumberRangeFormatter**

### OpenSSL

- **Openssl\OpensslException**
- **Openssl\Session**
- **Openssl\Psk**

### SNMP

- **Snmp\Mib**
- **Snmp\OidOutput**
- **Snmp\Output**
- **Snmp\StringOutput**

### Sodium

- **SodiumCryptoXofShake128State**
- **SodiumCryptoXofShake256State**
- **SodiumCryptoXofTurboshake128State**
- **SodiumCryptoXofTurboshake256State**

### URI

- **Uri\Rfc3986\UriBuilder**
- **Uri\WhatWg\UrlBuilder**
- **Uri\WhatWg\UrlPercentEncodingMode**

# [PHP 8.5](https://www.php.net/manual/en/migration85.new-classes.php)

## New Classes and Interfaces

### Core

- [NoDiscard](https://www.php.net/manual/en/class.nodiscard.php)
- [DelayedTargetValidation](https://www.php.net/manual/en/class.delayedtargetvalidation.php)

### Curl

- [CurlSharePersistentHandle](https://www.php.net/manual/en/class.curlsharepersistenthandle.php)

### Filter

- [Filter\FilterException](https://www.php.net/manual/en/class.filter-filterexception.php)
- [Filter\FilterFailedException](https://www.php.net/manual/en/class.filter-filterfailedexception.php)

### Intl

- [IntlListFormatter](https://www.php.net/manual/en/class.intllistformatter.php)

### URI

- [Uri\UriException](https://www.php.net/manual/en/class.uri-uriexception.php)
- [Uri\InvalidUriException](https://www.php.net/manual/en/class.uri-invaliduriexception.php)
- [Uri\UriComparisonMode](https://www.php.net/manual/en/enum.uri-uricomparisonmode.php)
- [Uri\Rfc3986\Uri](https://www.php.net/manual/en/class.uri-rfc3986-uri.php)
- [Uri\WhatWg\InvalidUrlException](https://www.php.net/manual/en/class.uri-whatwg-invalidurlexception.php)
- [Uri\WhatWg\UrlValidationErrorType](https://www.php.net/manual/en/enum.uri-whatwg-urlvalidationerrortype.php)
- [Uri\WhatWg\UrlValidationError](https://www.php.net/manual/en/class.uri-whatwg-urlvalidationerror.php)
- [Uri\WhatWg\Url](https://www.php.net/manual/en/class.uri-whatwg-url.php)

# [PHP 8.4](https://www.php.net/manual/en/migration84.new-classes.php)

## New Classes, Enums, and Interfaces

### Core

- [Deprecated](https://www.php.net/manual/en/class.deprecated.php)
- [RequestParseBodyException](https://www.php.net/manual/en/class.requestparsebodyexception.php)

### BCMath

- [BcMath\Number](https://www.php.net/manual/en/class.bcmath-number.php)

### DBA

- [Dba\Connection](https://www.php.net/manual/en/class.dba-connection.php)

### DOM

- [Dom\HTMLDocument](https://www.php.net/manual/en/class.dom-htmldocument.php)
- [Dom\XMLDocument](https://www.php.net/manual/en/class.dom-xmldocument.php)
- [Dom\Document](https://www.php.net/manual/en/class.dom-document.php)
- [Dom\ParentNode](https://www.php.net/manual/en/class.dom-parentnode.php)
- [Dom\ChildNode](https://www.php.net/manual/en/class.dom-childnode.php)
- [Dom\Implementation](https://www.php.net/manual/en/class.dom-implementation.php)
- [Dom\Node](https://www.php.net/manual/en/class.dom-node.php)
- [Dom\NodeList](https://www.php.net/manual/en/class.dom-nodelist.php)
- [Dom\NamedNodeMap](https://www.php.net/manual/en/class.dom-namednodemap.php)
- [Dom\DtdNamedNodeMap](https://www.php.net/manual/en/class.dom-dtdnamednodemap.php)
- [Dom\HTMLCollection](https://www.php.net/manual/en/class.dom-htmlcollection.php)
- [Dom\AdjacentPosition](https://www.php.net/manual/en/enum.dom-adjacentposition.php)
- [Dom\Element](https://www.php.net/manual/en/class.dom-element.php)
- [Dom\HTMLElement](https://www.php.net/manual/en/class.dom-htmlelement.php)
- [Dom\Attr](https://www.php.net/manual/en/class.dom-attr.php)
- [Dom\CharacterData](https://www.php.net/manual/en/class.dom-characterdata.php)
- [Dom\Text](https://www.php.net/manual/en/class.dom-text.php)
- [Dom\CDATASection](https://www.php.net/manual/en/class.dom-cdatasection.php)
- [Dom\ProcessingInstruction](https://www.php.net/manual/en/class.dom-processinginstruction.php)
- [Dom\Comment](https://www.php.net/manual/en/class.dom-comment.php)
- [Dom\DocumentType](https://www.php.net/manual/en/class.dom-documenttype.php)
- [Dom\DocumentFragment](https://www.php.net/manual/en/class.dom-documentfragment.php)
- [Dom\Entity](https://www.php.net/manual/en/class.dom-entity.php)
- [Dom\EntityReference](https://www.php.net/manual/en/class.dom-entityreference.php)
- [Dom\Notation](https://www.php.net/manual/en/class.dom-notation.php)
- [Dom\TokenList](https://www.php.net/manual/en/class.dom-tokenlist.php)
- [Dom\NamespaceInfo](https://www.php.net/manual/en/class.dom-namespaceinfo.php)
- [Dom\XPath](https://www.php.net/manual/en/class.dom-xpath.php)

### ODBC

- [Odbc\Connection](https://www.php.net/manual/en/class.odbc-connection.php)
- [Odbc\Result](https://www.php.net/manual/en/class.odbc-result.php)

### PCNTL

- [Pcntl\QosClass](https://www.php.net/manual/en/enum.pcntl-qosclass.php) (macOS only)

### PDO_DBLIB

- [Pdo\DbLib](https://www.php.net/manual/en/class.pdo-dblib.php)

### PDO_FIREBIRD

- [Pdo\Firebird](https://www.php.net/manual/en/class.pdo-firebird.php)

### PDO_MYSQL

- [Pdo\Mysql](https://www.php.net/manual/en/class.pdo-mysql.php)

### PDO_ODBC

- [Pdo\Odbc](https://www.php.net/manual/en/class.pdo-odbc.php)

### PDO_PGSQL

- [Pdo\Pgsql](https://www.php.net/manual/en/class.pdo-pgsql.php)

### PDO_SQLITE

- [Pdo\Sqlite](https://www.php.net/manual/en/class.pdo-sqlite.php)

### Reflection

- [ReflectionConstant](https://www.php.net/manual/en/class.reflectionconstant.php)

### SOAP

- [Soap\Url](https://www.php.net/manual/en/class.soap-url.php)
- [Soap\Sdl](https://www.php.net/manual/en/class.soap-sdl.php)

### Standard

- [RoundingMode](https://www.php.net/manual/en/enum.roundingmode.php)
- [StreamBucket](https://www.php.net/manual/en/class.streambucket.php)

# [PHP 8.3](https://www.php.net/manual/en/migration83.new-classes.php)

## New Classes and Interfaces

### Date

- [DateError](https://www.php.net/manual/en/class.dateerror.php)

- [DateObjectError](https://www.php.net/manual/en/class.dateobjecterror.php)

- [DateRangeError](https://www.php.net/manual/en/class.daterangeerror.php)

- [DateException](https://www.php.net/manual/en/class.dateexception.php)

- [DateInvalidOperationException](https://www.php.net/manual/en/class.dateinvalidoperationexception.php)

- [DateInvalidTimeZoneException](https://www.php.net/manual/en/class.dateinvalidtimezoneexception.php)

- [DateMalformedIntervalStringException](https://www.php.net/manual/en/class.datemalformedintervalstringexception.php)

- [DateMalformedPeriodStringException](https://www.php.net/manual/en/class.datemalformedperiodstringexception.php)

- [DateMalformedStringException](https://www.php.net/manual/en/class.datemalformedstringexception.php)

### Random

- [Random\IntervalBoundary](https://www.php.net/manual/en/enum.random-intervalboundary.php)

# [PHP 8.1](https://www.php.net/manual/en/migration81.new-classes.php)

## New Classes and Interfaces

### cURL

- [CURLStringFile](https://www.php.net/manual/en/class.curlstringfile.php)

### FileInfo

- [finfo](https://www.php.net/manual/en/class.finfo.php)

### FTP

- [FTP\Connection](https://www.php.net/manual/en/class.ftp-connection.php)

### IMAP

- [IMAP\Connection](https://www.php.net/manual/en/class.imap-connection.php)

### Intl

- [IntlDatePatternGenerator](https://www.php.net/manual/en/class.intldatepatterngenerator.php)

### LDAP

- [LDAP\Connection](https://www.php.net/manual/en/class.ldap-connection.php)

- [LDAP\Result](https://www.php.net/manual/en/class.ldap-result.php)

- [LDAP\ResultEntry](https://www.php.net/manual/en/class.ldap-result-entry.php)

### PgSQL

- [PgSql\Connection](https://www.php.net/manual/en/class.pgsql-connection.php)

- [PgSql\Lob](https://www.php.net/manual/en/class.pgsql-lob.php)

- [PgSql\Result](https://www.php.net/manual/en/class.pgsql-result.php)

### PSpell

- [PSpell\Config](https://www.php.net/manual/en/class.pspell-config.php)

- [PSpell\Dictionary](https://www.php.net/manual/en/class.pspell-dictionary.php)

### Reflection

- [ReflectionFiber](https://www.php.net/manual/en/class.reflectionfiber.php)

# [PHP 8.0](https://www.php.net/manual/en/migration80.new-classes.php)

## New Classes and Interfaces

### cURL

- [CurlHandle](https://www.php.net/manual/en/class.curlhandle.php)

- [CurlMultiHandle](https://www.php.net/manual/en/class.curlmultihandle.php)

- [CurlShareHandle](https://www.php.net/manual/en/class.curlsharehandle.php)

### Enchant

- [EnchantBroker](https://www.php.net/manual/en/class.enchantbroker.php)

- [EnchantDictionary](https://www.php.net/manual/en/class.enchantdictionary.php)

### GD

- [GdImage](https://www.php.net/manual/en/class.gdimage.php)

### OpenSSL

- [OpenSSLAsymmetricKey](https://www.php.net/manual/en/class.opensslasymmetrickey.php)

- [OpenSSLCertificate](https://www.php.net/manual/en/class.opensslcertificate.php)

- [OpenSSLCertificateSigningRequest](https://www.php.net/manual/en/class.opensslcertificatesigningrequest.php)

### Shmop

- [Shmop](https://www.php.net/manual/en/class.shmop.php)

### Sockets

- [AddressInfo](https://www.php.net/manual/en/class.addressinfo.php)

- [Socket](https://www.php.net/manual/en/class.socket.php)

### System V

- [SysvMessageQueue](https://www.php.net/manual/en/class.sysvmessagequeue.php)

- [SysvSemaphore](https://www.php.net/manual/en/class.sysvsemaphore.php)

- [SysvSharedMemory](https://www.php.net/manual/en/class.sysvsharedmemory.php)

### XML Parser

- [XMLParser](https://www.php.net/manual/en/class.xmlparser.php)

### XMLWriter

- [XMLWriter](https://www.php.net/manual/en/class.xmlwriter.php)

### Zlib

- [DeflateContext](https://www.php.net/manual/en/class.deflatecontext.php)

- [InflateContext](https://www.php.net/manual/en/class.inflatecontext.php)

# [PHP 7.4](https://www.php.net/manual/en/migration74.new-classes.php)

## New Classes and Interfaces

### Reflection

- [ReflectionReference](https://www.php.net/manual/en/class.reflectionreference.php)

# [PHP 7.0](https://www.php.net/manual/en/migration70.classes.php)

## New Classes and Interfaces

### [Intl](https://www.php.net/manual/en/book.intl.php)

- [IntlChar](https://www.php.net/manual/en/class.intlchar.php)

### [Reflection](https://www.php.net/manual/en/book.reflection.php)

- [ReflectionGenerator](https://www.php.net/manual/en/class.reflectiongenerator.php)

&nbsp;

- [ReflectionType](https://www.php.net/manual/en/class.reflectiontype.php)

### [Session Handling](https://www.php.net/manual/en/book.session.php)

- [SessionUpdateTimestampHandlerInterface](https://www.php.net/manual/en/class.sessionupdatetimestamphandlerinterface.php)

### Exception Hierarchy

- [Throwable](https://www.php.net/manual/en/class.throwable.php)

- [Error](https://www.php.net/manual/en/class.error.php)

- [TypeError](https://www.php.net/manual/en/class.typeerror.php)

- [ParseError](https://www.php.net/manual/en/class.parseerror.php)

- [AssertionError](https://www.php.net/manual/en/class.assertionerror.php)

- [ArithmeticError](https://www.php.net/manual/en/class.arithmeticerror.php)

- [DivisionByZeroError](https://www.php.net/manual/en/class.divisionbyzeroerror.php)

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.classes.php)

## New Classes and Interfaces

### [cURL](https://php-legacy-docs.zend.com/manual/php5/en/book.curl.html)

- [CURLFile](https://php-legacy-docs.zend.com/manual/php5/en/class.curlfile.html)

### [Date and Time](https://php-legacy-docs.zend.com/manual/php5/en/book.datetime.html)

- [DateTimeImmutable](https://php-legacy-docs.zend.com/manual/php5/en/class.datetimeimmutable.html)
- [DateTimeInterface](https://php-legacy-docs.zend.com/manual/php5/en/class.datetimeinterface.html)

### [Intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html)

- [IntlCalendar](https://php-legacy-docs.zend.com/manual/php5/en/class.intlcalendar.html)
- [IntlGregorianCalendar](https://php-legacy-docs.zend.com/manual/php5/en/class.intlgregoriancalendar.html)
- [IntlTimeZone](https://php-legacy-docs.zend.com/manual/php5/en/class.intltimezone.html)
- [IntlBreakIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.intlbreakiterator.html)
- [IntlRuleBasedBreakIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.intlrulebasedbreakiterator.html)
- [IntlCodePointBreakIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.intlcodepointbreakiterator.html)

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.classes.php)

## New Classes and Interfaces

The following classes were introduced in PHP 5.4.0:

[SPL](https://php-legacy-docs.zend.com/manual/php5/en/book.spl.html):

- [CallbackFilterIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.callbackfilteriterator.html)
- [RecursiveCallbackFilterIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.recursivecallbackfilteriterator.html)

[Reflection](https://php-legacy-docs.zend.com/manual/php5/en/book.reflection.html):

- [ReflectionZendExtension](https://php-legacy-docs.zend.com/manual/php5/en/class.reflectionzendextension.html)

[Json](https://php-legacy-docs.zend.com/manual/php5/en/book.json.html):

- [JsonSerializable](https://php-legacy-docs.zend.com/manual/php5/en/class.jsonserializable.html)

[Session](https://php-legacy-docs.zend.com/manual/php5/en/book.session.html):

- [SessionHandler](https://php-legacy-docs.zend.com/manual/php5/en/class.sessionhandler.html)
- [SessionHandlerInterface](https://php-legacy-docs.zend.com/manual/php5/en/class.sessionhandlerinterface.html)

[Snmp](https://php-legacy-docs.zend.com/manual/php5/en/book.snmp.html):

- [SNMP](https://php-legacy-docs.zend.com/manual/php5/en/class.snmp.html)

[Intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html):

- [Transliterator](https://php-legacy-docs.zend.com/manual/php5/en/class.transliterator.html)
- [Spoofchecker](https://php-legacy-docs.zend.com/manual/php5/en/class.spoofchecker.html)

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.classes.php)

## New Classes

The following classes were introduced in PHP 5.3.0:

[Date/Time](https://php-legacy-docs.zend.com/manual/php5/en/book.datetime.html):

- [DateInterval](https://php-legacy-docs.zend.com/manual/php5/en/class.dateinterval.html)
- [DatePeriod](https://php-legacy-docs.zend.com/manual/php5/en/class.dateperiod.html)

[Phar](https://php-legacy-docs.zend.com/manual/php5/en/book.phar.html):

- [Phar](https://php-legacy-docs.zend.com/manual/php5/en/class.phar.html)
- [PharData](https://php-legacy-docs.zend.com/manual/php5/en/class.phardata.html)
- [PharException](https://php-legacy-docs.zend.com/manual/php5/en/class.pharexception.html)
- [PharFileInfo](https://php-legacy-docs.zend.com/manual/php5/en/class.pharfileinfo.html)

[SPL](https://php-legacy-docs.zend.com/manual/php5/en/book.spl.html):

- [FilesystemIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.filesystemiterator.html)
- [GlobIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.globiterator.html)
- [MultipleIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.multipleiterator.html)
- [RecursiveTreeIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.recursivetreeiterator.html)
- [SplDoublyLinkedList](https://php-legacy-docs.zend.com/manual/php5/en/class.spldoublylinkedlist.html)
- [SplFixedArray](https://php-legacy-docs.zend.com/manual/php5/en/class.splfixedarray.html)
- [SplHeap](https://php-legacy-docs.zend.com/manual/php5/en/class.splheap.html)
- [SplMaxHeap](https://php-legacy-docs.zend.com/manual/php5/en/class.splmaxheap.html)
- [SplMinHeap](https://php-legacy-docs.zend.com/manual/php5/en/class.splminheap.html)
- [SplPriorityQueue](https://php-legacy-docs.zend.com/manual/php5/en/class.splpriorityqueue.html)
- [SplQueue](https://php-legacy-docs.zend.com/manual/php5/en/class.splqueue.html)
- [SplStack](https://php-legacy-docs.zend.com/manual/php5/en/class.splstack.html)

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.classes.php)

## New Classes

The following classes were introduced in PHP 5.2.0:

- [DateTime](https://php-legacy-docs.zend.com/manual/php5/en/ref.datetime.html)
- [DateTimeZone](https://php-legacy-docs.zend.com/manual/php5/en/ref.datetime.html)
- RegexIterator - extends [FilterIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.filteriterator.html); implements [Iterator](https://php-legacy-docs.zend.com/manual/php5/en/class.iterator.html), [Traversable](https://php-legacy-docs.zend.com/manual/php5/en/class.traversable.html), [OuterIterator](https://php-legacy-docs.zend.com/manual/php5/en/class.outeriterator.html) Constants:
  - **`RegexIterator::ALL_MATCHES`**
  - **`RegexIterator::GET_MATCH`**
  - **`RegexIterator::MATCH`**
  - **`RegexIterator::REPLACE`**
  - **`RegexIterator::SPLIT`**
  - **`RegexIterator::USE_KEY`**

  Properties:
  - public replacement

  Methods:
  - RegexIterator::\_\_construct(Iterator it, string regex \[, int mode \[, int flags \[, int preg_flags\]\]\]) - Create an `RegexIterator` from another iterator and a regular expression
  - bool RegexIterator::accept() - Match (string)current() against regular expression
  - bool RegexIterator::getFlags() - Returns current operation flags
  - bool RegexIterator::getMode() - Returns current operation mode
  - bool RegexIterator::getPregFlags() - Returns current PREG flags (if in use or **`NULL`**)
  - bool RegexIterator::setFlags(int new_flags) - Set operation flags
  - bool RegexIterator::setMode(int new_mode) - Set new operation mode
  - bool RegexIterator::setPregFlags(int new_flags) - Set PREG flags
- RecursiveRegexIterator Constants:
  - **`RecursiveRegexIterator::ALL_MATCHES`**
  - **`RecursiveRegexIterator::GET_MATCH`**
  - **`RecursiveRegexIterator::MATCH`**
  - **`RecursiveRegexIterator::REPLACE`**
  - **`RecursiveRegexIterator::SPLIT`**
  - **`RecursiveRegexIterator::USE_KEY`**

  Methods:
  - RecursiveRegexIterator::\_\_construct(RecursiveIterator it, string regex \[, int mode \[, int flags \[, int preg_flags\]\]\]) - Create an `RecursiveRegexIterator` from another recursive iterator and a regular expression
  - RecursiveRegexIterator RecursiveRegexIterator::getChildren() - Return the inner iterator's children contained in a `RecursiveRegexIterator`
  - bool RecursiveRegexIterator::hasChildren() - Check whether the inner iterator's current element has children
