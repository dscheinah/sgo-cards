<?php

use App\Helper\Modifier\DependentModifier;

return [
    'more_player_damage' => [
        'data' => [
            'damage' => 1.3,
        ],
        'multiplicative' => true,
        'player' => true,
        'text' => 'More global Damage',
    ],
    'more_player_defense' => [
        'data' => [
            'defense' => 1.5,
        ],
        'multiplicative' => true,
        'player' => true,
        'text' => 'More global Defense',
    ],
    'more_player_magic' => [
        'data' => [
            'magic' => 1.3,
        ],
        'multiplicative' => true,
        'player' => true,
        'text' => 'More global Magic',
    ],
    'more_player_speed' => [
        'data' => [
            'speed' => 1.3,
        ],
        'multiplicative' => true,
        'player' => true,
        'text' => 'More global Speed',
    ],
    'reduce_damage' => [
        'data' => [
            'damage' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'text' => 'Less global Damage',
    ],
    'reduce_magic' => [
        'data' => [
            'magic' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'text' => 'Less global Magic',
    ],
    'reduce_speed' => [
        'data' => [
            'speed' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'text' => 'Less global Speed',
    ],
    'more_modifiers' => [
        'data' => [
            'mods' => 2,
        ],
        'modifiers' => true,
        'world' => true,
        'text' => 'More global Buff and Curse effectivity',
    ],
    'reduce_modifiers' => [
        'data' => [
            'mods' => 0.5,
        ],
        'modifiers' => true,
        'world' => true,
        'text' => 'Less global Buff and Curse effectivity',
    ],
    'add_damage' => [
        'data' => [
            'damage' => 1,
        ],
        'self' => true,
        'text' => 'Increase Damage',
    ],
    'add_defense' => [
        'data' => [
            'defense' => 1,
        ],
        'self' => true,
        'text' => 'Increase Defense',
    ],
    'add_magic' => [
        'data' => [
            'magic' => 1,
        ],
        'self' => true,
        'text' => 'Increase Magic',
    ],
    'remove_damage' => [
        'data' => [
            'damage' => -1.5,
        ],
        'enemy' => true,
        'text' => 'Reduce Enemy Damage',
    ],
    'remove_defense' => [
        'data' => [
            'defense' => -1.5,
        ],
        'enemy' => true,
        'text' => 'Reduce Enemy Defense',
    ],
    'remove_magic' => [
        'data' => [
            'magic' => -1.5,
        ],
        'enemy' => true,
        'text' => 'Reduce Enemy Magic',
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
