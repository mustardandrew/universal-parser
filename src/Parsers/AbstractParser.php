<?php

namespace UniversalParser\Parsers;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AbstractParser
 *
 * @package UniversalParser\Parsers
 */
class AbstractParser
{
    /**
     * @param Crawler $crawler
     * @param string $exp
     * @param string $attribute
     * @return string
     */
    protected function getAttributeByExp(Crawler $crawler, string $exp, string $attribute) : string
    {
        if (! ($node = $crawler->filter($exp))->count()) {
            return '';
        }

        $value = $node->first()->attr($attribute);

        return $value ?: '';
    }

    /**
     * Get text
     *
     * @param Crawler $crawler
     * @param string $exp
     * @return string
     */
    protected function getTextByExp(Crawler $crawler, string $exp) : string
    {
        if (! ($node = $crawler->filter($exp))->count()) {
            return '';
        }

        $value = $node->first()->text();

        return $value ?: '';
    }

    /**
     * Clean value
     *
     * @param array $data
     * @return array
     */
    protected function cleanData(array $data) : array
    {
        foreach ($data as &$item) {
            $item = $this->cleanValue($item);
        }

        return $data;
    }

    /**
     * Clean value
     *
     * @param string $value
     * @return string
     */
    protected function cleanValue(string $value) : string
    {
        return trim($value);
    }
}