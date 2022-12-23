--TEST--
SOAP XML Schema 80: Element form qualified/unqualified (elementFormDefault - default)
--FILE--
<?php
include __DIR__."/test_schema.inc";
$schema = <<<EOF
    <complexType name="testType">
        <sequence>
            <element name="int1" type="int"/>
            <element name="int2" type="int" form="qualified"/>
            <element name="int3" type="int" form="unqualified"/>
        </sequence>
    </complexType>
EOF;

test_schema($schema,'type="tns:testType"', "rpc", "literal");
?>
--EXPECTF--
Methods:
  > test(testType $testParam): void

Types:
  > http://test-uri/:testType
