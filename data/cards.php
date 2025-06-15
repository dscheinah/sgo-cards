<?php
$healthTier1 = [
    'icon' => '❤️',
    'text' => 'Health',
    'data' => [
        'health' => 1,
    ],
];
$healthTier2 = [
    'icon' => '❤️❤️',
    'text' => 'Extra Health',
    'data' => [
        'health' => 2,
    ],
];
$healthTier3 = [
    'icon' => '❤️❤️❤️',
    'text' => 'Super Health',
    'data' => [
        'health' => 5,
    ],
];
$healthTier4 = [
    'icon' => '💖',
    'text' => 'Ultra Health',
    'data' => [
        'health' => 9,
    ],
];
$damageTier1 = [
    'icon' => '⚔️',
    'text' => 'Damage',
    'data' => [
        'damage' => 1,
    ],
];
$damageTier2 = [
    'icon' => '⚔️⚔️',
    'text' => 'Extra Damage',
    'data' => [
        'damage' => 2,
    ],
];
$damageTier3 = [
    'icon' => '⚔️⚔️⚔️',
    'text' => 'Super Damage',
    'data' => [
        'damage' => 5,
    ],
];
$damageTier4 = [
    'icon' => '🪓',
    'text' => 'Ultra Damage',
    'data' => [
        'damage' => 9,
    ],
];
$defenseTier1 = [
    'icon' => '🛡️',
    'text' => 'Defense',
    'data' => [
        'defense' => 1,
    ],
];
$defenseTier2 = [
    'icon' => '🛡️🛡️',
    'text' => 'Extra Defense',
    'data' => [
        'defense' => 2,
    ],
];
$defenseTier3 = [
    'icon' => '🛡️🛡️🛡️',
    'text' => 'Super Defense',
    'data' => [
        'defense' => 5,
    ],
];
$defenseTier4 = [
    'icon' => '🪬',
    'text' => 'Ultra Defense',
    'data' => [
        'defense' => 9,
    ],
];
$magicTier1 = [
    'icon' => '🪄️',
    'text' => 'Magic',
    'data' => [
        'magic' => 1,
    ],
];
$magicTier2 = [
    'icon' => '🪄️🪄️',
    'text' => 'Extra Magic',
    'data' => [
        'magic' => 2,
    ],
];
$magicTier3 = [
    'icon' => '🪄️🪄️🪄️',
    'text' => 'Super Magic',
    'data' => [
        'magic' => 5,
    ],
];
$magicTier4 = [
    'icon' => '🦄',
    'text' => 'Ultra Magic',
    'data' => [
        'magic' => 9,
    ],
];
$speedTier1 = [
    'icon' => '🥾',
    'text' => 'Speed',
    'data' => [
        'speed' => 1,
    ],
];
$speedTier2 = [
    'icon' => '🥾🥾',
    'text' => 'Extra Speed',
    'data' => [
        'speed' => 2,
    ],
];
$speedTier3 = [
    'icon' => '🥾🥾🥾',
    'text' => 'Super Speed',
    'data' => [
        'speed' => 5,
    ],
];
$speedTier4 = [
    'icon' => '👟',
    'text' => 'Ultra Speed',
    'data' => [
        'speed' => 9,
    ],
];

$defenseAndDamage = [
    'icon' => '🛡️⚔️',
    'text' => 'Defense and Damage',
    'data' => [
        'defense' => 2,
        'damage' => 2,
    ],
    'league' => true,
];
$defenseAndMagic = [
    'icon' => '🛡️🪄️',
    'text' => 'Defense and Magic',
    'data' => [
        'defense' => 2,
        'magic' => 1,
    ],
    'league' => true,
];
$defenseAndSpeed = [
    'icon' => '🛡️🥾️',
    'text' => 'Defense and Speed',
    'data' => [
        'defense' => 2,
        'speed' => 1,
    ],
    'league' => true,
];
$damageAndMagic = [
    'icon' => '⚔️🪄️',
    'text' => 'Damage and Magic',
    'data' => [
        'damage' => 2,
        'magic' => 1,
    ],
    'league' => true,
];
$damageAndSpeed = [
    'icon' => '⚔️🥾',
    'text' => 'Damage and Speed',
    'data' => [
        'damage' => 2,
        'speed' => 1,
    ],
    'league' => true,
];
$magicAndSpeed = [
    'icon' => '🪄️🥾',
    'text' => 'Magic and Speed',
    'data' => [
        'magic' => 1,
        'speed' => 1,
    ],
    'league' => true,
];

$tradeDefenseForDamage = [
    'icon' => '💱⚔️',
    'text' => 'Trade Defense for Damage',
    'data' => [
        'damage' => 2,
        'defense' => -1,
    ],
];
$tradeDamageForDefense = [
    'icon' => '💱🛡️',
    'text' => 'Trade Damage for Defense',
    'data' => [
        'defense' => 2,
        'damage' => -1,
    ]
];
$tradePhysicalForMagic = [
    'icon' => '💱🪄️',
    'text' => 'Trade Physical for Magic',
    'data' => [
        'magic' => 3,
        'damage' => -1,
        'defense' => -1,
    ],
];

