<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Response;

use Illuminate\Support\Carbon;
use Psr\Http\Message\UriInterface;

/**
 * Interface ShortenResponseInterface
 * @package NorthernLights\Client\Polr\Response
 */
interface ShortenResponseInterface extends ResponseInterface
{
    /**
     * Representation of the shortened URL
     * Field: result
     *
     * @return UriInterface
     */
    public function getShortUrl(): UriInterface;

    /**
     * Original long URL
     *
     * This value is not retrieved from the API, but initial input
     *
     * @return UriInterface
     */
    public function getLongUrl(): UriInterface;

    /**
     * Creation date
     *
     * This value is not retrieved from API, but generated upon request
     *
     * @return Carbon
     */
    public function getCreationDate(): Carbon;
}
