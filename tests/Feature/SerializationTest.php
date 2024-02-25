<?php

use function Withinboredom\Bytes\Kilobytes;

it('can be serialized', function () {
    $kb = Kilobytes(12);
    $string = serialize($kb);
    expect($string)->toBe('O:29:"Withinboredom\Bytes\Kilobytes":1:{s:5:"bytes";i:12288;}');
});

it('can be deserialized', function () {
    $string = 'O:29:"Withinboredom\Bytes\Kilobytes":1:{s:5:"bytes";i:16384;}';
    $kb = unserialize($string);
    expect($kb)->toBe(Kilobytes(16));
});

it('emits a warning when it should', function () {
    $expected = Kilobytes(16);
    $string = 'O:29:"Withinboredom\Bytes\Kilobytes":1:{s:5:"bytes";i:16384;}';

    $kb = unserialize($string);
    $error = error_get_last();
    expect($error['message'])->toBe(
        'A value was unserialized that will not have the appropriate identity. If you are seeing this message, please use a custom serialization/deserialization logic if you rely on identity of DataUnit.'
    )
        ->and($kb->getBinaryValue())->toBe($expected->getBinaryValue())
        ->and($kb)->not()->toBe($expected)
        ->and($kb)->toEqual($expected);
});
