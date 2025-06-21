<?php

namespace App\Helper\Specialization;

class OffensiveMagicSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        $player['magic'] += (int) (1.2 ** $duration);
        return $player;
    }
}
