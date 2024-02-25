<?php

namespace Withinboredom\Bytes;

function Bytes(float|int $value): Bytes
{
    return Bytes::fromBinaryValue($value);
}

function Kilobytes(float|int $value): Kilobytes
{
    return Kilobytes::fromBinaryValue($value);
}

function Megabytes(float|int $value): Megabytes
{
    return Megabytes::fromBinaryValue($value);
}

function Gigabytes(float|int $value): Gigabytes
{
    return Gigabytes::fromBinaryValue($value);
}

function Terrabytes(float|int $value): Terrabytes
{
    return Terrabytes::fromBinaryValue($value);
}

function Petabytes(float|int $value): Petabytes
{
    return Petabytes::fromBinaryValue($value);
}
