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
            if ($value < 1) {
                $target = $data[$key] * (1 - max($value, .25));
                $data[$key] -= $target * $change;
            } else {
                $target = $data[$key] * log($value);
                $data[$key] += $target * $change;
            }
        }
        return $data;
    }
}
