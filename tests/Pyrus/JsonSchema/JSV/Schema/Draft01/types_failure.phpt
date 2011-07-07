--TEST--
JsonSchema: basic types, schema validation, failure test
--FILE--
<?php
require dirname(__FILE__) . '/setup.php.inc';
$test->assertSchemaValidateFail(array('Instance is not a required type: object'), $env->validate(array(1), array('type' => 'object')), "Object");
$test->assertSchemaValidateFail(array('Instance is not a required type: array'), $env->validate(new \stdClass, array('type' => 'array')), "Array with object");
$test->assertSchemaValidateFail(array('Instance is not a required type: array'), $env->validate(array('oops' => 1), array('type' => 'array')), "Array");
$test->assertSchemaValidateFail(array('Instance is not a required type: string'), $env->validate(1, array('type' => 'string')), "String");
$test->assertSchemaValidateFail(array('Instance is not a required type: number'), $env->validate('5', array('type' => 'number')), "Number");
$test->assertSchemaValidateFail(array('Instance is not a required type: boolean'), $env->validate(0, array('type' => 'boolean')), "Boolean");
$test->assertSchemaValidateFail(array('Instance is not a required type: null'), $env->validate('f', array('type' => 'null', 'optional' => true)), "Null");

$test->assertSchemaValidateFail(array('Instance is not a required type: null, boolean, number, integer, string, array'),
                                $env->validate(new \stdClass, array('type' => array('null', 'boolean', 'number', 'integer', 'string', 'array'))),
                                "Union");
$test->assertSchemaValidateFail(array('Instance is not a required type: [schema: {"type":"string"}], [schema: {"type":"object"}]'),
                                $env->validate(array(1), array('type' => array(array('type' => 'string'), array('type' => 'object' )))),
                                "Schema Union");
?>
===DONE===
--EXPECT--
===DONE===