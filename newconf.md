# [New INI Configuration Directives in PHP 5.2, 5.0](index.md)

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.newconf.php)

## New INI Configuration Directives

New `php.ini` directives introduced in PHP 5.2.0:

- [allow_url_include](https://php-legacy-docs.zend.com/manual/php5/en/filesystem.configuration.html#ini.allow-url-include) This useful option makes it possible to differentiate between standard file operations on remote files, and the inclusion of remote files. While the former is usually desirable, the latter can be a security risk if used naively. Starting with PHP 5.2.0, you can allow remote file operations while disallowing the inclusion of remote files in local scripts. In fact, this is the default configuration.
- [pcre.backtrack_limit](https://php-legacy-docs.zend.com/manual/php5/en/pcre.configuration.html#ini.pcre.backtrack-limit) PCRE's backtracking limit.
- [pcre.recursion_limit](https://php-legacy-docs.zend.com/manual/php5/en/pcre.configuration.html#ini.pcre.recursion-limit) PCRE's recursion limit. Please note that if you set this value to a high number you may consume all the available process stack and eventually crash PHP (due to reaching the stack size limit imposed by the Operating System).
- [session.cookie_httponly](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.cookie-httponly) Marks the cookie as accessible only through the HTTP protocol. This means that the cookie won't be accessible by scripting languages, such as JavaScript. This setting can effectively help to reduce identity theft through XSS attacks (although it is not supported by all browsers).

New directives in PHP 5.2.2:

- [max_input_nesting_level](https://php-legacy-docs.zend.com/manual/php5/en/info.configuration.html#ini.max-input-nesting-level) Limits how deep [input variables](https://php-legacy-docs.zend.com/manual/php5/en/language.variables.external.html) can be nested, default is 64.

# [PHP 5.0](https://php-legacy-docs.zend.com/manual/php5/en/migration5.newconf.php)

## New Directives

There were some new `php.ini` directives introduced in PHP 5. Here is a list of them:

- [mail.force_extra_parameters](https://php-legacy-docs.zend.com/manual/php5/en/mail.configuration.html#ini.mail.force_extra_parameters) - Force the addition of the specified parameters to be passed as extra parameters to the sendmail binary. These parameters will always replace the value of the 5th parameter to [mail()](https://php-legacy-docs.zend.com/manual/php5/en/function.mail.html), even in safe mode
- [register_long_arrays](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.register-long-arrays) - allow/disallow PHP to register the deprecated long `$HTTP_*_VARS`
- [session.hash_function](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.hash-function) - select a hash function (MD5 or SHA-1)
- [session.hash_bits_per_character](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.hash-bits-per-character) - define how many bits are stored in each character when converting the binary hash data to something readable (from 4 to 6)
- [zend.ze1_compatibility_mode](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend.ze1-compatibility-mode) - Enable compatibility mode with Zend Engine 1 (PHP 4)
