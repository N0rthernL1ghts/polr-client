<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Response;

use Exception;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Carbon;
use NorthernLights\Client\Polr\Traits\CarbonUtilTrait;
use Psr\Http\Message\UriInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Class LookupResponse
 * @package NorthernLights\Client\Polr\Response
 */
class LookupResponse extends Response implements LookupResponseInterface
{
    /** @var UriInterface */
    private $longUrl;

    /** @var string */
    private $urlEnding;

    /** @var int */
    private $clicksCount;

    /** @var Carbon */
    private $createdAt;

    /** @var Carbon */
    private $updatedAt;

    /** Carbon utilities */
    use CarbonUtilTrait;

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
        $result = $data['result'] ?? [];
        $createdAt = $result['created_at'] ?? [];
        $updatedAt = $result['updated_at'] ?? [];
        $longUrl = $result['long_url'] ?? 'http://error-api-call-failed';

        $this->urlEnding = $this->context['url_ending'];
        $this->longUrl = new Uri($longUrl);
        $this->clicksCount = $result['clicks'] ?? 0;


        $this->createdAt = $this->createFromDate(
            $createdAt['date'] ?? null,
            $createdAt['timezone'] ?? null
        );

        $this->updatedAt = $this->createFromDate(
            $updatedAt['date'] ?? null,
            $updatedAt['timezone'] ?? null
        );
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
    public function getUrlEnding(): string
    {
        return $this->urlEnding;
    }

    /**
     * {@inheritdoc}
     */
    public function getClicks(): int
    {
        return $this->clicksCount;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreationDate(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdateDate(): Carbon
    {
        return $this->updatedAt;
    }
}
