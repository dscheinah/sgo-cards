<?php
return [
    'increase_damage' => [
        'data' => [
            'damage' => 1.5,
        ],
        'multiplicative' => true,
        'player' => true,
        'text' => 'Increased global Damage',
    ],
    'increase_defense' => [
        'data' => [
            'defense' => 1.5,
        ],
        'multiplicative' => true,
        'player' => true,
        'text' => 'Increased global Defense',
    ],
    'increase_magic' => [
        'data' => [
            'magic' => 1.5,
        ],
        'multiplicative' => true,
        'player' => true,
        'text' => 'Increased global Magic',
    ],
    'increase_speed' => [
        'data' => [
            'speed' => 1.5,
        ],
        'multiplicative' => true,
        'player' => true,
        'text' => 'Increased global Speed',
    ],
    'reduce_damage' => [
        'data' => [
            'damage' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'text' => 'Reduced global Damage',
    ],
    'reduce_defense' => [
        'data' => [
            'defense' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'text' => 'Reduced global Defense',
    ],
    'reduce_magic' => [
        'data' => [
            'magic' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'text' => 'Reduced global Magic',
    ],
    'reduce_speed' => [
        'data' => [
            'speed' => 0.5,
        ],
        'multiplicative' => true,
        'world' => true,
        'text' => 'Reduced global Speed',
    ],
    'increase_modifiers' => [
        'data' => [
            'mods' => 2,
        ],
        'modifiers' => true,
        'world' => true,
        'text' => 'Increased global Buff and Curse effectivity',
    ],
    'reduce_modifiers' => [
        'data' => [
            'mods' => 0.5,
        ],
        'modifiers' => true,
        'world' => true,
        'text' => 'Reduced global Buff and Curse effectivity',
    ],
    'add_damage' => [
        'data' => [
            'damage' => 1,
        ],
        'self' => true,
        'text' => 'Increase Damage by 1',
    ],
    'add_defense' => [
        'data' => [
            'defense' => 1,
        ],
        'self' => true,
        'text' => 'Increase Defense by 1',
    ],
    'add_magic' => [
        'data' => [
            'magic' => 1,
        ],
        'self' => true,
        'text' => 'Increase Magic by 1',
    ],
    'remove_damage' => [
        'data' => [
            'damage' => -1,
        ],
        'enemy' => true,
        'text' => 'Reduce Damage by 1',
    ],
    'remove_defense' => [
        'data' => [
            'defense' => -1,
        ],
        'enemy' => true,
        'text' => 'Reduce Defense by 1',
    ],
    'remove_magic' => [
        'data' => [
            'magic' => -1,
        ],
        'enemy' => true,
        'text' => 'Reduce Magic by 1',
    ],
];
