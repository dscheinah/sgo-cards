<?php
return [
    [
        [
            'icon' => '❤️',
            'text' => 'Health',
            'health' => 2,
        ],
        [
            'icon' => '⚔️',
            'text' => 'Damage',
            'damage' => 1,
        ],
        [
            'icon' => '🛡️',
            'text' => 'Defense',
            'defense' => 1,
        ],
        [
            'icon' => '🪄',
            'text' => 'Magic',
            'magic' => 1,
        ],
        [
            'icon' => '🥾',
            'text' => 'Speed',
            'speed' => 1,
        ],
        [
            'icon' => '💱⚔️',
            'text' => 'Trade Defense for Damage',
            'damage' => 2,
            'defense' => -1,
        ],
        [
            'icon' => '💱🛡️',
            'text' => 'Trade Damage for Defense',
            'defense' => 2,
            'damage' => -1,
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
            'health' => 5,
        ],
        [
            'icon' => '⚔️⚔️',
            'text' => 'Extra Damage',
            'damage' => 2,
        ],
        [
            'icon' => '🛡️🛡️',
            'text' => 'Extra Defense',
            'defense' => 2,
        ],
        [
            'icon' => '🪄🪄',
            'text' => 'Extra Magic',
            'magic' => 2,
        ],
        [
            'icon' => '🥾🥾',
            'text' => 'Extra Speed',
            'speed' => 2,
        ],
        [
            'icon' => '💱🪄️',
            'text' => 'Trade Physical for Magic',
            'magic' => 4,
            'damage' => -1,
            'defense' => -1,
        ],
    ],
];
