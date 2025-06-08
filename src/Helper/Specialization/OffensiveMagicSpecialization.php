<?php

namespace App\Helper\Specialization;

class OffensiveMagicSpecialization implements SpecializationInterface
{
    public static function enemy(array $enemy): array
    {
        return $enemy;
    }

    public static function battle(array $stats, int $duration): array
    {
        $stats['magic'] += (int) (1.3 ** $duration);
        return $stats;
    }
}
