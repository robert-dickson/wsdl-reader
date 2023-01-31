<?php
declare(strict_types=1);

namespace Soap\WsdlReader\Formatter;

use Soap\Engine\Metadata\Model\XsdType;

final class EnumFormatter
{
    public function __invoke(XsdType $type): string
    {
        $meta = $type->getMeta();
        $enums = (array) ($meta['enums'] ?? []);
        if (!$enums) {
            return '';
        }

        return ' in ('.join('|', $enums).')';
    }
}
