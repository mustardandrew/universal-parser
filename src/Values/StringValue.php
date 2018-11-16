<?php

namespace UniversalParser\Values;

use UniversalParser\Interfaces\ValueInterface;

/**
 * Class StringValue
 *
 * @package UniversalParser\Values
 */
class StringValue implements ValueInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * StringValue constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue() : string
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
        return $this->getValue();
    }
}