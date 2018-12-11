<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Response;

use Illuminate\Support\Carbon;
use Psr\Http\Message\UriInterface;

/**
 * Interface DataResponseInterface
 * @package NorthernLights\Client\Polr\Response
 */
interface DataResponseInterface extends ResponseInterface
{
    /**
     * Get link ending for the URL
     * - https://url.sh/X
     *
     * Field: url_ending
     *
     * @return string
     */
    public function getUrlEnding(): string;

    /**
     * Data
     *
     * Field: data
     *
     * @return array
     */
    public function getData(): array;
}
