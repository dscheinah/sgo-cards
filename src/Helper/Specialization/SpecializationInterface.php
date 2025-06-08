<?php

namespace App\Helper\Specialization;

interface SpecializationInterface
{
    public static function enemy(array $enemy): array;

    public static function battle(array $stats, int $duration): array;
}
