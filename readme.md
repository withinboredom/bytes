# Bytes

This library allows you to create define data units in a nearly native way, compare them, and convert between them.

Use this:

```
composer require withinboredom/bytes
```

## This library is unusual!

The following code is 100% valid:

```php
$kb = \Withinboredom\Bytes\Kilobytes(128)->multiply(1000);
$mb = \Withinboredom\Bytes\Megabytes(125);
$tb = \Withinboredom\Bytes\Terrabytes(1);

$arr = [$kb, $mb, $tb];
// sort the array
usort($arr, \Withinboredom\Bytes\Bytes::compare(...));

// values with the same units are always triple-equal to each other
assert($kb->megabytes() === $mb);

// values with the same units are always natively comparable
assert($mb < $tb->megabytes());

// you can always expect a certain unit
function test(\Withinboredom\Bytes\Megabytes $megabytes): void;

// or convert them to your expected unit in your body
function test(\Withinboredom\Bytes\DataUnit $size): void;

// get base-2 sized values
echo $kb->getBinaryValue();

// or si-units
echo $kb->getSiValue();
```
