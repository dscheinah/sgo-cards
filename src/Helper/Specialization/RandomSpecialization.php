<?php

namespace App\Helper\Specialization;

class RandomSpecialization implements SpecializationInterface
{
    public static function battle(array $player, int $duration): array
    {
        foreach ($player as $key => $value) {
            $player[$key] += (mt_rand() % 3) - 1;
            if ($player[$key] < 0) {
                $player[$key] = 0;
            }
        }
        return $player;
    }
}
