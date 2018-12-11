<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Attributes;

/**
 * Class ShortenAttributes
 * @package NorthernLights\Client\Polr\Attributes
 */
class LookupAttributes extends Attributes implements LookupAttributesInterface
{
    /**
     * ShortenAttributes constructor.
     *
     * Available attributes:
     *  - url_key (optional): URL ending key for lookups against secret URLs
     *
     * @param array $attributes
     * @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2actionlookup
     */
    public function __construct(array $attributes = [])
    {
        // We want to have only chosen items in attributes
        parent::__construct([
            'url_key' => $attributes['url_key'] ?? null,
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
