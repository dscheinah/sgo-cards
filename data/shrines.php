<?php

use App\Helper\Shrine\AirShrine;
use App\Helper\Shrine\EarthShrine;
use App\Helper\Shrine\FireShrine;
use App\Helper\Shrine\IceShrine;
use App\Helper\Shrine\MistShrine;
use App\Helper\Shrine\NatureShrine;
use App\Helper\Shrine\PowerShrine;
use App\Helper\Shrine\WaterShrine;
use App\Model\Card;

return [
    'fire' => [
        'handler' => FireShrine::class,
        'text' => 'Shrine of Fire',
        'icon' => '🔥⛩️',
        'color' => 'red',
        'description' => 'Increase offensive Magic',
        'tags' => [Card::MAGIC],
    ],
    'ice' => [
        'handler' => IceShrine::class,
        'text' => 'Shrine of Ice',
        'icon' => '️❄️⛩️️',
        'color' => 'aqua',
        'description' => 'Require additional Speed',
        'tags' => [Card::SPEED],
    ],
    'mist' => [
        'handler' => MistShrine::class,
        'text' => 'Shrine of Mist',
        'icon' => '☁️⛩️️',
        'color' => 'darkgray',
        'description' => 'Chance to miss Damage',
        'tags' => [Card::DAMAGE],
    ],
    'nature' => [
        'handler' => NatureShrine::class,
        'text' => 'Shrine of Nature',
        'icon' => '🍂⛩️',
        'color' => 'green',
        'description' => 'Poison based on Health',
        'tags' => [Card::HEALTH],
    ],
    'power' => [
        'handler' => PowerShrine::class,
        'text' => 'Shrine of Power',
        'icon' => '⚡️⛩️️',
        'color' => 'gold',
        'description' => 'Speed applies to Magic',
        'tags' => [Card::SPEED, Card::MAGIC],
    ],
    'water' => [
        'handler' => WaterShrine::class,
        'text' => 'Shrine of Water',
        'icon' => '💧⛩️',
        'color' => 'blue',
        'description' => 'Increase defensive Magic',
        'tags' => [Card::MAGIC],
    ],
    'earth' => [
        'handler' => EarthShrine::class,
        'text' => 'Shrine of Earth',
        'icon' => '⛰️⛩️',
        'color' => 'brown',
        'description' => 'Deal Damage with Defense',
        'tags' => [Card::DEFENSE, Card::DAMAGE],
    ],
    'air' => [
        'handler' => AirShrine::class,
        'text' => 'Shrine of Air',
        'icon' => '🌪️⛩️',
        'color' => 'magenta',
        'description' => 'Break Defense with Speed',
        'tags' => [Card::SPEED, Card::DAMAGE],
    ],
];
