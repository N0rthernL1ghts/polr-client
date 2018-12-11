<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use NorthernLights\Client\Polr\Attributes\DataAttributes;
use NorthernLights\Client\Polr\Attributes\DataAttributesInterface;
use NorthernLights\Client\Polr\Attributes\LookupAttributes;
use NorthernLights\Client\Polr\Attributes\LookupAttributesInterface;
use NorthernLights\Client\Polr\Attributes\ShortenAttributes;
use NorthernLights\Client\Polr\Attributes\ShortenAttributesInterface;
use NorthernLights\Client\Polr\Config\Config;
use NorthernLights\Client\Polr\Exception\NotImplementedException;
use NorthernLights\Client\Polr\Response\DataResponse;
use NorthernLights\Client\Polr\Response\DataResponseInterface;
use NorthernLights\Client\Polr\Response\LookupResponse;
use NorthernLights\Client\Polr\Response\LookupResponseInterface;
use NorthernLights\Client\Polr\Response\ShortenResponse;
use NorthernLights\Client\Polr\Response\ShortenResponseInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiClient
 * @package NorthernLights\Client\Polr
 */
class ApiClient implements ApiClientInterface, ApiEndpointsInterface
{
    /** @var Config */
    private $config;

    /** @var Client */
    private $httpClient;

    /** @var array */
    private $commonAttributes;

    /**
     * Lookup constructor.
     * @param Config|null $config
     */
    public function __construct(Config $config = null)
    {
        $config = ($config !== null) ? $config : new Config();
        $this->config = $config;

        // These are appended to each request
        $this->commonAttributes = [
            'response_type' => 'json',
            'key' => $config->get('api_key')
        ];

        /**
         * Initialize HTTP client
         */

        $httpClientHeaders = [
            'Accept' => 'application/json'
        ];

        $headers = $this->config->get('headers');

        if (is_array($headers)) {
            $httpClientHeaders = array_merge($httpClientHeaders, $headers);
        }

        $this->httpClient = new Client([
            'base_uri' => $this->config->get('host'),
            'timeout' => $this->config->get('timeout'),
            'debug' => $this->config->get('debug'),
            'cert' => $this->config->get('cert'),
            'ssl_key' => $this->config->get('ssl_key'),
            'headers' => $httpClientHeaders,
            'http_errors' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function lookup(string $urlEnding, LookupAttributesInterface $attributes = null): LookupResponseInterface
    {
        $endpoint = $this->config->get('endpoint_lookup');
        $attributes = $attributes ?? new LookupAttributes();

        $data = array_merge([
            'url_ending' => $urlEnding,
        ], $attributes->getAttributes(), $this->commonAttributes);

        $response = $this->httpRequest($data, $endpoint);

        return new LookupResponse($response, $attributes, ['url_ending' => $urlEnding]);
    }

    /**
     * {@inheritdoc}
     */
    public function data(string $urlEnding, DataAttributesInterface $attributes = null): DataResponseInterface
    {
        $endpoint = $this->config->get('endpoint_data');
        $attributes = $attributes ?? new DataAttributes();

        $data = array_merge([
            'url_ending' => $urlEnding
        ], $attributes->getAttributes(), $this->commonAttributes);

        $response = $this->httpRequest($data, $endpoint);

        return new DataResponse($response, $attributes, ['url_ending' => $urlEnding]);
    }

    /**
     * {@inheritdoc}
     */
    public function shorten(string $url, ShortenAttributesInterface $attributes = null): ShortenResponseInterface
    {
        $endpoint = $this->config->get('endpoint_shorten');
        $attributes = $attributes ?? new ShortenAttributes();

        $data = array_merge([
            'url' => $url
        ], $attributes->getAttributes(), $this->commonAttributes);

        $response = $this->httpRequest($data, $endpoint);

        return new ShortenResponse($response, $attributes, ['long_url' => $url]);
    }

    /**
     * {@inheritdoc}
     */
    public function shortenBulk(array $urls): array
    {
        $endpoint = $this->config->get('endpoint_shorten_bulk');

        //TODO: Implement /api/v2/action/shorten_bulk
        throw new NotImplementedException($endpoint  . ' not implemented');

        return [];
    }

    /**
     * Send HTTP request
     *
     * @param array $data
     * @param string $endpoint
     * @param string $method
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function httpRequest(array $data, string $endpoint, string $method = 'POST'): ResponseInterface
    {

        $httpClient = $this->httpClient;

        try {
            $response = $httpClient->request($method, $endpoint, [
                'json' => $data
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return $response;
    }
}
