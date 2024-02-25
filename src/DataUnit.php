<?php

namespace Withinboredom\Bytes;

interface DataUnit
{
    public static function from(DataUnit $size): DataUnit;

    public static function fromBinaryValue(int|float $value): DataUnit;

    public static function fromSiValue(int|float $value): DataUnit;

    public function getBinaryValue(): float|int;

    public function getSiValue(): float|int;

    public function compare(DataUnit $other): int;

    public function add(DataUnit $other): DataUnit;

    public function subtract(DataUnit $other): DataUnit;

    public function multiply(DataUnit|int|float $value): DataUnit;

    public function divide(DataUnit|int|float $value): DataUnit;

    public function bytes(): Bytes;
    public function kilobytes(): Kilobytes;
    public function megabytes(): Megabytes;
    public function gigabytes(): Gigabytes;
    public function terrabytes(): Terrabytes;
    public function petabytes(): Petabytes;
}
