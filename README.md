array-reader
============

PHP ArrayReader

[![Build Status](https://travis-ci.org/codeliner/array-reader.png?branch=master)](https://travis-ci.org/codeliner/array-reader)


## Installation

Installation of malocher\event-store uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).
Add following requirement to your composer.json

```sh
"codeliner/array-reader" : "1.0.*"
```

## Usage

You can use the ArrayReader to read single values from a multidimensional array by passing the path to one
of the `{type}Value()` methods. Each `{type}Value()` method takes a default value as second argument If the path can
not be found in the original array, the default is used as return value.

## Example

```php
$arrayReader = new ArrayReader(
    array(
        'hash' => array(
            'with' => array(
                'nested' => 'value'
            )
        )
    )
);

echo $arrayReader->stringValue('hash.with.nested'));

//Output: value

$arrayReader = new ArrayReader(
    array(
        'hash' => array(
            'with' => array(
                'nested' => 'value'
            )
        )
    )
);

echo $arrayReader->stringValue('hash.not.existing.path', 'defaultString'));

//Output: defaultString
```


