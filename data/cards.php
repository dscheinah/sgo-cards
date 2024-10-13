<?php
return [
    [
        [
            'icon' => '❤️',
            'text' => 'Health',
            'data' => [
                'health' => 3,
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
            'icon' => '🪄️',
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
    ],
    [
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
        [
            'icon' => '💱🪄️',
            'text' => 'Trade Physical for Magic',
            'data' => [
                'magic' => 3,
                'damage' => -1,
                'defense' => -1,
            ],
        ],
        [
            'icon' => '💨',
            'text' => 'Evasion',
            'modifier' => 'speed_as_defense',
            'league' => true,
        ],
        [
            'icon' => '🧚🛡️',
            'text' => 'Magic Shield',
            'modifier' => 'defense_as_magic',
            'league' => true,
        ],
        [
            'icon' => '🧚🥾',
            'text' => 'Magic Boots',
            'modifier' => 'speed_as_magic',
            'league' => true,
        ],
    ],
    [
        [
            'icon' => '❤️❤️',
            'text' => 'Extra Health',
            'data' => [
                'health' => 6,
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
            'icon' => '🪄️🪄️',
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
            'icon' => '🛡️⚔️',
            'text' => 'Defense and Damage',
            'data' => [
                'defense' => 1,
                'damage' => 1,
            ],
            'league' => true,
        ],
        [
            'icon' => '🛡️🪄️',
            'text' => 'Defense and Magic',
            'data' => [
                'defense' => 1,
                'magic' => 1,
            ],
            'league' => true,
        ],
        [
            'icon' => '🛡️🥾️',
            'text' => 'Defense and Speed',
            'data' => [
                'defense' => 1,
                'speed' => 1,
            ],
            'league' => true,
        ],
    ],
    [
        [
            'icon' => '️️🔺⚔️',
            'text' => 'Buff Damage',
            'modifier' => 'add_damage',
        ],
        [
            'icon' => '🔺🛡️',
            'text' => 'Buff Defense',
            'modifier' => 'add_defense',
        ],
        [
            'icon' => '️️🔺🪄️',
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
            'icon' => '🪄️🔻',
            'text' => 'Curse Enemy Magic',
            'modifier' => 'remove_magic',
        ],
        [
            'icon' => '⚔️🪄️',
            'text' => 'Damage and Magic',
            'data' => [
                'damage' => 1,
                'magic' => 1,
            ],
            'league' => true,
        ],
        [
            'icon' => '⚔️🥾',
            'text' => 'Damage and Speed',
            'data' => [
                'damage' => 1,
                'speed' => 1,
            ],
            'league' => true,
        ],
        [
            'icon' => '🪄️🥾',
            'text' => 'Magic and Speed',
            'data' => [
                'magic' => 1,
                'speed' => 1,
            ],
            'league' => true,
        ],
    ],
    [
        [
            'icon' => '❤️❤️❤️',
            'text' => 'Super Health',
            'data' => [
                'health' => 9,
            ],
        ],
        [
            'icon' => '⚔️⚔️⚔️',
            'text' => 'Super Damage',
            'data' => [
                'damage' => 4,
            ],
        ],
        [
            'icon' => '🛡️🛡️🛡️',
            'text' => 'Super Defense',
            'data' => [
                'defense' => 4,
            ],
        ],
        [
            'icon' => '🪄️🪄️🪄️',
            'text' => 'Super Magic',
            'data' => [
                'magic' => 4,
            ],
        ],
        [
            'icon' => '🥾🥾🥾',
            'text' => 'Super Speed',
            'data' => [
                'speed' => 4,
            ],
        ],
        [
            'icon' => '🥀🛡️⚔️',
            'text' => 'Thorns',
            'modifier' => 'defense_as_damage',
            'league' => true,
        ],
        [
            'icon' => '🔫🪄️⚔️',
            'text' => 'Enchanted Weapon',
            'modifier' => 'magic_as_damage',
            'league' => true,
        ],
    ],
    [
        [
            'icon' => '💥🪄️❤️️',
            'text' => 'Convert Magic to Health',
            'modifier' => 'convert_magic_to_health',
        ],
        [
            'icon' => '💥🥾❤️',
            'text' => 'Convert Speed to Health',
            'modifier' => 'convert_speed_to_health',
        ],
        [
            'icon' => '️️⏫️️⚔️️',
            'text' => 'Increase Damage',
            'modifier' => 'more_damage',
        ],
        [
            'icon' => '⏫️️🛡️',
            'text' => 'Increase Defense',
            'modifier' => 'more_defense',
        ],
        [
            'icon' => '❣️⚔️',
            'text' => 'Leech',
            'modifier' => 'damage_as_health',
            'league' => true,
        ],
        [
            'icon' => '❤️‍🔥🪄️',
            'text' => 'Healing Spell',
            'modifier' => 'magic_as_health',
            'league' => true,
        ],
    ],
    [
        [
            'icon' => '🪓',
            'text' => 'Ultra Damage',
            'data' => [
                'damage' => 8,
            ],
        ],
        [
            'icon' => '🪬',
            'text' => 'Ultra Defense',
            'data' => [
                'defense' => 8,
            ],
        ],
        [
            'icon' => '🦄',
            'text' => 'Ultra Magic',
            'data' => [
                'magic' => 8,
            ],
        ],
        [
            'icon' => '👟',
            'text' => 'Ultra Speed',
            'data' => [
                'speed' => 8,
            ],
        ],
        [
            'icon' => '💖',
            'text' => 'Ultra Health',
            'data' => [
                'health' => 12,
            ],
            'league' => true,
        ],
        [
            'icon' => '💪',
            'text' => 'Berserker',
            'modifier' => 'convert_all_to_damage',
            'league' => true,
        ],
    ],
];
