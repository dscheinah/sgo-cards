<?php

namespace App\Helper\Specialization;

class DefensiveMagicSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        $player['magic_defense'] += 2 * (int) (1.1 ** $duration);
        return $player;
    }
}
