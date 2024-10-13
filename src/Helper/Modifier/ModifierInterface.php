<?php

namespace App\Helper\Modifier;

interface ModifierInterface
{
    public static function apply(array $data, array $modifier, float $change): array;

    public static function multiply(array $data, array $modifier, float $change): array;
}
