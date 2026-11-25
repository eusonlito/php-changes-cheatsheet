# [New Error Messages in PHP 5.2](index.md)

# [PHP 5.2](https://php-legacy-docs.zend.com/manual/php5/en/migration52.error-messages.php)

## New Error Messages

Below are the new error messages that have not been discussed elsewhere in this document.

**Example \#1 In PHP Core**

    <?php
    echo " ";
    session_regenerate_id();
    /*  Warning:  session_regenerate_id(): Cannot regenerate
        session id - headers already sent in filename on line n */

    str_word_count("string", 4);
    /* Warning:  str_word_count(): Invalid format value 4
       in filename on line n */

    strripos("foo", "f", 4);
    /* Notice:  strripos(): Offset is greater than the
       length of haystack string in filename on line n */

    strrpos("foo", "f", 4);
    /* Notice:  strrpos(): Offset is greater than the
       length of haystack string in filename on line n */

    /* As of PHP 5.2.1, when allow_url_include is OFF (default) */
    include "php://input";
    /* Warning:  include(): URL file-access is disabled
       in the server configuration in filename on line n */
    ?>

**Example \#2 [Object Oriented Code](https://php-legacy-docs.zend.com/manual/php5/en/language.oop5.html) in PHP Core**

    <?php
    interface foo {
    }
    class bar implements foo, foo {
    }
    /* Fatal error: Class bar cannot implement previously
       implemented interface foo in filename on line n */


    class foo {
        public $bar;
        function __get($var)
        {
            return $this->bar;
        }
    }

    $foo = new foo;
    $bar =& $foo->prop;
    /* Notice: Indirect modification of overloaded property
       foo::$prop has no effect in filename on line n */


    class foo implements iterator {
        public function current() {
        }
        public function next() {
        }
        public function key() {
        }
        public function valid() {
        }
        public function rewind() {
        }
    }

    $foo = new foo();
    foreach($foo as &$ref) {}
    /* Fatal error: An iterator cannot be used with foreach
       by reference in filename on line n */


    class foo {
        private function __construct() {
        }
    }
    class bar extends foo {
        public function __construct() {
            parent::__construct();
            /* Fatal error:  Cannot call private
               foo::__construct() in filename on line n */
        }
    }
    new bar;


    stream_filter_register("", "class");
    /* Warning:  stream_filter_register(): Filter name
       cannot be empty in filename on line n */


    stream_filter_register("filter", "");
    /* Warning:  stream_filter_register(): Class name
       cannot be empty in filename on line n */
    ?>

**Example \#3 In the [bzip2](https://php-legacy-docs.zend.com/manual/php5/en/ref.bzip2.html) Extension**

    <?php
    bzopen("", "w");
    /* Warning:  bzopen(): filename cannot be empty
       in filename on line n */

    bzopen("foo", "a");
    /* Warning:  bzopen(): 'a' is not a valid mode for
       bzopen(). Only 'w' and 'r' are supported in
       filename on line n */

    $fp = fopen("foo", "w");
    bzopen($fp, "r");
    /* Warning:  bzopen(): cannot read from a stream
       opened in write only mode in filename on line n */
    ?>

**Example \#4 In the [datetime](https://php-legacy-docs.zend.com/manual/php5/en/ref.datetime.html) Extension**

    <?php
    strtotime("today", "now");
    /* Warning:  strtotime() expects parameter 2 to be
       long, string given in filename on line n */

    /* As of PHP 5.2.1 */
    new DateTime(new stdclass);
    /* Fatal error: Uncaught exception 'Exception' with
       message 'DateTime::__construct() expects parameter
       1 to be string, object given' in filename:n */
    ?>

**Example \#5 In the [dBase](https://php-legacy-docs.zend.com/manual/php5/en/ref.dbase.html) Extension**

    <?php
    dbase_open("foo", -1);
    /* Warning: Invalid access mode -1 in filename on line n */

    /* As of PHP 5.2.1 */
    dbase_open("foo", null);
    /* Warning: The filename cannot be empty in filename on line n */
    ?>

**Example \#6 In the [mcrypt](https://php-legacy-docs.zend.com/manual/php5/en/ref.mcrypt.html) Extension**

    <?php
    $key = "this is a secret key";
    $td = mcrypt_module_open('tripledes', '', 'ecb', '');
    $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td),
                            MCRYPT_RAND);
    mcrypt_generic_init($td, $key, $iv);
    $encrypted_data = mcrypt_generic($td, "");
    /* Warning: mcrypt_generic(): An empty string was
       passed in filename on line n */
    ?>

**Example \#7 In the [oci8](https://php-legacy-docs.zend.com/manual/php5/en/ref.oci8.html) Extension**

    <?php
    oci_connect("user", "pass", "db", "bogus_charset");
    /* Warning: Invalid character set name:
       bogus_charset in filename on line n */

    $oci = oci_connect("user", "pass", "db");
    oci_password_change($oci, "", "old", "new");
    /* Warning: username cannot be empty in filename
       on line n */

    oci_password_change($oci, "user", "", "new");
    /* Warning: old password cannot be empty in filename
       on line n */

    oci_password_change($oci, "user", "old", "");
    /* Warning: new password cannot be empty in filename
       on line n */
    ?>

**Example \#8 In the [SPL](https://php-legacy-docs.zend.com/manual/php5/en/ref.spl.html) Extension**

    <?php
    $obj = new SplFileObject(__FILE__);
    $obj->fgetcsv("foo");
    /* Warning:  SplFileObject::fgetcsv(): delimiter must
       be a character in filename on line n */

    $obj->fgetcsv(",", "foo");
    /* Warning:  SplFileObject::fgetcsv(): enclosure must
       be a character in filename on line n */
    ?>

**Example \#9 In the [Semaphore](https://php-legacy-docs.zend.com/manual/php5/en/ref.sem.html) (sysvmsg) extension**

    <?php
    /* Warning:  maximum size of the message has to be
       greater then zero in filename on line n */
    ?>

**Example \#10 A 5.2.1+ [Zip](https://php-legacy-docs.zend.com/manual/php5/en/ref.zip.html) Example**

    <?php
    $obj = new ZipArchive();
    $obj->open('archive.zip');
    $obj->setCommentName('', 'comment');
    /* Notice:  ZipArchive::setCommentName(): Empty string
       as entry name in filename on line n */

    /* As of PHP 5.2.1 */
    $obj->getCommentName('');
    /* Notice:  ZipArchive::getCommentName(): Empty string
       as entry name in filename on line n */
    ?>
