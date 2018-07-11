<?php
/*
 * This file is part of the codeliner/array-reader.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 08.03.14 - 21:28
 */

namespace Codeliner\ArrayReader;

/**
 * Class ArrayReader
 *
 * @package Codeliner\ArrayReader
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class ArrayReader
{
    /**
     * @var array
     */
    private $originalArray = [];

    /**
     * @param array $anArray
     */
    public function __construct(array $anArray)
    {
        $this->originalArray = $anArray;
    }

    public function integerValue(string $aPath, int $default = 0): int
    {
        $value = $this->getValueFromPath($aPath);

        if (is_null($value)) {
            return \intval($default);
        }

        return \intval($value);
    }

    public function floatValue(string $aPath, float $default = 0.0): float
    {
        $value = $this->getValueFromPath($aPath);

        if (is_null($value)) {
            return \floatval($default);
        }

        return \floatval($value);
    }

    public function booleanValue(string $aPath, bool $default = false): bool
    {
        $value = $this->getValueFromPath($aPath);

        if (is_null($value)) {
            return (bool)$default;
        }

        return (bool)$value;
    }

    public function stringValue(string $aPath, string $default = ''): string
    {
        $value = $this->getValueFromPath($aPath);

        if (is_null($value)) {
            return \strval($default);
        }

        return \strval($value);
    }

    public function arrayValue(string $aPath, array $default = []): array
    {
        $value = $this->getValueFromPath($aPath);

        if (is_null($value)) {
            return $default;
        }

        if (is_scalar($value)) {
            return array($value);
        }

        if (is_object($value)) {
            $value = json_decode(json_encode($value), true);
        }

        return $value;
    }

    /**
     * @param string $aPath
     * @param mixed $default
     * @return mixed
     */
    public function mixedValue(string $aPath, $default = null)
    {
        $value = $this->getValueFromPath($aPath);

        if (is_null($value)) {
            return $default;
        }

        return $value;
    }

    public function toArray(): array
    {
        return $this->originalArray;
    }

    protected function toPathKeys(string $aPath): array
    {
        $aPath = str_replace('\.', '___IamADot___', $aPath);
        $parts = explode('.', $aPath);

        return array_map(function ($part) { return str_replace('___IamADot___', '.', $part); }, $parts);
    }

    /**
     * @param string $aPath
     * @return mixed
     */
    protected function getValueFromPath(string $aPath)
    {
        $pathKeys = $this->toPathKeys($aPath);

        $arrayCopyOrValue = $this->originalArray;

        foreach($pathKeys as $pathKey) {

            if (!isset($arrayCopyOrValue[$pathKey])) {
                return null;
            }

            $arrayCopyOrValue = $arrayCopyOrValue[$pathKey];
        }

        return $arrayCopyOrValue;
    }
}
