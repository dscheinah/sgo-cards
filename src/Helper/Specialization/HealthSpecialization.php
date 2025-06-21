<?php

namespace App\Helper\Specialization;

class HealthSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        $player['health'] += (int) (1.3 ** $duration);
        return $player;
    }
}
