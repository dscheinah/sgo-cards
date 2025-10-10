<?php

namespace App\Helper\Specialization;

class HealthSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        $player['health'] += (int) (1.2 ** $duration);
        return $player;
    }
}
