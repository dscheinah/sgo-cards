<?php

namespace App\Helper\Modifier;

use App\Model\Modifier;

class DependentModifier implements ModifierInterface
{
    public static function apply(array $data, Modifier $modifier, float $change): array
    {
        if ($data[$modifier->source] <= 0) {
            return $data;
        }
        $data[$modifier->target] += $data[$modifier->source] * log($modifier->data['value'] * $change + 1);
        return $data;
    }

    public static function multiply(array $data, Modifier $modifier, float $change): array
    {
        return self::apply($data, $modifier, $change);
    }
}
