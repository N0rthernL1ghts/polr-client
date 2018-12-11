<?php
/**
 * This is examples bootstrap and configuration file
 * Contains examples:
 * - Initializing config \NorthernLights\Client\Polr\Provider\Config()
 */

namespace NorthernLights\Client\Polr\Example;

use NorthernLights\Client\Polr\Config\Config;

require __DIR__ . '/../vendor/autoload.php';

/**
 * Make sure that this file cannot be executed
 * Just in case if vendor dir is available publicly
 */
if(PHP_SAPI !== 'cli') {
    echo 'This script must be run in CLI environment' . PHP_EOL;
    exit(1);
}

/**
 * Initialize config
 *
 * This step is optional
 */
$config = new Config([
    'debug' => true,
    'host' => 'https://www.example.com/polr',
    'api_key' => 'e2cc68e37a3f1551056f9d272f2d68'
]);