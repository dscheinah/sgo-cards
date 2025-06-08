<?php

namespace App\Helper\Specialization;

class HealthSpecialization implements SpecializationInterface
{
    public static function enemy(array $enemy): array
    {
        return $enemy;
    }

    public static function battle(array $stats, int $duration): array
    {
        $stats['health'] += (int) (1.3 ** $duration);
        return $stats;
    }
}
