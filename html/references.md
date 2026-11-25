# [Changes in reference handling in PHP 5.1](index.md)

# [PHP 5.1](https://php-legacy-docs.zend.com/manual/php5/en/migration51.references.php)

## Changes in reference handling

- [Overview](https://php-legacy-docs.zend.com/manual/php5/en/migration51.references.html#migration51.references-overview)

- [Code that worked under PHP 4.3.x, but now fails](https://php-legacy-docs.zend.com/manual/php5/en/migration51.references.html#migration51.references-fails)

- [Code that worked under PHP 4.3.x, but now throws an error](https://php-legacy-docs.zend.com/manual/php5/en/migration51.references.html#migration51.references-error)

- [Code that failed under PHP 4.3.x, but now works](https://php-legacy-docs.zend.com/manual/php5/en/migration51.references.html#migration51.references-works)

- [Code that should have worked under PHP 5.0.x](https://php-legacy-docs.zend.com/manual/php5/en/migration51.references.html#migration51.references-didnotwork)

- [Warnings that came and went](https://php-legacy-docs.zend.com/manual/php5/en/migration51.references.html#migration51.references-warnings)

## Overview

From the PHP script writer's point of view, the change most likely to impact legacy code is in the way that references are handled in all PHP versions post-dating the PHP 4.4.0 release.

Until and including PHP 4.3, it was possible to send, assign or return variables by reference that should really be returned by value, such as a constant, a temporary value (e.g. the result of an expression), or the result of a function that had itself been returned by value, as here:

    <?php
    $foo = "123";

    function return_value() {
        global $foo;
        return $foo;
    }

    $bar = &return_value();
    ?>

Although this code would usually work as expected under PHP 4.3, in the general case the result is undefined. The Zend Engine could not act correctly on these values as references. This bug could and did lead to various hard-to-reproduce memory corruption problems, particularly where the code base was large.

In PHP 4.4.0, PHP 5.0.4 and all subsequent PHP releases, the Engine was fixed to 'know' when the reference operation is being used on a value that should not be referenced. The actual value is now used in such cases, and a warning is emitted. The warning takes the form of an **`E_NOTICE`** in PHP 4.4.0 and up, and **`E_STRICT`** in PHP 5.0.4 and up.

Code that could potentially produce memory corruption can no longer do so. However, some legacy code might work differently as a result.

## Code that worked under PHP 4.3, but now fails

    <?php
    function func(&$arraykey) {
        return $arraykey; // function returns by value!
    }

    $array = array('a', 'b', 'c');
    foreach (array_keys($array) as $key) {
        $y = &func($array[$key]);
        $z[] =& $y;
    }

    var_dump($z);
    ?>
    <

Running the above script under any version of PHP that pre-dates the reference fix would produce this output:

    array(3) {
      [0]=>
      &string(1) "a"
      [1]=>
      &string(1) "b"
      [2]=>
      &string(1) "c"
    }

Following the reference fix, the same code would result in:

    array(3) {
      [0]=>
      &string(1) "c"
      [1]=>
      &string(1) "c"
      [2]=>
      &string(1) "c"
    }

This is because, following the changes, `func()` assigns by value. The value of `$y` is re-assigned, and reference-binding is preserved from `$z`. Prior to the fix, the value was assigned by reference, leading `$y` to be re-bound on each assignment. The attempt to bind to a temporary value by reference was the cause of the memory corruption.

Such code can be made to work identically in both the pre-fix and the post-fix PHP versions. The signature of `func()` can be altered to return by reference, or the reference assignment can be removed from the result of `func()`.

    <?php
    function func() {
        return 'function return';
    }

    $x = 'original value';
    $y =& $x;
    $y = &func();
    echo $x;
    ?>

In PHP 4.3 `$x` would be 'original value', whereas after the changes it would be 'function return' - remember that where the function does not return by reference, the reference assignment is converted to a regular assignment. Again, this can be brought to a common base, either by forcing `func()` to return by reference or by eliminating the by-reference assignment.

## Code that worked under PHP 4.3.x, but now throws an error

    <?php
    class Foo {

        function getThis() {
            return $this;
        }

        function destroyThis() {
            $baz =& $this->getThis();
        }
    }

    $bar = new Foo();
    $bar->destroyThis();
    var_dump($bar);
    ?>

In PHP 5.0.3, `$bar` evaluated to **`NULL`** instead of returning an object. That happened because `getThis()` returns by value, but the value here is assigned by reference. Although it now works in the expected way, this is actually invalid code which will throw an **`E_NOTICE`** under PHP 4.4 or an **`E_STRICT`** under PHP 5.0.4 and up.

## Code that failed under PHP 4.3.x, but now works

    <?php
    function &f() {
        $x = "foo";
        var_dump($x);
        print "$x\n";
        return($a);
    }

    for ($i = 0; $i < 3; $i++) {
        $h = &f();
    }
    ?>

In PHP 4.3 the third call to [var_dump()](https://php-legacy-docs.zend.com/manual/php5/en/function.var-dump.html) produces **`NULL`**, due to the memory corruption caused by returning an uninitialized value by reference. This is valid code in PHP 5.0.4 and up, but threw errors in earlier releases of PHP.

    <?php
    $arr = array('a1' => array('alfa' => 'ok'));
    $arr =& $arr['a1'];
    echo '-'.$arr['alfa']."-\n";
    ?>

Until PHP 5.0.5, it wasn't possible to assign an array element by reference in this way. It now is.

## Code that `should have worked` under PHP 5.0.x

There are a couple of instances of bugs reported under PHP 5.0 prior to the reference fixes which now 'work'. However, in both cases errors are thrown by PHP 5.1.x, because the code was invalid in the first place. Returning values by reference using `self::` now works in the general case but throws an **`E_STRICT`** warning, and although your mileage may vary when assigning by reference to an overloaded object, you will still see an **`E_ERROR`** when you try it, even where the assignment itself appears to work.

## Warnings that came and went

Nested calls to functions returning by reference are valid code under both PHP 4.3.x and PHP 5.1.x, but threw an unwarranted **`E_NOTICE`** or **`E_STRICT`** under the intervening PHP releases.

    <?php
    function & foo() {
        $var = 'ok';
        return $var;
    }

    function & bar() {
        return foo();
    }

    $a =& bar();
    echo "$a\n";
    ?>
