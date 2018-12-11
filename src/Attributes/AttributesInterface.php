<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Attributes;

/**
 * Interface AttributesInterface
 * @package NorthernLights\Client\Polr\Attributes
 */
interface AttributesInterface
{
    /**
     * Get assigned attributes
     *
     * @return array
     */
    public function getAttributes(): array;
}
