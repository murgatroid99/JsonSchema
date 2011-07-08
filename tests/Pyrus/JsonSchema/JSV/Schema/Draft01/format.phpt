--TEST--
JsonSchema: format, schema validation
--FILE--
<?php
require dirname(__FILE__) . '/setup.php.inc';

$env->createSchema(array('enum' => array('Jan', 'Feb', 'Mar', 'Apr', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov',
                                         'Dec')), null, 'http://example.com/months#');

$test->assertSchemaValidate($env->validate('Jan', array('format' => 'http://example.com/months#')), "Jan");
?>
===DONE===
--EXPECT--
===DONE===