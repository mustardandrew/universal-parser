<?php

namespace UniversalParser\Interfaces;

/**
 * Interface HttpClientAdapterInterface
 *
 * @package UniversalParser\Interfaces
 */
interface HttpClientAdapterInterface
{
    /**
     * Get content
     *
     * @param string $url
     * @return string
     */
    public function getContent(string $url) : string;
}