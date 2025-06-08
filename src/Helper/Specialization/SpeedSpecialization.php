<?php

namespace App\Helper\Specialization;

class SpeedSpecialization implements SpecializationInterface
{
    public static function enemy(array $enemy): array
    {
        return $enemy;
    }

    public static function battle(array $stats, int $duration): array
    {
        if ($stats['speed'] > 0) {
            $stats['speed'] = 0;
            $stats['damage'] += $stats['speed'];
        }
        return $stats;
    }
}
