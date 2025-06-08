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
        'name' => 'Hot Desert has increased temperature that drains Health',
        'handler' => DesertArea::class,
    ],
    [
        'name' => 'Crossing Rivers stop your way and prevent combat Damage',
        'handler' => RiverArea::class,
    ],
    [
        'name' => 'Dark Forest allows for hidden attacks ignoring Defense',
        'handler' => ForestArea::class,
    ],
    [
        'name' => 'Ancient City has a barrier to prevent all Magic',
        'handler' => CityArea::class,
    ],
    [
        'name' => 'Muddy Swamp makes it difficult to move and reduces Speed',
        'handler' => SwampArea::class,
    ],
    [
        'name' => 'Endless Void creates confusion to randomize all stats',
        'handler' => VoidArea::class,
    ],
    [
        'name' => 'Bloody Ritual allows the use of Health as offensive Magic',
        'handler' => RitualArea::class,
    ],
    [
        'name' => 'Deep Caves enable instincts to use Defense as defensive Magic',
        'handler' => CaveArea::class,
    ],
    [
        'name' => 'Clear Runways allow evading to give Speed as Health',
        'handler' => RunwayArea::class,
    ],
    [
        'name' => 'Trapped Dungeons reflect back the dealt Damage',
        'handler' => DungeonArea::class,
    ],
    [
        'name' => 'Godly Tournament declares the winner based on total stats',
        'handler' => TournamentArea::class,
    ]
];
