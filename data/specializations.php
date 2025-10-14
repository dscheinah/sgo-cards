<?php

use App\Helper\Specialization\DamageSpecialization;
use App\Helper\Specialization\DefenseSpecialization;
use App\Helper\Specialization\DefensiveMagicSpecialization;
use App\Helper\Specialization\OffensiveMagicSpecialization;
use App\Helper\Specialization\HealthSpecialization;
use App\Helper\Specialization\RandomSpecialization;
use App\Helper\Specialization\SpeedSpecialization;

return [
    'rogue' => [
        'icon' => '🗡️️',
        'name' => 'Rogue',
        'description' => 'You never know what he does',
        'handler' => RandomSpecialization::class,
    ],

    'cleric' => [
        'icon' => '📿',
        'name' => 'Cleric',
        'description' => 'Increase Health',
        'data' => [
            'health' => 20,
        ],
        'modifiers' => [
            'add_health',
            'add_health',
        ]
    ],
    'priest' => [
        'icon' => '📿',
        'name' => 'Priest',
        'description' => 'Increase Health and Regeneration',
        'data' => [
            'health' => 40,
        ],
        'modifiers' => [
            'add_health',
            'add_health',
        ],
        'handler' => HealthSpecialization::class
    ],
    'healer' => [
        'icon' => '📿',
        'name' => 'Healer',
        'description' => 'More Health and Regeneration',
        'data' => [
            'health' => 80,
        ],
        'modifiers' => [
            'add_health',
            'add_health',
            'more_player_health',
        ],
        'handler' => HealthSpecialization::class
    ],

    'fighter' => [
        'icon' => '🤺',
        'name' => 'Fighter',
        'description' => 'Increase Damage',
        'data' => [
            'damage' => 10,
        ],
        'modifiers' => [
            'add_damage',
            'add_damage',
        ],
    ],
    'warrior' => [
        'icon' => '🤺',
        'name' => 'Warrior',
        'description' => 'Increase Damage and special Defense',
        'data' => [
            'damage' => 30,
        ],
        'modifiers' => [
            'add_damage',
            'add_damage',
        ],
        'handler' => DefenseSpecialization::class
    ],
    'barbarian' => [
        'icon' => '🤺',
        'name' => 'Barbarian',
        'description' => 'More Damage and special Defense',
        'data' => [
            'damage' => 90,
        ],
        'modifiers' => [
            'add_damage',
            'add_damage',
            'more_player_damage',
        ],
        'handler' => DefenseSpecialization::class
    ],

    'knight' => [
        'icon' => '💂',
        'name' => 'Knight',
        'description' => 'Increase Defense',
        'data' => [
            'defense' => 5,
        ],
        'modifiers' => [
            'add_defense',
            'add_defense',
        ],
    ],
    'warden' => [
        'icon' => '💂',
        'name' => 'Warden',
        'description' => 'Increase Defense and defensive Magic',
        'data' => [
            'defense' => 15,
        ],
        'modifiers' => [
            'add_defense',
            'add_defense',
        ],
        'handler' => DefensiveMagicSpecialization::class
    ],
    'paladin' => [
        'icon' => '💂',
        'name' => 'Paladin',
        'description' => 'More Defense and defensive Magic',
        'data' => [
            'defense' => 45,
        ],
        'modifiers' => [
            'add_defense',
            'add_defense',
            'more_player_defense',
        ],
        'handler' => DefensiveMagicSpecialization::class
    ],

    'wizard' => [
        'icon' => '🧙',
        'name' => 'Wizard',
        'description' => 'Increase Magic',
        'data' => [
            'magic' => 10,
        ],
        'modifiers' => [
            'add_magic',
            'add_magic',
        ],
    ],
    'mage' => [
        'icon' => '🧙',
        'name' => 'Mage',
        'description' => 'Increase Magic and offensive Magic',
        'data' => [
            'magic' => 30,
        ],
        'modifiers' => [
            'add_magic',
            'add_magic',
        ],
        'handler' => OffensiveMagicSpecialization::class,
    ],
    'sorcerer' => [
        'icon' => '🧙',
        'name' => 'Sorcerer',
        'description' => 'More Magic and offensive Magic',
        'data' => [
            'magic' => 90,
        ],
        'modifiers' => [
            'add_magic',
            'add_magic',
            'more_player_magic',
        ],
        'handler' => OffensiveMagicSpecialization::class,
    ],

    'archer' => [
        'icon' => '🏹',
        'name' => 'Archer',
        'description' => 'Increase Speed',
        'data' => [
            'speed' => 5,
        ],
        'modifiers' => [
            'add_speed',
            'add_speed',
        ],
    ],
    'hunter' => [
        'icon' => '🏹',
        'name' => 'Hunter',
        'description' => 'Increase Speed and Hits',
        'data' => [
            'speed' => 15,
        ],
        'modifiers' => [
            'add_speed',
            'add_speed',
        ],
        'handler' => SpeedSpecialization::class,
    ],
    'ranger' => [
        'icon' => '🏹',
        'name' => 'Ranger',
        'description' => 'More Speed and Hits',
        'data' => [
            'speed' => 45,
        ],
        'modifiers' => [
            'add_speed',
            'add_speed',
            'more_player_speed',
        ],
        'handler' => SpeedSpecialization::class,
    ],

    'assassin' => [
        'icon' => '🥷',
        'name' => 'Assassin',
        'description' => 'Faster and deadlier than average',
        'y' => 60,
        'modifiers' => [
            'add_damage',
            'more_player_damage',
            'add_speed',
            'more_player_speed',
        ],
    ],
    'necromancer' => [
        'icon' => '💀',
        'name' => 'Necro',
        'description' => 'Summons damaging undead every round',
        'y' => 70,
        'modifiers' => [
            'more_player_magic',
        ],
        'handler' => DamageSpecialization::class,
    ],
    'monk' => [
        'icon' => '🐒',
        'name' => 'Monk',
        'description' => 'Specialized in all kinds of Debuffs',
        'y' => 80,
        'modifiers' => [
            'more_player_health',
            'remove_damage',
            'remove_damage',
            'remove_defense',
            'remove_defense',
            'remove_magic',
            'remove_magic',
            'remove_speed',
            'remove_speed',
        ],
    ],
    'bard' => [
        'icon' => '🎶',
        'name' => 'Bard',
        'description' => 'Music affects everything',
        'y' => 90,
        'modifiers' => [
            'more_modifiers',
        ],
    ],
];
