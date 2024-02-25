<?php

use function Withinboredom\Bytes\Kilobytes;
use function Withinboredom\Bytes\Megabytes;

it('can do math!', function () {
    $bytes = Kilobytes(128)->multiply(1000);
    $expected = Megabytes(125);
    expect($bytes)->toBe($expected->kilobytes());
});
