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
            $data[$key] *= $value < 1 ? $value / $change : $value * $change;
        }
        return $data;
    }
}
