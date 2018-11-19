<?php

namespace UniversalParser\Parsers;

use Symfony\Component\DomCrawler\Crawler;
use UniversalParser\Interfaces\ParserInterface;
use UniversalParser\Interfaces\ValueInterface;
use UniversalParser\Values\ArrayValue;

/**
 * Class MetaParser
 *
 * @package UniversalParser\Parsers
 */
class MetaParser extends AbstractParser implements ParserInterface
{
    /**
     * Get data
     *
     * @param string $content
     * @return ValueInterface
     */
    public function getData(string &$content): ValueInterface
    {
        $crawler = new Crawler($content);

        $data = [
            'lang'        => $this->getLang($crawler),
            'title'       => $this->getTitle($crawler),
            'keywords'    => $this->getKeywords($crawler),
            'description' => $this->getDescription($crawler),
        ];

        $data = $this->cleanData($data);

        return new ArrayValue($data);
    }

    /**
     * @param Crawler $crawler
     * @return string
     */
    protected function getLang(Crawler $crawler) : string
    {
        return $this->getAttributeByExp($crawler, 'html', 'lang');
    }

    /**
     * Get meta title
     *
     * @param Crawler $crawler
     * @return string
     */
    protected function getTitle(Crawler $crawler) : string
    {
        return $this->getTextByExp($crawler, 'title');
    }

    /**
     * Get keywords
     *
     * @param Crawler $crawler
     * @return string
     */
    protected function getKeywords(Crawler $crawler) : string
    {
        return $this->getAttributeByExp($crawler, 'meta[name=keywords]', 'content');
    }

    /**
     * Get description
     *
     * @param Crawler $crawler
     * @return string
     */
    protected function getDescription(Crawler $crawler) : string
    {
        return $this->getAttributeByExp($crawler, 'meta[name=description]', 'content');
    }
}