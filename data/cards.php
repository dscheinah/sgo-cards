<?php

use App\Model\Card;

$healthTier1 = [
    'icon' => '❤️',
    'text' => 'Health',
    'data' => [
        'health' => 1,
    ],
    'tags' => [Card::HEALTH, Card::BASE],
];
$healthTier2 = [
    'icon' => '❤️❤️',
    'text' => 'Extra Health',
    'data' => [
        'health' => 2,
    ],
    'tags' => [Card::HEALTH, Card::BASE],
];
$healthTier3 = [
    'icon' => '💖️',
    'text' => 'Super Health',
    'data' => [
        'health' => 5,
    ],
    'tags' => [Card::HEALTH, Card::BASE],
];
$healthTier4 = [
    'icon' => '💖💖',
    'text' => 'Ultra Health',
    'data' => [
        'health' => 9,
    ],
    'tags' => [Card::HEALTH, Card::BASE],
];
$damageTier1 = [
    'icon' => '⚔️',
    'text' => 'Damage',
    'data' => [
        'damage' => 1,
    ],
    'tags' => [Card::DAMAGE, Card::BASE],
];
$damageTier2 = [
    'icon' => '⚔️⚔️',
    'text' => 'Extra Damage',
    'data' => [
        'damage' => 2,
    ],
    'tags' => [Card::DAMAGE, Card::BASE],
];
$damageTier3 = [
    'icon' => '🪓',
    'text' => 'Super Damage',
    'data' => [
        'damage' => 5,
    ],
    'tags' => [Card::DAMAGE, Card::BASE],
];
$damageTier4 = [
    'icon' => '🪓🪓',
    'text' => 'Ultra Damage',
    'data' => [
        'damage' => 9,
    ],
    'tags' => [Card::DAMAGE, Card::BASE],
];
$defenseTier1 = [
    'icon' => '🛡️',
    'text' => 'Defense',
    'data' => [
        'defense' => 1,
    ],
    'tags' => [Card::DEFENSE, Card::BASE],
];
$defenseTier2 = [
    'icon' => '🛡️🛡️',
    'text' => 'Extra Defense',
    'data' => [
        'defense' => 2,
    ],
    'tags' => [Card::DEFENSE, Card::BASE],
];
$defenseTier3 = [
    'icon' => '🪬',
    'text' => 'Super Defense',
    'data' => [
        'defense' => 5,
    ],
    'tags' => [Card::DEFENSE, Card::BASE],
];
$defenseTier4 = [
    'icon' => '🪬🪬',
    'text' => 'Ultra Defense',
    'data' => [
        'defense' => 9,
    ],
    'tags' => [Card::DEFENSE, Card::BASE],
];
$magicTier1 = [
    'icon' => '🪄️',
    'text' => 'Magic',
    'data' => [
        'magic' => 1,
    ],
    'tags' => [Card::MAGIC, Card::BASE],
];
$magicTier2 = [
    'icon' => '🪄️🪄️',
    'text' => 'Extra Magic',
    'data' => [
        'magic' => 2,
    ],
    'tags' => [Card::MAGIC, Card::BASE],
];
$magicTier3 = [
    'icon' => '🦄',
    'text' => 'Super Magic',
    'data' => [
        'magic' => 5,
    ],
    'tags' => [Card::MAGIC, Card::BASE],
];
$magicTier4 = [
    'icon' => '🦄🦄',
    'text' => 'Ultra Magic',
    'data' => [
        'magic' => 9,
    ],
    'tags' => [Card::MAGIC, Card::BASE],
];
$speedTier1 = [
    'icon' => '🥾',
    'text' => 'Speed',
    'data' => [
        'speed' => 1,
    ],
    'tags' => [Card::SPEED, Card::BASE],
];
$speedTier2 = [
    'icon' => '🥾🥾',
    'text' => 'Extra Speed',
    'data' => [
        'speed' => 2,
    ],
    'tags' => [Card::SPEED, Card::BASE],
];
$speedTier3 = [
    'icon' => '👟',
    'text' => 'Super Speed',
    'data' => [
        'speed' => 5,
    ],
    'tags' => [Card::SPEED, Card::BASE],
];
$speedTier4 = [
    'icon' => '👟👟',
    'text' => 'Ultra Speed',
    'data' => [
        'speed' => 9,
    ],
    'tags' => [Card::SPEED, Card::BASE],
];

