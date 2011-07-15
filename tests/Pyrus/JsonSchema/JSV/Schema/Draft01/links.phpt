--TEST--
JsonSchema: links, schema validation
--FILE--
<?php
require dirname(__FILE__) . '/setup.php.inc';

$test->assertSchemaValidate($env->validate(array('a' => array(), 'b' => array()),
                                           array(
                                            'type' => 'object',
                                            'additionalProperties' =>
                                            array('$ref' => '#')
                                                 )), 'link full');

$schema = $env->createSchema(array(
                                   "id" => "http://test.example.com/3",
                                   "properties" => array(
                                                         "test" => array("type" => "object")
                                                        ),
                                   "extends" => array('$ref' => "http://json-schema.org/hyper-schema")
                                  ), null, "http://test.example.com/3");
$test->assertSchemaValidate($env->validate(array('a' => array(), 'b' => array()),
                                           array(
                                            '$schema' => 'http://test.example.com/3',
                                            'test' => array())), 'link describedby');
?>
===DONE===
--EXPECT--
===DONE===