# Polr API Client

[![Latest Stable Version](https://poser.pugx.org/northern-lights/polr-client/v/stable)](https://packagist.org/packages/northern-lights/polr-client)
[![Total Downloads](https://poser.pugx.org/northern-lights/polr-client/downloads)](https://packagist.org/packages/northern-lights/polr-client)
[![Latest Unstable Version](https://poser.pugx.org/northern-lights/polr-client/v/unstable)](https://packagist.org/packages/northern-lights/polr-client)
[![Maintainability](https://api.codeclimate.com/v1/badges/ad0be96540ad3c002ab7/maintainability)](https://codeclimate.com/github/N0rthernL1ghts/polr-client/maintainability)
[![Semantic Versioning](https://img.shields.io/badge/Semantic_Versioning-Yes-blue.svg)](https://semver.org)
[![License](https://poser.pugx.org/northern-lights/polr-client/license)](https://packagist.org/packages/northern-lights/polr-client)

## Introduction

> REST API client written in PHP for cydrobolt/polr

## Usage

Very minimal example, using default configuration
``` php
<?php

namespace NorthernLights\Client\Polr\Example;

use NorthernLights\Client\Polr\ApiClient;
use NorthernLights\Client\Polr\Config\Config;
use NorthernLights\Client\Polr\Response\ShortenResponseInterface;


/**
 * Initialize API client and pass $config to it (DI)
 * @var ApiClient $api
 */
$api = new ApiClient();

/**
 * Shorten the long URL.
 * @var ShortenResponseInterface $response
 */
$response = $api->shorten('https://www.polrproject.org');

// Check if API request was successful. Remains true as long as HTTP status code equals 200 OK
if (!$response->wasSuccessful()) {
    echo 'There was an error querying the api' . PHP_EOL;
    exit(1);
}

echo 'Short URL is ' . $response->getShortUrl() . PHP_EOL;
```

For more detailed examples and configuration, please take a look in [examples](https://github.com/N0rthernL1ghts/polr-client/tree/master/examples). All use scenarios are covered. 
- [configuration](examples/config.php)
- [lookup  [/api/v2/action/lookup]](https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionlookup)
- [shorten [/api/v2/action/shorten]](https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionshorten)
- [shorten_bulk [/api/v2/action/shorten_bulk]](https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionshorten_bulk) 
- [data [/api/v2/data/link]](https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2datalink)

## Installation

The recommended way to install is via Composer:

```
composer require northern-lights/polr-client
```
Alternatively, you can download latest stable version from [releases](https://github.com/N0rthernL1ghts/polr-client/releases/latest).

Please note that this library doesn't ship with autoloader, but relies on Composer internal autoloader.

## Industry standards and best practices
Library strives to comply with latest standards and best practices in the industry therefore we included

__PSR-2 coding standard Compliance check & fix__

We want the code to be as good as it is possible

- [squizlabs/PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)

``` bash
$ composer check-style
$ composer fix-style
```
Note: Second command will actually modify files

__Code syntax check (lint)__

Very basic check which saves us the trouble

- [jakub-onderka/php-parallel-lint](https://github.com/JakubOnderka/PHP-Parallel-Lint)

``` bash
$ composer php-lint
```

__Static Code Analysis__

So we catch bugs early.

- [phpstan/phpstan](https://github.com/phpstan/phpstan)

``` bash
$ composer phpsam
```

__Unit testing__

So we make sure that all moving parts are running smoothly

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit)

``` bash
$ composer test
```

## TODO
- Implement [shorten_bulk [/api/v2/action/shorten_bulk]](https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionshorten_bulk) 


## Disclaimer
This project or it's authors are not affiliated with the [Polr Project](https://polrproject.org/) or any third party.

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.