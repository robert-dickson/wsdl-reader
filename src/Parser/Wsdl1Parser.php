<?php
declare(strict_types=1);

namespace Soap\WsdlReader\Parser;

use Soap\WsdlReader\Model\Wsdl1;
use Soap\WsdlReader\Parser\Definitions\BindingParser;
use Soap\WsdlReader\Parser\Definitions\MessageParser;
use Soap\WsdlReader\Parser\Definitions\NamespacesParser;
use Soap\WsdlReader\Parser\Definitions\PortTypeParser;
use Soap\WsdlReader\Parser\Definitions\SchemaParser;
use Soap\WsdlReader\Parser\Definitions\ServiceParser;
use VeeWee\Xml\Dom\Document;

final class Wsdl1Parser
{
    public function __invoke(Document $wsdl): Wsdl1
    {
        return new Wsdl1(
            bindings: BindingParser::tryParse($wsdl),
            messages: MessageParser::tryParse($wsdl),
            portTypes: PortTypeParser::tryParse($wsdl),
            services: ServiceParser::tryParse($wsdl),
            schema: SchemaParser::tryParse($wsdl),
            namespaces: NamespacesParser::tryParse($wsdl),
        );
    }
}
