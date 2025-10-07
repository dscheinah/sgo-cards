<?php

use App\Helper\Treasure\BombTreasure;
use App\Helper\Treasure\ChargeTreasure;
use App\Helper\Treasure\ConvertTreasure;
use App\Helper\Treasure\EvasionTreasure;
use App\Helper\Treasure\PoisonTreasure;
use App\Helper\Treasure\PotionTreasure;
use App\Helper\Treasure\RngTreasure;
use App\Helper\Treasure\StatTreasure;
use App\Helper\Treasure\TreasureTreasure;
use App\Model\Card;

return [
    'health_rng' => [
        'handler' => RngTreasure::class,
        'type' => Card::HEALTH,
        'icon' => '🖌️',
        'name' => 'Re-Brush',
        'descriptions' => [
            'identify' => 'Identifies by picking Health related cards',
            'effect' => 'Reduces available Health related cards.',
            'level' => 'Levels by picking cards with Health related Modifiers.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 150,
    ],
    'damage_rng' => [
        'handler' => RngTreasure::class,
        'type' => Card::DAMAGE,
        'icon' => '🪚',
        'name' => 'Un-Saw',
        'descriptions' => [
            'identify' => 'Identifies by picking Damage related cards',
            'effect' => 'Reduces available Damage related cards.',
            'level' => 'Levels by picking cards with Damage related Modifiers.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 150,
    ],
    'defense_rng' => [
        'handler' => RngTreasure::class,
        'type' => Card::DEFENSE,
        'icon' => '🔨️',
        'name' => 'In-Hammer',
        'descriptions' => [
            'identify' => 'Identifies by picking Defense related cards',
            'effect' => 'Reduces available Defense related cards.',
            'level' => 'Levels by picking cards with Defense related Modifiers.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 150,
    ],
    'magic_rng' => [
        'handler' => RngTreasure::class,
        'type' => Card::MAGIC,
        'icon' => '🧹',
        'name' => 'De-Broom',
        'descriptions' => [
            'identify' => 'Identifies by picking Magic related cards',
            'effect' => 'Reduces available Magic related cards.',
            'level' => 'Levels by picking cards with Magic related Modifiers.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 150,
    ],
    'speed_rng' => [
        'handler' => RngTreasure::class,
        'type' => Card::SPEED,
        'icon' => '🔒️',
        'name' => 'Ex-Lock',
        'descriptions' => [
            'identify' => 'Identifies by picking Speed related cards',
            'effect' => 'Reduces available Speed related cards.',
            'level' => 'Levels by picking cards with Speed related Modifiers.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 150,
    ],
    'health' => [
        'handler' => StatTreasure::class,
        'type' => Card::HEALTH,
        'icon' => '🧣',
        'name' => 'Healthy Scarf',
        'descriptions' => [
            'identify' => 'Identifies by reaching Health',
            'effect' => 'Increases Health in battle but reduces all other stats equally.',
            'level' => 'Levels by picking base Health cards.',
        ],
        'trigger_min' => 100,
        'trigger_max' => 200,
    ],
    'damage' => [
        'handler' => StatTreasure::class,
        'type' => Card::DAMAGE,
        'icon' => '🧤',
        'name' => 'Aggressive Gloves',
        'descriptions' => [
            'identify' => 'Identifies by reaching Damage',
            'effect' => 'Increases Damage in battle but reduces all other stats equally.',
            'level' => 'Levels by picking base Damage cards.',
        ],
        'trigger_min' => 100,
        'trigger_max' => 200,
    ],
    'defense' => [
        'handler' => StatTreasure::class,
        'type' => Card::DEFENSE,
        'icon' => '🥻',
        'name' => 'Heavy Armor',
        'descriptions' => [
            'identify' => 'Identifies by reaching Defense',
            'effect' => 'Increases Defense in battle but reduces all other stats equally.',
            'level' => 'Levels by picking base Defense cards.',
        ],
        'trigger_min' => 100,
        'trigger_max' => 200,
    ],
    'magic' => [
        'handler' => StatTreasure::class,
        'type' => Card::MAGIC,
        'icon' => '💍',
        'name' => 'Enchanted Ring',
        'descriptions' => [
            'identify' => 'Identifies by reaching Magic',
            'effect' => 'Increases Magic in battle but reduces all other stats equally.',
            'level' => 'Levels by picking base Magic cards.',
        ],
        'trigger_min' => 100,
        'trigger_max' => 200,
    ],
    'speed' => [
        'handler' => StatTreasure::class,
        'type' => Card::SPEED,
        'icon' => '👒',
        'name' => 'Lightweight Hat',
        'descriptions' => [
            'identify' => 'Identifies by reaching Speed',
            'effect' => 'Increases Speed in battle but reduces all other stats equally.',
            'level' => 'Levels by picking base Speed cards.',
        ],
        'trigger_min' => 100,
        'trigger_max' => 200,
    ],
    'convert_damage' => [
        'handler' => ConvertTreasure::class,
        'type' => 'damage',
        'icon' => '🕯️',
        'name' => 'Enlightening Candle',
        'descriptions' => [
            'identify' => 'Identifies by picking Conversion cards',
            'effect' => 'Converts a percentage of Damage to offensive Magic.',
            'level' => 'Levels by picking Conversion cards.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 100,
    ],
    'convert_offensive_magic' => [
        'handler' => ConvertTreasure::class,
        'type' => 'offensive_magic',
        'icon' => '💎',
        'name' => 'Creational Diamond',
        'descriptions' => [
            'identify' => 'Identifies by picking Conversion cards',
            'effect' => 'Converts a percentage of offensive Magic to Damage.',
            'level' => 'Levels by picking Conversion cards.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 100,
    ],
    'convert_defense' => [
        'handler' => ConvertTreasure::class,
        'type' => 'defense',
        'icon' => '🪞',
        'name' => 'Reflecting Mirror',
        'descriptions' => [
            'identify' => 'Identifies by picking Conversion cards',
            'effect' => 'Converts a percentage of Defense to defensive Magic.',
            'level' => 'Levels by picking Conversion cards.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 100,
    ],
    'convert_defensive_magic' => [
        'handler' => ConvertTreasure::class,
        'type' => 'defensive_magic',
        'icon' => '🧿',
        'name' => 'Protecting Amulet',
        'descriptions' => [
            'identify' => 'Identifies by picking Conversion cards',
            'effect' => 'Converts a percentage of defensive Magic to Defense.',
            'level' => 'Levels by picking Conversion cards.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 100,
    ],
    'evasion' => [
        'handler' => EvasionTreasure::class,
        'icon' => '⛓️',
        'name' => 'Hindering Chains',
        'descriptions' => [
            'identify' => 'Identifies by reaching Total stats',
            'effect' => 'Converts Speed mechanic to mitigation based on difference..',
            'level' => 'Levels by loosing a battle.',
        ],
        'trigger_min' => 300,
        'trigger_max' => 600,
    ],
    'potion' => [
        'handler' => PotionTreasure::class,
        'icon' => '🧪',
        'name' => 'Potion',
        'descriptions' => [
            'identify' => 'Refills slowly after each battle.',
            'effect' => 'Consumes charges to heal yourself once per battle on demand.',
            'level' => 'Levels by usage.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 200,
        'charges_base' => 5,
        'multiple' => true,
    ],
    'bomb' => [
        'handler' => BombTreasure::class,
        'icon' => '💣️',
        'name' => 'Bomb',
        'descriptions' => [
            'identify' => 'Refills slowly after each battle.',
            'effect' => 'Consumes charges to deal extra damage against stronger enemies.',
            'level' => 'Levels by usage.',
        ],
        'trigger_min' => 50,
        'trigger_max' => 200,
        'charges_base' => 3,
        'multiple' => true,
    ],
    'poison' => [
        'handler' => PoisonTreasure::class,
        'icon' => '💊',
        'name' => 'Poison',
        'descriptions' => [
            'identify' => 'Refills slowly after each try.',
            'effect' => 'Consumes charges to apply poison each battle.',
            'level' => 'Levels to the maximum rounds of your battles.',
        ],
        'trigger_min' => 3,
        'trigger_max' => 9,
        'charges_base' => 7,
    ],
    'consumable' => [
        'handler' => ChargeTreasure::class,
        'icon' => '🧺',
        'name' => 'Refilled Basket',
        'descriptions' => [
            'identify' => 'Identifies by reaching x+y',
            'effect' => 'Increases charges of consumable treasures.',
            'level' => 'Levels by defeating bots.',
        ],
        'trigger_min' => 150,
        'trigger_max' => 190,
    ],
    'treasure' => [
        'handler' => TreasureTreasure::class,
        'icon' => '🎺',
        'name' => 'Buffed Trumpet',
        'descriptions' => [
            'identify' => 'Identifies by reaching x+y',
            'effect' => 'Increases the level of all other treasures.',
            'level' => 'Levels by defeating users.',
        ],
        'trigger_min' => 150,
        'trigger_max' => 190,
    ],
];
