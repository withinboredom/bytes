<?php

namespace Withinboredom\Bytes;

interface DataUnit
{
    public static function from(Bytes $size): static;

    public static function fromBinaryValue(int|float $value): static;

    public static function fromSiValue(int|float $value): static;

    public function getBinaryValue(): float|int;

    public function getSiValue(): float|int;
}
