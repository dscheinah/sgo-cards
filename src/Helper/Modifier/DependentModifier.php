<?php

namespace App\Helper\Modifier;

use App\Model\Modifier;

class DependentModifier implements ModifierInterface
{
    public static function apply(array $data, Modifier $modifier, float $change): array
    {
        $source = max($data[$modifier->source], 0);
        $limited = log($modifier->data['value'] + 1);
        $data[$modifier->target] += $source * $limited * $change;
        return $data;
    }

    public static function multiply(array $data, Modifier $modifier, float $change): array
    {
        return self::apply($data, $modifier, $change);
    }
}
