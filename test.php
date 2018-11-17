<?php

require "vendor/autoload.php";

$universalParser = new \UniversalParser\UniversalParser(
    new \UniversalParser\HttpClientAdapter(),
    [
        'title' => \UniversalParser\Parsers\TitleParser::class,
        'links' => \UniversalParser\Parsers\LinksParser::class,
    ]
);

$url = 'https://laravel.com/docs/5.7/contributions';

try {
    $data = $universalParser->getData($url);

    echo "Parse url {$url}", PHP_EOL;
    echo "Title is: {$data['title']}", PHP_EOL, '---', PHP_EOL;
    echo "Links", PHP_EOL, $data['links'];

} catch (Exception $e) {
    echo "ERROR: ", $e->getMessage(), PHP_EOL;
}




