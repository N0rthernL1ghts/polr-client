<?php

namespace NorthernLights\Client\Polr\Example;

use NorthernLights\Client\Polr\ApiClient;
use NorthernLights\Client\Polr\Attributes\DataAttributes;
use NorthernLights\Client\Polr\Attributes\DataAttributesInterface;
use NorthernLights\Client\Polr\Config\Config;
use NorthernLights\Client\Polr\Response\DataResponseInterface;

require __DIR__ . '/config.php';
/** @var Config $config */

/**
 * Initialize API client and pass $config to it (DI)
 * @var ApiClient $api
 */
$api = new ApiClient($config);

$todayDate = date('Y-m-d H:i:s');

/**
 * Initialize attributes
 * Possibility to supply additional parameters to API
 *
 * This step is optional
 *
 * @var DataAttributesInterface $attributes
 */
$attributes = new DataAttributes([
    'left_bound' => $todayDate,
    'right_bound' => $todayDate,
    'stats_type' => 'day'
]);

/**
 * Perform lookup. Argument $attributes, is optional
 * @var DataResponseInterface $response
 */
$response = $api->data('polr', $attributes);

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
