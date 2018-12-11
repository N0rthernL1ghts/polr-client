<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Config;

use Zend\Config\Config as ZendConfig;

/**
 * Class Config
 * @package NorthernLights\Client\Polr\Config
 */
class Config extends ZendConfig
{
    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        // Default template
        $default = [
            /** @see http://docs.guzzlephp.org/en/stable/request-options.html#debug */
            'debug' => false,

            /** @see http://docs.guzzlephp.org/en/stable/request-options.html#timeout */
            'timeout' => 5.0,

            /** @see http://docs.guzzlephp.org/en/stable/request-options.html#cert */
            'cert' => null,

            /** @see http://docs.guzzlephp.org/en/stable/request-options.html#ssl-key */
            'ssl_key' => null,

            /** @see http://docs.guzzlephp.org/en/stable/request-options.html#headers */
            'headers' => null,

            /** Your Polr API server, without trailing slash */
            'host' => 'http://demo.polr.me',

            /** @see https://docs.polrproject.org/en/latest/developer-guide/api/#api-keys */
            'api_key' => 'demo-admin',

            /** @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionlookup */
            'endpoint_lookup' => '/api/v2/action/lookup',

            /** @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2datalink */
            'endpoint_data' => '/api/v2/data/link',

            /** @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionshorten */
            'endpoint_shorten' => '/api/v2/action/shorten',

            /** @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionshorten_bulk */
            'endpoint_shorten_bulk' => '/api/v2/action/shorten_bulk'
        ];


        $config = array_merge($default, $config);

        // Call parent constructor \Zend\Config\Config::__construct()
        parent::__construct($config);
    }
}
