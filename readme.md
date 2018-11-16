# Universal Parser in php

Universal interface for make concrete parser in php.

## Requirements

- PHP >=7.1

## Install

```bash
composer require muan/universal-parser
```

## Usage

Create **HttpClientAdapter** or make your own adapter by implementing interface **HttpClientAdapterInterface**.

```php
$httpClientAdapter = new \UniversalParser\HttpClientAdapter();
```

Make array with parsers. You can create your own parsers by implementing **ParserInterface**.

```php
$parsers = [
    'title' => \UniversalParser\Parsers\TitleParser::class,
];
```

Create Universal Parser

```php
$universalParser = new \UniversalParser\UniversalParser($httpClientAdapter, $parsers);
```

and parse url

```php
$url = 'https://laravel.com/docs/5.7/contributions';
$data = $universalParser->getData($url);
```

## License

Universal Parser package is licensed under the [MIT License](http://opensource.org/licenses/MIT).


