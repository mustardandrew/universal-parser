<?php

namespace UniversalParser\Values;

use UniversalParser\Interfaces\ValueInterface;

/**
 * Class IntegerValue
 *
 * @package UniversalParser\Values
 */
class IntegerValue implements ValueInterface
{
    /**
     * @var int
     */
    private $value;

    /**
     * StringValue constructor.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return int
     */
    public function getValue() : int
    {
        return $this->value;
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}