$defenseAndDamage = [
    'icon' => '🛡️⚔️',
    'text' => 'Defense and Damage',
    'data' => [
        'defense' => 2,
        'damage' => 2,
    ],
    'league' => true,
    'tags' => [Card::DEFENSE, Card::DAMAGE, Card::BASE],
];
$defenseAndMagic = [
    'icon' => '🛡️🪄️',
    'text' => 'Defense and Magic',
    'data' => [
        'defense' => 2,
        'magic' => 1,
    ],
    'league' => true,
    'tags' => [Card::DEFENSE, Card::MAGIC, Card::BASE],
];
$defenseAndSpeed = [
    'icon' => '🛡️🥾️',
    'text' => 'Defense and Speed',
    'data' => [
        'defense' => 2,
        'speed' => 1,
    ],
    'league' => true,
    'tags' => [Card::DEFENSE, Card::SPEED, Card::BASE],
];
$damageAndMagic = [
    'icon' => '⚔️🪄️',
    'text' => 'Damage and Magic',
    'data' => [
        'damage' => 2,
        'magic' => 1,
    ],
    'league' => true,
    'tags' => [Card::DAMAGE, Card::MAGIC, Card::BASE],
];
$damageAndSpeed = [
    'icon' => '⚔️🥾',
    'text' => 'Damage and Speed',
    'data' => [
        'damage' => 2,
        'speed' => 1,
    ],
    'league' => true,
    'tags' => [Card::DAMAGE, Card::SPEED, Card::BASE],
];
$magicAndSpeed = [
    'icon' => '🪄️🥾',
    'text' => 'Magic and Speed',
    'data' => [
        'magic' => 1,
        'speed' => 1,
    ],
    'league' => true,
    'tags' => [Card::MAGIC, Card::SPEED, Card::BASE],
];

$tradeDefenseForDamage = [
    'icon' => '💱⚔️',
    'text' => 'Trade Defense for Damage',
    'data' => [
        'damage' => 2,
        'defense' => -1,
    ],
    'tags' => [Card::DAMAGE, Card::BASE],
];
$tradeDamageForDefense = [
    'icon' => '💱🛡️',
    'text' => 'Trade Damage for Defense',
    'data' => [
        'defense' => 2,
        'damage' => -1,
    ],
    'tags' => [Card::DEFENSE, Card::BASE],
];
$tradePhysicalForMagic = [
    'icon' => '💱🪄️',
    'text' => 'Trade Physical for Magic',
    'data' => [
        'magic' => 3,
        'damage' => -1,
        'defense' => -1,
    ],
    'tags' => [Card::MAGIC, Card::BASE],
];

$boostDefenseFromSpeed = [
    'icon' => '💨🛡️',
    'text' => 'Evasion',
    'modifier' => 'speed_as_defense',
    'league' => true,
    'data' => [
        'defense' => 2,
    ],
    'tags' => [Card::SPEED, Card::DEFENSE, Card::MODIFIER],
];
$boostMagicFromDefense = [
    'icon' => '🔮🪄️',
    'text' => 'Magic Shield',
    'modifier' => 'defense_as_magic',
    'league' => true,
    'data' => [
        'magic' => 2,
    ],
    'tags' => [Card::DEFENSE, Card::MAGIC, Card::MODIFIER],
];
$boostMagicFromSpeed = [
    'icon' => '🧚🪄️',
    'text' => 'Magic Boots',
    'modifier' => 'speed_as_magic',
    'league' => true,
    'data' => [
        'magic' => 2,
    ],
    'tags' => [Card::SPEED, Card::MAGIC, Card::MODIFIER],
];
$boostDamageFromDefense = [
    'icon' => '🥀⚔️',
    'text' => 'Thorns',
    'modifier' => 'defense_as_damage',
    'league' => true,
    'data' => [
        'damage' => 2,
    ],
    'tags' => [Card::DEFENSE, Card::DAMAGE, Card::MODIFIER],
];
$boostDamageFromMagic = [
    'icon' => '🔫⚔️',
    'text' => 'Enchanted Weapon',
    'modifier' => 'magic_as_damage',
    'league' => true,
    'data' => [
        'damage' => 2,
    ],
    'tags' => [Card::MAGIC, Card::DAMAGE, Card::MODIFIER],
];
$boostHealthFromDamage = [
    'icon' => '❣️',
    'text' => 'Leech',
    'modifier' => 'damage_as_health',
    'league' => true,
    'data' => [
        'health' => 2,
    ],
    'tags' => [Card::DAMAGE, Card::HEALTH, Card::MODIFIER],
];
$boostHealthFromMagic = [
    'icon' => '❤️‍🔥',
    'text' => 'Healing Spell',
    'modifier' => 'magic_as_health',
    'league' => true,
    'data' => [
        'health' => 2,
    ],
    'tags' => [Card::MAGIC, Card::HEALTH, Card::MODIFIER],
];

