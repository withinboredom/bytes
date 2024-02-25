<?php

use Withinboredom\Bytes\Megabytes;

use function Withinboredom\Bytes\Bytes;
use function Withinboredom\Bytes\Megabytes;

it('can be compared', function () {
    $bytes = Bytes(12);
    $megabytes = Megabytes(1);
    expect($megabytes > Megabytes::from($bytes))->toBeTrue();
});
