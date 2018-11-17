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
class LinksParser implements ParserInterface
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

        $data = $this->cleanData($data);
        $data = $this->filterData($data);

        return new ArrayValue($data);
    }

    /**
     * Filter data
     *
     * @param array $data
     * @return array
     */
    private function filterData(array $data) : array
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

    /**
     * Clean value
     *
     * @param array $data
     * @return array
     */
    private function cleanData(array $data) : array
    {
        foreach ($data as &$link) {
            $link = $this->cleanValue($link);
        }

        return $data;
    }

    /**
     * Clean value
     *
     * @param string $value
     * @return string
     */
    private function cleanValue(string $value) : string
    {
        return trim($value);
    }
}