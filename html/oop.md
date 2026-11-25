# [Class and object changes in PHP 5.1, 5.0](index.md)

# [PHP 5.1](https://php-legacy-docs.zend.com/manual/php5/en/migration51.oop.php)

## Class and object changes

- [`instanceof`, `is_a()`, `is_subclass_of()` and `catch`](https://php-legacy-docs.zend.com/manual/php5/en/migration51.oop.html#migration51.oop-functions)

- [Abstract private methods](https://php-legacy-docs.zend.com/manual/php5/en/migration51.oop.html#migration51.oop-methods)

- [Access modifiers in interfaces](https://php-legacy-docs.zend.com/manual/php5/en/migration51.oop.html#migration51.oop-modifiers)

- [Changes in inheritance rules](https://php-legacy-docs.zend.com/manual/php5/en/migration51.oop.html#migration51.oop-inheritance)

- [Class constants](https://php-legacy-docs.zend.com/manual/php5/en/migration51.oop.html#migration51.oop-constants)

## `instanceof`, `is_a()`, `is_subclass_of()` and `catch`

In PHP 5.0, `is_a()` was deprecated and replaced by the `instanceof` operator. There were some issues with the initial implementation of `instanceof`, which relied on `__autoload()` to search for missing classes. If the class was not present, `instanceof` would throw a fatal **`E_ERROR`** due to the failure of `__autoload()` to discover that class. The same behaviour occurred in the `catch` operator and the `is_subclass_of()` function, for the same reason.

None of these functions or operators call `__autoload()` in PHP 5.1.x, and the `class_exists()` workarounds used in code written for PHP 5.0.x, while not problematic in any way, are no longer necessary.

## Abstract private methods

Abstract private methods were supported between PHP 5.0.0 and PHP 5.0.4, but were then disallowed on the grounds that the behaviours of `private` and `abstract` are mutually exclusive.

## Access modifiers in interfaces

Under PHP 5.0, function declarations in interfaces were treated in exactly the same way as function declarations in classes. This has not been the case since October 2004, at which point only the `public` access modifier was allowed in interface function declarations. Since April 2005 - which pre-dates the PHP 5.0b1 release - the `static` modifier has also been allowed. However, the `protected` and `private` modifiers will now throw an **`E_ERROR`**, as will `abstract`. Note that this change should not affect your existing code, as none of these modifiers makes sense in the context of interfaces anyway.

## Changes in inheritance rules

Under PHP 5.0, it was possible to have a function declaration in a derived class that did not match the declaration of the same function in the base class, e.g.

This code will cause an **`E_STRICT`** error to be emitted under PHP 5.1.x.

    <?php
    class Base {
        function &return_by_ref() {
            $r = 1;
            return $r;
        }
    }

    class Derived extends Base {
        function return_by_ref() {
            return 1;
        }
    }
    ?>

## Class constants

Under PHP 5.0.x, the following code was valid:

Under PHP 5.1.x, redefinition of a class constant will throw a fatal **`E_ERROR`**.

    <?php
    class test {
        const foobar = 'foo';
        const foobar = 'bar';
    }

    ?>

# [PHP 5.0](https://php-legacy-docs.zend.com/manual/php5/en/migration5.oop.php)

## New Object Model

In PHP 5 there is a new Object Model. PHP's handling of objects has been completely rewritten, allowing for better performance and more features. In previous versions of PHP, objects were handled like primitive types (for instance integers and strings). The drawback of this method was that semantically the whole object was copied when a variable was assigned, or passed as a parameter to a method. In the new approach, objects are referenced by handle, and not by value (one can think of a handle as an object's identifier).

Many PHP programmers aren't even aware of the copying quirks of the old object model and, therefore, the majority of PHP applications will work out of the box, or with very few modifications.

The new Object Model is documented at the [Language Reference](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.html).

In PHP 5, function with the name of a class is called as a constructor only if defined in the same class. In PHP 4, it is called also if defined in the parent class.

See also the [zend.ze1_compatibility_mode](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend.ze1-compatibility-mode) directive for compatibility with PHP 4.
