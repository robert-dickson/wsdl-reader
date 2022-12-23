--TEST--
SOAP XML Schema 42: Extension of simple type
--FILE--
<?php
include __DIR__."/test_schema.inc";
$schema = <<<EOF
    <complexType name="testType">
        <simpleContent>
            <extension base="int">
                <attribute name="int" type="int"/>
            </extension>
        </simpleContent>
    </complexType>
EOF;
test_schema($schema,'type="tns:testType"');
?>
--EXPECTF--
Methods:
  > test(testType $testParam): void

Types:
  > http://test-uri/:testType
