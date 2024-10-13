# Symfony Property Access is incompatible with PHP 8.4

Run:

```shell
composer install
php index.php
```

See output:

```txt
array(2) {
  ["property"] => string(8) "readonly"
  ["PropertyAccessor::isWritable()"] => bool(false)
}
array(3) {
  ["property"] => string(18) "public_private_set"
  ["PropertyAccessor::isWritable()"] => bool(true)
  ["PropertyAccessor::setValue()"] => string(127) "Fail! Cannot modify private(set) property Foo::$public_private_set from scope Symfony\Component\PropertyAccess\PropertyAccessor"
}
array(3) {
  ["property"] => string(20) "public_protected_set"
  ["PropertyAccessor::isWritable()"] => bool(true)
  ["PropertyAccessor::setValue()"] => string(131) "Fail! Cannot modify protected(set) property Foo::$public_protected_set from scope Symfony\Component\PropertyAccess\PropertyAccessor"
}
array(3) {
  ["property"] => string(19) "virtual_no_set_hook"
  ["PropertyAccessor::isWritable()"] => bool(true)
  ["PropertyAccessor::setValue()"] => string(53) "Fail! Property Foo::$virtual_no_set_hook is read-only"
}
```

Expected `["PropertyAccessor::isWritable()"] => bool(false)` for all properties.
