<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Response;

use NorthernLights\Client\Polr\Attributes\AttributesInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * Interface ResponseInterface
 * @package NorthernLights\Client\Polr\Response
 */
interface ResponseInterface
{
    /**
     * Get PSR HTTP response
     *
     * @return PsrResponseInterface
     */
    public function getHttpResponse(): PsrResponseInterface;

    /**
     * Get attributes
     *
     * @return AttributesInterface
     */
    public function getAttributes(): AttributesInterface;


    /**
     * If API query was successful, this fill indicate that
     * (Judged by HTTP status code)
     *
     * @return bool
     */
    public function wasSuccessful(): bool;
}
