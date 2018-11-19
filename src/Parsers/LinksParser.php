<?php

namespace UniversalParser\Parsers;

use Symfony\Component\DomCrawler\Crawler;
use UniversalParser\Interfaces\ParserInterface;
use UniversalParser\Interfaces\ValueInterface;
use UniversalParser\Values\ArrayValue;

/**
 * Class LinksParser
 *
 * @package UniversalParser\Parsers
 */
class LinksParser extends AbstractParser implements ParserInterface
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

        $data = $crawler->filter('a')->each(function (Crawler $node) {
            return $node->attr('href');
        });

        $data = $this->filterData($data);
        $data = $this->cleanData($data);

        return new ArrayValue($data);
    }

    /**
     * Filter data
     *
     * @param array $data
     * @return array
     */
    protected function filterData(array $data) : array
    {
        $data = array_filter($data);

        $result = [];

        foreach ($data as &$item) {
            if ($item[0] !== '#' && $item !== '/') {
                $result[] = $item;
            }
        }

        return $result;
    }
}