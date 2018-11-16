<?php

namespace UniversalParser\Parsers;

use Symfony\Component\DomCrawler\Crawler;
use UniversalParser\Interfaces\ParserInterface;
use UniversalParser\Interfaces\ValueInterface;
use UniversalParser\Values\StringValue;

/**
 * Class TitleParser
 *
 * @package UniversalParser\Parsers
 */
class TitleParser implements ParserInterface
{
    /**
     * Get data
     *
     * @param string $content
     * @return ValueInterface
     */
    public function getData(string &$content) : ValueInterface
    {
        $value = '';

        $crawler = new Crawler($content);

        if (($node = $crawler->filter('h1'))->count()) {
            $value = $node->first()->text();
        }

        $value = $this->clearValue($value);

        return new StringValue($value);
    }

    /**
     * Clear value
     *
     * @param string $value
     * @return string
     */
    private function clearValue(string $value) : string
    {
        return trim($value);
    }
}