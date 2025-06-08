<?php

namespace App\Helper\Specialization;

class DefensiveMagicSpecialization implements SpecializationInterface
{
    public static function enemy(array $enemy): array
    {
        $enemy['magic_offense'] *= .8;
        return $enemy;
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }
}
