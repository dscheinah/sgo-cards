<?php

namespace App\Helper\Specialization;

class HealthSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        $player['health'] += 2 * (int) (1.1 ** $duration);
        return $player;
    }
}
