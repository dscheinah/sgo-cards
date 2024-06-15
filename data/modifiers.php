<?php
return [
    'increase_damage' => [
        'damage' => 1.5,
        'multiplicative' => true,
        'player' => true,
        'text' => 'Increased global Damage',
    ],
    'increase_defense' => [
        'defense' => 1.5,
        'multiplicative' => true,
        'player' => true,
        'text' => 'Increased global Defense',
    ],
    'increase_magic' => [
        'magic' => 1.5,
        'multiplicative' => true,
        'player' => true,
        'text' => 'Increased global Magic',
    ],
    'increase_speed' => [
        'speed' => 1.5,
        'multiplicative' => true,
        'player' => true,
        'text' => 'Increased global Speed',
    ],
    'reduce_damage' => [
        'damage' => 0.5,
        'multiplicative' => true,
        'world' => true,
        'text' => 'Reduced global Damage',
    ],
    'reduce_defense' => [
        'defense' => 0.5,
        'multiplicative' => true,
        'world' => true,
        'text' => 'Reduced global Defense',
    ],
    'reduce_magic' => [
        'magic' => 0.5,
        'multiplicative' => true,
        'world' => true,
        'text' => 'Reduced global Magic',
    ],
    'reduce_speed' => [
        'speed' => 0.5,
        'multiplicative' => true,
        'world' => true,
        'text' => 'Reduced global Speed',
    ],
    'increase_modifiers' => [
        'modifiers' => 2,
        'world' => true,
        'text' => 'Increased global Buff and Curse effectivity',
    ],
    'reduce_modifiers' => [
        'modifiers' => 0.5,
        'world' => true,
        'text' => 'Reduced global Buff and Curse effectivity',
    ],
    'add_damage' => [
        'damage' => 1,
        'self' => true,
        'text' => 'Increase Damage by 1',
    ],
    'add_defense' => [
        'defense' => 1,
        'self' => true,
        'text' => 'Increase Defense by 1',
    ],
    'add_magic' => [
        'magic' => 1,
        'self' => true,
        'text' => 'Increase Magic by 1',
    ],
    'remove_damage' => [
        'damage' => -1,
        'enemy' => true,
        'text' => 'Reduce Damage by 1',
    ],
    'remove_defense' => [
        'defense' => -1,
        'enemy' => true,
        'text' => 'Reduce Defense by 1',
    ],
    'remove_magic' => [
        'magic' => -1,
        'enemy' => true,
        'text' => 'Reduce Magic by 1',
    ],
];
