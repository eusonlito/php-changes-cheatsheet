# [Integer values in function parameters in PHP 5.1](index.md)

# [PHP 5.1](https://php-legacy-docs.zend.com/manual/php5/en/migration51.integer-parameters.php)

## Integer values in function parameters

With the advent of PHP 5.0.x, a new parameter parsing API was introduced which is used by a large number of PHP functions. In all versions of PHP between 5.0.x and 5.1.x, the handling of integer values was very strict and would reject non-well formed numeric values when a PHP function expected an integer. These checks have now been relaxed to support non-well formed numeric strings such as " 123" and "123 ", and will no longer fail as they did under PHP 5.0.x. However, to promote code safety and input validation, PHP functions will now emit an **`E_NOTICE`** when such strings are passed as integers.
