<?php

namespace UniversalParser;

use UniversalParser\Interfaces\HttpClientAdapterInterface;
use UniversalParser\Interfaces\ParserInterface;
use UniversalParser\Interfaces\ValueInterface;
use Exception;

/**
 * Class UniversalParser
 *
 * @package Parser
 */
class UniversalParser
{
    /**
     * @var HttpClientAdapterInterface
     */
    private $httpClientAdapter;

    /**
     * @var array
     */
    private $parsers;

    /**
     * UniversalParser constructor.
     * @param array $parsers
     * @param HttpClientAdapterInterface $httpClientAdapter
     */
    public function __construct(HttpClientAdapterInterface $httpClientAdapter, array $parsers)
    {
        $this->httpClientAdapter = $httpClientAdapter;
        $this->parsers = $parsers;
    }

    /**
     *  Get data
     *
     * @param string $url
     * @param bool $needConverted
     * @return array
     * @throws Exception
     */
    public function getData(string $url, bool $needConverted = true) : array
    {
        $content = $this->httpClientAdapter->getContent($url);

        $data = $this->parse($content);

        if ($needConverted) {
            $data = $this->convertToSimpleData($data);
        }

        return $data;
    }

    /**
     * Convert to simple data
     *
     * @param array $data
     * @return array
     */
    private function convertToSimpleData(array $data) : array
    {
        foreach ($data as &$item) {
            if (is_object($item) && method_exists($item, 'getValue')) {
                $item = $item->{'getValue'}();
            }
            if (is_array($item)) {
                $item = $this->convertToSimpleData($item);
            }
        }

        return $data;
    }

    /**
     * Parse content
     *
     * @param string $content
     * @return array
     * @throws Exception
     */
    private function parse(string &$content) : array
    {
        $data = [];

        foreach ($this->parsers as $field => $parserClass) {
            $data[$field] = $this->parseWithClass($parserClass, $content);
        }

        return $data;
    }

    /**
     * Parse with class
     *
     * @param string $parserClass
     * @param string $content
     * @return ValueInterface
     * @throws Exception
     */
    private function parseWithClass(string $parserClass, string &$content) : ValueInterface
    {
        if (! class_exists($parserClass)) {
            throw new Exception("Class '{$parserClass}' not exists!");
        }

        $parser = new $parserClass;

        if (! $parser instanceof ParserInterface) {
            throw new Exception("Parser '{$parserClass}' must implements ParserInterface!");
        }

        return $parser->getData($content);
    }
}