<?php

use App\Helper\Area\CaveArea;
use App\Helper\Area\CityArea;
use App\Helper\Area\DesertArea;
use App\Helper\Area\DungeonArea;
use App\Helper\Area\ForestArea;
use App\Helper\Area\RitualArea;
use App\Helper\Area\RiverArea;
use App\Helper\Area\RunwayArea;
use App\Helper\Area\SwampArea;
use App\Helper\Area\TournamentArea;
use App\Helper\Area\VoidArea;

return [
    [
        'icon' => '🌵️',
        'name' => 'Hot Desert has increased temperature that drains Health',
        'handler' => DesertArea::class,
    ],
    [
        'icon' => '🌊',
        'name' => 'Crossing Rivers stop your way and prevent combat Damage',
        'handler' => RiverArea::class,
    ],
    [
        'icon' => '🌳',
        'name' => 'Dark Forest allows for hidden attacks ignoring Defense',
        'handler' => ForestArea::class,
    ],
    [
        'icon' => '🏚️',
        'name' => 'Ancient City has a barrier to prevent offensive Magic',
        'handler' => CityArea::class,
    ],
    [
        'icon' => '🦟',
        'name' => 'Muddy Swamp makes it difficult to move and removes Speed',
        'handler' => SwampArea::class,
    ],
    [
        'icon' => '🌌',
        'name' => 'Endless Void creates confusion to randomize all stats',
        'handler' => VoidArea::class,
    ],
    [
        'icon' => '🩸',
        'name' => 'Bloody Ritual sacrifices Health for offensive Magic',
        'handler' => RitualArea::class,
    ],
    [
        'icon' => '🕷️',
        'name' => 'Deep Caves enable instincts to use Defense as defensive Magic',
        'handler' => CaveArea::class,
    ],
    [
        'icon' => '🛤️',
        'name' => 'Clear Runways allow evading to give Speed as Health',
        'handler' => RunwayArea::class,
    ],
    [
        'icon' => '🕳️',
        'name' => 'Trapped Dungeons reflect back the dealt Damage',
        'handler' => DungeonArea::class,
    ],
    [
        'icon' => '👿',
        'name' => 'Godly Tournament declares the winner based on total stats',
        'handler' => TournamentArea::class,
    ]
];
