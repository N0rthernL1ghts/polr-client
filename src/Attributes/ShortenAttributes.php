<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Attributes;

/**
 * Class ShortenAttributes
 * @package NorthernLights\Client\Polr\Attributes
 */
class ShortenAttributes extends Attributes implements ShortenAttributesInterface
{
    /**
     * ShortenAttributes constructor.
     *
     * Available attributes:
     *  - is_secret (optional): whether the URL should be a secret URL or not. Defaults to false. (e.g true or false)
     *  - custom_ending (optional): a custom ending for the short URL. If left empty, no custom ending will be assigned.
     *
     * @param array $attributes
     * @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionshorten
     */
    public function __construct(array $attributes = [])
    {
        // We want to have only chosen items in attributes
        parent::__construct([
            'is_secret' => $attributes['is_secret'] ?? false,
            'custom_ending' => $attributes['custom_ending'] ?? null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
