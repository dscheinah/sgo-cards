<?php

namespace App\Helper\Specialization;

class OffensiveMagicSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        $player['magic_offense'] += (int) (1.1 ** $duration);
        return $player;
    }
}
