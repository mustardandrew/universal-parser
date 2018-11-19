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
class TitleParser extends AbstractParser implements ParserInterface
{
    /**
     * Get data
     *
     * @param string $content
     * @return ValueInterface
     */
    public function getData(string &$content) : ValueInterface
    {
        $crawler = new Crawler($content);

        $value = $this->getTextByExp($crawler, 'h1');
        $value = $this->cleanValue($value);

        return new StringValue($value);
    }
}