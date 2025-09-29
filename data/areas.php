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
        'name' => 'Hot Desert',
        'description' => 'Drains Health with increased temperature.',
        'handler' => DesertArea::class,
    ],
    [
        'icon' => '🌊',
        'name' => 'Crossing Rivers',
        'description' => 'Stop your way and prevent combat Damage.',
        'handler' => RiverArea::class,
    ],
    [
        'icon' => '🌳',
        'name' => 'Dark Forest',
        'description' => 'Allows hidden attacks ignoring Defense.',
        'handler' => ForestArea::class,
    ],
    [
        'icon' => '🏚️',
        'name' => 'Ancient City',
        'description' => 'Has a barrier to prevent offensive Magic.',
        'handler' => CityArea::class,
    ],
    [
        'icon' => '🦟',
        'name' => 'Muddy Swamp',
        'description' => 'Makes it difficult to use Speed.',
        'handler' => SwampArea::class,
    ],
    [
        'icon' => '🌌',
        'name' => 'Endless Void',
        'description' => 'Creates confusion to randomize all stats.',
        'handler' => VoidArea::class,
    ],
    [
        'icon' => '🩸',
        'name' => 'Bloody Ritual',
        'description' => 'Sacrifices Health for offensive Magic.',
        'handler' => RitualArea::class,
    ],
    [
        'icon' => '🕷️',
        'name' => 'Deep Caves',
        'description' => 'Use Defense as defensive Magic.',
        'handler' => CaveArea::class,
    ],
    [
        'icon' => '🛤️',
        'name' => 'Clear Runways',
        'description' => 'Allow evading to give Speed as Health.',
        'handler' => RunwayArea::class,
    ],
    [
        'icon' => '🕳️',
        'name' => 'Trapped Dungeons',
        'description' => 'Reflect back the dealt Damage.',
        'handler' => DungeonArea::class,
    ],
    [
        'icon' => '👿',
        'name' => 'Godly Tournament',
        'description' => 'Declares the winner by Total stats.',
        'handler' => TournamentArea::class,
    ]
];
