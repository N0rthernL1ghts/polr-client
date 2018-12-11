<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Response;

use Exception;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Carbon;
use Psr\Http\Message\UriInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Class ShortenResponse
 * @package NorthernLights\Client\Polr\Response
 */
class ShortenResponse extends Response implements ShortenResponseInterface
{
    /** @var UriInterface */
    private $longUrl;

    /** @var UriInterface */
    private $shortUrl;

    /** @var Carbon */
    private $createdAt;

    /**
     * {@inheritdoc}
     */
    protected function process()
    {
        $json = $this->json;
        $http = $this->getHttpResponse();

        // If API query failed, better to give up early
        if (!$this->status) {
            return;
        }

        try {
            $responseBody = $http->getBody();
            $responseJson = $json->decode($responseBody, JsonEncoder::FORMAT);

            $this->populateFields($responseJson);
        } catch (Exception $e) {
        }
    }

    /**
     * Populate fields
     *
     * This method shouldn't have been called in first place if API call failed,
     * however, we will try to handle non-existent data as well.
     *
     *
     * @param array $data
     *
     * @return void
     */
    private function populateFields(array $data)
    {
        $shortUrl = $data['result'] ?? 'http://error-api-call-failed';

        $this->shortUrl = new Uri($shortUrl);
        $this->longUrl = new Uri($this->context['long_url']);
        $this->createdAt = new Carbon();
    }

    /**
     * {@inheritdoc}
     */
    public function getLongUrl(): UriInterface
    {
        return $this->longUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getShortUrl(): UriInterface
    {
        return $this->shortUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreationDate(): Carbon
    {
        return $this->createdAt;
    }
}
