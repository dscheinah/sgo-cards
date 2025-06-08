<?php

namespace App\Model;

class LeagueStatistics
{
    public array $statistics = [];

    public int $user_count;

    public int $player_count;

    public array $shrines = [
        'positions' => [],
        'data' => [],
    ];
}
