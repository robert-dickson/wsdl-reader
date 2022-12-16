<?php
declare(strict_types=1);

namespace Soap\WsdlReader\Model\Definitions;

class Binding
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly SoapVersion $soapVersion,
        public readonly TransportType $transport,
        public readonly BindingOperations $operations,
    ){
    }
}