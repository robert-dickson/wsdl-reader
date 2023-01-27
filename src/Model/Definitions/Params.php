<?php
declare(strict_types=1);

namespace Soap\WsdlReader\Model\Definitions;

final class Params
{
    /**
     * @var list<Param>
     */
    public readonly array $items;

    public function __construct(
        Param ... $items
    ) {
        $this->items = $items;
    }
}
