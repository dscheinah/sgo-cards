<?php

namespace App\Helper\Modifier;

use App\Model\Modifier;

class DefaultModifier implements ModifierInterface
{
    public static function apply(array $data, Modifier $modifier, float $change): array
    {
        foreach ($modifier->data as $key => $value) {
            $data[$key] += $value * $change;
        }
        return $data;
    }

    public static function multiply(array $data, Modifier $modifier, float $change): array
    {
        foreach ($modifier->data as $key => $value) {
            if ($data[$key] <= 0) {
                continue;
            }
            if ($value < 1) {
                $data[$key] -= $data[$key] * (1 - max($value / $change, .25));
            } else {
                $data[$key] += $data[$key] * log($value * $change, 10);
            }
        }
        return $data;
    }
}
