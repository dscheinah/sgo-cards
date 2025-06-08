<?php

namespace App\Helper\Modifier;

use App\Model\Modifier;

interface ModifierInterface
{
    public static function apply(array $data, Modifier $modifier, float $change): array;

    public static function multiply(array $data, Modifier $modifier, float $change): array;
}
