<?php

namespace Withinboredom\Bytes;

trait Converter
{
    public static function fromBinaryValue(int|float $value): static
    {
        return parent::fromBinaryValue($value * 1024.0);
    }

    public static function fromSiValue(int|float $value): static
    {
        return parent::fromSiValue($value * 1000.0);
    }

    public function getBinaryValue(): float|int
    {
        return parent::getBinaryValue() / 1024.0;
    }

    public function getSiValue(): float|int
    {
        return parent::getSiValue() / 1000.0;
    }
}
