<?php

use Symfony\Component\PropertyAccess\PropertyAccessor;

require_once __DIR__.'/vendor/autoload.php';

$accessor = new PropertyAccessor();

final class Foo
{
    public readonly bool $readonly;
    public private(set) bool $public_private_set;
    public protected(set) bool $public_protected_set;
    public bool $virtual_no_set_hook { get => true; }
}

$object = new Foo();

foreach (new ReflectionClass(Foo::class)->getProperties() as $property) {
    $writable = $accessor->isWritable($object, $property->name);

    if (!$writable) {
        var_dump([
            'property' => $property->name,
            'PropertyAccessor::isWritable()' => false,
        ]);

        continue;
    }

    try {
        $accessor->setValue($object, $property->name, false);

        var_dump([
            'property' => $property->name,
            'PropertyAccessor::isWritable()' => true,
            'PropertyAccessor::setValue()' => 'OK!',
        ]);
    } catch (Throwable $exception) {
        var_dump([
            'property' => $property->name,
            'PropertyAccessor::isWritable()' => true,
            'PropertyAccessor::setValue()' => 'Fail! '.$exception->getMessage(),
        ]);
    }
}
