array-reader
============

PHP ArrayReader

[![Build Status](https://travis-ci.org/codeliner/array-reader.png?branch=master)](https://travis-ci.org/codeliner/array-reader)


## Installation

Installation of codeliner\array-reader uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).
Add following requirement to your composer.json

```sh
"codeliner/array-reader" : "~2.0"
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


//If a key in your array contains a dot you escape it in the path with a backslash

$arrayReader = new ArrayReader(
    array(
        'hash' => array(
            'with.dot.key' => array(
                'nested' => 'value'
            )
        )
    )
);

echo $arrayReader->stringValue('hash.with\.dot\.key.nested'));

//Output: value

//If you need to differentiate between a NULL value and a not existing path, you can explicity check if the path exists:

$arrayReader = new ArrayReader(
    array(
        'hash' => array(
            'with' => array(
                'nested' => null
            )
        )
    )
);

if($arrayReader->pathExists('hash.with.nested')) {
    echo "path exists";
}

//Output: path exists
```


