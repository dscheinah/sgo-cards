<?php

namespace App\Helper\Specialization;

class SpeedSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        if ($player['speed_damage'] > 0) {
            $player['speed_damage'] = 0;
            $player['damage'] += $player['speed_damage'];
        }
        return $player;
    }
}
