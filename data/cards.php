<?php
return [
    [
        [
            'icon' => '❤️',
            'text' => 'Health',
            'data' => [
                'health' => 2,
            ],
        ],
        [
            'icon' => '⚔️',
            'text' => 'Damage',
            'data' => [
                'damage' => 1,
            ],
        ],
        [
            'icon' => '🛡️',
            'text' => 'Defense',
            'data' => [
                'defense' => 1,
            ],
        ],
        [
            'icon' => '🪄',
            'text' => 'Magic',
            'data' => [
                'magic' => 1,
            ],
        ],
        [
            'icon' => '🥾',
            'text' => 'Speed',
            'data' => [
                'speed' => 1,
            ],
        ],
        [
            'icon' => '💱⚔️',
            'text' => 'Trade Defense for Damage',
            'data' => [
                'damage' => 2,
                'defense' => -1,
            ],
        ],
        [
            'icon' => '💱🛡️',
            'text' => 'Trade Damage for Defense',
            'data' => [
                'defense' => 2,
                'damage' => -1,
            ]
        ],
    ],
    [
        [
            'icon' => '️️⏫⚔️',
            'text' => 'Buff Damage',
            'modifier' => 'add_damage',
        ],
        [
            'icon' => '⏫🛡️',
            'text' => 'Buff Defense',
            'modifier' => 'add_defense',
        ],
        [
            'icon' => '⏫🪄',
            'text' => 'Buff Magic',
            'modifier' => 'add_magic',
        ],
        [
            'icon' => '⚔️🔻',
            'text' => 'Curse Enemy Damage',
            'modifier' => 'remove_damage',
        ],
        [
            'icon' => '🛡️🔻',
            'text' => 'Curse Enemy Defense',
            'modifier' => 'remove_defense',
        ],
        [
            'icon' => '🪄🔻',
            'text' => 'Curse Enemy Magic',
            'modifier' => 'remove_magic',
        ],
    ],
    [
        [
            'icon' => '❤️❤️',
            'text' => 'Extra Health',
            'data' => [
                'health' => 5,
            ],
        ],
        [
            'icon' => '⚔️⚔️',
            'text' => 'Extra Damage',
            'data' => [
                'damage' => 2,
            ],
        ],
        [
            'icon' => '🛡️🛡️',
            'text' => 'Extra Defense',
            'data' => [
                'defense' => 2,
            ],
        ],
        [
            'icon' => '🪄🪄',
            'text' => 'Extra Magic',
            'data' => [
                'magic' => 2,
            ],
        ],
        [
            'icon' => '🥾🥾',
            'text' => 'Extra Speed',
            'data' => [
                'speed' => 2,
            ],
        ],
        [
            'icon' => '💱🪄️',
            'text' => 'Trade Physical for Magic',
            'data' => [
                'magic' => 4,
                'damage' => -1,
                'defense' => -1,
            ],
        ],
    ],
];