$buffDamage = [
    'icon' => '️️🔺⚔️',
    'text' => 'Buff Damage',
    'modifier' => 'add_damage',
    'tags' => [Card::DAMAGE, Card::MODIFIER],
];
$buffDefense = [
    'icon' => '🔺🛡️',
    'text' => 'Buff Defense',
    'modifier' => 'add_defense',
    'tags' => [Card::DEFENSE, Card::MODIFIER],
];
$buffMagic = [
    'icon' => '️️🔺🪄️',
    'text' => 'Buff Magic',
    'modifier' => 'add_magic',
    'tags' => [Card::MAGIC, Card::MODIFIER],
];
$curseDamage = [
    'icon' => '⚔️🔻',
    'text' => 'Curse Enemy Damage',
    'modifier' => 'remove_damage',
    'tags' => [Card::DAMAGE, Card::MODIFIER],
];
$curseDefense = [
    'icon' => '🛡️🔻',
    'text' => 'Curse Enemy Defense',
    'modifier' => 'remove_defense',
    'tags' => [Card::DEFENSE, Card::MODIFIER],
];
$curseMagic = [
    'icon' => '🪄️🔻',
    'text' => 'Curse Enemy Magic',
    'modifier' => 'remove_magic',
    'tags' => [Card::MAGIC, Card::MODIFIER],
];

$convertDamageToHealth = [
    'icon' => '⚔️💥',
    'text' => 'Convert Damage to Health',
    'modifier' => 'convert_damage_to_health',
    'league' => true,
    'tags' => [Card::DAMAGE, Card::HEALTH, Card::CONVERSION],
];
$convertDefenseToHealth = [
    'icon' => '🛡️💥️️',
    'text' => 'Convert Defense to Health',
    'modifier' => 'convert_defense_to_health',
    'league' => true,
    'tags' => [Card::DEFENSE, Card::HEALTH, Card::CONVERSION],
];
$convertMagicToHealth = [
    'icon' => '🪄️💥️️',
    'text' => 'Convert Magic to Health',
    'modifier' => 'convert_magic_to_health',
    'tags' => [Card::MAGIC, Card::HEALTH, Card::CONVERSION],
];
$convertSpeedToHealth = [
    'icon' => '🥾💥️',
    'text' => 'Convert Speed to Health',
    'modifier' => 'convert_speed_to_health',
    'tags' => [Card::SPEED, Card::HEALTH, Card::CONVERSION],
];
$convertAllToDamage = [
    'icon' => '💪️️',
    'text' => 'Berserker',
    'modifier' => 'convert_all_to_damage',
    'league' => true,
    'tags' => [Card::HEALTH, Card::DEFENSE, Card::MAGIC, Card::SPEED, Card::DAMAGE, Card::CONVERSION],
];

$increaseDamage = [
    'icon' => '️️⏫️️⚔️️',
    'text' => 'Increase Damage',
    'modifier' => 'more_damage',
    'tags' => [Card::DAMAGE, Card::MODIFIER],
];
$increaseDefense = [
    'icon' => '⏫️️🛡️',
    'text' => 'Increase Defense',
    'modifier' => 'more_defense',
    'tags' => [Card::DEFENSE, Card::MODIFIER],
];
$increaseMagic = [
    'icon' => '⏫️️🪄️️',
    'text' => 'Increase Magic',
    'modifier' => 'more_magic',
    'tags' => [Card::MAGIC, Card::MODIFIER],
];
$increaseSpeed = [
    'icon' => '⏫️️🥾️',
    'text' => 'Increase Speed',
    'modifier' => 'more_speed',
    'tags' => [Card::SPEED, Card::MODIFIER],
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
