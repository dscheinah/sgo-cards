<?php

namespace App\Helper\Shrine;

interface ShrineInterface
{
    public function player(array $player): array;

    public function stats(array $stats): array;

    public function speed(array $stats, int $damage): int;

    public function battle(array $stats): array;
}
