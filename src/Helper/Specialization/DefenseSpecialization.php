<?php

namespace App\Helper\Specialization;

class DefenseSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        $player['defense'] += 2 * (int) (1.1 ** $duration);
        return $player;
    }
}
