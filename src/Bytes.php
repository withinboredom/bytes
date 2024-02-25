<?php

namespace Withinboredom\Bytes;

readonly class Bytes
{
    protected function __construct(public int $bytes) {}

    public static function from(Bytes $size): static
    {
        return static::create($size->bytes);
    }

    public static function fromBinaryValue(int|float $value): static
    {
        return static::create($value);
    }

    public static function fromSiValue(int|float $value): static
    {
        return static::create($value);
    }

    protected static function create(int $value): static
    {
        static $map = [];

        $key = number_format($value, 0, '', '');

        $realValue = ($map[static::class][$key] ?? null)?->get() ?? new static($value);
        $map[static::class][$key] = \WeakReference::create($realValue);

        return $realValue;
    }

    public function getBinaryValue(): float|int
    {
        return $this->bytes;
    }

    public function getSiValue(): float|int
    {
        return $this->bytes;
    }
}
