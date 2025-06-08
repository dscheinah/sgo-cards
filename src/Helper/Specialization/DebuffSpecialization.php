<?php

namespace App\Helper\Specialization;

class DebuffSpecialization implements SpecializationInterface
{
    public static function enemy(array $enemy): array
    {
        return array_map(static fn ($value) => $value * .9, $enemy);
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }
}
