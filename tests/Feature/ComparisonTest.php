<?php

use function Withinboredom\Bytes\Bytes;
use function Withinboredom\Bytes\Megabytes;

it('can be compared', function () {
    $bytes = Bytes(12);
    $megabytes = Megabytes(1);
    expect($megabytes)->toBeGreaterThan($bytes);
});
