# [Checking for E_STRICT in PHP 5.1](index.md)

# [PHP 5.1](https://php-legacy-docs.zend.com/manual/php5/en/migration51.errorcheck.php)

## Checking for **`E_STRICT`**

If you only have a single script to check, you can pick up **`E_STRICT`** errors using PHP's commandline lint facility:

``` shellcode
php -d error_reporting=4095 -l script_to_check.php
```

For larger projects, the shell script below will achieve the same task:

``` shellcode
#!/bin/sh

directory=$1

shift

# These extensions are checked
extensions="php inc"

check_file ()
{
  echo -ne "Doing PHP syntax check on $1 ..."

  # Options:
  ERRORS=`/www/php/bin/php -d display_errors=1 -d html_errors=0 -d error_prepend_string=" " -d error_append_string=" " -d error_reporting=4095 -l $1 | grep -v "No syntax errors detected"`

  if test -z "$ERRORS"; then
    echo -ne "OK."
  else
    echo -e "Errors found!\n$ERRORS"
  fi

  echo
}

# loop over remaining file args
for FILE in "$@" ; do
  for ext in $extensions; do
     if echo $FILE | grep "\.$ext$" > /dev/null; then
       if test -f $FILE; then
         check_file "$FILE"
       fi
     fi
  done
done
```
