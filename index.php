<?php

use Symfony\Component\PropertyAccess\PropertyAccessor;

require_once __DIR__.'/vendor/autoload.php';

final class User
{
    public function __construct(
        public private(set) string $name = 'Bob',
   ) {}
}

$accessor = new PropertyAccessor();
$user = (new ReflectionClass(User::class))->newInstanceWithoutConstructor();

// bool(true)
var_dump($accessor->isWritable($user, 'name'));

// Uncaught Error: Cannot modify private(set) property User::$name from scope Symfony\Component\PropertyAccess\PropertyAccessor
$accessor->setValue($user, 'name', 'Jack');
