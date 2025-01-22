<?php

use App\Helper\Shrine\FireShrine;
use App\Helper\Shrine\IceShrine;
use App\Helper\Shrine\MistShrine;
use App\Helper\Shrine\NatureShrine;
use App\Helper\Shrine\PowerShrine;
use App\Helper\Shrine\WaterShrine;

return [
    'fire' => [
        'handler' => FireShrine::class,
        'text' => 'Shrine of Fire',
        'icon' => '🔥⛩️🔥',
        'color' => 'red',
        'description' => 'Increase offensive Magic',
    ],
    'ice' => [
        'handler' => IceShrine::class,
        'text' => 'Shrine of Ice',
        'icon' => '️❄️⛩️️❄️',
        'color' => 'aqua',
        'description' => 'Require more Speed',
    ],
    'mist' => [
        'handler' => MistShrine::class,
        'text' => 'Shrine of Mist',
        'icon' => '☁️⛩️☁️',
        'color' => 'darkgray',
        'description' => 'Chance to miss Damage',
    ],
    'nature' => [
        'handler' => NatureShrine::class,
        'text' => 'Shrine of Nature',
        'icon' => '🍂⛩️🍂',
        'color' => 'green',
        'description' => 'Poison based on Health',
    ],
    'power' => [
        'handler' => PowerShrine::class,
        'text' => 'Shrine of Power',
        'icon' => '⚡️⛩️⚡️',
        'color' => 'Gold',
        'description' => 'Speed applies to Magic',
    ],
    'water' => [
        'handler' => WaterShrine::class,
        'text' => 'Shrine of Water',
        'icon' => '💧⛩️💧',
        'color' => 'blue',
        'description' => 'Increase defensive Magic',
    ],
];
