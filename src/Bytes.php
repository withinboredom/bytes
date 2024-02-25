<?php

namespace Withinboredom\Bytes;

readonly class Bytes implements DataUnit
{
    protected function __construct(protected int $bytes, private \Closure $deathCallback) {}

    public function __destruct()
    {
        ($this->deathCallback)($this);
    }

    public static function from(DataUnit $size): static
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

    protected static function create(int|self $value): static
    {
        static $map = [];

        if($value instanceof self) {
            $key = number_format($value->bytes, 0, '', '');
            $realValue = ($map[$value::class][$key] ?? null)?->get();
            if($realValue !== null) {
                trigger_error('A value was unserialized that will not have the appropriate identity. If you are seeing this message, please use a custom serialization/deserialization logic if you rely on identity of DataUnit.', E_USER_WARNING);
                $value->deathCallback = static fn() => null;
                return $value;
            }
            $map[$value::class][$key] = \WeakReference::create($value);
            $value->deathCallback = static function ($value) use (&$map, $key) {
                unset($map[$value::class][$key]);

                if(empty($map[$value::class])) {
                    unset($map[$value::class]);
                }
            };

            return $value;
        }

        $key = number_format($value, 0, '', '');

        $realValue = ($map[static::class][$key] ?? null)?->get() ?? new static($value, static function ($value) use (&$map, $key) {
            unset($map[$value::class][$key]);

            if(empty($map[$value::class])) {
                unset($map[$value::class]);
            }
        });
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

    #[\Override] public function compareto(DataUnit $other): int
    {
        return $this->bytes <=> $other->bytes;
    }

    #[\Override] public function add(DataUnit $other): DataUnit
    {
        return static::create($this->bytes + $other->bytes);
    }

    #[\Override] public function subtract(DataUnit $other): DataUnit
    {
        return static::create($this->bytes - $other->bytes);
    }

    #[\Override] public function multiply(float|DataUnit|int $value): DataUnit
    {
        return match($value instanceof DataUnit) {
            true => static::create($this->bytes * $value->bytes),
            false => static::create($this->bytes * $value),
        };
    }

    #[\Override] public function divide(float|DataUnit|int $value): DataUnit
    {
        return match($value instanceof DataUnit) {
            true => static::create($this->bytes / $value->bytes),
            false => static::create($this->bytes / $value),
        };
    }

    #[\Override] public function bytes(): Bytes
    {
        return self::from($this);
    }

    #[\Override] public function kilobytes(): Kilobytes
    {
        return Kilobytes::from($this);
    }

    #[\Override] public function megabytes(): Megabytes
    {
        return Megabytes::from($this);
    }

    #[\Override] public function gigabytes(): Gigabytes
    {
        return Gigabytes::from($this);
    }

    #[\Override] public function terrabytes(): Terrabytes
    {
        return Terrabytes::from($this);
    }

    #[\Override] public function petabytes(): Petabytes
    {
        return Petabytes::from($this);
    }

    #[\Override] public static function compare(DataUnit $left, DataUnit $right): int
    {
        return $left->compareto($right);
    }

    public function __clone(): void
    {
        throw new \LogicException('Cloning a pointless endeavor since these are value objects');
    }

    public function __serialize(): array
    {
        return ['bytes' => $this->bytes];
    }

    public function __unserialize(array $data): void
    {
        $this->bytes = $data['bytes'];
        static::create($this);
    }
}
