<?php
declare(strict_types=1);

namespace Soap\WsdlReader\Metadata\Converter\Types\Visitor;

use GoetasWebservices\XML\XSDReader\Schema\Element\ElementDef;
use Soap\Engine\Metadata\Collection\PropertyCollection;
use Soap\Engine\Metadata\Model\Type as SoapType;
use Soap\Engine\Metadata\Model\XsdType;
use Soap\WsdlReader\Metadata\Converter\Types\TypesConverterContext;

class ElementVisitor
{
    public function __invoke(ElementDef $element, TypesConverterContext $context): SoapType
    {
        return new SoapType(
            (new XsdType($element->getName()))
                ->withMeta([
                    'docs' =>$element->getDoc(),
                    'abstract' => $element->getType() && $element->getType()->isAbstract(),
                    // TODO :
                    // 'extension' => $element->getType()->getExtension()->getBase()->getName(),
                    // 'resitriction'
                    // $element->getType()->getRestriction() && $element->getType()->getRestriction()->getChecks();
                ])
                ->withXmlNamespace($element->getSchema()->getTargetNamespace()),
            new PropertyCollection(...(new PropertiesVisitor())($element->getType(), $context))
        );
    }
}
