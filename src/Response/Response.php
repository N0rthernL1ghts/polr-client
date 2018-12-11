<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Response;

use NorthernLights\Client\Polr\Attributes\AttributesInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Symfony\Component\Serializer\Encoder\JsonDecode;

/**
 * Class LookupResponse
 * @package NorthernLights\Client\Polr\Response
 */
abstract class Response implements ResponseInterface
{
    /** @var PsrResponseInterface */
    private $httpResponse;

    /** @var AttributesInterface */
    private $attributes;

    /** @var JsonDecode */
    protected $json;

    /** @var bool */
    protected $status;

    /** @var array */
    protected $context;

    /**
     * Response constructor.
     * @param PsrResponseInterface $httpResponse
     * @param AttributesInterface $attributes
     * @param array $context Simple array used for passing data to extending classes
     */
    final public function __construct(
        PsrResponseInterface $httpResponse,
        AttributesInterface $attributes,
        array $context = []
    ) {
        $this->httpResponse = $httpResponse;
        $this->attributes = $attributes;
        $this->json = new JsonDecode(true);
        $this->status = ($httpResponse->getStatusCode() === 200); // We expect 200
        $this->context = $context;

        // Call init implemented by extending class
        $this->process();
    }

    /**
     * {@inheritdoc}
     */
    final public function getHttpResponse(): PsrResponseInterface
    {
        return $this->httpResponse;
    }

    /**
     * {@inheritdoc}
     */
    final public function getAttributes(): AttributesInterface
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function wasSuccessful(): bool
    {
        return $this->status;
    }

    /**
     * process/init
     * - This method will be called upon initialization
     * - Must NOT return value ( >= PHP 7.1 this will be strict with return void declaration)
     *
     * @return void
     */
    abstract protected function process();
}
