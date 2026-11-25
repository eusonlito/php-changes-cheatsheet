# [New Methods in PHP 5.5, 5.4, 5.3, 5.2](index.md)

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.new-methods.php)

## New Methods

### [MySQLi](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html)

- [mysqli::begin_transaction()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.begin-transaction.html)
- [mysqli::release_savepoint()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.release-savepoint.html)
- [mysqli::savepoint()](https://php-legacy-docs.zend.com/manual/php5/en/mysqli.savepoint.html)

### [Intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html)

- [IntlDateFormatter::formatObject()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.formatobject.html)
- [IntlDateFormatter::getCalendarObject()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.getcalendarobject.html)
- [IntlDateFormatter::getTimeZone()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.gettimezone.html)
- [IntlDateFormatter::setTimeZone()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.settimezone.html)

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.methods.php)

## New Methods

Several new methods were introduced in 5.4.0:

[XSL](https://php-legacy-docs.zend.com/manual/php5/en/book.xsl.html):

- [XsltProcessor::setSecurityPrefs()](https://php-legacy-docs.zend.com/manual/php5/en/xsltprocessor.setsecurityprefs.html)
- [XsltProcessor::getSecurityPrefs()](https://php-legacy-docs.zend.com/manual/php5/en/xsltprocessor.getsecurityprefs.html)

[SPL](https://php-legacy-docs.zend.com/manual/php5/en/book.spl.html):

- [RegexIterator::getRegex()](https://php-legacy-docs.zend.com/manual/php5/en/regexiterator.getregex.html)
- [SplObjectStorage::getHash()](https://php-legacy-docs.zend.com/manual/php5/en/splobjectstorage.gethash.html)
- [DirectoryIterator::getExtension()](https://php-legacy-docs.zend.com/manual/php5/en/directoryiterator.getextension.html)
- [SplDoublyLinkedList::serialize()](https://php-legacy-docs.zend.com/manual/php5/en/spldoublylinkedlist.serialize.html)
- [SplDoublyLinkedList::unserialize()](https://php-legacy-docs.zend.com/manual/php5/en/spldoublylinkedlist.unserialize.html)
- [SplFileInfo::getExtension()](https://php-legacy-docs.zend.com/manual/php5/en/splfileinfo.getextension.html)
- [SplFileObject::fputcsv()](https://php-legacy-docs.zend.com/manual/php5/en/splfileobject.fputcsv.html)
- **SplQueue::serialize()**
- **SplQueue::unserialize()**
- **SplStack::serialize()**
- **SplStack::unserialize()**
- **SplTempFileObject::fputcsv()**

[Reflection](https://php-legacy-docs.zend.com/manual/php5/en/book.reflection.html):

- [ReflectionExtension::isPersistent()](https://php-legacy-docs.zend.com/manual/php5/en/reflectionextension.ispersistent.html)
- [ReflectionExtension::isTemporary()](https://php-legacy-docs.zend.com/manual/php5/en/reflectionextension.istemporary.html)
- [ReflectionClass::isCloneable()](https://php-legacy-docs.zend.com/manual/php5/en/reflectionclass.iscloneable.html)

[Closure](https://php-legacy-docs.zend.com/manual/php5/en/class.closure.html):

- [Closure::bind()](https://php-legacy-docs.zend.com/manual/php5/en/closure.bind.html)
- [Closure::bindTo()](https://php-legacy-docs.zend.com/manual/php5/en/closure.bindto.html)

[PDO_dblib](https://php-legacy-docs.zend.com/manual/php5/en/ref.pdo-dblib.html):

- **PDO::newRowset()**

[StreamWrapper](https://php-legacy-docs.zend.com/manual/php5/en/class.streamwrapper.html):

- [StreamWrapper::stream_metadata()](https://php-legacy-docs.zend.com/manual/php5/en/streamwrapper.stream-metadata.html)
- [StreamWrapper::stream_truncate()](https://php-legacy-docs.zend.com/manual/php5/en/streamwrapper.stream-truncate.html)

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.methods.php)

## New Methods

Several new methods were introduced in 5.3.0:

[Date/Time](https://php-legacy-docs.zend.com/manual/php5/en/book.datetime.html):

- [DateTime::add()](https://php-legacy-docs.zend.com/manual/php5/en/datetime.add.html) - Adds an amount of days, months, years, hours, minutes and seconds to a [DateTime](https://php-legacy-docs.zend.com/manual/php5/en/class.datetime.html) object.
- [DateTime::createFromFormat()](https://php-legacy-docs.zend.com/manual/php5/en/datetime.createfromformat.html) - Returns a new [DateTime](https://php-legacy-docs.zend.com/manual/php5/en/class.datetime.html) object formatted according to the given format.
- [DateTime::diff()](https://php-legacy-docs.zend.com/manual/php5/en/datetime.diff.html) - Returns the difference between two [DateTime](https://php-legacy-docs.zend.com/manual/php5/en/class.datetime.html) objects.
- [DateTime::getLastErrors()](https://php-legacy-docs.zend.com/manual/php5/en/datetime.getlasterrors.html) - Returns the warnings and errors from the last date/time operation.
- [DateTime::sub()](https://php-legacy-docs.zend.com/manual/php5/en/datetime.sub.html) - Subtracts an amount of days, months, years, hours, minutes and seconds from a [DateTime](https://php-legacy-docs.zend.com/manual/php5/en/class.datetime.html) object.

[Exception](https://php-legacy-docs.zend.com/manual/php5/en/class.exception.html):

- [Exception::getPrevious()](https://php-legacy-docs.zend.com/manual/php5/en/exception.getprevious.html) - Retrieves the previous exception.

[DOM](https://php-legacy-docs.zend.com/manual/php5/en/book.dom.html):

- [DOMNode::getLineNo()](https://php-legacy-docs.zend.com/manual/php5/en/domnode.getlineno.html) - Get the line number of a parsed node.

[PDO_FIREBIRD](https://php-legacy-docs.zend.com/manual/php5/en/ref.pdo-firebird.html):

- [PDO::setAttribute()](https://php-legacy-docs.zend.com/manual/php5/en/pdo.setattribute.html) - Sets an attribute.

[Reflection](https://php-legacy-docs.zend.com/manual/php5/en/book.reflection.html):

- [ReflectionClass::getNamespaceName()](https://php-legacy-docs.zend.com/manual/php5/en/reflectionclass.getnamespacename.html) - Returns the name of namespace where this class is defined.
- [ReflectionClass::getShortName()](https://php-legacy-docs.zend.com/manual/php5/en/reflectionclass.getshortname.html) - Returns the short name of this class (without namespace part).
- [ReflectionClass::inNamespace()](https://php-legacy-docs.zend.com/manual/php5/en/reflectionclass.innamespace.html) - Returns whether this class is defined in a namespace.
- **ReflectionFunction::getNamespaceName()** - Returns the name of namespace where this function is defined.
- **ReflectionFunction::getShortName()** - Returns the short name of the function (without namespace part).
- **ReflectionFunction::inNamespace()** - Returns whether this function is defined in a namespace.
- [ReflectionProperty::setAccessible()](https://php-legacy-docs.zend.com/manual/php5/en/reflectionproperty.setaccessible.html) - Sets whether non-public properties can be requested.

[SPL](https://php-legacy-docs.zend.com/manual/php5/en/book.spl.html):

- [SplObjectStorage::addAll()](https://php-legacy-docs.zend.com/manual/php5/en/splobjectstorage.addall.html) - Add all elements from another SplObjectStorage object.
- [SplObjectStorage::removeAll()](https://php-legacy-docs.zend.com/manual/php5/en/splobjectstorage.removeall.html) - Remove all elements from another SplObjectStorage object.

[XSL](https://php-legacy-docs.zend.com/manual/php5/en/book.xsl.html):

- [XSLTProcessor::setProfiling()](https://php-legacy-docs.zend.com/manual/php5/en/xsltprocessor.setprofiling.html) - Sets the profiling output file.

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.methods.php)

## New Methods

New methods were introduced in 5.2.0:

[dom](https://php-legacy-docs.zend.com/manual/php5/en/book.dom.html):

- [DOMDocument::registerNodeClass()](https://php-legacy-docs.zend.com/manual/php5/en/domdocument.registernodeclass.html) - Register extended class used to create base node type
- [DOMElement::setIDAttribute()](https://php-legacy-docs.zend.com/manual/php5/en/domelement.setidattribute.html) - Declares the attribute specified by name to be of type ID
- [DOMElement::setIDAttributeNode()](https://php-legacy-docs.zend.com/manual/php5/en/domelement.setidattributenode.html) - Declares the attribute specified by node to be of type ID
- [DOMElement::setIDAttributeNS()](https://php-legacy-docs.zend.com/manual/php5/en/domelement.setidattributens.html) - Declares the attribute specified by local name and namespace URI to be of type ID
- [DOMNode::C14N()](https://php-legacy-docs.zend.com/manual/php5/en/domnode.c14n.html)(\[bool exclusive \[, bool with_comments \[, array xpath \[, array ns_prefixes\]\]\]\]) - Canonicalize nodes to a string
- [DOMNode::C14NFile()](https://php-legacy-docs.zend.com/manual/php5/en/domnode.c14nfile.html)(string uri \[, bool exclusive \[, bool with_comments \[, array xpath \[, array ns_prefixes\]\]\]\]) - Canonicalize nodes to a file
- [DOMNode::getNodePath()](https://php-legacy-docs.zend.com/manual/php5/en/domnode.getnodepath.html)() - Gets an `xpath` for a node

[soap](https://php-legacy-docs.zend.com/manual/php5/en/ref.soap.html):

- [SoapServer::setObject()](https://php-legacy-docs.zend.com/manual/php5/en/soapserver.setobject.html)(object obj) - Sets object which will handle SOAP requests

[spl](https://php-legacy-docs.zend.com/manual/php5/en/ref.spl.html):

- int [ArrayObject::asort()](https://php-legacy-docs.zend.com/manual/php5/en/arrayobject.asort.html)(void) - Sort the entries by values
- int [ArrayObject::ksort()](https://php-legacy-docs.zend.com/manual/php5/en/arrayobject.ksort.html)(void) - Sort the entries by key
- int [ArrayObject::natcasesort()](https://php-legacy-docs.zend.com/manual/php5/en/arrayobject.natcasesort.html)(void) - Sort the entries by key using case insensitive "natural order" algorithm.
- int [ArrayObject::natsort()](https://php-legacy-docs.zend.com/manual/php5/en/arrayobject.natsort.html)(void) - Sort the entries by values using "natural order" algorithm.
- int [ArrayObject::uasort()](https://php-legacy-docs.zend.com/manual/php5/en/arrayobject.uasort.html)(callback cmp_function) - Sort the entries by values using a user defined function
- int [ArrayObject::uksort()](https://php-legacy-docs.zend.com/manual/php5/en/arrayobject.uksort.html)(callback cmp_function) - Sort the entries by key using a user defined function.
- ArrayIterator [AppendIterator::getArrayIterator()](https://php-legacy-docs.zend.com/manual/php5/en/appenditerator.getarrayiterator.html)() - Get access to inner `ArrayIterator`
- int [AppendIterator::getIteratorIndex()](https://php-legacy-docs.zend.com/manual/php5/en/appenditerator.getiteratorindex.html)() - Get index of iterator
- bool [CachingIterator::getCache()](https://php-legacy-docs.zend.com/manual/php5/en/cachingiterator.getcache.html)() - Return the cache
- int [CachingIterator::getFlags()](https://php-legacy-docs.zend.com/manual/php5/en/cachingiterator.getflags.html)() - Return the internal flags
- bool [CachingIterator::offsetExists()](https://php-legacy-docs.zend.com/manual/php5/en/cachingiterator.offsetexists.html)(mixed index) - Returns **`TRUE`** if the requested index exists
- string [CachingIterator::offsetGet()](https://php-legacy-docs.zend.com/manual/php5/en/cachingiterator.offsetget.html)(mixed index) - Return the internal cache if used
- void [CachingIterator::offsetSet()](https://php-legacy-docs.zend.com/manual/php5/en/cachingiterator.offsetset.html)(mixed index, mixed newval) - Set given index in cache
- void [CachingIterator::offsetUnset()](https://php-legacy-docs.zend.com/manual/php5/en/cachingiterator.offsetunset.html)(mixed index) - Unset given index in cache
- void [CachingIterator::setFlags()](https://php-legacy-docs.zend.com/manual/php5/en/cachingiterator.setflags.html)() - Set the internal flags
- array("delimiter" =\>, "enclosure" =\>) [SplFileObject::getCsvControl()](https://php-legacy-docs.zend.com/manual/php5/en/splfileobject.getcsvcontrol.html)(void) - Get the delimiter and enclosure character used in [fgetcsv()](https://php-legacy-docs.zend.com/manual/php5/en/function.fgetcsv.html)
- void [SplFileObject::setCsvControl()](https://php-legacy-docs.zend.com/manual/php5/en/splfileobject.setcsvcontrol.html)(\[string delimiter = ',' \[, string enclosure = '"'\]\]) - Set the delimiter and enclosure character used in [fgetcsv()](https://php-legacy-docs.zend.com/manual/php5/en/function.fgetcsv.html)

[Tidy](https://php-legacy-docs.zend.com/manual/php5/en/ref.tidy.html)

- tidyNode [tidyNode::getParent()](https://php-legacy-docs.zend.com/manual/php5/en/tidynode.getparent.html)() - Returns the parent node of the current node (Added in PHP 5.2.2)

[XMLReader](https://php-legacy-docs.zend.com/manual/php5/en/book.xmlreader.html)

- boolean [XMLReader::setSchema()](https://php-legacy-docs.zend.com/manual/php5/en/xmlreader.setschema.html) - Use W3C XSD schema to validate the document as it is processed. Activation is only possible before the first [XMLReader::read()](https://php-legacy-docs.zend.com/manual/php5/en/xmlreader.read.html)

[zip](https://php-legacy-docs.zend.com/manual/php5/en/ref.zip.html):

- [ZipArchive::addEmptyDir()](https://php-legacy-docs.zend.com/manual/php5/en/ziparchive.addemptydir.html)() - Creates an empty directory in the archive
