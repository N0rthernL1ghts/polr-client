<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr;

use NorthernLights\Client\Polr\Attributes\DataAttributesInterface;
use NorthernLights\Client\Polr\Attributes\LookupAttributesInterface;
use NorthernLights\Client\Polr\Attributes\ShortenAttributesInterface;
use NorthernLights\Client\Polr\Response\LookupResponseInterface;
use NorthernLights\Client\Polr\Response\ShortenResponseInterface;

/**
 * Interface ApiEndpointsInterface
 * @package NorthernLights\Client\Polr
 */
interface ApiEndpointsInterface
{
    /**
     * Looks up the shortened URL
     *
     * @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionlookup
     *
     * @param string $urlEnding The link ending for the URL to look up. (e.g 5ga)
     * @return LookupResponseInterface
     */
    public function lookup(string $urlEnding, LookupAttributesInterface $attributes = null): LookupResponseInterface;

    /**
     * Looks up the shortened URL data
     *
     * @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2datalink
     *
     * @param string $urlEnding The link ending for the URL to look up. (e.g 5ga)
     * @return mixed
     */
    public function data(string $urlEnding, DataAttributesInterface $attributes = null);

    /**
     * Shortens a URL
     *
     * @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionshorten
     *
     * @param string $url The URL to shorten
     * @param ShortenAttributesInterface|null $attributes
     * @return ShortenResponseInterface
     */
    public function shorten(string $url, ShortenAttributesInterface $attributes = null):ShortenResponseInterface;

    /**
     * Shortens URL in a bulk
     *
     * @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionshorten_bulk
     *
     * @param array $urls [ 'https://www.example.com/shorten_me' => ShortenAttributesInterface]
     * @return array
     */
    public function shortenBulk(array $urls):array;
}
