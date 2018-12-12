<?php

namespace NorthernLights\Client\Polr\Example;

use NorthernLights\Client\Polr\ApiClient;
use NorthernLights\Client\Polr\Attributes\ShortenAttributes;
use NorthernLights\Client\Polr\Attributes\ShortenAttributesInterface;
use NorthernLights\Client\Polr\Config\Config;
use NorthernLights\Client\Polr\Response\ShortenResponseInterface;

require __DIR__ . '/config.php';
/** @var Config $config */

/**
 * Initialize API client and pass $config to it (DI)
 * @var ApiClient $api
 */
$api = new ApiClient($config);

/**
 * Initialize attributes
 * Possibility to supply additional parameters to API
 *
 * This step is optional
 *
 * @var ShortenAttributesInterface $attributes
 */
$attributes = new ShortenAttributes(['custom_ending' => 'polr']);

/**
 * Perform lookup. Argument $attributes, is optional
 * @var ShortenResponseInterface $response
 */
$response = $api->shorten('https://www.polrproject.org', $attributes);

// Check if API request was successful. Remains true as long as HTTP status code equals 200 OK
if (!$response->wasSuccessful()) {
    echo 'There was an error querying the api' . PHP_EOL;
}

/***
 * Dump results
 */

echo 'Response object: ' . PHP_EOL;
dump($response);

echo 'HTTP Response:' . PHP_EOL;
dump(
    $response->getHttpResponse()->getBody()->__toString()
);
