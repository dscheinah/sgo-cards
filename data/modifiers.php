<?php

use App\Helper\Modifier\DependentModifier;

return [
    'more_player_health' => [
        'data' => [
            'health' => 1.2,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'More global Health',
    ],
    'more_player_damage' => [
        'data' => [
            'damage' => 1.3,
        ],
        'multiplicative' => true,
        'player' => true,
        'self' => true,
        'text' => 'More global Damage',
    ],
    'more_player_defense' => [
        'data' => [
            'defense' => 1.3,
        ],
        'multiplicative' => true,
        'player' => true,
        'self' => true,
        'text' => 'More global Defense',
    ],
    'more_player_magic' => [
        'data' => [
            'magic' => 1.2,
        ],
        'multiplicative' => true,
        'player' => true,
        'self' => true,
        'text' => 'More global Magic',
    ],
    'more_player_speed' => [
        'data' => [
            'speed' => 1.3,
        ],
        'multiplicative' => true,
        'player' => true,
        'self' => true,
        'text' => 'More global Speed',
    ],
    'reduce_damage' => [
        'data' => [
            'damage' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'self' => true,
        'text' => 'Less global Damage',
    ],
    'reduce_magic' => [
        'data' => [
            'magic' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'self' => true,
        'text' => 'Less global Magic',
    ],
    'reduce_speed' => [
        'data' => [
            'speed' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'self' => true,
        'text' => 'Less global Speed',
    ],
    'more_modifiers' => [
        'data' => [
            'mods' => 1.7,
        ],
        'modifiers' => true,
        'world' => true,
        'text' => 'More global Buff and Curse effectivity',
    ],
    'reduce_modifiers' => [
        'data' => [
            'mods' => 0.6,
        ],
        'modifiers' => true,
        'world' => true,
        'text' => 'Less global Buff and Curse effectivity',
    ],
    'add_health' => [
        'data' => [
            'health' => 1.7,
        ],
        'self' => true,
        'text' => 'Increase Health',
    ],
    'add_damage' => [
        'data' => [
            'damage' => 1.7,
        ],
        'self' => true,
        'text' => 'Increase Damage',
    ],
    'add_defense' => [
        'data' => [
            'defense' => 1.7,
        ],
        'self' => true,
        'text' => 'Increase Defense',
    ],
    'add_magic' => [
        'data' => [
            'magic' => 1.7,
        ],
        'self' => true,
        'text' => 'Increase Magic',
    ],
    'add_speed' => [
        'data' => [
            'speed' => 1.7,
        ],
        'self' => true,
        'text' => 'Increase Speed',
    ],
    'remove_damage' => [
        'data' => [
            'damage' => -3,
        ],
        'enemy' => true,
        'text' => 'Reduce Enemy Damage',
    ],
    'remove_defense' => [
        'data' => [
            'defense' => -3,
        ],
        'enemy' => true,
        'text' => 'Reduce Enemy Defense',
    ],
    'remove_magic' => [
        'data' => [
            'magic' => -3,
        ],
        'enemy' => true,
        'text' => 'Reduce Enemy Magic',
    ],
    'remove_speed' => [
        'data' => [
            'speed' => -3,
        ],
        'enemy' => true,
        'text' => 'Reduce Enemy Speed',
    ],
    'convert_damage_to_health' => [
        'data' => [
            'damage' => 0.9,
            'health' => 1.1,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'Convert Damage to Health',
    ],
    'convert_defense_to_health' => [
        'data' => [
            'defense' => 0.9,
            'health' => 1.1,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'Convert Defense to Health',
    ],
    'convert_magic_to_health' => [
        'data' => [
            'magic' => 0.9,
            'health' => 1.1,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'Convert Magic to Health',
    ],
    'convert_speed_to_health' => [
        'data' => [
            'speed' => 0.9,
            'health' => 1.1,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'Convert Speed to Health',
    ],
    'more_damage' => [
        'data' => [
            'damage' => 1.1,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'More Damage',
    ],
    'more_defense' => [
        'data' => [
            'defense' => 1.1,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'More Defense',
    ],
    'more_magic' => [
        'data' => [
            'magic' => 1.1,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'More Magic',
    ],
    'more_speed' => [
        'data' => [
            'speed' => 1.1,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'More Speed',
    ],
    'convert_all_to_damage' => [
        'data' => [
            'damage' => 1.3,
            'health' => 0.9,
            'defense' => 0.9,
            'magic' => 0.9,
            'speed' => 0.9,
        ],
        'multiplicative' => true,
        'self' => true,
        'text' => 'Convert to Damage',
    ],
    'speed_as_defense' => [
        'handler' => DependentModifier::class,
        'data' => [
            'value' => 0.1,
        ],
        'source' => 'speed',
        'target' => 'defense',
        'self' => true,
        'text' => 'Add Defense from Speed',
    ],
    'defense_as_magic' => [
        'handler' => DependentModifier::class,
        'data' => [
            'value' => 0.1,
        ],
        'source' => 'defense',
        'target' => 'magic',
        'self' => true,
        'text' => 'Add Magic from Defense',
    ],
    'speed_as_magic' => [
        'handler' => DependentModifier::class,
        'data' => [
            'value' => 0.1,
        ],
        'source' => 'speed',
        'target' => 'magic',
        'self' => true,
        'text' => 'Add Magic from Speed',
    ],
    'defense_as_damage' => [
        'handler' => DependentModifier::class,
        'data' => [
            'value' => 0.1,
        ],
        'source' => 'defense',
        'target' => 'damage',
        'self' => true,
        'text' => 'Add Damage from Defense',
    ],
    'magic_as_damage' => [
        'handler' => DependentModifier::class,
        'data' => [
            'value' => 0.1,
        ],
        'source' => 'magic',
        'target' => 'damage',
        'self' => true,
        'text' => 'Add Damage from Magic',
    ],
    'damage_as_health' => [
        'handler' => DependentModifier::class,
        'data' => [
            'value' => 0.1,
        ],
        'source' => 'damage',
        'target' => 'health',
        'self' => true,
        'text' => 'Add Health from Damage',
    ],
    'magic_as_health' => [
        'handler' => DependentModifier::class,
        'data' => [
            'value' => 0.1,
        ],
        'source' => 'magic',
        'target' => 'health',
        'self' => true,
        'text' => 'Add Health from Magic',
    ],
];
