<?php

use Withinboredom\Bytes\Bytes;
use Withinboredom\Bytes\Gigabytes;
use Withinboredom\Bytes\Kilobytes;
use Withinboredom\Bytes\Megabytes;
use Withinboredom\Bytes\Petabytes;
use Withinboredom\Bytes\Terrabytes;

it('Converts binary values', function ($from, $expected) {
    $bytes = $expected;

    $byte = Bytes::fromBinaryValue($bytes);

    $converted = $from::from($byte);
    expect($converted)->toBeInstanceOf($from);

    /** @var Bytes $start */
    $start = $from::fromBinaryValue(1);
    expect($start)->toBeInstanceOf($from)
        ->and((float) $start->getBinaryValue())->toBe(1.0)
        ->and($start)->toBe($converted);
})->with([
    [Bytes::class, 1],
    [Kilobytes::class, 2 ** 10],
    [Megabytes::class, 2 ** 20],
    [Gigabytes::class, 2 ** 30],
    [Petabytes::class, 2 **  50],
    [Terrabytes::class, 2 ** 40],
]);

it('Converts si values', function ($from, $expected) {
    $bytes = $expected;

    $byte = Bytes::fromSiValue($bytes);

    $converted = $from::from($byte);
    expect($converted)->toBeInstanceOf($from);

    /** @var Bytes $start */
    $start = $from::fromSiValue(1);
    expect($start)->toBeInstanceOf($from)
        ->and((float) $start->getSiValue())->toBe(1.0)
        ->and($start)->toBe($converted);
})->with([
    [Bytes::class, 1],
    [Kilobytes::class, 1000 ** 1],
    [Megabytes::class, 1000 ** 2],
    [Gigabytes::class, 1000 ** 3],
    [Petabytes::class, 1000 ** 5],
    [Terrabytes::class, 1000 ** 4],
]);
