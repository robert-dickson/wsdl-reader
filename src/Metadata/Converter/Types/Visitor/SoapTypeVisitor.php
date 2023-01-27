<?php
declare(strict_types=1);

namespace Soap\WsdlReader\Metadata\Converter\Types\Visitor;

use GoetasWebservices\XML\XSDReader\Schema\Type\Type;
use Soap\Engine\Metadata\Collection\PropertyCollection;
use Soap\Engine\Metadata\Model\Type as SoapType;
use Soap\Engine\Metadata\Model\XsdType;
use Soap\WsdlReader\Metadata\Converter\Types\TypesConverterContext;

final class SoapTypeVisitor
{
    public function __invoke(Type $type, TypesConverterContext $context): SoapType
    {
        $restrictions = $type->getRestriction();
        $parent = $type->getParent();
        $extension = $type->getExtension();
        $base = $restrictions?->getBase() ?: $extension?->getBase();

        return new SoapType(
            (new XsdType($type->getName()))
                ->withMeta([
                    'abstract' => $type->isAbstract(),
                    'restrictions' => $restrictions ? $restrictions->getChecks() : [],
                    'parent' => $parent && method_exists($parent, 'getChecks') ? $parent->getChecks() : [],
                    'extends' => $base?->getName() ?? '',
                ])
                ->withBaseType($base?->getName() ?? '')
                ->withXmlNamespaceName('TODO') // TODO
                ->withXmlNamespace($type->getSchema()->getTargetNamespace()),
            new PropertyCollection(...(new PropertiesVisitor())($type, $context))
        );
    }
}
