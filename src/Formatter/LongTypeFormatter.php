<?php
declare(strict_types=1);

namespace Soap\WsdlReader\Formatter;

use Soap\Engine\Metadata\Model\Property;
use Soap\Engine\Metadata\Model\Type;
use function Psl\Str\format;

class LongTypeFormatter
{
    /**
     * TODO: level
     */
    public function __invoke(Type $type, int $level = 1): string
    {
        $hasProps = (bool) $type->getProperties()->count();
        $declaration = [
            $type->getXsdType()->getXmlNamespace() . ':'.$type->getName(),
            $type->getXsdType()->getBaseType() ? ' extends '.$type->getXsdType()->getBaseType() : '', // TODO : FQN Base type?
            $hasProps ? ' {' : '',
        ];

        $parts = [
            join('', $declaration),
            ...$type->getProperties()->map(
                static fn (Property $property): string => format(
                    '    %s $%s',
                    (new XsdTypeFormatter())($property->getType()),
                    $property->getName()
                )
            ),
            $hasProps ? '  }' : '',
        ];

        return join(PHP_EOL, $parts);
    }
}
