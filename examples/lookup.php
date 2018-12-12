<?php

namespace NorthernLights\Client\Polr\Example;

use NorthernLights\Client\Polr\ApiClient;
use NorthernLights\Client\Polr\Attributes\LookupAttributes;
use NorthernLights\Client\Polr\Attributes\LookupAttributesInterface;
use NorthernLights\Client\Polr\Config\Config;
use NorthernLights\Client\Polr\Response\LookupResponseInterface;

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
 * @var LookupAttributesInterface $attributes
 */
$attributes = new LookupAttributes(['url_key' => 'url-secret-key']);

/**
 * Perform lookup. Argument $attributes, is optional
 * @var LookupResponseInterface $response
 */
$response = $api->lookup('11', $attributes);

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