$boostDefenseFromSpeed = [
    'icon' => '💨🛡️',
    'text' => 'Evasion',
    'modifier' => 'speed_as_defense',
    'league' => true,
    'data' => [
        'defense' => 2,
    ],
];
$boostMagicFromDefense = [
    'icon' => '🔮🪄️',
    'text' => 'Magic Shield',
    'modifier' => 'defense_as_magic',
    'league' => true,
    'data' => [
        'magic' => 2,
    ],
];
$boostMagicFromSpeed = [
    'icon' => '🧚🪄️',
    'text' => 'Magic Boots',
    'modifier' => 'speed_as_magic',
    'league' => true,
    'data' => [
        'magic' => 2,
    ],
];
$boostDamageFromDefense = [
    'icon' => '🥀⚔️',
    'text' => 'Thorns',
    'modifier' => 'defense_as_damage',
    'league' => true,
    'data' => [
        'damage' => 2,
    ],
];
$boostDamageFromMagic = [
    'icon' => '🔫⚔️',
    'text' => 'Enchanted Weapon',
    'modifier' => 'magic_as_damage',
    'league' => true,
    'data' => [
        'damage' => 2,
    ],
];
$boostHealthFromDamage = [
    'icon' => '❣️',
    'text' => 'Leech',
    'modifier' => 'damage_as_health',
    'league' => true,
    'data' => [
        'health' => 2,
    ],
];
$boostHealthFromMagic = [
    'icon' => '❤️‍🔥',
    'text' => 'Healing Spell',
    'modifier' => 'magic_as_health',
    'league' => true,
    'data' => [
        'health' => 2,
    ],
];

$buffDamage = [
    'icon' => '️️🔺⚔️',
    'text' => 'Buff Damage',
    'modifier' => 'add_damage',
];
$buffDefense = [
    'icon' => '🔺🛡️',
    'text' => 'Buff Defense',
    'modifier' => 'add_defense',
];
$buffMagic = [
    'icon' => '️️🔺🪄️',
    'text' => 'Buff Magic',
    'modifier' => 'add_magic',
];
$curseDamage = [
    'icon' => '⚔️🔻',
    'text' => 'Curse Enemy Damage',
    'modifier' => 'remove_damage',
];
$curseDefense = [
    'icon' => '🛡️🔻',
    'text' => 'Curse Enemy Defense',
    'modifier' => 'remove_defense',
];
$curseMagic = [
    'icon' => '🪄️🔻',
    'text' => 'Curse Enemy Magic',
    'modifier' => 'remove_magic',
];

$convertDamageToHealth = [
    'icon' => '💥⚔️❤️️',
    'text' => 'Convert Damage to Health',
    'modifier' => 'convert_damage_to_health',
    'league' => true,
];
$convertDefenseToHealth = [
    'icon' => '💥🛡️️❤️️',
    'text' => 'Convert Defense to Health',
    'modifier' => 'convert_defense_to_health',
    'league' => true,
];
$convertMagicToHealth = [
    'icon' => '💥🪄️❤️️',
    'text' => 'Convert Magic to Health',
    'modifier' => 'convert_magic_to_health',
];
$convertSpeedToHealth = [
    'icon' => '💥🥾❤️',
    'text' => 'Convert Speed to Health',
    'modifier' => 'convert_speed_to_health',
];
$convertAllToDamage = [
    'icon' => '💥💪️️⚔️',
    'text' => 'Berserker',
    'modifier' => 'convert_all_to_damage',
    'league' => true,
];

$increaseDamage = [
    'icon' => '️️⏫️️⚔️️',
    'text' => 'Increase Damage',
    'modifier' => 'more_damage',
];
$increaseDefense = [
    'icon' => '⏫️️🛡️',
    'text' => 'Increase Defense',
    'modifier' => 'more_defense',
];
$increaseMagic = [
    'icon' => '⏫️️🪄️️',
    'text' => 'Increase Magic',
    'modifier' => 'more_magic',
];
$increaseSpeed = [
    'icon' => '⏫️️🥾️',
    'text' => 'Increase Speed',
    'modifier' => 'more_speed',
];

return [
    [
        $healthTier1,
        $damageTier1,
        $defenseTier1,
        $magicTier1,
        $speedTier1,
    ],
    [
        $buffDamage,
        $buffDefense,
        $buffMagic,
        $tradeDefenseForDamage,
        $tradeDamageForDefense,
        $damageAndMagic,
        $damageAndSpeed,
        $magicAndSpeed,
    ],
    [
        $healthTier2,
        $damageTier2,
        $defenseTier2,
        $magicTier2,
        $speedTier2,
        $boostDefenseFromSpeed,
        $boostMagicFromSpeed,
    ],
    [
        $curseDamage,
        $curseDefense,
        $curseMagic,
        $tradePhysicalForMagic,
        $defenseAndDamage,
        $defenseAndMagic,
        $defenseAndSpeed,
    ],
    [
        $increaseDamage,
        $increaseDefense,
        $increaseSpeed,
        $convertDamageToHealth,
        $convertDefenseToHealth,
    ],
    [
        $healthTier3,
        $damageTier3,
        $defenseTier3,
        $magicTier3,
        $speedTier3,
        $boostDamageFromDefense,
        $boostMagicFromDefense,
    ],
    [
        $convertMagicToHealth,
        $convertSpeedToHealth,
        $increaseMagic,
        $boostDamageFromMagic,
        $convertAllToDamage,
    ],
    [
        $damageTier4,
        $defenseTier4,
        $magicTier4,
        $speedTier4,
        $healthTier4,
        $boostHealthFromDamage,
        $boostHealthFromMagic,
    ],
];
