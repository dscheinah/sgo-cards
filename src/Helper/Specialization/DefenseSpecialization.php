<?php

namespace App\Helper\Specialization;

class DefenseSpecialization implements SpecializationInterface
{
    public static function enemy(array $enemy): array
    {
        $enemy['damage'] *= .8;
        return $enemy;
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }
}
