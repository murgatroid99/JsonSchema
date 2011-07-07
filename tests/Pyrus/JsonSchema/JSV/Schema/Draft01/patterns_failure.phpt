--TEST--
JsonSchema: basic types, schema validation, failure test
--FILE--
<?php
require dirname(__FILE__) . '/setup.php.inc';
$test->assertSchemaValidateFail(array('String does not match pattern [schema path: #]'),
                                $env->validate('', array('pattern' => '^ $')), "space");
$test->assertSchemaValidateFail(array('String does not match pattern [schema path: #]'),
                                $env->validate('today', array('pattern' => 'dam')), "dam");
$test->assertSchemaValidateFail(array('Schema has invalid pattern "aa(a" [schema path: #]'),
                                $env->validate('aaaaa', array('pattern' => 'aa(a')), "space");
?>
===DONE===
--EXPECT--
===DONE===