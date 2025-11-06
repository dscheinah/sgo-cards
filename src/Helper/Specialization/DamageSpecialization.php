<?php

namespace App\Helper\Specialization;

class DamageSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        $player['damage'] += (int) (1.15 ** $duration);
        return $player;
    }
}
