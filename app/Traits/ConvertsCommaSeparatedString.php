<?php

namespace App\Traits;

trait ConvertsCommaSeparatedString
{
    /**
     * Convert a comma-separated string to an array of integers.
     */
    public function convertToIntegerArray(string $string): array
    {
        return array_map('intval', explode(',', $string));
    }
}
