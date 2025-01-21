<?php

namespace App\Helper\Modifier;

class DefaultModifier implements ModifierInterface
{
    public static function apply(array $data, array $modifier, float $change): array
    {
        foreach ($modifier['data'] as $key => $value) {
            $data[$key] += $value * $change;
        }
        return $data;
    }

    public static function multiply(array $data, array $modifier, float $change): array
    {
        foreach ($modifier['data'] as $key => $value) {
            if ($value < 1) {
                $limited = max($value, .25);
                $data[$key] *= $limited / $change;
            } else {
                $limited = log($value) + 1;
                $data[$key] *= $limited * $change;
            }
        }
        return $data;
    }
}
