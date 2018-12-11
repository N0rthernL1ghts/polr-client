<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Response;

use Illuminate\Support\Carbon;
use Psr\Http\Message\UriInterface;

/**
 * Interface LookupResponseInterface
 * @package NorthernLights\Client\Polr\Response
 */
interface LookupResponseInterface extends ResponseInterface
{
    /**
     * Get link ending for the URL
     * - https://url.sh/X
     *
     * This value is not retrieved from the API, but initial input
     *
     * @return string
     */
    public function getUrlEnding(): string;

    /**
     * Original long URL
     * Field: long_url
     *
     * @return UriInterface
     */
    public function getLongUrl(): UriInterface;

    /**
     * Creation date
     * Field: created_at
     *
     * @return Carbon
     */
    public function getCreationDate(): Carbon;

    /**
     * The date entry was updated last time
     * Field: updated_at
     *
     * @return Carbon
     */
    public function getUpdateDate(): Carbon;

    /**
     * Clicks count
     * Field: clicks
     *
     * @return int
     */
    public function getClicks(): int;
}
