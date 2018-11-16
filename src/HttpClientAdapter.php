<?php

namespace UniversalParser;

use GuzzleHttp\Client;
use UniversalParser\Interfaces\HttpClientAdapterInterface;

/**
 * Class HttpClientAdapter
 *
 * @package UniversalParser
 */
class HttpClientAdapter implements HttpClientAdapterInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * HttpClientAdapter constructor.
     */
    public function __construct()
    {
        $this->initClient();
    }

    /**
     * Init http client
     */
    private function initClient()
    {
        $this->client = new Client();
    }

    /**
     * Get content
     *
     * @param string $url
     * @return string
     */
    public function getContent(string $url): string
    {
        $response = $this->client->get($url);
        return $response->getBody();
    }
}