<?php

namespace UniversalParser\Interfaces;

/**
 * Interface ParserInterface
 *
 * @package UniversalParser\Interfaces
 */
interface ParserInterface
{
    /**
     * Get data
     *
     * @param string $content
     * @return mixed
     */
    public function getData(string &$content) : ValueInterface;
}