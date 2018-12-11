<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Response;

use Exception;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Carbon;
use Psr\Http\Message\UriInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Class DataResponse
 * @package NorthernLights\Client\Polr\Response
 */
class DataResponse extends Response implements DataResponseInterface
{
    /** @var array */
    private $data;

    /** @var string */
    private $urlEnding;

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

        $this->urlEnding = $result['url_ending'] ?? 'error-api-call-failed';
        $this->data = $result['data'] ?? [];
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
    public function getData(): array
    {
        return $this->data;
    }
}
