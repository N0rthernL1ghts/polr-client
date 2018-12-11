<?php declare(strict_types=1);

namespace NorthernLights\Client\Polr\Attributes;

/**
 * Class DataAttributes
 * @package NorthernLights\Client\Polr\Attributes
 */
class DataAttributes extends Attributes implements DataAttributesInterface
{
    /**
     * DataAttributes constructor.
     *
     * Available attributes:
     *  - left_bound (optional): left date bound (e.g 2017-02-28 22:41:43)
     *  - right_bound (optional): right date bound (e.g 2017-03-13 22:41:43)
     *  - stats_type: the type of data to fetch
     *    - day: click counts for each day from left_bound to right_bound
     *    - country: click counts per country
     *    - referer: click counts per referer
     *
     * The dates must be formatted for the strtotime PHP function and must be parsable by Carbon.
     *
     * @param array $attributes
     * @see https://docs.polrproject.org/en/latest/developer-guide/api/#apiv2datalink
     */
    public function __construct(array $attributes = [])
    {
        // We want to have only chosen items in attributes
        parent::__construct([
            'left_bound' => $attributes['left_bound'] ?? null,
            'right_bound' => $attributes['right_bound'] ?? null,
            'stats_type' => $attributes['stats_type'] ?? 'country'
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
