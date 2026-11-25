# [Deprecated Features in PHP 8.6, 8.5, 8.4, 8.3, 8.2, 8.1, 8.0, 7.4, 7.3, 7.2, 7.1, 7.0, 5.6, 5.5, 5.4, 5.3](index.md)

# [PHP 8.6](https://www.php.net/manual/en/migration86.deprecated.php)

## Deprecated Features

### PHP Core

#### Using "namespace" as a class constant name

Declaring a [class constant](https://www.php.net/manual/en/language.oop5.constants.php) named `namespace` is now deprecated. `namespace` is a semi-reserved keyword, and the name is being reserved for possible future syntax such as a `::namespace` pseudo-constant analogous to `::class`. Methods and static properties named `namespace` are not affected. Rename the constant, for example to `NAMESPACE_NAME`.

#### Returning from a finally block

Using the `return` statement inside a [`finally`](https://www.php.net/manual/en/control-structures.finally.php) block is now deprecated, and emits a compile-time deprecation notice. Such a `return` silently discards an exception thrown by, or overwrites the value returned from, the associated `try` or `catch` block, so failures vanish without a trace. Move the `return` out of the `finally` block instead; the same result can always be expressed without it.

```
<?php
function getConfig(): array
{
    try {
        return loadConfig(); // throws if the file is missing
    } finally {
        return []; // Deprecated: the exception is gone, the caller just gets []
    }
}
```

#### Nullable return type for \_\_debugInfo()

Declaring a return type of ?[array](https://www.php.net/manual/en/language.types.array.php) for [\_\_debugInfo()](https://www.php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo) is now deprecated. Returning **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** from this method was [already deprecated in PHP 8.5](https://www.php.net/manual/en/migration85.deprecated.php#migration85.deprecated.core.return-null-from-debuginfo), so the nullable return type no longer describes valid behaviour. Declare [array](https://www.php.net/manual/en/language.types.array.php) instead.

#### Returning values from \_\_construct() and \_\_destruct()

Returning a value from [\_\_construct()](https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor) or [\_\_destruct()](https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.destructor) is now deprecated, and emits a compile-time deprecation notice. These methods cannot declare a return type, and their return value can never be observed during normal use, which made returning a value confusing at best. Using `return;` without a value to skip the remaining logic is still allowed, as is calling these methods manually.

For the same reason, using `yield` to make [\_\_construct()](https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor) or [\_\_destruct()](https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.destructor) a [generator](https://www.php.net/manual/en/language.generators.php) is now deprecated.

#### Naming a function readonly

Declaring a function named `readonly` is now deprecated. [readonly](https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties) is a reserved keyword; a lexer exception was added in PHP 8.1 solely to keep an existing WordPress function of that name working, and no other keyword in PHP receives such special treatment. Rename the function.

#### Using let, is, or \_ as an identifier

Using `let` or `is` as the name of a class, interface, trait, enum, function, or constant (including via [define()](https://www.php.net/manual/en/function.define.php)) is now deprecated, as is using either as the alias in a [class_alias()](https://www.php.net/manual/en/function.class-alias.php) call or in a `use`, `use function`, or `use const` declaration. The names are being reserved as keywords for potential future features: `let` for block scoping and `is` for pattern matching. Rename the affected symbols.

The [deprecation of `_` as a class name in PHP 8.4](https://www.php.net/manual/en/migration84.deprecated.php#migration84.deprecated.core.underscore-class-name) is extended to constants: declaring a constant named `_` with `const` or [define()](https://www.php.net/manual/en/function.define.php), and aliasing a class or constant to `_` in a `use` declaration, are now deprecated. Functions named `_`, including the [\_()](https://www.php.net/manual/en/function.-.php) alias of [gettext()](https://www.php.net/manual/en/function.gettext.php), are not affected.

#### Third argument to define()

Passing the `case_insensitive` argument to [define()](https://www.php.net/manual/en/function.define.php) is now deprecated. Case-insensitive constants were removed in PHP 8.0, since when the argument has been ignored. Explicitly passing **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** now emits a deprecation notice. Passing **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** continues to emit a warning, whose message now states that this will become an error in PHP 9.0. Omit the argument.

#### is_a() and is_subclass_of() with a string when allow_string is false

Calling [is_a()](https://www.php.net/manual/en/function.is-a.php) or [is_subclass_of()](https://www.php.net/manual/en/function.is-subclass-of.php) with a string as the first argument while `allow_string` is **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** is now deprecated. In that case the functions always return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**, even when the class is already loaded, so such a call indicates a bug. To avoid triggering autoloading, check [class_exists()](https://www.php.net/manual/en/function.class-exists.php) with autoloading disabled first, and then call the function with `allow_string` set to **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)**.

#### metaphone()

The [metaphone()](https://www.php.net/manual/en/function.metaphone.php) function is now deprecated. It implements the original 1990 Metaphone algorithm, which is limited to English pronunciation rules and has long been superseded by Double Metaphone and Metaphone 3. Phonetic algorithms are language-specific and frequently updated, so they are better served by a userland library; use one instead.

#### More than 16 filters in a php://filter URL

Using more than 16 filters in a [php://filter](https://www.php.net/manual/en/wrappers.php.php) URL without configuring the `filter.max_filter_count` stream context option now emits a deprecation notice. Long filter chains have no known legitimate use, but are the basis of a class of attacks that turn a local file inclusion or an arbitrary file read into remote code execution. When `filter.max_filter_count` is set explicitly, exceeding it is already an error: opening the stream fails with a warning.

Code that needs more filters should either add them with [stream_filter_append()](https://www.php.net/manual/en/function.stream-filter-append.php) or [stream_filter_prepend()](https://www.php.net/manual/en/function.stream-filter-prepend.php), which are not limited, or raise the limit through the context option, for example globally with [stream_context_set_default()](https://www.php.net/manual/en/function.stream-context-set-default.php).

#### Passing objects to array_walk(), array_walk_recursive(), and http_build_query()

Passing an object as the `array` argument to [array_walk()](https://www.php.net/manual/en/function.array-walk.php) or [array_walk_recursive()](https://www.php.net/manual/en/function.array-walk-recursive.php) is now deprecated. A small number of functions silently interpret an object as the array of its visible properties. Modifying such properties through a by-reference callback violates [readonly](https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties) semantics and can corrupt enum cases, and [array_walk_recursive()](https://www.php.net/manual/en/function.array-walk-recursive.php) does not recurse into nested objects anyway. Call [get_object_vars()](https://www.php.net/manual/en/function.get-object-vars.php) on the object first and pass the resulting array.

Passing an object as the `data` argument to [http_build_query()](https://www.php.net/manual/en/function.http-build-query.php) is now deprecated. Objects encountered as values within `data` now also emit a deprecation notice when they are interpreted as arrays. Treating objects as arrays has been a recurring source of confusion, in particular for [Stringable](https://www.php.net/manual/en/class.stringable.php) objects, which users expect to be converted to a string instead. Convert objects to arrays with [get_object_vars()](https://www.php.net/manual/en/function.get-object-vars.php), recursively if necessary, before calling the function.

#### is_double(), is_long(), is_integer(), and doubleval()

Following the [deprecation of the non-canonical cast names in PHP 8.5](https://www.php.net/manual/en/migration85.deprecated.php#migration85.deprecated.core.non-canonical-cast-names), the function aliases that carry the same outdated type names are now deprecated. They behave identically to their canonical counterparts, which should be used instead:

- [is_double()](https://www.php.net/manual/en/function.is-double.php) =\> [is_float()](https://www.php.net/manual/en/function.is-float.php)
- [is_long()](https://www.php.net/manual/en/function.is-long.php) =\> [is_int()](https://www.php.net/manual/en/function.is-int.php)
- [is_integer()](https://www.php.net/manual/en/function.is-integer.php) =\> [is_int()](https://www.php.net/manual/en/function.is-int.php)
- [doubleval()](https://www.php.net/manual/en/function.doubleval.php) =\> [floatval()](https://www.php.net/manual/en/function.floatval.php)

#### strcoll() and SORT_LOCALE_STRING

The [strcoll()](https://www.php.net/manual/en/function.strcoll.php) function is now deprecated. It compares strings according to the `LC_COLLATE` setting of the current locale, which is global process state set via [setlocale()](https://www.php.net/manual/en/function.setlocale.php) that any library can change, it is not binary safe unlike every other string comparison function, and some locales do not implement correct collation rules. Use [Collator::compare()](https://www.php.net/manual/en/collator.compare.php) from the [intl](https://www.php.net/manual/en/book.intl.php) extension instead, which is accurate and has up-to-date collation rules.

The **[`SORT_LOCALE_STRING`](https://www.php.net/manual/en/array.constants.php#constant.sort-locale-string)** flag of the sort functions is now deprecated for the same reasons, as it sorts using [strcoll()](https://www.php.net/manual/en/function.strcoll.php). Use one of the following methods of the [Collator](https://www.php.net/manual/en/class.collator.php) class instead:

- [Collator::sort()](https://www.php.net/manual/en/collator.sort.php)
- [Collator::asort()](https://www.php.net/manual/en/collator.asort.php)
- [Collator::sortWithSortKeys()](https://www.php.net/manual/en/collator.sortwithsortkeys.php)

### Bzip2

Passing an object as the parameters of the [bzip2.compress and bzip2.decompress](https://www.php.net/manual/en/filters.compression.php) stream filters is now deprecated, as only an associative array is documented and supported. Call [get_object_vars()](https://www.php.net/manual/en/function.get-object-vars.php) on the object first and pass the resulting array.

### GMP

The shift (`<<`, `>>`) and exponentiation (`**`) operators on [GMP](https://www.php.net/manual/en/class.gmp.php) objects now emit a deprecation notice when the right operand is a [float](https://www.php.net/manual/en/language.types.float.php) whose conversion to [int](https://www.php.net/manual/en/language.types.integer.php) loses precision, consistent with the deprecation of implicit lossy float to int conversions elsewhere in the language.

### MBString

The mbregex functions have been deprecated, because the underlying Oniguruma library is no longer maintained; its maintenance ended in April 2025. The functions will be removed in PHP 9.0. For most use cases the [PCRE](https://www.php.net/manual/en/book.pcre.php) functions with the `u` modifier are a suitable replacement. The affected functions are:

- [mb_ereg()](https://www.php.net/manual/en/function.mb-ereg.php)
- [mb_ereg_match()](https://www.php.net/manual/en/function.mb-ereg-match.php)
- [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php)
- [mb_ereg_replace_callback()](https://www.php.net/manual/en/function.mb-ereg-replace-callback.php)
- [mb_ereg_search()](https://www.php.net/manual/en/function.mb-ereg-search.php)
- [mb_ereg_search_getpos()](https://www.php.net/manual/en/function.mb-ereg-search-getpos.php)
- [mb_ereg_search_getregs()](https://www.php.net/manual/en/function.mb-ereg-search-getregs.php)
- [mb_ereg_search_init()](https://www.php.net/manual/en/function.mb-ereg-search-init.php)
- [mb_ereg_search_pos()](https://www.php.net/manual/en/function.mb-ereg-search-pos.php)
- [mb_ereg_search_regs()](https://www.php.net/manual/en/function.mb-ereg-search-regs.php)
- [mb_ereg_search_setpos()](https://www.php.net/manual/en/function.mb-ereg-search-setpos.php)
- [mb_eregi()](https://www.php.net/manual/en/function.mb-eregi.php)
- [mb_eregi_replace()](https://www.php.net/manual/en/function.mb-eregi-replace.php)
- [mb_regex_encoding()](https://www.php.net/manual/en/function.mb-regex-encoding.php)
- [mb_regex_set_options()](https://www.php.net/manual/en/function.mb-regex-set-options.php)
- [mb_split()](https://www.php.net/manual/en/function.mb-split.php)

The **[`MB_ONIGURUMA_VERSION`](https://www.php.net/manual/en/mbstring.constants.php#constant.mb-oniguruma-version)** constant and the [mbstring.regex_retry_limit](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.regex-retry-limit) and [mbstring.regex_stack_limit](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.regex-stack-limit) INI directives are deprecated along with them.

Passing an object as the `vars` argument to [mb_convert_variables()](https://www.php.net/manual/en/function.mb-convert-variables.php) is now deprecated, as objects are silently interpreted as the array of their visible properties. Call [get_object_vars()](https://www.php.net/manual/en/function.get-object-vars.php) on the object first, or use [mb_convert_encoding()](https://www.php.net/manual/en/function.mb-convert-encoding.php), which converts arrays recursively and returns the result instead of modifying its argument in place.

### MySQLi

The [mysqli_get_charset()](https://www.php.net/manual/en/mysqli.get-charset.php) function and the [mysqli::get_charset()](https://www.php.net/manual/en/mysqli.get-charset.php) method are now deprecated, without replacement. They expose internal implementation details of the character set that have been meaningless since the switch to mysqlnd; in particular the reported collation does not correspond to the collation defined by the server. To get the name of the current character set, use [mysqli_character_set_name()](https://www.php.net/manual/en/mysqli.character-set-name.php) or [mysqli::character_set_name()](https://www.php.net/manual/en/mysqli.character-set-name.php).

The [mysqli_stmt_init()](https://www.php.net/manual/en/mysqli.stmt-init.php) function and the [mysqli::stmt_init()](https://www.php.net/manual/en/mysqli.stmt-init.php) method are now deprecated. They create an empty statement object that still has to be prepared before use, and are a source of statement objects left in an inconsistent state. Use [mysqli_prepare()](https://www.php.net/manual/en/mysqli.prepare.php) or [mysqli::prepare()](https://www.php.net/manual/en/mysqli.prepare.php) instead, which prepare the statement in one step. For the same reason, calling the [mysqli_stmt::\_\_construct()](https://www.php.net/manual/en/mysqli-stmt.construct.php) constructor without the `query` parameter is now deprecated; pass the query to the constructor instead.

### Reflection

Calling [ReflectionProperty::setValue()](https://www.php.net/manual/en/reflectionproperty.setvalue.php) or [ReflectionProperty::setRawValue()](https://www.php.net/manual/en/reflectionproperty.setrawvalue.php) with an object that is not an instance of the class on which the property was declared is now deprecated. Unlike the other [ReflectionProperty](https://www.php.net/manual/en/class.reflectionproperty.php) methods, which throw for such objects, these methods silently set a property on the unrelated object, which is no better than a normal assignment and conceptually wrong.

Passing an object to [ReflectionMethod::invoke()](https://www.php.net/manual/en/reflectionmethod.invoke.php) or [ReflectionMethod::invokeArgs()](https://www.php.net/manual/en/reflectionmethod.invokeargs.php) when invoking a static method is now deprecated. Static methods have no `$this`, so the object was ignored entirely and never validated. Pass **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** instead.

### Session

Passing an object that does not implement both the [SessionIdInterface::create_sid()](https://www.php.net/manual/en/sessionidinterface.create-sid.php) and [SessionUpdateTimestampHandlerInterface::validateId()](https://www.php.net/manual/en/sessionupdatetimestamphandlerinterface.validateid.php) methods to [session_set_save_handler()](https://www.php.net/manual/en/function.session-set-save-handler.php) is now deprecated, regardless of which interfaces the object declares. These methods are required for a save handler to behave correctly under [session.use_strict_mode](https://www.php.net/manual/en/session.configuration.php#ini.session.use-strict-mode), which is [enabled by default as of PHP 8.6](https://www.php.net/manual/en/migration86.incompatible.php#migration86.incompatible.session) and mitigates session fixation.

Accordingly, an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)** is now emitted when a class implements [SessionHandlerInterface](https://www.php.net/manual/en/class.sessionhandlerinterface.php) without defining the [SessionIdInterface::create_sid()](https://www.php.net/manual/en/sessionidinterface.create-sid.php) or [SessionUpdateTimestampHandlerInterface::validateId()](https://www.php.net/manual/en/sessionupdatetimestamphandlerinterface.validateid.php) methods. In PHP 9.0 these methods will be moved from [SessionIdInterface](https://www.php.net/manual/en/class.sessionidinterface.php) and [SessionUpdateTimestampHandlerInterface](https://www.php.net/manual/en/class.sessionupdatetimestamphandlerinterface.php) into [SessionHandlerInterface](https://www.php.net/manual/en/class.sessionhandlerinterface.php), where they will be required. Implement both methods on custom save handlers now.

### SPL

The [spl_classes()](https://www.php.net/manual/en/function.spl-classes.php) function is now deprecated. No other extension exposes such a function, and the Reflection extension is always available. Use [ReflectionExtension::getClassNames()](https://www.php.net/manual/en/reflectionextension.getclassnames.php) instead.

The [spl_object_hash()](https://www.php.net/manual/en/function.spl-object-hash.php) function is now deprecated. Since PHP 8.1 its return value has been nothing more than a reformatted [spl_object_id()](https://www.php.net/manual/en/function.spl-object-id.php), and the name is misleading as the value is not derived from the contents of the object. The string form is also error-prone: two hashes can compare loosely equal because both are numeric strings. Use [spl_object_id()](https://www.php.net/manual/en/function.spl-object-id.php) instead.

The following [ArrayIterator](https://www.php.net/manual/en/class.arrayiterator.php) methods are now deprecated. They only exist because [ArrayIterator](https://www.php.net/manual/en/class.arrayiterator.php) historically shared its implementation with [ArrayObject](https://www.php.net/manual/en/class.arrayobject.php); most of them make little sense on an iterator and prevent optimizing its implementation. The corresponding [ArrayObject](https://www.php.net/manual/en/class.arrayobject.php) methods are not deprecated.

- [ArrayIterator::getFlags()](https://www.php.net/manual/en/arrayiterator.getflags.php)
- [ArrayIterator::setFlags()](https://www.php.net/manual/en/arrayiterator.setflags.php)
- [ArrayIterator::asort()](https://www.php.net/manual/en/arrayiterator.asort.php)
- [ArrayIterator::ksort()](https://www.php.net/manual/en/arrayiterator.ksort.php)
- [ArrayIterator::uasort()](https://www.php.net/manual/en/arrayiterator.uasort.php)
- [ArrayIterator::uksort()](https://www.php.net/manual/en/arrayiterator.uksort.php)
- [ArrayIterator::natsort()](https://www.php.net/manual/en/arrayiterator.natsort.php)
- [ArrayIterator::natcasesort()](https://www.php.net/manual/en/arrayiterator.natcasesort.php)
- [ArrayIterator::unserialize()](https://www.php.net/manual/en/arrayiterator.unserialize.php)
- [ArrayIterator::serialize()](https://www.php.net/manual/en/arrayiterator.serialize.php)

The CSV methods of [SplFileObject](https://www.php.net/manual/en/class.splfileobject.php) are now deprecated. Their historical design inconsistencies, further exposed by named arguments, have made them increasingly difficult to maintain, and CSV handling does not naturally belong in [SplFileObject](https://www.php.net/manual/en/class.splfileobject.php). Use [fgetcsv()](https://www.php.net/manual/en/function.fgetcsv.php) and [fputcsv()](https://www.php.net/manual/en/function.fputcsv.php) on a stream instead.

- [SplFileObject::fgetcsv()](https://www.php.net/manual/en/splfileobject.fgetcsv.php)
- [SplFileObject::fputcsv()](https://www.php.net/manual/en/splfileobject.fputcsv.php)
- [SplFileObject::setCsvControl()](https://www.php.net/manual/en/splfileobject.setcsvcontrol.php)
- [SplFileObject::getCsvControl()](https://www.php.net/manual/en/splfileobject.getcsvcontrol.php)

### Zlib

Passing an object as the parameters of the [zlib.deflate and zlib.inflate](https://www.php.net/manual/en/filters.compression.php) stream filters is now deprecated, as only an associative array is documented and supported. Call [get_object_vars()](https://www.php.net/manual/en/function.get-object-vars.php) on the object first and pass the resulting array.

Passing an object as the `options` argument to [deflate_init()](https://www.php.net/manual/en/function.deflate-init.php) or [inflate_init()](https://www.php.net/manual/en/function.inflate-init.php) is now deprecated, as objects are silently interpreted as the array of their visible properties. Call [get_object_vars()](https://www.php.net/manual/en/function.get-object-vars.php) on the object first and pass the resulting array.

# [PHP 8.5](https://www.php.net/manual/en/migration85.deprecated.php)

## Deprecated Features

### PHP Core

#### Changes to user output handler

Trying to produce output (e.g. with [echo](https://www.php.net/manual/en/function.echo.php)) within a user output handler is deprecated. The deprecation warning will bypass the handler producing the output to ensure it is visible; if there are nested output handlers the next one will still be used.

#### Non-canonical cast names

Non-canonical cast names `(boolean)`, `(integer)`, `(double)`, and `(binary)` have been deprecated, use `(bool)`, `(int)`, `(float)`, and `(string)` respectively.

#### Terminating case statements with a semicolon

Terminating case statements with a semicolon instead of a colon has been deprecated.

#### The backtick operator

[The backtick operator](https://www.php.net/manual/en/language.operators.execution.php) as an alias for [shell_exec()](https://www.php.net/manual/en/function.shell-exec.php) has been deprecated.

#### Returning null from \_\_debugInfo()

Returning **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** from [\_\_debugInfo()](https://www.php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo) has been deprecated. Return an empty array instead.

#### report_memleaks INI directive

The [report_memleaks](https://www.php.net/manual/en/errorfunc.configuration.php#ini.report-memleaks) INI directive has been deprecated.

#### Constant redeclaration

Constant redeclaration has been deprecated. Note that this already generated a warning and will continue to do so.

#### Closure binding issues

The following closure binding issues, which already emit an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)**, are now deprecated:

- Binding an instance to a static closure.
- Binding methods to objects that are not instances of the class (or subclass) that the method is defined.
- Unbinding \$this from a method.
- Unbinding \$this from a closure that uses \`\$this\`.
- Binding a closure to the scope of an internal class.
- Rebinding the scope of a closure created from a function or method.

#### \_\_sleep() and \_\_wakeup() magic methods

The [\_\_sleep()](https://www.php.net/manual/en/language.oop5.magic.php#object.sleep) and [\_\_wakeup()](https://www.php.net/manual/en/language.oop5.magic.php#object.wakeup) magic methods have been soft-deprecated. The [\_\_serialize()](https://www.php.net/manual/en/language.oop5.magic.php#object.serialize) and [\_\_unserialize()](https://www.php.net/manual/en/language.oop5.magic.php#object.unserialize) magic methods should be used instead, or at the same time if compatibility with PHP 7 is required.

#### Using null as an array offset

Using **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** as an array offset or when calling [array_key_exists()](https://www.php.net/manual/en/function.array-key-exists.php) is now deprecated. Instead an empty string should be used.

#### Incrementing non-numeric strings

Incrementing non-numeric strings is now deprecated. Instead the [str_increment()](https://www.php.net/manual/en/function.str-increment.php) function should be used.

#### register_argc_argv INI directive

Deriving `$_SERVER['argc']` and `$_SERVER['argv']` from the query string for non-CLI SAPIs has been deprecated. Configure `register_argc_argv=0` and switch to either [`$_GET`](https://www.php.net/manual/en/reserved.variables.get.php) or `$_SERVER['QUERY_STRING']` to access the information, after verifying that the usage is safe.

### cURL

The [curl_close()](https://www.php.net/manual/en/function.curl-close.php) function has been deprecated, as [CurlHandle](https://www.php.net/manual/en/class.curlhandle.php) objects are freed automatically.

The [curl_share_close()](https://www.php.net/manual/en/function.curl-share-close.php) function has been deprecated, as [CurlShareHandle](https://www.php.net/manual/en/class.curlsharehandle.php) objects are freed automatically.

### Date

The **[`DATE_RFC7231`](https://www.php.net/manual/en/datetime.constants.php#constant.date-rfc7231)** and **[`DateTimeInterface::RFC7231`](https://www.php.net/manual/en/class.datetimeinterface.php#datetimeinterface.constants.rfc7231)** constants have been deprecated. This is because the associated timezone is ignored and always uses GMT.

### FileInfo

The [finfo_close()](https://www.php.net/manual/en/function.finfo-close.php) function has been deprecated. As [finfo](https://www.php.net/manual/en/class.finfo.php) objects are freed automatically.

The `context` parameter of the [finfo_buffer()](https://www.php.net/manual/en/function.finfo-buffer.php) function has been deprecated as it is ignored.

### GD

The [imagedestroy()](https://www.php.net/manual/en/function.imagedestroy.php) function has been deprecated, as [GdImage](https://www.php.net/manual/en/class.gdimage.php) objects are freed automatically.

### Hash

The **[`MHASH_*`](https://www.php.net/manual/en/mhash.constants.php#constant.mhash-adler32)** constants have been deprecated.

### Intl

The [intl.error_level](https://www.php.net/manual/en/intl.configuration.php#ini.intl.error-level) INI setting has been deprecated. Errors should either be checked manually or exceptions should be enabled by using the [intl.use_exceptions](https://www.php.net/manual/en/intl.configuration.php#ini.intl.use-exceptions) INI setting.

### LDAP

Specific Oracle Instant Client calls and constants have been deprecated. List of affected calls:

- [ldap_connect()](https://www.php.net/manual/en/function.ldap-connect.php) with wallet support
- [ldap_connect_wallet()](https://www.php.net/manual/en/function.ldap-connect-wallet.php)

List of affected constants:

- **`GSLC_SSL_NO_UATH`**
- **`GSLC_SSL_ONEWAY_UATH`**
- **`GSLC_SSL_TWOWAY_UATH`**

### MySQLi

The [mysqli_execute()](https://www.php.net/manual/en/function.mysqli-execute.php) alias function has been deprecated. Use [mysqli_stmt_execute()](https://www.php.net/manual/en/mysqli-stmt.execute.php) instead.

### OpenSSL

The `key_length` parameter for [openssl_pkey_derive()](https://www.php.net/manual/en/function.openssl-pkey-derive.php) has been deprecated. This is because it is either ignored, or truncates the key, which can be a security vulnerability.

### PDO

The `"uri:"` DSN scheme has been deprecated due to security concerns with DSNs coming from remote URIs.

Driver specific constants in the PDO class have been deprecated. List of affected constants and their replacement:

- **`PDO::DBLIB_ATTR_CONNECTION_TIMEOUT`** =\> **[`Pdo\Dblib::ATTR_CONNECTION_TIMEOUT`](https://www.php.net/manual/en/class.pdo-dblib.php#pdo-dblib.constants.attr-connection-timeout)**
- **`PDO::DBLIB_ATTR_QUERY_TIMEOUT`** =\> **[`Pdo\Dblib::ATTR_QUERY_TIMEOUT`](https://www.php.net/manual/en/class.pdo-dblib.php#pdo-dblib.constants.attr-query-timeout)**
- **`PDO::DBLIB_ATTR_STRINGIFY_UNIQUEIDENTIFIER`** =\> **[`Pdo\Dblib::ATTR_STRINGIFY_UNIQUEIDENTIFIER`](https://www.php.net/manual/en/class.pdo-dblib.php#pdo-dblib.constants.attr-stringify-uniqueidentifier)**
- **`PDO::DBLIB_ATTR_VERSION`** =\> **[`Pdo\Dblib::ATTR_VERSION`](https://www.php.net/manual/en/class.pdo-dblib.php#pdo-dblib.constants.attr-version)**
- **`PDO::DBLIB_ATTR_TDS_VERSION`** =\> **[`Pdo\Dblib::ATTR_TDS_VERSION`](https://www.php.net/manual/en/class.pdo-dblib.php#pdo-dblib.constants.attr-tds-version)**
- **`PDO::DBLIB_ATTR_SKIP_EMPTY_ROWSETS`** =\> **[`Pdo\Dblib::ATTR_SKIP_EMPTY_ROWSETS`](https://www.php.net/manual/en/class.pdo-dblib.php#pdo-dblib.constants.attr-skip-empty-rowsets)**
- **`PDO::DBLIB_ATTR_DATETIME_CONVERT`** =\> **[`Pdo\Dblib::ATTR_DATETIME_CONVERT`](https://www.php.net/manual/en/class.pdo-dblib.php#pdo-dblib.constants.attr-datetime-convert)**
- **[`PDO::FB_ATTR_DATE_FORMAT`](https://www.php.net/manual/en/ref.pdo-firebird.php#pdo.constants.fb-attr-date-format)** =\> **[`Pdo\Firebird::ATTR_DATE_FORMAT`](https://www.php.net/manual/en/class.pdo-firebird.php#pdo-firebird.constants.attr-date-format)**
- **[`PDO::FB_ATTR_TIME_FORMAT`](https://www.php.net/manual/en/ref.pdo-firebird.php#pdo.constants.fb-attr-time-format)** =\> **[`Pdo\Firebird::ATTR_TIME_FORMAT`](https://www.php.net/manual/en/class.pdo-firebird.php#pdo-firebird.constants.attr-time-format)**
- **[`PDO::FB_ATTR_TIMESTAMP_FORMAT`](https://www.php.net/manual/en/ref.pdo-firebird.php#pdo.constants.fb-attr-timestamp-format)** =\> **[`Pdo\Firebird::ATTR_TIMESTAMP_FORMAT`](https://www.php.net/manual/en/class.pdo-firebird.php#pdo-firebird.constants.attr-timestamp-format)**
- **[`PDO::MYSQL_ATTR_USE_BUFFERED_QUERY`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-use-buffered-query)** =\> **[`Pdo\Mysql::ATTR_USE_BUFFERED_QUERY`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-use-buffered-query)**
- **[`PDO::MYSQL_ATTR_LOCAL_INFILE`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-local-infile)** =\> **[`Pdo\Mysql::ATTR_LOCAL_INFILE`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-local-infile)**
- **[`PDO::MYSQL_ATTR_LOCAL_INFILE_DIRECTORY`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-local-infile-directory)** =\> **[`Pdo\Mysql::ATTR_LOCAL_INFILE_DIRECTORY`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-local-infile-directory)**
- **[`PDO::MYSQL_ATTR_INIT_COMMAND`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-init-command)** =\> **[`Pdo\Mysql::ATTR_INIT_COMMAND`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-init-command)**
- **[`PDO::MYSQL_ATTR_MAX_BUFFER_SIZE`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-max-buffer-size)** =\> **[`Pdo\Mysql::ATTR_MAX_BUFFER_SIZE`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-max-buffer-size)**
- **[`PDO::MYSQL_ATTR_READ_DEFAULT_FILE`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-read-default-file)** =\> **[`Pdo\Mysql::ATTR_READ_DEFAULT_FILE`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-read-default-file)**
- **[`PDO::MYSQL_ATTR_READ_DEFAULT_GROUP`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-read-default-group)** =\> **[`Pdo\Mysql::ATTR_READ_DEFAULT_GROUP`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-read-default-group)**
- **[`PDO::MYSQL_ATTR_COMPRESS`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-compress)** =\> **[`Pdo\Mysql::ATTR_COMPRESS`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-compress)**
- **[`PDO::MYSQL_ATTR_DIRECT_QUERY`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-direct-query)** =\> **[`Pdo\Mysql::ATTR_DIRECT_QUERY`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-direct-query)**
- **[`PDO::MYSQL_ATTR_FOUND_ROWS`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-found-rows)** =\> **[`Pdo\Mysql::ATTR_FOUND_ROWS`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-found-rows)**
- **[`PDO::MYSQL_ATTR_IGNORE_SPACE`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-ignore-space)** =\> **[`Pdo\Mysql::ATTR_IGNORE_SPACE`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-ignore-space)**
- **[`PDO::MYSQL_ATTR_SSL_KEY`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-ssl-key)** =\> **[`Pdo\Mysql::ATTR_SSL_KEY`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-ssl-key)**
- **[`PDO::MYSQL_ATTR_SSL_CERT`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-ssl-cert)** =\> **[`Pdo\Mysql::ATTR_SSL_CERT`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-ssl-cert)**
- **[`PDO::MYSQL_ATTR_SSL_CA`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-ssl-ca)** =\> **[`Pdo\Mysql::ATTR_SSL_CA`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-ssl-ca)**
- **[`PDO::MYSQL_ATTR_SSL_CAPATH`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-ssl-capath)** =\> **[`Pdo\Mysql::ATTR_SSL_CAPATH`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-ssl-capath)**
- **[`PDO::MYSQL_ATTR_SSL_CIPHER`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-ssl-cipher)** =\> **[`Pdo\Mysql::ATTR_SSL_CIPHER`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-ssl-cipher)**
- **[`PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-ssl-verify-server-cert)** =\> **[`Pdo\Mysql::ATTR_SSL_VERIFY_SERVER_CERT`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-ssl-verify-server-cert)**
- **[`PDO::MYSQL_ATTR_SERVER_PUBLIC_KEY`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-server-public-key)** =\> **[`Pdo\Mysql::ATTR_SERVER_PUBLIC_KEY`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-server-public-key)**
- **[`PDO::MYSQL_ATTR_MULTI_STATEMENTS`](https://www.php.net/manual/en/ref.pdo-mysql.php#pdo.constants.mysql-attr-multi-statements)** =\> **[`Pdo\Mysql::ATTR_MULTI_STATEMENTS`](https://www.php.net/manual/en/class.pdo-mysql.php#pdo-mysql.constants.attr-multi-statements)**
- **[`PDO::ODBC_ATTR_USE_CURSOR_LIBRARY`](https://www.php.net/manual/en/ref.pdo-odbc.php#pdo.constants.odbc-attr-use-cursor-library)** =\> **[`Pdo\Odbc::ATTR_USE_CURSOR_LIBRARY`](https://www.php.net/manual/en/class.pdo-odbc.php#pdo-odbc.constants.attr-use-cursor-library)**
- **[`PDO::ODBC_ATTR_ASSUME_UTF8`](https://www.php.net/manual/en/ref.pdo-odbc.php#pdo.constants.odbc-attr-assume-utf8)** =\> **[`Pdo\Odbc::ATTR_ASSUME_UTF8`](https://www.php.net/manual/en/class.pdo-odbc.php#pdo-odbc.constants.attr-assume-utf8)**
- **[`PDO::ODBC_SQL_USE_IF_NEEDED`](https://www.php.net/manual/en/ref.pdo-odbc.php#pdo.constants.odbc-sql-use-if-needed)** =\> **[`Pdo\Odbc::SQL_USE_IF_NEEDED`](https://www.php.net/manual/en/class.pdo-odbc.php#pdo-odbc.constants.sql-use-if-needed)**
- **[`PDO::ODBC_SQL_USE_DRIVER`](https://www.php.net/manual/en/ref.pdo-odbc.php#pdo.constants.odbc-sql-use-driver)** =\> **[`Pdo\Odbc::SQL_USE_DRIVER`](https://www.php.net/manual/en/class.pdo-odbc.php#pdo-odbc.constants.sql-use-driver)**
- **[`PDO::ODBC_SQL_USE_ODBC`](https://www.php.net/manual/en/ref.pdo-odbc.php#pdo.constants.odbc-sql-use-odbc)** =\> **[`Pdo\Odbc::SQL_USE_ODBC`](https://www.php.net/manual/en/class.pdo-odbc.php#pdo-odbc.constants.sql-use-odbc)**
- **[`PDO::PGSQL_ATTR_DISABLE_PREPARES`](https://www.php.net/manual/en/ref.pdo-pgsql.php#pdo.constants.pgsql-attr-disable-prepares)** =\> **[`Pdo\Pgsql::ATTR_DISABLE_PREPARES`](https://www.php.net/manual/en/class.pdo-pgsql.php#pdo-pgsql.constants.attr-disable-prepares)**
- **`PDO::SQLITE_ATTR_EXTENDED_RESULT_CODES`** =\> **[`Pdo\Sqlite::ATTR_EXTENDED_RESULT_CODES`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.attr-extended-result-codes)**
- **`PDO::SQLITE_ATTR_OPEN_FLAGS`** =\> **[`Pdo\Sqlite::ATTR_OPEN_FLAGS`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.attr-open-flags)**
- **`PDO::SQLITE_ATTR_READONLY_STATEMENT`** =\> **[`Pdo\Sqlite::ATTR_READONLY_STATEMENT`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.attr-readonly-statement)**
- **[`PDO::SQLITE_DETERMINISTIC`](https://www.php.net/manual/en/pdo.constants.php#pdo.constants.sqlite-deterministic)** =\> **[`Pdo\Sqlite::DETERMINISTIC`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.deterministic)**
- **`PDO::SQLITE_OPEN_READONLY`** =\> **[`Pdo\Sqlite::OPEN_READONLY`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.open-readonly)**
- **`PDO::SQLITE_OPEN_READWRITE`** =\> **[`Pdo\Sqlite::OPEN_READWRITE`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.open-readwrite)**
- **`PDO::SQLITE_OPEN_CREATE`** =\> **[`Pdo\Sqlite::OPEN_CREATE`](https://www.php.net/manual/en/class.pdo-sqlite.php#pdo-sqlite.constants.open-create)**

Driver specific methods in the PDO class have been deprecated. List of affected methods and their replacement:

- [PDO::pgsqlCopyFromArray()](https://www.php.net/manual/en/pdo.pgsqlcopyfromarray.php) =\> [Pdo\Pgsql::copyFromArray()](https://www.php.net/manual/en/pdo-pgsql.copyfromarray.php)
- [PDO::pgsqlCopyFromFile()](https://www.php.net/manual/en/pdo.pgsqlcopyfromfile.php) =\> [Pdo\Pgsql::copyFromFile()](https://www.php.net/manual/en/pdo-pgsql.copyfromfile.php)
- [PDO::pgsqlCopyToArray()](https://www.php.net/manual/en/pdo.pgsqlcopytoarray.php) =\> [Pdo\Pgsql::copyToArray()](https://www.php.net/manual/en/pdo-pgsql.copytoarray.php)
- [PDO::pgsqlCopyToFile()](https://www.php.net/manual/en/pdo.pgsqlcopytofile.php) =\> [Pdo\Pgsql::copyToFile()](https://www.php.net/manual/en/pdo-pgsql.copytofile.php)
- [PDO::pgsqlGetNotify()](https://www.php.net/manual/en/pdo.pgsqlgetnotify.php) =\> [Pdo\Pgsql::getNotify()](https://www.php.net/manual/en/pdo-pgsql.getnotify.php)
- [PDO::pgsqlGetPid()](https://www.php.net/manual/en/pdo.pgsqlgetpid.php) =\> [Pdo\Pgsql::getPid()](https://www.php.net/manual/en/pdo-pgsql.getpid.php)
- [PDO::pgsqlLOBCreate()](https://www.php.net/manual/en/pdo.pgsqllobcreate.php) =\> [Pdo\Pgsql::lobCreate()](https://www.php.net/manual/en/pdo-pgsql.lobcreate.php)
- [PDO::pgsqlLOBOpen()](https://www.php.net/manual/en/pdo.pgsqllobopen.php) =\> [Pdo\Pgsql::lobOpen()](https://www.php.net/manual/en/pdo-pgsql.lobopen.php)
- [PDO::pgsqlLOBUnlink()](https://www.php.net/manual/en/pdo.pgsqllobunlink.php) =\> [Pdo\Pgsql::lobUnlink()](https://www.php.net/manual/en/pdo-pgsql.lobunlink.php)
- [PDO::sqliteCreateAggregate()](https://www.php.net/manual/en/pdo.sqlitecreateaggregate.php) =\> [Pdo\Sqlite::createAggregate()](https://www.php.net/manual/en/pdo-sqlite.createaggregate.php)
- [PDO::sqliteCreateCollation()](https://www.php.net/manual/en/pdo.sqlitecreatecollation.php) =\> [Pdo\Sqlite::createCollation()](https://www.php.net/manual/en/pdo-sqlite.createcollation.php)
- [PDO::sqliteCreateFunction()](https://www.php.net/manual/en/pdo.sqlitecreatefunction.php) =\> [Pdo\Sqlite::createFunction()](https://www.php.net/manual/en/pdo-sqlite.createfunction.php)

### PDO_PGSQL

Constants related to transaction states have been deprecated as this feature is unavailable with PDO:

- **[`PDO::PGSQL_TRANSACTION_IDLE`](https://www.php.net/manual/en/ref.pdo-pgsql.php#pdo.constants.pgsql-transaction-idle)**
- **[`PDO::PGSQL_TRANSACTION_ACTIVE`](https://www.php.net/manual/en/ref.pdo-pgsql.php#pdo.constants.pgsql-transaction-active)**
- **[`PDO::PGSQL_TRANSACTION_INTRANS`](https://www.php.net/manual/en/ref.pdo-pgsql.php#pdo.constants.pgsql-transaction-intrans)**
- **[`PDO::PGSQL_TRANSACTION_INERROR`](https://www.php.net/manual/en/ref.pdo-pgsql.php#pdo.constants.pgsql-transaction-inerror)**
- **[`PDO::PGSQL_TRANSACTION_UNKNOWN`](https://www.php.net/manual/en/ref.pdo-pgsql.php#pdo.constants.pgsql-transaction-unknown)**

### Reflection

The `setAccessible()` methods of various Reflection objects have been deprecated, as those no longer have an effect.

Calling [ReflectionClass::getConstant()](https://www.php.net/manual/en/reflectionclass.getconstant.php) for constants that do not exist has been deprecated.

Calling [ReflectionProperty::getDefaultValue()](https://www.php.net/manual/en/reflectionproperty.getdefaultvalue.php) for properties without default values has been deprecated.

### SPL

Unregistering all autoloaders by passing the [spl_autoload_call()](https://www.php.net/manual/en/function.spl-autoload-call.php) function as a callback argument to [spl_autoload_unregister()](https://www.php.net/manual/en/function.spl-autoload-unregister.php) has been deprecated. Instead if this is needed, one should iterate over the return value of [spl_autoload_functions()](https://www.php.net/manual/en/function.spl-autoload-functions.php) and call [spl_autoload_unregister()](https://www.php.net/manual/en/function.spl-autoload-unregister.php) on each value.

The [SplObjectStorage::contains()](https://www.php.net/manual/en/splobjectstorage.contains.php), [SplObjectStorage::attach()](https://www.php.net/manual/en/splobjectstorage.attach.php), and [SplObjectStorage::detach()](https://www.php.net/manual/en/splobjectstorage.detach.php) methods have been deprecated in favour of [SplObjectStorage::offsetExists()](https://www.php.net/manual/en/splobjectstorage.offsetexists.php), [SplObjectStorage::offsetSet()](https://www.php.net/manual/en/splobjectstorage.offsetset.php), and [SplObjectStorage::offsetUnset()](https://www.php.net/manual/en/splobjectstorage.offsetunset.php) respectively.

Using [ArrayObject](https://www.php.net/manual/en/class.arrayobject.php) and [ArrayIterator](https://www.php.net/manual/en/class.arrayiterator.php) with objects has been deprecated.

### Standard

The [socket_set_timeout()](https://www.php.net/manual/en/function.socket-set-timeout.php) alias function has been deprecated. Use [stream_set_timeout()](https://www.php.net/manual/en/function.stream-set-timeout.php) instead.

Passing **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** to [readdir()](https://www.php.net/manual/en/function.readdir.php), [rewinddir()](https://www.php.net/manual/en/function.rewinddir.php), and [closedir()](https://www.php.net/manual/en/function.closedir.php) to use the last opened directory has been deprecated. Provide the last opened directory explicitly instead.

Passing integers outside the interval `[0, 255]` to [chr()](https://www.php.net/manual/en/function.chr.php) is now deprecated. This is because a byte can only hold a value within this interval.

Passing a string which is not a single byte to [ord()](https://www.php.net/manual/en/function.ord.php) is now deprecated, this is indicative of a bug.

The locally predefined variable [\$http_response_header](https://www.php.net/manual/en/reserved.variables.httpresponseheader.php) is deprecated. Instead one should call the [http_get_last_response_headers()](https://www.php.net/manual/en/function.http-get-last-response-headers.php) function.

### XML

The [xml_parser_free()](https://www.php.net/manual/en/function.xml-parser-free.php) function has been deprecated, as [XMLParser](https://www.php.net/manual/en/class.xmlparser.php) objects are freed automatically.

# [PHP 8.4](https://www.php.net/manual/en/migration84.deprecated.php)

## Deprecated Features

### PHP Core

#### Implicitly nullable parameter

A parameter's type is implicitly widened to accept [null](https://www.php.net/manual/en/language.types.null.php) if the default value for it is **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**.

The following code:

```
<?php
function foo(T1 $a = null) {}
```

should be converted to:

```
<?php
function foo(T1|null $a = null) {}
```

or

```
<?php
function foo(?T1 $a = null) {}
```

However, if such a parameter declaration is followed by a mandatory parameter:

```
<?php
function foo(T1 $a, T2 $b = null, T3 $c) {}
```

It must be converted to:

```
<?php
function foo(T1 $a, T2|null $b, T3 $c) {}
```

or

```
<?php
function foo(T1 $a, ?T2 $b, T3 $c) {}
```

as optional parameter before required ones are deprecated.

#### Raising zero to the power of negative number

Raising a number to the power of a negative number is equivalent to taking the reciprocal of the number raised to the positive opposite of the power. That is, `10`^(`-2`) is the same as `1 / 10`^(`2`). Therefore raising `0` to the power of a negative number corresponds to dividing by `0`, i.e. `0`^(`-2`) is the same as `1 / 0`^(`2`), or `1 / 0`. Thus, this behavior has been deprecated.

This affects the exponentiation operator `**` and the [pow()](https://www.php.net/manual/en/function.pow.php) function.

If the IEEE 754 semantics are desired one should use the new [fpow()](https://www.php.net/manual/en/function.fpow.php) function.

#### Using underscore `_` as class name

Naming a class `_` is now deprecated:

```
<?php
class _ {}
```

> **Note**:
>
> Classes whose names start with an underscore are *not* deprecated:
>
> ```
> <?php
> class _MyClass {}
> ```

#### Using [trigger_error()](https://www.php.net/manual/en/function.trigger-error.php) with **[`E_USER_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-user-error)**

Calling [trigger_error()](https://www.php.net/manual/en/function.trigger-error.php) with `error_level` being equal to **[`E_USER_ERROR`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-user-error)** is now deprecated.

Such usages should be replaced by either throwing an exception, or calling [exit()](https://www.php.net/manual/en/function.exit.php), whichever is more appropriate.

#### The **[`E_STRICT`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-strict)** constant

Because the **[`E_STRICT`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-strict)** error level was removed, this constant is now deprecated.

### cURL

The **[`CURLOPT_BINARYTRANSFER`](https://www.php.net/manual/en/curl.constants.php#constant.curlopt-binarytransfer)** constant is now deprecated.

### Date

The ` DatePeriod::__construct(string $isostr, int $options = 0)` signature has been deprecated. Use [DatePeriod::createFromISO8601String()](https://www.php.net/manual/en/dateperiod.createfromiso8601string.php) instead.

The **[`SUNFUNCS_RET_TIMESTAMP`](https://www.php.net/manual/en/datetime.constants.php#constant.sunfuncs-ret-timestamp)**, **[`SUNFUNCS_RET_STRING`](https://www.php.net/manual/en/datetime.constants.php#constant.sunfuncs-ret-string)**, and **[`SUNFUNCS_RET_DOUBLE`](https://www.php.net/manual/en/datetime.constants.php#constant.sunfuncs-ret-double)** constants are now deprecated. This follows from the deprecation of the [date_sunset()](https://www.php.net/manual/en/function.date-sunset.php) and [date_sunrise()](https://www.php.net/manual/en/function.date-sunrise.php) functions in PHP 8.1.0.

### DBA

Passing **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** or **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** to [dba_key_split()](https://www.php.net/manual/en/function.dba-key-split.php) is now deprecated. It would always return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** in those cases.

### DOM

The **[`DOM_PHP_ERR`](https://www.php.net/manual/en/dom.constants.php#constant.dom-php-err)** constant is now deprecated.

The following properties have been formally deprecated:

- [DOMDocument::\$actualEncoding](https://www.php.net/manual/en/class.domdocument.php#domdocument.props.actualencoding)
- [DOMDocument::\$config](https://www.php.net/manual/en/class.domdocument.php#domdocument.props.config)
- [DOMEntity::\$actualEncoding](https://www.php.net/manual/en/class.domentity.php#domentity.props.actualencoding)
- [DOMEntity::\$encoding](https://www.php.net/manual/en/class.domentity.php#domentity.props.encoding)
- [DOMEntity::\$version](https://www.php.net/manual/en/class.domentity.php#domentity.props.version)

### Hash

Passing invalid options to hash functions is now deprecated.

### Intl

Calling **intlcal_set()** or [IntlCalendar::set()](https://www.php.net/manual/en/intlcalendar.set.php) with more than two arguments is deprecated. Use either [IntlCalendar::setDate()](https://www.php.net/manual/en/intlcalendar.setdate.php) or [IntlCalendar::setDateTime()](https://www.php.net/manual/en/intlcalendar.setdatetime.php) instead.

Calling **intlgregcal_create_instance()** or [IntlGregorianCalendar::\_\_construct()](https://www.php.net/manual/en/intlgregoriancalendar.construct.php) with more than two arguments is deprecated. Use either [IntlGregorianCalendar::createFromDate()](https://www.php.net/manual/en/intlgregoriancalendar.createfromdate.php) or [IntlGregorianCalendar::createFromDateTime()](https://www.php.net/manual/en/intlgregoriancalendar.createfromdatetime.php) instead.

### LDAP

Calling [ldap_connect()](https://www.php.net/manual/en/function.ldap-connect.php) with more than two arguments is deprecated. Use [ldap_connect_wallet()](https://www.php.net/manual/en/function.ldap-connect-wallet.php) instead.

Calling [ldap_exop()](https://www.php.net/manual/en/function.ldap-exop.php) with more than four arguments is deprecated. Use [ldap_exop_sync()](https://www.php.net/manual/en/function.ldap-exop-sync.php) instead.

### MySQLi

The [mysqli_ping()](https://www.php.net/manual/en/mysqli.ping.php) function and [mysqli::ping()](https://www.php.net/manual/en/mysqli.ping.php) method are now deprecated as the reconnect feature was removed in PHP 8.2.0.

The [mysqli_kill()](https://www.php.net/manual/en/mysqli.kill.php) function and [mysqli::kill()](https://www.php.net/manual/en/mysqli.kill.php) method are now deprecated. If this functionality is needed a SQL `KILL` command can be used instead.

The [mysqli_refresh()](https://www.php.net/manual/en/mysqli.refresh.php) function and [mysqli::refresh()](https://www.php.net/manual/en/mysqli.refresh.php) method are now deprecated. If this functionality is needed a SQL `FLUSH` command can be used instead. All **[`MYSQLI_REFRESH_*`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-refresh-grant)** constants have been deprecated as well.

Passing the `mode` parameter to [mysqli_store_result()](https://www.php.net/manual/en/mysqli.store-result.php) explicitly has been deprecated. As the **[`MYSQLI_STORE_RESULT_COPY_DATA`](https://www.php.net/manual/en/mysqli.constants.php#constant.mysqli-store-result-copy-data)** constant was only used in conjunction with this function it has also been deprecated.

### PDO_PGSQL

Using escaped question marks (`??`) inside dollar-quoted strings is deprecated. Because PDO_PGSQL now has its own SQL parser with dollar-quoted strings support, it is no longer necessary to escape question marks inside them.

### PGSQL

The 2 arguments signature of [pg_fetch_result()](https://www.php.net/manual/en/function.pg-fetch-result.php), [pg_field_prtlen()](https://www.php.net/manual/en/function.pg-field-prtlen.php), and [pg_field_is_null()](https://www.php.net/manual/en/function.pg-field-is-null.php) is now deprecated. Use the 3 arguments signature with `row` set to **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** instead.

### Random

[lcg_value()](https://www.php.net/manual/en/function.lcg-value.php) is now deprecated, as the function is broken in multiple ways. Use [Random\Randomizer::getFloat()](https://www.php.net/manual/en/random-randomizer.getfloat.php) instead.

### Reflection

Calling [ReflectionMethod::\_\_construct()](https://www.php.net/manual/en/reflectionmethod.construct.php) with one argument is deprecated. Use [ReflectionMethod::createFromMethodName()](https://www.php.net/manual/en/reflectionmethod.createfrommethodname.php) instead.

### Session

Calling [session_set_save_handler()](https://www.php.net/manual/en/function.session-set-save-handler.php) with more than two arguments is deprecated. Use the two arguments signature instead.

Changing the value of the [`session.sid_length`](https://www.php.net/manual/en/session.configuration.php#ini.session.sid-length) and [`session.sid_bits_per_character`](https://www.php.net/manual/en/session.configuration.php#ini.session.sid-bits-per-character) INI settings is deprecated. Update the session storage backend to accept 32 character hexadecimal session IDs and stop changing these two INI settings instead.

Changing the value of the [`session.use_only_cookies`](https://www.php.net/manual/en/session.configuration.php#ini.session.use-only-cookies), [`session.use_trans_sid`](https://www.php.net/manual/en/session.configuration.php#ini.session.use-trans-sid), [`session.trans_sid_tags`](https://www.php.net/manual/en/session.configuration.php#ini.session.trans-sid-tags), [`session.trans_sid_hosts`](https://www.php.net/manual/en/session.configuration.php#ini.session.trans-sid-hosts), and [`session.referer_check`](https://www.php.net/manual/en/session.configuration.php#ini.session.referer-check) INI settings is deprecated. The **[`SID`](https://www.php.net/manual/en/session.constants.php#constant.sid)** constant is also deprecated.

### SOAP

Passing an [int](https://www.php.net/manual/en/language.types.integer.php) to [SoapServer::addFunction()](https://www.php.net/manual/en/soapserver.addfunction.php) is now deprecated. If all PHP functions need to be provided flatten the array returned by [get_defined_functions()](https://www.php.net/manual/en/function.get-defined-functions.php).

The **[`SOAP_FUNCTIONS_ALL`](https://www.php.net/manual/en/soap.constants.php#constant.soap-functions-all)** constant is now deprecated.

### SPL

The [SplFixedArray::\_\_wakeup()](https://www.php.net/manual/en/splfixedarray.wakeup.php) method is now deprecated, as it implements [SplFixedArray::\_\_serialize()](https://www.php.net/manual/en/splfixedarray.serialize.php) and [SplFixedArray::\_\_unserialize()](https://www.php.net/manual/en/splfixedarray.unserialize.php) which need to be overwritten instead.

Using the default value for the `escape` parameter for the [SplFileObject::setCsvControl()](https://www.php.net/manual/en/splfileobject.setcsvcontrol.php), [SplFileObject::fputcsv()](https://www.php.net/manual/en/splfileobject.fputcsv.php), and [SplFileObject::fgetcsv()](https://www.php.net/manual/en/splfileobject.fgetcsv.php) is now deprecated. It must be passed explicitly either positionally or via named arguments. This does not apply to [SplFileObject::fputcsv()](https://www.php.net/manual/en/splfileobject.fputcsv.php) and [SplFileObject::fgetcsv()](https://www.php.net/manual/en/splfileobject.fgetcsv.php) if [SplFileObject::setCsvControl()](https://www.php.net/manual/en/splfileobject.setcsvcontrol.php) was used to set a new default value.

### Standard

Calling [stream_context_set_option()](https://www.php.net/manual/en/function.stream-context-set-option.php) with two arguments is deprecated. Use [stream_context_set_options()](https://www.php.net/manual/en/function.stream-context-set-options.php) instead.

Unserializing strings using the uppercase `S` tag with [unserialize()](https://www.php.net/manual/en/function.unserialize.php) is deprecated.

Using the default value for the `escape` parameter for the [fputcsv()](https://www.php.net/manual/en/function.fputcsv.php), [fgetcsv()](https://www.php.net/manual/en/function.fgetcsv.php), and [str_getcsv()](https://www.php.net/manual/en/function.str-getcsv.php) is now deprecated. It must be passed explicitly either positionally or via named arguments.

### XML

The [xml_set_object()](https://www.php.net/manual/en/function.xml-set-object.php) function has been deprecated.

Passing non-[callable](https://www.php.net/manual/en/language.types.callable.php) strings to the xml_set\_\* functions is now deprecated.

# [PHP 8.3](https://www.php.net/manual/en/migration83.deprecated.php)

## Deprecated Features

### PHP Core

#### Saner Increment/Decrement operators

Using the [increment](https://www.php.net/manual/en/language.operators.increment.php) operator (`++`) on empty, non-numeric, or non-alphanumeric strings is now deprecated. Moreover, incrementing non-numeric strings is soft deprecated. That means no **[`E_DEPRECATED`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-deprecated)** diagnostic is emitted, but this feature should not be used when producing new code. The new [str_increment()](https://www.php.net/manual/en/function.str-increment.php) function should be used instead.

Using the [decrement](https://www.php.net/manual/en/language.operators.increment.php) operator (`--`) on empty or non-numeric strings is now deprecated.

#### get_class()/get_parent_class() call without arguments

Calling [get_class()](https://www.php.net/manual/en/function.get-class.php) and [get_parent_class()](https://www.php.net/manual/en/function.get-parent-class.php) without arguments is now deprecated.

### DBA

Calling [dba_fetch()](https://www.php.net/manual/en/function.dba-fetch.php) with `dba` as the 3rd argument is now deprecated.

### FFI

Calling [FFI::cast()](https://www.php.net/manual/en/ffi.cast.php), [FFI::new()](https://www.php.net/manual/en/ffi.new.php), and [FFI::type()](https://www.php.net/manual/en/ffi.type.php) statically is now deprecated.

### Intl

The **`U_MULTIPLE_DECIMAL_SEP*E*RATORS`** constant had been deprecated, using the **`U_MULTIPLE_DECIMAL_SEP*A*RATORS`** constant instead is recommended.

The **[`NumberFormatter::TYPE_CURRENCY`](https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.type-currency)** constant has been deprecated.

### LDAP

Calling [ldap_connect()](https://www.php.net/manual/en/function.ldap-connect.php) with separate `hostname` and `port` is deprecated.

### MBString

Passing a negative `width` to [mb_strimwidth()](https://www.php.net/manual/en/function.mb-strimwidth.php) is now deprecated.

### Phar

Calling [Phar::setStub()](https://www.php.net/manual/en/phar.setstub.php) with a [resource](https://www.php.net/manual/en/language.types.resource.php) and a `length` is now deprecated. Such calls should be replaced by: `$phar->setStub(stream_get_contents($resource));`

### Random

The **[`MT_RAND_PHP`](https://www.php.net/manual/en/random.constants.php#constant.mt-rand-php)** Mt19937 variant is deprecated.

### Reflection

Calling [ReflectionProperty::setValue()](https://www.php.net/manual/en/reflectionproperty.setvalue.php) with only one parameter is deprecated. To set static properties, pass **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** as the first parameter.

### Standard

The [assert_options()](https://www.php.net/manual/en/function.assert-options.php) function is now deprecated.

The **[`ASSERT_ACTIVE`](https://www.php.net/manual/en/info.constants.php#constant.assert-active)**, **[`ASSERT_BAIL`](https://www.php.net/manual/en/info.constants.php#constant.assert-bail)**, **[`ASSERT_CALLBACK`](https://www.php.net/manual/en/info.constants.php#constant.assert-callback)**, **[`ASSERT_EXCEPTION`](https://www.php.net/manual/en/info.constants.php#constant.assert-exception)**, and **[`ASSERT_WARNING`](https://www.php.net/manual/en/info.constants.php#constant.assert-warning)** constants have been deprecated.

The `assert.*` INI settings have been deprecated. See the [Changes to INI File Handling](https://www.php.net/manual/en/migration83.other-changes.php#migration83.other-changes.ini) page for further details.

### SQLite3

Using exceptions is now preferred, warnings will be removed in the future. Calling `SQLite3::enableExceptions(false)` will trigger a deprecation warning in this version.

### Zip

The **[`ZipArchive::FL_RECOMPRESS`](https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.fl-recompress)** constant is deprecated and will be removed in a future version of libzip.

# [PHP 8.2](https://www.php.net/manual/en/migration82.deprecated.php)

## Deprecated Features

### PHP Core

#### Usage of dynamic properties

The creation of dynamic properties is deprecated, unless the class opts in by using the `#[\AllowDynamicProperties]` attribute. [stdClass](https://www.php.net/manual/en/class.stdclass.php) allows dynamic properties. Usage of the [\_\_get()](https://www.php.net/manual/en/language.oop5.overloading.php#object.get)/[\_\_set()](https://www.php.net/manual/en/language.oop5.overloading.php#object.set) magic methods is not affected by this change. A dynamic properties deprecation warning can be addressed by:

- Declaring the property (preferred).
- Adding the `#[\AllowDynamicProperties]` attribute to the class (which also applies to all child classes).
- Using a [WeakMap](https://www.php.net/manual/en/class.weakmap.php) if additional data needs to be associated with an object which one does not own.

#### Relative callables

Callables that are not accepted by the `$callable()` syntax (but are accepted by [call_user_func()](https://www.php.net/manual/en/function.call-user-func.php)) are deprecated. In particular:

- `"self::method"`
- `"parent::method"`
- `"static::method"`
- `["self", "method"]`
- `["parent", "method"]`
- `["static", "method"]`
- `["Foo", "Bar::method"]`
- `[new Foo, "Bar::method"]`

This does not affect normal method callables such as `"A::method"` or `["A", "method"]`.

#### `"${var}"` and `"${expr}"` style interpolation

The `"${var}"` and `"${expr}"` style of string interpolation is deprecated. Use `"$var"/"{$var}"` and `"{${expr}}"`, respectively.

### MBString

Usage of the `QPrint`, `Base64`, `Uuencode`, and `HTML-ENTITIES` 'text encodings' is deprecated for all MBString functions. Unlike all the other text encodings supported by MBString, these do not encode a sequence of Unicode codepoints, but rather a sequence of raw bytes. It is not clear what the correct return values for most MBString functions should be when one of these non-encodings is specified. Moreover, PHP has separate, built-in implementations of all of them; for example, UUencoded data can be handled using [convert_uuencode()](https://www.php.net/manual/en/function.convert-uuencode.php)/[convert_uudecode()](https://www.php.net/manual/en/function.convert-uudecode.php).

### SPL

The internal **SplFileInfo::\_bad_state_ex()** method has been deprecated.

### Standard

[utf8_encode()](https://www.php.net/manual/en/function.utf8-encode.php) and [utf8_decode()](https://www.php.net/manual/en/function.utf8-decode.php) have been deprecated.

# [PHP 8.1](https://www.php.net/manual/en/migration81.deprecated.php)

## Deprecated Features

### PHP Core

#### Implementing [Serializable](https://www.php.net/manual/en/class.serializable.php) without **\_\_serialize()** and **\_\_unserialize()**

Either only the new methods should be implemented, if no support for PHP prior to version 7.4 is provided, or both should be implemented.

#### Passing **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** to non-nullable parameters of built-in functions

Scalar types for built-in functions are nullable by default. This behaviour is deprecated to align with the behaviour of user-defined functions, where scalar types need to be marked as nullable explicitly.

```
<?php
var_dump(str_contains("foobar", null));
// Deprecated: Passing null to parameter #2 ($needle) of type string
//             is deprecated
?>
```

#### Implicit incompatible [float](https://www.php.net/manual/en/language.types.float.php) to [int](https://www.php.net/manual/en/language.types.integer.php) conversions

The implicit conversion of [float](https://www.php.net/manual/en/language.types.float.php) to [int](https://www.php.net/manual/en/language.types.integer.php) which leads to a loss in precision is now deprecated. This affects [array](https://www.php.net/manual/en/language.types.array.php) keys, [int](https://www.php.net/manual/en/language.types.integer.php) type declarations in coercive mode, and operators working on [int](https://www.php.net/manual/en/language.types.integer.php)s.

```
<?php
$a = [];
$a[15.5]; // deprecated, as key value loses the 0.5 component
$a[15.0]; // ok, as 15.0 == 15
?>
```

#### Calling a static element on a trait

Calling a static method, or accessing a static property directly on a trait is deprecated. Static methods and properties should only be accessed on a class using the trait.

#### Returning a non-[array](https://www.php.net/manual/en/language.types.array.php) from **\_\_sleep()**

Returning a value which is not an [array](https://www.php.net/manual/en/language.types.array.php) from [\_\_sleep()](https://www.php.net/manual/en/language.oop5.magic.php#object.sleep) now generates a diagnostic.

#### Returning by reference from a [void](https://www.php.net/manual/en/language.types.void.php) function

```
<?php
function &test(): void {}
?>
```

Such a function is contradictory, and already emits the following **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)** when called: `Only variable references should be returned by reference`.

#### Autovivification from **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**

Autovivification is the process of creating a new [array](https://www.php.net/manual/en/language.types.array.php) when appending to a value. Autovivification is prohibited from scalar values, **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** however was an exception. This is now deprecated.

```
<?php
$arr = false;
$arr[] = 2;   // deprecated
?>
```

> **Note**:
>
> Autovivification from **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)** and undefined values is still allowed:
>
> ```
> <?php
> // From undefined
> $arr[] = 'some value';
> $arr['doesNotExist'][] = 2;
> // From null
> $arr = null;
> $arr[] = 2;
> ?>
> ```

### ctype

#### Verifying non-string arguments

Passing a non-string argument is deprecated. In the future, the argument will be interpreted as a string instead of an ASCII codepoint. Depending on the intended behavior, the argument should either be cast to [string](https://www.php.net/manual/en/language.types.string.php) or an explicit call to [chr()](https://www.php.net/manual/en/function.chr.php) should be made. All `ctype_*()` functions are affected.

### Date

[date_sunrise()](https://www.php.net/manual/en/function.date-sunrise.php) and [date_sunset()](https://www.php.net/manual/en/function.date-sunset.php) have been deprecated in favor of [date_sun_info()](https://www.php.net/manual/en/function.date-sun-info.php).

[strptime()](https://www.php.net/manual/en/function.strptime.php) has been deprecated. Use [date_parse_from_format()](https://www.php.net/manual/en/function.date-parse-from-format.php) instead (for locale-independent parsing), or [IntlDateFormatter::parse()](https://www.php.net/manual/en/intldateformatter.parse.php) (for locale-dependent parsing).

[strftime()](https://www.php.net/manual/en/function.strftime.php) and [gmstrftime()](https://www.php.net/manual/en/function.gmstrftime.php) have been deprecated. Use [date()](https://www.php.net/manual/en/function.date.php) instead (for locale-independent formatting), or [IntlDateFormatter::format()](https://www.php.net/manual/en/intldateformatter.format.php) (for locale-dependent formatting).

### Filter

The **[`FILTER_SANITIZE_STRING`](https://www.php.net/manual/en/filter.constants.sanitization.php#constant.filter-sanitize-string)** and **[`FILTER_SANITIZE_STRIPPED`](https://www.php.net/manual/en/filter.constants.sanitization.php#constant.filter-sanitize-stripped)** filters are deprecated.

The [filter.default](https://www.php.net/manual/en/filter.configuration.php#ini.filter.default) INI directive is deprecated.

### GD

The `num_points` of [imagepolygon()](https://www.php.net/manual/en/function.imagepolygon.php), [imageopenpolygon()](https://www.php.net/manual/en/function.imageopenpolygon.php) and [imagefilledpolygon()](https://www.php.net/manual/en/function.imagefilledpolygon.php) has been deprecated.

### Hash

The [mhash()](https://www.php.net/manual/en/function.mhash.php), [mhash_keygen_s2k()](https://www.php.net/manual/en/function.mhash-keygen-s2k.php), [mhash_count()](https://www.php.net/manual/en/function.mhash-count.php), [mhash_get_block_size()](https://www.php.net/manual/en/function.mhash-get-block-size.php), and [mhash_get_hash_name()](https://www.php.net/manual/en/function.mhash-get-hash-name.php) functions have been deprecated. Use the `hash_*()` functions instead.

### IMAP

The **[`NIL`](https://www.php.net/manual/en/imap.constants.php#constant.nil)** constant has been deprecated. Use `0` instead.

### Intl

Calling [IntlCalendar::roll()](https://www.php.net/manual/en/intlcalendar.roll.php) with a [bool](https://www.php.net/manual/en/language.types.boolean.php) argument is deprecated. Use `1` and `-1` instead of **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** and **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** respectively.

### Multibyte String

Calling [mb_check_encoding()](https://www.php.net/manual/en/function.mb-check-encoding.php) without any arguments is deprecated.

### MySQLi

The [mysqli_driver::\$driver_version](https://www.php.net/manual/en/class.mysqli-driver.php#mysqli-driver.props.driver-version) property has been deprecated. It was meaningless and outdated, use **[`PHP_VERSION_ID`](https://www.php.net/manual/en/reserved.constants.php#constant.php-version-id)** instead.

Calling [mysqli::get_client_info()](https://www.php.net/manual/en/mysqli.get-client-info.php) or [mysqli_get_client_info()](https://www.php.net/manual/en/mysqli.get-client-info.php) with the `mysqli` argument has been deprecated. Call [mysqli_get_client_info()](https://www.php.net/manual/en/mysqli.get-client-info.php) without any arguments to obtain the version information of the client library.

The [mysqli::init()](https://www.php.net/manual/en/mysqli.init.php) method has been deprecated. Replace calls to **parent::init()** with **parent::\_\_construct()**.

### OCI8

The [oci8.old_oci_close_semantics](https://www.php.net/manual/en/oci8.configuration.php#ini.oci8.old-oci-close-semantics) INI directive is deprecated.

### ODBC

[odbc_result_all()](https://www.php.net/manual/en/function.odbc-result-all.php) has been deprecated.

### PDO

The **[`PDO::FETCH_SERIALIZE`](https://www.php.net/manual/en/pdo.constants.fetch-modes.php#pdo.constants.fetch-serialize)** fetch mode has been deprecated.

### PgSQL

Not passing the connection argument to all `pgsql_*()` functions has been deprecated.

### SOAP

The `ssl_method` option of [SoapClient::\_\_construct()](https://www.php.net/manual/en/soapclient.construct.php) has been deprecated in favor of SSL stream context options.

### Standard

Calling [key()](https://www.php.net/manual/en/function.key.php), [current()](https://www.php.net/manual/en/function.current.php), [next()](https://www.php.net/manual/en/function.next.php), [prev()](https://www.php.net/manual/en/function.prev.php), [reset()](https://www.php.net/manual/en/function.reset.php), or [end()](https://www.php.net/manual/en/function.end.php) on [object](https://www.php.net/manual/en/language.types.object.php)s is deprecated. Either convert the [object](https://www.php.net/manual/en/language.types.object.php) to an [array](https://www.php.net/manual/en/language.types.array.php) using [get_mangled_object_vars()](https://www.php.net/manual/en/function.get-mangled-object-vars.php) first, or use the methods provided by a class that implements [Iterator](https://www.php.net/manual/en/class.iterator.php), such as [ArrayIterator](https://www.php.net/manual/en/class.arrayiterator.php), instead.

The [auto_detect_line_endings](https://www.php.net/manual/en/filesystem.configuration.php#ini.auto-detect-line-endings) INI directive is deprecated. If necessary, handle `"\r"` line breaks manually instead.

The **[`FILE_BINARY`](https://www.php.net/manual/en/filesystem.constants.php#constant.file-binary)** and **[`FILE_TEXT`](https://www.php.net/manual/en/filesystem.constants.php#constant.file-text)** constants have been deprecated. They never had any effect.

# [PHP 8.0](https://www.php.net/manual/en/migration80.deprecated.php)

## Deprecated Features

### PHP Core

- If a parameter with a default value is followed by a required parameter, the default value has no effect. This is deprecated as of PHP 8.0.0 and can generally be resolved by dropping the default value, without a change in functionality:

  ```
  <?php
  function test($a = [], $b) {} // Before
  function test($a, $b) {}      // After
  ?>
  ```

  One exception to this rule are parameters of the form `Type $param = null`, where the null default makes the type implicitly nullable. This usage remains allowed, but it is recommended to use an explicit nullable type instead:

  ```
  <?php
  function test(A $a = null, $b) {} // Still allowed
  function test(?A $a, $b) {}       // Recommended
  ?>
  ```

- Calling [get_defined_functions()](https://www.php.net/manual/en/function.get-defined-functions.php) with `exclude_disabled` explicitly set to **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** is deprecated and no longer has an effect. [get_defined_functions()](https://www.php.net/manual/en/function.get-defined-functions.php) will never include disabled functions.

### Enchant

- [enchant_broker_set_dict_path()](https://www.php.net/manual/en/function.enchant-broker-set-dict-path.php) and [enchant_broker_get_dict_path()](https://www.php.net/manual/en/function.enchant-broker-get-dict-path.php) are deprecated, because that functionality is neither available in libenchant \< 1.5 nor in libenchant-2.

- [enchant_dict_add_to_personal()](https://www.php.net/manual/en/function.enchant-dict-add-to-personal.php) is deprecated; use [enchant_dict_add()](https://www.php.net/manual/en/function.enchant-dict-add.php) instead.

- [enchant_dict_is_in_session()](https://www.php.net/manual/en/function.enchant-dict-is-in-session.php) is deprecated; use [enchant_dict_is_added()](https://www.php.net/manual/en/function.enchant-dict-is-added.php) instead.

- [enchant_broker_free()](https://www.php.net/manual/en/function.enchant-broker-free.php) and [enchant_broker_free_dict()](https://www.php.net/manual/en/function.enchant-broker-free-dict.php) are deprecated; unset the object instead.

- The **[`ENCHANT_MYSPELL`](https://www.php.net/manual/en/enchant.constants.php#constant.enchant-myspell)** and **[`ENCHANT_ISPELL`](https://www.php.net/manual/en/enchant.constants.php#constant.enchant-ispell)** constants are deprecated.

### LibXML

[libxml_disable_entity_loader()](https://www.php.net/manual/en/function.libxml-disable-entity-loader.php) has been deprecated. As libxml 2.9.0 is now required, external entity loading is guaranteed to be disabled by default, and this function is no longer needed to protect against XXE attacks, unless the (still vulnerable) **[`LIBXML_NOENT`](https://www.php.net/manual/en/libxml.constants.php#constant.libxml-noent)** is used. In that case, it is recommended to refactor the code using [libxml_set_external_entity_loader()](https://www.php.net/manual/en/function.libxml-set-external-entity-loader.php) to suppress loading of external entities.

### PGSQL / PDO PGSQL

- The constant **[`PGSQL_LIBPQ_VERSION_STR`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-libpq-version-str)** now has the same value as **[`PGSQL_LIBPQ_VERSION`](https://www.php.net/manual/en/pgsql.constants.php#constant.pgsql-libpq-version)**, and thus is deprecated.

- Function aliases in the pgsql extension have been deprecated. See the following list for which functions should be used instead:

  - **pg_errormessage()** → [pg_last_error()](https://www.php.net/manual/en/function.pg-last-error.php)
  - **pg_numrows()** → [pg_num_rows()](https://www.php.net/manual/en/function.pg-num-rows.php)
  - **pg_numfields()** → [pg_num_fields()](https://www.php.net/manual/en/function.pg-num-fields.php)
  - **pg_cmdtuples()** → [pg_affected_rows()](https://www.php.net/manual/en/function.pg-affected-rows.php)
  - **pg_fieldname()** → [pg_field_name()](https://www.php.net/manual/en/function.pg-field-name.php)
  - **pg_fieldsize()** → [pg_field_size()](https://www.php.net/manual/en/function.pg-field-size.php)
  - **pg_fieldtype()** → [pg_field_type()](https://www.php.net/manual/en/function.pg-field-type.php)
  - **pg_fieldnum()** → [pg_field_num()](https://www.php.net/manual/en/function.pg-field-num.php)
  - **pg_result()** → [pg_fetch_result()](https://www.php.net/manual/en/function.pg-fetch-result.php)
  - **pg_fieldprtlen()** → [pg_field_prtlen()](https://www.php.net/manual/en/function.pg-field-prtlen.php)
  - **pg_fieldisnull()** → [pg_field_is_null()](https://www.php.net/manual/en/function.pg-field-is-null.php)
  - **pg_freeresult()** → [pg_free_result()](https://www.php.net/manual/en/function.pg-free-result.php)
  - **pg_getlastoid()** → [pg_last_oid()](https://www.php.net/manual/en/function.pg-last-oid.php)
  - **pg_locreate()** → [pg_lo_create()](https://www.php.net/manual/en/function.pg-lo-create.php)
  - **pg_lounlink()** → [pg_lo_unlink()](https://www.php.net/manual/en/function.pg-lo-unlink.php)
  - **pg_loopen()** → [pg_lo_open()](https://www.php.net/manual/en/function.pg-lo-open.php)
  - **pg_loclose()** → [pg_lo_close()](https://www.php.net/manual/en/function.pg-lo-close.php)
  - **pg_loread()** → [pg_lo_read()](https://www.php.net/manual/en/function.pg-lo-read.php)
  - **pg_lowrite()** → [pg_lo_write()](https://www.php.net/manual/en/function.pg-lo-write.php)
  - **pg_loreadall()** → [pg_lo_read_all()](https://www.php.net/manual/en/function.pg-lo-read-all.php)
  - **pg_loimport()** → [pg_lo_import()](https://www.php.net/manual/en/function.pg-lo-import.php)
  - **pg_loexport()** → [pg_lo_export()](https://www.php.net/manual/en/function.pg-lo-export.php)
  - **pg_setclientencoding()** → [pg_set_client_encoding()](https://www.php.net/manual/en/function.pg-set-client-encoding.php)
  - **pg_clientencoding()** -\> [pg_client_encoding()](https://www.php.net/manual/en/function.pg-client-encoding.php)

### Standard Library

- Sort comparison functions that return **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** or **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)** will now throw a deprecation warning, and should be replaced with an implementation that returns an integer less than, equal to, or greater than zero.

  ```
  <?php
  // Replace
  usort($array, fn($a, $b) => $a > $b);
  // With
  usort($array, fn($a, $b) => $a <=> $b);
  ?>
  ```

### Zip

- Using an empty file as ZipArchive is deprecated. Libzip 1.6.0 does not accept empty files as valid zip archives any longer. The existing workaround will be removed in the next version.

- The procedural API of Zip is deprecated. Use [ZipArchive](https://www.php.net/manual/en/class.ziparchive.php) instead. Iteration over all entries can be accomplished using [ZipArchive::statIndex()](https://www.php.net/manual/en/ziparchive.statindex.php) and a [for](https://www.php.net/manual/en/control-structures.for.php) loop:

  ```
  <?php
  // iterate using the procedural API
  assert(is_resource($zip));
  while ($entry = zip_read($zip)) {
      echo zip_entry_name($entry);
  }

  // iterate using the object-oriented API
  assert($zip instanceof ZipArchive);
  for ($i = 0; $entry = $zip->statIndex($i); $i++) {
      echo $entry['name'];
  }
  ?>
  ```

### Reflection

- [ReflectionFunction::isDisabled()](https://www.php.net/manual/en/reflectionfunction.isdisabled.php) is deprecated, as it is no longer possible to create a [ReflectionFunction](https://www.php.net/manual/en/class.reflectionfunction.php) for a disabled function. This method now always returns **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

- [ReflectionParameter::getClass()](https://www.php.net/manual/en/reflectionparameter.getclass.php), [ReflectionParameter::isArray()](https://www.php.net/manual/en/reflectionparameter.isarray.php), and [ReflectionParameter::isCallable()](https://www.php.net/manual/en/reflectionparameter.iscallable.php) are deprecated. [ReflectionParameter::getType()](https://www.php.net/manual/en/reflectionparameter.gettype.php) and the [ReflectionType](https://www.php.net/manual/en/class.reflectiontype.php) APIs should be used instead.

# [PHP 7.4](https://www.php.net/manual/en/migration74.deprecated.php)

## Deprecated Features

### PHP Core

#### Nested ternary operators without explicit parentheses

Nested ternary operations must explicitly use parentheses to dictate the order of the operations. Previously, when used without parentheses, the left-associativity would not result in the expected behaviour in most cases.

```
<?php
1 ? 2 : 3 ? 4 : 5;   // deprecated
(1 ? 2 : 3) ? 4 : 5; // ok
1 ? 2 : (3 ? 4 : 5); // ok
?>
```

Parentheses are *not* required when nesting into the middle operand, as this is always unambiguous and not affected by associativity:

```
1 ? 2 ? 3 : 4 : 5 // ok
```

#### Array and string offset access using curly braces

The array and string offset access syntax using curly braces is deprecated. Use `$var[$idx]` instead of `$var{$idx}`.

#### (real) cast and [is_real()](https://www.php.net/manual/en/function.is-real.php) function

The `(real)` cast is deprecated, use `(float)` instead.

The [is_real()](https://www.php.net/manual/en/function.is-real.php) function is also deprecated, use [is_float()](https://www.php.net/manual/en/function.is-float.php) instead.

#### Unbinding `$this` when `$this` is used

Unbinding `$this` of a non-static closure that uses `$this` is deprecated.

#### `parent` keyword without parent class

Using `parent` inside a class without a parent is deprecated, and will throw a compile-time error in the future. Currently an error will only be generated if/when the parent is accessed at run-time.

#### allow_url_include INI option

The [allow_url_include](https://www.php.net/manual/en/filesystem.configuration.php#ini.allow-url-include) ini directive is deprecated. Enabling it will generate a deprecation notice at startup.

#### Invalid characters in base conversion functions

Passing invalid characters to [base_convert()](https://www.php.net/manual/en/function.base-convert.php), [bindec()](https://www.php.net/manual/en/function.bindec.php), [octdec()](https://www.php.net/manual/en/function.octdec.php) and [hexdec()](https://www.php.net/manual/en/function.hexdec.php) will now generate a deprecation notice. The result will still be computed as if the invalid characters did not exist. Leading and trailing whitespace, as well as prefixes of type 0x (depending on base) continue to be allowed.

#### Using [array_key_exists()](https://www.php.net/manual/en/function.array-key-exists.php) on objects

Using [array_key_exists()](https://www.php.net/manual/en/function.array-key-exists.php) on objects is deprecated. Instead either [isset()](https://www.php.net/manual/en/function.isset.php) or [property_exists()](https://www.php.net/manual/en/function.property-exists.php) should be used.

#### Magic quotes functions

The [get_magic_quotes_gpc()](https://www.php.net/manual/en/function.get-magic-quotes-gpc.php) and [get_magic_quotes_runtime()](https://www.php.net/manual/en/function.get-magic-quotes-runtime.php) functions are deprecated. They always return **[`false`](https://www.php.net/manual/en/reserved.constants.php#constant.false)**.

#### [hebrevc()](https://www.php.net/manual/en/function.hebrevc.php) function

The [hebrevc()](https://www.php.net/manual/en/function.hebrevc.php) function is deprecated. It can be replaced with `nl2br(hebrev($str))` or, preferably, the use of Unicode RTL support.

#### [convert_cyr_string()](https://www.php.net/manual/en/function.convert-cyr-string.php) function

The [convert_cyr_string()](https://www.php.net/manual/en/function.convert-cyr-string.php) function is deprecated. It can be replaced by one of **mb_convert_string()**, [iconv()](https://www.php.net/manual/en/function.iconv.php) or [UConverter](https://www.php.net/manual/en/class.uconverter.php).

#### [money_format()](https://www.php.net/manual/en/function.money-format.php) function

The [money_format()](https://www.php.net/manual/en/function.money-format.php) function is deprecated. It can be replaced by the intl [NumberFormatter](https://www.php.net/manual/en/class.numberformatter.php) functionality.

#### [ezmlm_hash()](https://www.php.net/manual/en/function.ezmlm-hash.php) function

The [ezmlm_hash()](https://www.php.net/manual/en/function.ezmlm-hash.php) function is deprecated.

#### [restore_include_path()](https://www.php.net/manual/en/function.restore-include-path.php) function

The [restore_include_path()](https://www.php.net/manual/en/function.restore-include-path.php) function is deprecated. It can be replaced by `ini_restore('include_path')`.

#### Implode with historical parameter order

Passing parameters to [implode()](https://www.php.net/manual/en/function.implode.php) in reverse order is deprecated, use `implode($glue, $parts)` instead of `implode($parts, $glue)`.

### COM

Importing type libraries with case-insensitive constant registering has been deprecated.

### Filter

**[`FILTER_SANITIZE_MAGIC_QUOTES`](https://www.php.net/manual/en/filter.constants.sanitization.php#constant.filter-sanitize-magic-quotes)** is deprecated, use **[`FILTER_SANITIZE_ADD_SLASHES`](https://www.php.net/manual/en/filter.constants.sanitization.php#constant.filter-sanitize-add-slashes)** instead.

### Multibyte String

Passing a non-string pattern to [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php) is deprecated. Currently, non-string patterns are interpreted as ASCII codepoints. In PHP 8, the pattern will be interpreted as a string instead.

Passing the encoding as 3rd parameter to [mb_strrpos()](https://www.php.net/manual/en/function.mb-strrpos.php) is deprecated. Instead pass a 0 offset, and encoding as 4th parameter.

### Lightweight Directory Access Protocol

[ldap_control_paged_result_response()](https://www.php.net/manual/en/function.ldap-control-paged-result-response.php) and [ldap_control_paged_result()](https://www.php.net/manual/en/function.ldap-control-paged-result.php) are deprecated. Pagination controls can be sent along with [ldap_search()](https://www.php.net/manual/en/function.ldap-search.php) instead.

### Reflection

Calls to [ReflectionType::\_\_toString()](https://www.php.net/manual/en/reflectiontype.tostring.php) now generate a deprecation notice. This method has been deprecated in favor of [ReflectionNamedType::getName()](https://www.php.net/manual/en/reflectionnamedtype.getname.php) in the documentation since PHP 7.1, but did not throw a deprecation notice for technical reasons.

The `export()` methods on all [Reflection](https://www.php.net/manual/en/class.reflection.php) classes are deprecated. Construct a [Reflection](https://www.php.net/manual/en/class.reflection.php) object and convert it to string instead:

```
<?php
// ReflectionClass::export(Foo::class, false) is:
echo new ReflectionClass(Foo::class), "\n";

// $str = ReflectionClass::export(Foo::class, true) is:
$str = (string) new ReflectionClass(Foo::class);
?>
```

### Socket

The **`AI_IDN_ALLOW_UNASSIGNED`** and **`AI_IDN_USE_STD3_ASCII_RULES`** flags for [socket_addrinfo_lookup()](https://www.php.net/manual/en/function.socket-addrinfo-lookup.php) are deprecated, due to an upstream deprecation in glibc.

# [PHP 7.3](https://www.php.net/manual/en/migration73.deprecated.php)

## Deprecated Features

### PHP Core

#### Case-Insensitive Constants

The declaration of case-insensitive constants has been deprecated. Passing **[`true`](https://www.php.net/manual/en/reserved.constants.php#constant.true)** as the third argument to [define()](https://www.php.net/manual/en/function.define.php) will now generate a deprecation warning. The use of case-insensitive constants with a case that differs from the declaration is also deprecated.

#### Namespaced assert()

Declaring a function called `assert()` inside a namespace is deprecated. The [assert()](https://www.php.net/manual/en/function.assert.php) function is subject to special handling by the engine, which may lead to inconsistent behavior when defining a namespaced function with the same name.

#### Searching Strings for non-string Needle

Passing a non-string needle to string search functions is deprecated. In the future the needle will be interpreted as a string instead of an ASCII codepoint. Depending on the intended behavior, you should either explicitly cast the needle to string or perform an explicit call to [chr()](https://www.php.net/manual/en/function.chr.php). The following functions are affected:

- [strpos()](https://www.php.net/manual/en/function.strpos.php)

- [strrpos()](https://www.php.net/manual/en/function.strrpos.php)

- [stripos()](https://www.php.net/manual/en/function.stripos.php)

- [strripos()](https://www.php.net/manual/en/function.strripos.php)

- [strstr()](https://www.php.net/manual/en/function.strstr.php)

- [strchr()](https://www.php.net/manual/en/function.strchr.php)

- [strrchr()](https://www.php.net/manual/en/function.strrchr.php)

- [stristr()](https://www.php.net/manual/en/function.stristr.php)

#### Strip-Tags Streaming

The [fgetss()](https://www.php.net/manual/en/function.fgetss.php) function and the [string.strip_tags stream filter](https://www.php.net/manual/en/filters.string.php) have been deprecated. This also affects the [SplFileObject::fgetss()](https://www.php.net/manual/en/splfileobject.fgetss.php) method and [gzgetss()](https://www.php.net/manual/en/function.gzgetss.php) function.

### Data Filtering

The explicit usage of the constants **[`FILTER_FLAG_SCHEME_REQUIRED`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-flag-scheme-required)** and **[`FILTER_FLAG_HOST_REQUIRED`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-flag-host-required)** is now deprecated; both are implied for **[`FILTER_VALIDATE_URL`](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-validate-url)** anyway.

### Image Processing and GD

[image2wbmp()](https://www.php.net/manual/en/function.image2wbmp.php) has been deprecated.

### Internationalization Functions

Usage of the **`Normalizer::NONE`** form throws a deprecation warning, if PHP is linked with ICU ≥ 56.

### Multibyte String

The following undocumented `mbereg_*()` aliases have been deprecated. Use the corresponding `mb_ereg_*()` variants instead.

- **mbregex_encoding()**

- **mbereg()**

- **mberegi()**

- **mbereg_replace()**

- **mberegi_replace()**

- **mbsplit()**

- **mbereg_match()**

- **mbereg_search()**

- **mbereg_search_pos()**

- **mbereg_search_regs()**

- **mbereg_search_init()**

- **mbereg_search_getregs()**

- **mbereg_search_getpos()**

- **mbereg_search_setpos()**

### ODBC and DB2 Functions (PDO_ODBC)

The [pdo_odbc.db2_instance_name](https://www.php.net/manual/en/ref.pdo-odbc.php#ini.pdo-odbc.db2-instance-name) ini setting has been formally deprecated. It is deprecated in the documentation as of PHP 5.1.1.

# [PHP 7.2](https://www.php.net/manual/en/migration72.deprecated.php)

## Deprecated features in PHP 7.2.x

### Unquoted strings

Unquoted strings that are non-existent global constants are taken to be strings of themselves. This behaviour used to emit an **[`E_NOTICE`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-notice)**, but will now emit an **[`E_WARNING`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-warning)**. In the next major version of PHP, an [Error](https://www.php.net/manual/en/class.error.php) exception will be thrown instead.

```
<?php

var_dump(NONEXISTENT);

/* Output:
Warning: Use of undefined constant NONEXISTENT - assumed 'NONEXISTENT' (this will throw an Error in a future version of PHP) in %s on line %d
string(11) "NONEXISTENT"
*/
```

### [png2wbmp()](https://www.php.net/manual/en/function.png2wbmp.php) and [jpeg2wbmp()](https://www.php.net/manual/en/function.jpeg2wbmp.php)

The [png2wbmp()](https://www.php.net/manual/en/function.png2wbmp.php) and [jpeg2wbmp()](https://www.php.net/manual/en/function.jpeg2wbmp.php) functions from the GD extension have now been deprecated and will be removed in the next major version of PHP.

### **[`INTL_IDNA_VARIANT_2003`](https://www.php.net/manual/en/intl.constants.php#constant.intl-idna-variant-2003)** variant

The Intl extension has deprecated the **[`INTL_IDNA_VARIANT_2003`](https://www.php.net/manual/en/intl.constants.php#constant.intl-idna-variant-2003)** variant, which is currently being used as the default for [idn_to_ascii()](https://www.php.net/manual/en/function.idn-to-ascii.php) and [idn_to_utf8()](https://www.php.net/manual/en/function.idn-to-utf8.php). PHP 7.4 will see these defaults changed to **[`INTL_IDNA_VARIANT_UTS46`](https://www.php.net/manual/en/intl.constants.php#constant.intl-idna-variant-uts46)**, and the next major version of PHP will remove **[`INTL_IDNA_VARIANT_2003`](https://www.php.net/manual/en/intl.constants.php#constant.intl-idna-variant-2003)** altogether.

### [\_\_autoload()](https://www.php.net/manual/en/function.autoload.php) method

The [\_\_autoload()](https://www.php.net/manual/en/function.autoload.php) method has been deprecated because it is inferior to [spl_autoload_register()](https://www.php.net/manual/en/function.spl-autoload-register.php) (due to it not being able to chain autoloaders), and there is no interoperability between the two autoloading styles.

### `track_errors` ini setting and `$php_errormsg` variable

When the `track_errors` ini setting is enabled, a `$php_errormsg` variable is created in the local scope when a non-fatal error occurs. Given that the preferred way of retrieving such error information is by using [error_get_last()](https://www.php.net/manual/en/function.error-get-last.php), this feature has been deprecated.

### [create_function()](https://www.php.net/manual/en/function.create-function.php) function

Given the security issues of this function (being a thin wrapper around [eval()](https://www.php.net/manual/en/function.eval.php)), this dated function has now been deprecated. The preferred alternative is to use [anonymous functions](https://www.php.net/manual/en/functions.anonymous.php).

### `mbstring.func_overload` ini setting

Given the interoperability problems of string-based functions being used in environments with this setting enabled, it has now been deprecated.

### `(unset)` cast

Casting any expression to this type will always result in **[`null`](https://www.php.net/manual/en/reserved.constants.php#constant.null)**, and so this superfluous casting type has now been deprecated.

### [parse_str()](https://www.php.net/manual/en/function.parse-str.php) without a second argument

Without the second argument to [parse_str()](https://www.php.net/manual/en/function.parse-str.php), the query string parameters would populate the local symbol table. Given the security implications of this, using [parse_str()](https://www.php.net/manual/en/function.parse-str.php) without a second argument has now been deprecated. The function should always be used with two arguments, as the second argument causes the query string to be parsed into an array.

### [gmp_random()](https://www.php.net/manual/en/function.gmp-random.php) function

This function generates a random number based upon a range that is calculated by an unexposed, platform-specific limb size. Because of this, the function has now been deprecated. The preferred way of generating a random number using the GMP extension is by [gmp_random_bits()](https://www.php.net/manual/en/function.gmp-random-bits.php) and [gmp_random_range()](https://www.php.net/manual/en/function.gmp-random-range.php).

### [each()](https://www.php.net/manual/en/function.each.php) function

This function is far slower at iteration than a normal `foreach`, and causes implementation issues for some language changes. It has therefore been deprecated.

### [assert()](https://www.php.net/manual/en/function.assert.php) with a string argument

Using [assert()](https://www.php.net/manual/en/function.assert.php) with a string argument required the string to be [eval()](https://www.php.net/manual/en/function.eval.php)'ed. Given the potential for remote code execution, using [assert()](https://www.php.net/manual/en/function.assert.php) with a string argument has now been deprecated in favour of using boolean expressions.

### `$errcontext` argument of error handlers

The `$errcontext` argument contains all local variables of the error site. Given its rare usage, and the problems it causes with internal optimisations, it has now been deprecated. Instead, a debugger should be used to retrieve information on local variables at the error site.

### [read_exif_data()](https://www.php.net/manual/en/function.read-exif-data.php) function

The [read_exif_data()](https://www.php.net/manual/en/function.read-exif-data.php) alias has been deprecated. The [exif_read_data()](https://www.php.net/manual/en/function.exif-read-data.php) function should be used instead.

# [PHP 7.1](https://www.php.net/manual/en/migration71.deprecated.php)

## Deprecated features in PHP 7.1.x

### ext/mcrypt

The mcrypt extension has been abandonware for nearly a decade now, and was also fairly complex to use. It has therefore been deprecated in favour of OpenSSL, where it will be removed from the core and into PECL in PHP 7.2.

### Eval option for [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php) and [mb_eregi_replace()](https://www.php.net/manual/en/function.mb-eregi-replace.php)

The `e` pattern modifier has been deprecated for the [mb_ereg_replace()](https://www.php.net/manual/en/function.mb-ereg-replace.php) and [mb_eregi_replace()](https://www.php.net/manual/en/function.mb-eregi-replace.php) functions.

# [PHP 7.0](https://www.php.net/manual/en/migration70.deprecated.php)

## Deprecated features in PHP 7.0.x

### PHP 4 style constructors

PHP 4 style constructors (methods that have the same name as the class they are defined in) are deprecated, and will be removed in the future. PHP 7 will emit **[`E_DEPRECATED`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-deprecated)** if a PHP 4 constructor is the only constructor defined within a class. Classes that implement a **\_\_construct()** method are unaffected.

```
<?php
class foo {
    function foo() {
        echo 'I am the constructor';
    }
}
?>
```

The above example will output:

    Deprecated: Methods with the same name as their class will not be constructors in a future version of PHP; foo has a deprecated constructor in example.php on line 3

### Static calls to non-static methods

[Static](https://www.php.net/manual/en/language.oop5.static.php) calls to methods that are not declared **static** are deprecated, and may be removed in the future.

```
<?php
class foo {
    function bar() {
        echo 'I am not static!';
    }
}

foo::bar();
?>
```

The above example will output:

    Deprecated: Non-static method foo::bar() should not be called statically in - on line 8
    I am not static!

### [password_hash()](https://www.php.net/manual/en/function.password-hash.php) salt option

The salt option for the [password_hash()](https://www.php.net/manual/en/function.password-hash.php) function has been deprecated to prevent developers from generating their own (usually insecure) salts. The function itself generates a cryptographically secure salt when no salt is provided by the developer - therefore custom salt generation should not be needed.

### `capture_session_meta` SSL context option

The `capture_session_meta` SSL context option has been deprecated. SSL metadata is now available through the [stream_get_meta_data()](https://www.php.net/manual/en/function.stream-get-meta-data.php) function.

### [LDAP](https://www.php.net/manual/en/book.ldap.php) deprecations

The following function has been deprecated:

- [ldap_sort()](https://www.php.net/manual/en/function.ldap-sort.php)

# [PHP 5.6](https://www.php.net/manual/en/migration56.deprecated.php)

## Deprecated features in PHP 5.6.x

### Calls from incompatible context

Methods called from an incompatible context are now deprecated, and will generate **[`E_DEPRECATED`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-deprecated)** errors when invoked instead of **[`E_STRICT`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-strict)**. Support for these calls will be removed in a future version of PHP.

An example of such a call is:

```
<?php
class A {
    function f() { echo get_class($this); }
}

class B {
    function f() { A::f(); }
}

(new B)->f();
?>
```

The above example will output:

    Deprecated: Non-static method A::f() should not be called statically, assuming $this from incompatible context in - on line 7
    B

### `$HTTP_RAW_POST_DATA` and `always_populate_raw_post_data`

`always_populate_raw_post_data` will now generate an **[`E_DEPRECATED`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-deprecated)** error when `$HTTP_RAW_POST_DATA` is populated. New code should use [`php://input`](https://www.php.net/manual/en/wrappers.php.php#wrappers.php.input) instead of `$HTTP_RAW_POST_DATA`, which will be removed in a future release. You can opt in for the new behaviour (in which `$HTTP_RAW_POST_DATA` is never defined hence no **[`E_DEPRECATED`](https://www.php.net/manual/en/errorfunc.constants.php#constant.e-deprecated)** error will be generated) by setting `always_populate_raw_post_data` to `-1`.

### [iconv](https://www.php.net/manual/en/book.iconv.php) and [mbstring](https://www.php.net/manual/en/book.mbstring.php) encoding settings

The [iconv](https://www.php.net/manual/en/book.iconv.php) and [mbstring](https://www.php.net/manual/en/book.mbstring.php) configuration options related to encoding have been deprecated in favour of [`default_charset`](https://www.php.net/manual/en/ini.core.php#ini.default-charset). The deprecated options are:

- [`iconv.input_encoding`](https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.input-encoding)

- [`iconv.output_encoding`](https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.output-encoding)

- [`iconv.internal_encoding`](https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.internal-encoding)

- [`mbstring.http_input`](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.http-input)

- [`mbstring.http_output`](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.http-output)

- [`mbstring.internal_encoding`](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.internal-encoding)

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.deprecated.php)

## Deprecated features in PHP 5.5.x

### [ext/mysql](https://php-legacy-docs.zend.com/manual/php5/en/book.mysql.html) deprecation

The [original MySQL extension](https://php-legacy-docs.zend.com/manual/php5/en/book.mysql.html) is now deprecated, and will generate **`E_DEPRECATED`** errors when connecting to a database. Instead, use the [MySQLi](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html) or [PDO_MySQL](https://php-legacy-docs.zend.com/manual/php5/en/ref.pdo-mysql.html) extensions.

### [preg_replace()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-replace.html) `/e` modifier

The [preg_replace()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-replace.html) `/e` modifier is now deprecated. Instead, use the [preg_replace_callback()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-replace-callback.html) function.

### [intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html) deprecations

[IntlDateFormatter::setTimeZoneID()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.settimezoneid.html) and [datefmt_set_timezone_id()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.settimezoneid.html) are now deprecated. Instead, use the [IntlDateFormatter::setTimeZone()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.settimezone.html) method and [datefmt_set_timezone()](https://php-legacy-docs.zend.com/manual/php5/en/intldateformatter.settimezone.html) function, respectively.

### [mcrypt](https://php-legacy-docs.zend.com/manual/php5/en/book.mcrypt.html) deprecations

The following functions have been deprecated:

- [mcrypt_cbc()](https://php-legacy-docs.zend.com/manual/php5/en/function.mcrypt-cbc.html)
- [mcrypt_cfb()](https://php-legacy-docs.zend.com/manual/php5/en/function.mcrypt-cfb.html)
- [mcrypt_ecb()](https://php-legacy-docs.zend.com/manual/php5/en/function.mcrypt-ecb.html)
- [mcrypt_ofb()](https://php-legacy-docs.zend.com/manual/php5/en/function.mcrypt-ofb.html)

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.deprecated.php)

## Deprecated features in PHP 5.4.x

Deprecated functions:

- [mysql_list_dbs()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysql-list-dbs.html)

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.deprecated.php)

## Deprecated features in PHP 5.3.x

PHP 5.3.0 introduces two new error levels: **`E_DEPRECATED`** and **`E_USER_DEPRECATED`**. The **`E_DEPRECATED`** error level is used to indicate that a function or feature has been deprecated. The **`E_USER_DEPRECATED`** level is intended for indicating deprecated features in user code, similarly to the **`E_USER_ERROR`** and **`E_USER_WARNING`** levels.

The following is a list of deprecated INI directives. Use of any of these INI directives will cause an **`E_DEPRECATED`** error to be thrown at startup.

- [define_syslog_variables](https://php-legacy-docs.zend.com/manual/php5/en/network.configuration.html#ini.define-syslog-variables)
- [register_globals](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.register-globals)
- [register_long_arrays](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.register-long-arrays)
- [safe_mode](https://php-legacy-docs.zend.com/manual/php5/en/ini.sect.safe-mode.html#ini.safe-mode)
- [magic_quotes_gpc](https://php-legacy-docs.zend.com/manual/php5/en/info.configuration.html#ini.magic-quotes-gpc)
- [magic_quotes_runtime](https://php-legacy-docs.zend.com/manual/php5/en/info.configuration.html#ini.magic-quotes-runtime)
- [magic_quotes_sybase](https://php-legacy-docs.zend.com/manual/php5/en/sybase.configuration.html#ini.magic-quotes-sybase)
- Comments starting with '#' are now deprecated in .INI files.

Deprecated functions:

- [call_user_method()](https://php-legacy-docs.zend.com/manual/php5/en/function.call-user-method.html) (use [call_user_func()](https://php-legacy-docs.zend.com/manual/php5/en/function.call-user-func.html) instead)
- [call_user_method_array()](https://php-legacy-docs.zend.com/manual/php5/en/function.call-user-method-array.html) (use [call_user_func_array()](https://php-legacy-docs.zend.com/manual/php5/en/function.call-user-func-array.html) instead)
- [define_syslog_variables()](https://php-legacy-docs.zend.com/manual/php5/en/function.define-syslog-variables.html)
- [dl()](https://php-legacy-docs.zend.com/manual/php5/en/function.dl.html)
- [ereg()](https://php-legacy-docs.zend.com/manual/php5/en/function.ereg.html) (use [preg_match()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-match.html) instead)
- [ereg_replace()](https://php-legacy-docs.zend.com/manual/php5/en/function.ereg-replace.html) (use [preg_replace()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-replace.html) instead)
- [eregi()](https://php-legacy-docs.zend.com/manual/php5/en/function.eregi.html) (use [preg_match()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-match.html) with the `'i'` modifier instead)
- [eregi_replace()](https://php-legacy-docs.zend.com/manual/php5/en/function.eregi-replace.html) (use [preg_replace()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-replace.html) with the `'i'` modifier instead)
- [mcrypt_generic_end()](https://php-legacy-docs.zend.com/manual/php5/en/function.mcrypt-generic-end.html)
- [set_magic_quotes_runtime()](https://php-legacy-docs.zend.com/manual/php5/en/function.set-magic-quotes-runtime.html) and its alias, [magic_quotes_runtime()](https://php-legacy-docs.zend.com/manual/php5/en/function.magic-quotes-runtime.html)
- [session_register()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-register.html) (use the [`$_SESSION`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.session.html) superglobal instead)
- [session_unregister()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-unregister.html) (use the [`$_SESSION`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.session.html) superglobal instead)
- [session_is_registered()](https://php-legacy-docs.zend.com/manual/php5/en/function.session-is-registered.html) (use the [`$_SESSION`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.session.html) superglobal instead)
- [set_socket_blocking()](https://php-legacy-docs.zend.com/manual/php5/en/function.set-socket-blocking.html) (use [stream_set_blocking()](https://php-legacy-docs.zend.com/manual/php5/en/function.stream-set-blocking.html) instead)
- [split()](https://php-legacy-docs.zend.com/manual/php5/en/function.split.html) (use [preg_split()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-split.html) instead)
- [spliti()](https://php-legacy-docs.zend.com/manual/php5/en/function.spliti.html) (use [preg_split()](https://php-legacy-docs.zend.com/manual/php5/en/function.preg-split.html) with the `'i'` modifier instead)
- [sql_regcase()](https://php-legacy-docs.zend.com/manual/php5/en/function.sql-regcase.html)
- [mysql_db_query()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysql-db-query.html) (use [mysql_select_db()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysql-select-db.html) and [mysql_query()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysql-query.html) instead)
- [mysql_escape_string()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysql-escape-string.html) (use [mysql_real_escape_string()](https://php-legacy-docs.zend.com/manual/php5/en/function.mysql-real-escape-string.html) instead)
- Passing locale category names as strings is now deprecated. Use the LC\_\* family of constants instead.
- The `is_dst` parameter to [mktime()](https://php-legacy-docs.zend.com/manual/php5/en/function.mktime.html). Use the new timezone handling functions instead.

Deprecated features:

- Assigning the return value of [new](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.basic.html#language.oop5.basic.new) by reference is now deprecated.
- Call-time pass-by-reference is now deprecated.
