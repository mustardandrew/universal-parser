<?php

namespace UniversalParser\Values;

use UniversalParser\Interfaces\ValueInterface;

/**
 * Class ArrayValue
 *
 * @package UniversalParser\Values
 */
class ArrayValue implements ValueInterface
{
    /**
     * @var array
     */
    private $value;

    /**
     * ArrayValue constructor.
     *
     * @param array $value
     */
    public function __construct(array $value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return array
     */
    public function getValue() : array
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode(PHP_EOL, $this->getValue());
    }
}