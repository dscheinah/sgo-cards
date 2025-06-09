<?php

use App\Helper\Specialization\DamageSpecialization;
use App\Helper\Specialization\DebuffSpecialization;
use App\Helper\Specialization\DefenseSpecialization;
use App\Helper\Specialization\DefensiveMagicSpecialization;
use App\Helper\Specialization\OffensiveMagicSpecialization;
use App\Helper\Specialization\HealthSpecialization;
use App\Helper\Specialization\RandomSpecialization;
use App\Helper\Specialization\SpeedSpecialization;

return [
    'rogue' => [
        'name' => 'Rogue: You never know what he does',
        'handler' => RandomSpecialization::class,
    ],

    'cleric' => [
        'name' => 'Cleric: Increase Health',
        'data' => [
            'health' => 20,
        ],
        'modifiers' => [
            'add_health',
            'add_health',
        ]
    ],
    'priest' => [
        'name' => 'Priest: Increase Health and Regeneration',
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
        'name' => 'Healer: More Health and Regeneration',
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
        'name' => 'Fighter: Increase Damage',
        'data' => [
            'damage' => 10,
        ],
        'modifiers' => [
            'add_damage',
            'add_damage',
        ],
    ],
    'warrior' => [
        'name' => 'Warrior: Increase Damage and Defense',
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
        'name' => 'Barbarian: More Damage and Defense',
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
        'name' => 'Knight: Increase Defense',
        'data' => [
            'defense' => 5,
        ],
        'modifiers' => [
            'add_defense',
            'add_defense',
        ],
    ],
    'warden' => [
        'name' => 'Warden: Increase Defense and defensive Magic',
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
        'name' => 'Paladin: More Defense and defensive Magic',
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
        'name' => 'Wizard: Increase Magic',
        'data' => [
            'magic' => 10,
        ],
        'modifiers' => [
            'add_magic',
            'add_magic',
        ],
    ],
    'mage' => [
        'name' => 'Mage: Increase Magic and offensive Magic',
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
        'name' => 'Sorcerer: More Magic and offensive Magic',
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
        'name' => 'Archer: Increase Speed',
        'data' => [
            'speed' => 5,
        ],
        'modifiers' => [
            'add_speed',
            'add_speed',
        ],
    ],
    'hunter' => [
        'name' => 'Hunter: Increase Speed and Hits',
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
        'name' => 'Ranger: More Speed and Hits',
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
        'name' => 'Assassin: Faster and deadlier than average',
        'y' => 60,
        'modifiers' => [
            'more_player_damage',
            'more_player_speed',
        ],
    ],
    'necromancer' => [
        'name' => 'Necromancer: Comes with an army of undead',
        'y' => 70,
        'modifiers' => [
            'more_player_magic',
        ],
        'handler' => DamageSpecialization::class,
    ],
    'monk' => [
        'name' => 'Monk: Specialized in all arts',
        'y' => 80,
        'modifiers' => [
            'more_player_health',
        ],
        'handler' => DebuffSpecialization::class
    ],
    'bard' => [
        'name' => 'Bard: Music affects everything',
        'y' => 90,
        'modifiers' => [
            'more_modifiers',
        ],
        'handler' => DebuffSpecialization::class,
    ],
];
