<?php

namespace App\Helper\Specialization;

class RandomSpecialization implements SpecializationInterface
{
    public static function enemy(array $enemy): array
    {
        return $enemy;
    }

    public static function battle(array $stats, int $duration): array
    {
        mt_srand();
        $mods = ['health', 'damage', 'magic'];
        shuffle($mods);
        $stats[$mods[0]]++;
        $stats[$mods[1]]--;
        return $stats;
    }
}
