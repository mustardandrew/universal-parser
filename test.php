<?php

require "vendor/autoload.php";

$universalParser = new \UniversalParser\UniversalParser(
    new \UniversalParser\HttpClientAdapter(),
    [
        'title' => \UniversalParser\Parsers\TitleParser::class,
        'meta' => \UniversalParser\Parsers\MetaParser::class,
        'links' => \UniversalParser\Parsers\LinksParser::class,
    ]
);

$url = 'https://laravel.com/docs/5.7/contributions';

try {
    $data = $universalParser->getData($url);

    echo "Parse url {$url}", PHP_EOL;
    print_r($data);

} catch (Exception $e) {
    echo "ERROR: ", $e->getMessage(), PHP_EOL;
}




