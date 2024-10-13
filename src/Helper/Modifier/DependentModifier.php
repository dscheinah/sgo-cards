<?php

namespace App\Helper\Modifier;

class DependentModifier implements ModifierInterface
{
    public static function apply(array $data, array $modifier, float $change): array
    {
        $source = max($data[$modifier['source']], 0);
        $data[$modifier['target']] += $source * $modifier['data']['value'] * $change;
        return $data;
    }

    public static function multiply(array $data, array $modifier, float $change): array
    {
        return self::apply($data, $modifier, $change);
    }
}
