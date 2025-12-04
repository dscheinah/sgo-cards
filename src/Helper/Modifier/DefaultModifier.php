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
                $data[$key] -= $data[$key] * max(log((1 - $value) * $change + 1, 10), 0);
            } else {
                $data[$key] += $data[$key] * max(log(($value - 1) * $change + 1, 10), 0);
            }
        }
        return $data;
    }
}
