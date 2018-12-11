<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Attributes;

/**
 * Class Attributes
 * @package NorthernLights\Client\Polr\Attributes
 */
abstract class Attributes
{
    /** @var array */
    protected $attributes;

    /**
     * Attributes constructor.
     *
     * Attributes (additional options) for specific endpoint
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        /**
         * We want to have only chosen items in attributes
         *
         * $this->attributes = [
         *    'attrib1' => $attributes['attrib1'] ?? null,
         *    'attrib2' => $attributes['attrib2'] ?? null
         * ];
         */
        $this->attributes = $attributes;
    }
}
