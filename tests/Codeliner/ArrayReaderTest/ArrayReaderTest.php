<?php
/*
 * This file is part of the codeliner/array-reader.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 08.03.14 - 21:30
 */
namespace Codeliner\ArrayReaderTest;

use Codeliner\ArrayReader\ArrayReader;

/**
 * Class ArrayReaderTest
 *
 * @package Codeliner\ArrayReaderTest
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class ArrayReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function is_integer_value()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => 1
                    )
                )
            )
        );

        $this->assertSame(1, $arrayReader->integerValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_string_converted_to_integer_value()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => '1'
                    )
                )
            )
        );

        $this->assertSame(1, $arrayReader->integerValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_default_integer_returned_when_path_not_exists()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => '1'
                    )
                )
            )
        );

        $this->assertSame(2, $arrayReader->integerValue('hash.with.unknown', 2));
    }

    /**
     * @test
     */
    public function is_float_value()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => 1.0
                    )
                )
            )
        );

        $this->assertSame(1.0, $arrayReader->floatValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_string_converted_to_float_value()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => '1.0'
                    )
                )
            )
        );

        $this->assertSame(1.0, $arrayReader->floatValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_default_float_returned_when_path_not_exists()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => '1.0'
                    )
                )
            )
        );

        $this->assertSame(2.1, $arrayReader->floatValue('hash.with.unknown', 2.1));
    }

    /**
     * @test
     */
    public function is_boolean_value()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => true
                    )
                )
            )
        );

        $this->assertTrue($arrayReader->booleanValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_string_converted_to_boolean_value()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => '1'
                    )
                )
            )
        );

        $this->assertTrue($arrayReader->booleanValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_default_boolean_returned_when_path_not_exists()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => true
                    )
                )
            )
        );

        $this->assertFalse($arrayReader->booleanValue('hash.with.unknown'));
    }

    /**
     * @test
     */
    public function is_string_value()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => 'value'
                    )
                )
            )
        );

        $this->assertSame('value', $arrayReader->stringValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_float_converted_to_string_value()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => 1.1
                    )
                )
            )
        );

        $this->assertSame('1.1', $arrayReader->stringValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_default_string_returned_when_path_not_exists()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => 'value'
                    )
                )
            )
        );

        $this->assertSame('default', $arrayReader->stringValue('hash.with.unknown', 'default'));
    }

    /**
     * @test
     */
    public function is_array_value()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => array(
                            'value'
                        )
                    )
                )
            )
        );

        $this->assertSame(array('value'), $arrayReader->arrayValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_object_converted_to_array_value()
    {
        $object = new \stdClass();
        $object->param = 'value';

        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => $object
                    )
                )
            )
        );

        $this->assertSame(array('param' => 'value'), $arrayReader->arrayValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_scalar_converted_to_array_value()
    {
        $object = new \stdClass();
        $object->param = 'value';

        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => 'scalar value'
                    )
                )
            )
        );

        $this->assertSame(array('scalar value'), $arrayReader->arrayValue('hash.with.nested'));
    }

    /**
     * @test
     */
    public function is_default_array_returned_when_path_not_exists()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => 'value'
                    )
                )
            )
        );

        $this->assertSame(array('default'), $arrayReader->arrayValue('hash.with.unknown', array('default')));
    }

    /**
     * @test
     */
    public function is_original_array_returned()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with' => array(
                        'nested' => 'value'
                    )
                )
            )
        );

        $check = array(
            'hash' => array(
                'with' => array(
                    'nested' => 'value'
                )
            )
        );

        $this->assertEquals($check, $arrayReader->toArray());
    }

    /**
     * @test
     */
    public function is_escaped_dot_ignored_in_path_detection()
    {
        $arrayReader = new ArrayReader(
            array(
                'hash' => array(
                    'with.dot.key' => array(
                        'nested' => 'value'
                    )
                )
            )
        );

        $this->assertSame('value', $arrayReader->stringValue('hash.with\.dot\.key.nested', 'default'));
    }
}

 