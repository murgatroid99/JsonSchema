--TEST--
JsonSchema: Draft 3, validate addressbook
--FILE--
<?php
require __DIR__ . '/setup.php.inc';
require __DIR__ . '/schema.setup.php.inc';

$a = function ($test_name, $schema_uri) use ($test, $env) {
    $schema = array( '$ref'=> $schema_uri );

    $test->assertSchemaValidateFail(array('Instance is not a required type: object [schema path: #]'), $env->validate('', $schema),
                                    "addressbook is object " . $test_name);
    $test->assertSchemaValidateFail(array('Property is required [schema path: #/cards]'), $env->validate(array(), $schema),
                                    "cards required " . $test_name);
    $test->assertSchemaValidateFail(array('Instance is not a required type: array [schema path: #/cards]'), $env->validate(array( "cards"=> new \stdClass), $schema),
                                    "cards must be array " . $test_name);
    $test->assertSchemaValidate($env->validate(array( "cards"=> array()), $schema), "empty array ok " . $test_name);

    $test->assertSchemaValidateFail(array('The number of items is less than the required minimum [schema path: #/cards/0]'),
                                    $env->validate(array( "cards"=> array( array())), $schema),
             "cards schema is enforced on items " . $test_name);

    $test->assertSchemaValidateFail(array('The number of items is less than the required minimum [schema path: #/cards/0]'),
                                    $env->validate(array( "cards"=> array(array('foo'))), $schema),
             "each card must have length 2 " . $test_name);

    $test->assertSchemaValidateFail(array(''), $env->validate(array( "cards"=> array(array('foo', 'bar'), array("foo" ))), $schema),
             "second card is bad " . $test_name);

    $test->assertSchemaValidate($env->validate(array( "cards"=> array(array("foo", "bar"))), $schema),
          "good addressbook with one card " . $test_name);

    $test->assertSchemaValidate($env->validate(array( "cards"=> array(array("foo", "bar"), array("bar", "foo"))), $schema),
          "good addressbook with two cards " . $test_name);
};

$a("Explicit Schema", "http://example.com/addressbook.json");
$a("Referring Schema", "http://example.com/addressbook_ref.json");
$a("Extends Schema", "http://example.com/addressbook_extends.json");
?>
===DONE===
--EXPECT--
===DONE===