<?php declare(strict_types=0);

namespace NorthernLights\Client\Polr\Traits;

use Illuminate\Support\Carbon;
use DateTimeZone;

/**
 * Trait CarbonUtilTrait
 * @package NorthernLights\Client\Polr\Traits
 */
trait CarbonUtilTrait
{
    /**
     * Create date
     *
     * @param string|null $date
     * @param string|null $timezone
     * @param bool $indicateError - If date is null, we will take 40 years from output date
     * @return Carbon
     */
    public function createFromDate(string $date = null, string $timezone = null, bool $indicateError = true)
    {
        $tz = new DateTimeZone($timezone);

        $carbon = new Carbon(
            $date,
            $tz
        );

        if ($date === null && $indicateError) {
            // Indicate error
            $carbon->subYear(40);
        }

        return $carbon;
    }
}
