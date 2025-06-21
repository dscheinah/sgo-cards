<?php

namespace App\Helper\Specialization;

interface SpecializationInterface
{
    public static function battle(array $player, int $duration): array;
}
