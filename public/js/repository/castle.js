export async function rankings(userId) {
    const result = await fetch('castle/ranking?user_id=' + encodeURIComponent(userId || ''));
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}

export async function tournament() {
    const result = await fetch('castle/tournament');
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}

export async function results(userId) {
    if (!userId) {
        return null;
    }
    return [
        {
            win: 10,
            loose: 5,
            last: 13,
            current: 12,
        },
        {
            loose: 10,
            win: 5,
            last: 4,
            current: 4,
        },
    ];
}

export async function enemies(heroId) {
    return [
        {
            hero_id: heroId,
            enemy_id: 1,
            name: 'Tattersail',
            tiers: [
                {
                    health: 20,
                    damage: 10,
                    defense: 10,
                    magic: 10,
                    speed: 5,
                    curse: 0,
                },
                {
                    health: 50,
                    damage: 20,
                    defense: 20,
                    magic: 20,
                    speed: 5,
                    curse: 12,
                },
                {
                    health: 100,
                    damage: 50,
                    defense: 50,
                    magic: 20,
                    speed: 10,
                    curse: 12,
                },
            ],
            shrine: {icon: "🍂⛩️", text: "Shrine of Nature"},
            specialization: {icon: "🤺", name: "Warrior"},
        },
        {
            hero_id: heroId,
            enemy_id: 2,
            name: 'Weatherwax',
            tiers: [
                {
                    health: 10,
                    damage: 20,
                    defense: 30,
                    magic: 40,
                    speed: 50,
                    curse: 0,
                },
            ],
        },
        {
            hero_id: heroId,
            enemy_id: 3,
            name: 'Celebrimbor',
            tiers: [
                {
                    health: 20,
                    damage: 10,
                    defense: 10,
                    magic: 10,
                    speed: 0,
                    curse: 0,
                },
                {
                    health: 40,
                    damage: 20,
                    defense: 20,
                    magic: 10,
                    speed: 0,
                    curse: 24,
                },
            ],
            specialization: {icon: "🤺", name: "Warrior"},
        },
        {
            hero_id: heroId,
            enemy_id: 4,
            name: 'Beric',
            tiers: [
                {
                    health: 10,
                    damage: 20,
                    defense: 30,
                    magic: 40,
                    speed: 50,
                    curse: 60,
                }
            ],
            shrine: {icon: "🍂⛩️", text: "Shrine of Nature"},
        },
    ];
}

export async function training(heroId, enemyId) {
    return {
        hero_id: heroId,
        enemy_id: enemyId,
        tiers: [
            {winner: true, duration: 4},
            {winner: false, duration: 10},
            {winner: true, duration: 7},
        ],
        log: [{
            player_health: 22,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 40,
            player_real_magic: 0,
            enemy_health: 22,
            enemy_damage: 80,
            enemy_magic: 56,
            enemy_real_damage: 49,
            enemy_real_magic: 24
        }, {
            player_health: 22,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 40,
            player_real_magic: 0,
            enemy_health: 22,
            enemy_damage: 80,
            enemy_magic: 56,
            enemy_real_damage: 49,
            enemy_real_magic: 24
        }, {
            player_health: 22,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 40,
            player_real_magic: 0,
            enemy_health: 22,
            enemy_damage: 80,
            enemy_magic: 56,
            enemy_real_damage: 49,
            enemy_real_magic: 24
        }, {
            player_health: 22,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 40,
            player_real_magic: 0,
            enemy_health: 22,
            enemy_damage: 80,
            enemy_magic: 56,
            enemy_real_damage: 49,
            enemy_real_magic: 24
        }, {
            player_health: 22,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 40,
            player_real_magic: 0,
            enemy_health: 22,
            enemy_damage: 80,
            enemy_magic: 56,
            enemy_real_damage: 47,
            enemy_real_magic: 24
        }, {
            player_health: 15,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 40,
            player_real_magic: 0,
            enemy_health: 18,
            enemy_damage: 80,
            enemy_magic: 56,
            enemy_real_damage: 47,
            enemy_real_magic: 24
        }, {
            player_health: 15,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 39,
            player_real_magic: 0,
            enemy_health: 18,
            enemy_damage: 79,
            enemy_magic: 56,
            enemy_real_damage: 44,
            enemy_real_magic: 24
        }, {
            player_health: 8,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 39,
            player_real_magic: 0,
            enemy_health: 14,
            enemy_damage: 79,
            enemy_magic: 56,
            enemy_real_damage: 44,
            enemy_real_magic: 24
        }, {
            player_health: 8,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 40,
            player_real_magic: 0,
            enemy_health: 14,
            enemy_damage: 80,
            enemy_magic: 55,
            enemy_real_damage: 43,
            enemy_real_magic: 23
        }, {
            player_health: 1,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 40,
            player_real_magic: 0,
            enemy_health: 10,
            enemy_damage: 80,
            enemy_magic: 55,
            enemy_real_damage: 43,
            enemy_real_magic: 23
        }, {
            player_health: 1,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 0,
            player_real_magic: 0,
            enemy_health: 10,
            enemy_damage: 81,
            enemy_magic: 56,
            enemy_real_damage: 42,
            enemy_real_magic: 24
        }, {
            player_health: 0,
            player_damage: 40,
            player_magic: 32,
            player_real_damage: 0,
            player_real_magic: 0,
            enemy_health: 10,
            enemy_damage: 81,
            enemy_magic: 56,
            enemy_real_damage: 42,
            enemy_real_magic: 24
        }]
    }
}

export async function heroes(userId, heroId) {
    if (!userId) {
        return null;
    }
    return [
        {
            id: 1,
            name: 'Tattersail',
            tiers: [
                {
                    health: 20,
                    damage: 10,
                    defense: 10,
                    magic: 10,
                    speed: 5,
                    curse: 0,
                },
                {
                    health: 50,
                    damage: 20,
                    defense: 20,
                    magic: 20,
                    speed: 5,
                    curse: 12,
                },
                {
                    health: 100,
                    damage: 50,
                    defense: 50,
                    magic: 20,
                    speed: 10,
                    curse: 12,
                },
            ],
            shrine: {icon: "🍂⛩️", text: "Shrine of Nature"},
            specialization: {icon: "🤺", name: "Warrior"},
            active: heroId === 1,
        },
        {
            id: 2,
            name: 'Weatherwax',
            tiers: [
                {
                    health: 10,
                    damage: 20,
                    defense: 30,
                    magic: 40,
                    speed: 50,
                    curse: 0,
                },
            ],
            active: heroId === 2,
        },
        null,
    ];
}

export function hero(userId, heroId) {
    if (!userId) {
        return null;
    }
    switch (heroId) {
        case 1:
            return {
                hero_id: 1,
                name: 'Tattersail',
                modifier: 'more_player_defense',
                shrine: 'mist',
                specialization: 'assassin',
                base: {
                    health_1: {
                        icon: "\u2764\ufe0f",
                        text: "Health",
                        tags: ["health", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    damage_1: {
                        icon: "\u2694\ufe0f",
                        text: "Damage",
                        tags: ["damage", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    defense_1: {
                        icon: "\ud83d\udee1\ufe0f",
                        text: "Defense",
                        tags: ["defense", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    magic_1: {
                        icon: "\ud83e\ude84\ufe0f",
                        text: "Magic",
                        tags: ["magic", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    speed_1: {
                        icon: "\ud83e\udd7e",
                        text: "Speed",
                        tags: ["speed", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                },
                tier_1: {
                    buff_damage: {
                        icon: "\ufe0f\ufe0f\ud83d\udd3a\u2694\ufe0f",
                        text: "Buff Damage",
                        tags: ["damage", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    buff_defense: {
                        icon: "\ud83d\udd3a\ud83d\udee1\ufe0f",
                        text: "Buff Defense",
                        tags: ["defense", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    buff_magic: {
                        icon: "\ufe0f\ufe0f\ud83d\udd3a\ud83e\ude84\ufe0f",
                        text: "Buff Magic",
                        tags: ["magic", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    trade_damage: {
                        icon: "\ud83d\udcb1\u2694\ufe0f",
                        text: "Trade Defense for Damage",
                        tags: ["damage", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    trade_defense: {
                        icon: "\ud83d\udcb1\ud83d\udee1\ufe0f",
                        text: "Trade Damage for Defense",
                        tags: ["defense", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    damage_magic: {
                        icon: "\u2694\ufe0f\ud83e\ude84\ufe0f",
                        text: "Damage and Magic",
                        tags: ["damage", "magic", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    damage_speed: {
                        icon: "\u2694\ufe0f\ud83e\udd7e",
                        text: "Damage and Speed",
                        tags: ["damage", "speed", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    magic_speed: {
                        icon: "\ud83e\ude84\ufe0f\ud83e\udd7e",
                        text: "Magic and Speed",
                        tags: ["magic", "speed", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    health_2: {
                        icon: "\u2764\ufe0f\u2764\ufe0f",
                        text: "Extra Health",
                        tags: ["health", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    damage_2: {
                        icon: "\u2694\ufe0f\u2694\ufe0f",
                        text: "Extra Damage",
                        tags: ["damage", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    defense_2: {
                        icon: "\ud83d\udee1\ufe0f\ud83d\udee1\ufe0f",
                        text: "Extra Defense",
                        tags: ["defense", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    magic_2: {
                        icon: "\ud83e\ude84\ufe0f\ud83e\ude84\ufe0f",
                        text: "Extra Magic",
                        tags: ["magic", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    speed_2: {
                        icon: "\ud83e\udd7e\ud83e\udd7e",
                        text: "Extra Speed",
                        tags: ["speed", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    evasion: {
                        icon: "\ud83d\udca8\ud83d\udee1\ufe0f",
                        text: "Evasion",
                        tags: ["speed", "defense", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    magic_boots: {
                        icon: "\ud83e\uddda\ud83e\ude84\ufe0f",
                        text: "Magic Boots",
                        tags: ["speed", "magic", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                },
                tier_2: {
                    curse_damage: {
                        icon: "\u2694\ufe0f\ud83d\udd3b",
                        text: "Curse Enemy Damage",
                        tags: ["damage", "curse"],
                        amount: Math.round(Math.random() * 2),
                    },
                    curse_defense: {
                        icon: "\ud83d\udee1\ufe0f\ud83d\udd3b",
                        text: "Curse Enemy Defense",
                        tags: ["defense", "curse"],
                        amount: Math.round(Math.random() * 2),
                    },
                    curse_magic: {
                        icon: "\ud83e\ude84\ufe0f\ud83d\udd3b",
                        text: "Curse Enemy Magic",
                        tags: ["magic", "curse"],
                        amount: Math.round(Math.random() * 2),
                    },
                    trade_magic: {
                        icon: "\ud83d\udcb1\ud83e\ude84\ufe0f",
                        text: "Trade Physical for Magic",
                        tags: ["magic", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    defense_damage: {
                        icon: "\ud83d\udee1\ufe0f\u2694\ufe0f",
                        text: "Defense and Damage",
                        tags: ["defense", "damage", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    defense_magic: {
                        icon: "\ud83d\udee1\ufe0f\ud83e\ude84\ufe0f",
                        text: "Defense and Magic",
                        tags: ["defense", "magic", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    defense_speed: {
                        icon: "\ud83d\udee1\ufe0f\ud83e\udd7e\ufe0f",
                        text: "Defense and Speed",
                        tags: ["defense", "speed", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    more_damage: {
                        icon: "\ufe0f\ufe0f\u23eb\ufe0f\ufe0f\u2694\ufe0f\ufe0f",
                        text: "Increase Damage",
                        tags: ["damage", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    more_defense: {
                        icon: "\u23eb\ufe0f\ufe0f\ud83d\udee1\ufe0f",
                        text: "Increase Defense",
                        tags: ["defense", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    more_speed: {
                        icon: "\u23eb\ufe0f\ufe0f\ud83e\udd7e\ufe0f",
                        text: "Increase Speed",
                        tags: ["speed", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    convert_damage_health: {
                        icon: "\u2694\ufe0f\ud83d\udca5",
                        text: "Convert Damage to Health",
                        tags: ["damage", "health", "conversion"],
                        amount: Math.round(Math.random() * 2),
                    },
                    convert_defense_health: {
                        icon: "\ud83d\udee1\ufe0f\ud83d\udca5\ufe0f\ufe0f",
                        text: "Convert Defense to Health",
                        tags: ["defense", "health", "conversion"],
                        amount: Math.round(Math.random() * 2),
                    },
                },
                tier_3: {
                    health_3: {
                        icon: "\ud83d\udc96\ufe0f",
                        text: "Super Health",
                        tags: ["health", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    damage_3: {
                        icon: "\ud83e\ude93",
                        text: "Super Damage",
                        tags: ["damage", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    defense_3: {
                        icon: "\ud83e\udeac",
                        text: "Super Defense",
                        tags: ["defense", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    magic_3: {
                        icon: "\ud83e\udd84",
                        text: "Super Magic",
                        tags: ["magic", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    speed_3: {
                        icon: "\ud83d\udc5f",
                        text: "Super Speed",
                        tags: ["speed", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    thorns: {
                        icon: "\ud83e\udd40\u2694\ufe0f",
                        text: "Thorns",
                        tags: ["defense", "damage", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    magic_shield: {
                        icon: "\ud83d\udd2e\ud83e\ude84\ufe0f",
                        text: "Magic Shield",
                        tags: ["defense", "magic", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    convert_magic_health: {
                        icon: "\ud83e\ude84\ufe0f\ud83d\udca5\ufe0f\ufe0f",
                        text: "Convert Magic to Health",
                        tags: ["magic", "health", "conversion"],
                        amount: Math.round(Math.random() * 2),
                    },
                    convert_speed_health: {
                        icon: "\ud83e\udd7e\ud83d\udca5\ufe0f",
                        text: "Convert Speed to Health",
                        tags: ["speed", "health", "conversion"],
                        amount: Math.round(Math.random() * 2),
                    },
                    more_magic: {
                        icon: "\u23eb\ufe0f\ufe0f\ud83e\ude84\ufe0f\ufe0f",
                        text: "Increase Magic",
                        tags: ["magic", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    enchanted_weapon: {
                        icon: "\ud83d\udd2b\u2694\ufe0f",
                        text: "Enchanted Weapon",
                        tags: ["magic", "damage", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    berserker: {
                        icon: "\ud83d\udcaa\ufe0f\ufe0f",
                        text: "Berserker",
                        tags: ["health", "defense", "magic", "speed", "damage", "conversion"],
                        amount: Math.round(Math.random() * 2),
                    },
                },
                final: {
                    damage_4: {
                        icon: "\ud83e\ude93\ud83e\ude93",
                        text: "Ultra Damage",
                        tags: ["damage", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    defense_4: {
                        icon: "\ud83e\udeac\ud83e\udeac",
                        text: "Ultra Defense",
                        tags: ["defense", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    magic_4: {
                        icon: "\ud83e\udd84\ud83e\udd84",
                        text: "Ultra Magic",
                        tags: ["magic", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    speed_4: {
                        icon: "\ud83d\udc5f\ud83d\udc5f",
                        text: "Ultra Speed",
                        tags: ["speed", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    health_4: {
                        icon: "\ud83d\udc96\ud83d\udc96",
                        text: "Ultra Health",
                        tags: ["health", "base"],
                        amount: Math.round(Math.random() * 2),
                    },
                    leech: {
                        icon: "\u2763\ufe0f",
                        text: "Leech",
                        tags: ["damage", "health", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    },
                    healing_spell: {
                        icon: "\u2764\ufe0f\u200d\ud83d\udd25",
                        text: "Healing Spell",
                        tags: ["magic", "health", "modifier"],
                        amount: Math.round(Math.random() * 2),
                    }
                },
            };
        case 2:
            return {
                hero_id: 2,
                name: 'Weatherwax',
                base: {
                    health_1: {
                        icon: "\u2764\ufe0f",
                        text: "Health",
                        tags: ["health", "base"],
                        amount: 0,
                    },
                    damage_1: {
                        icon: "\u2694\ufe0f",
                        text: "Damage",
                        tags: ["damage", "base"],
                        amount: 0,
                    },
                    defense_1: {
                        icon: "\ud83d\udee1\ufe0f",
                        text: "Defense",
                        tags: ["defense", "base"],
                        amount: 0,
                    },
                    magic_1: {
                        icon: "\ud83e\ude84\ufe0f",
                        text: "Magic",
                        tags: ["magic", "base"],
                        amount: 0,
                    },
                    speed_1: {
                        icon: "\ud83e\udd7e",
                        text: "Speed",
                        tags: ["speed", "base"],
                        amount: 0,
                    },
                },
                tier_1: {
                    buff_damage: {
                        icon: "\ufe0f\ufe0f\ud83d\udd3a\u2694\ufe0f",
                        text: "Buff Damage",
                        tags: ["damage", "modifier"],
                        amount: 0,
                    },
                    buff_defense: {
                        icon: "\ud83d\udd3a\ud83d\udee1\ufe0f",
                        text: "Buff Defense",
                        tags: ["defense", "modifier"],
                        amount: 0,
                    },
                    buff_magic: {
                        icon: "\ufe0f\ufe0f\ud83d\udd3a\ud83e\ude84\ufe0f",
                        text: "Buff Magic",
                        tags: ["magic", "modifier"],
                        amount: 0,
                    },
                },
            };
    }
    return {
        name: '',
        base: {
            health_1: {
                icon: "\u2764\ufe0f",
                text: "Health",
                tags: ["health", "base"],
                amount: 0,
            },
            damage_1: {
                icon: "\u2694\ufe0f",
                text: "Damage",
                tags: ["damage", "base"],
                amount: 0,
            },
            defense_1: {
                icon: "\ud83d\udee1\ufe0f",
                text: "Defense",
                tags: ["defense", "base"],
                amount: 0,
            },
            magic_1: {
                icon: "\ud83e\ude84\ufe0f",
                text: "Magic",
                tags: ["magic", "base"],
                amount: 0,
            },
            speed_1: {
                icon: "\ud83e\udd7e",
                text: "Speed",
                tags: ["speed", "base"],
                amount: 0,
            },
        },
    };
}

export function modifiers(userId) {
    if (!userId) {
        return null;
    }
    return [
        {
            identifier: 'more_player_damage',
            text: 'More global Damage',
        },
        {
            identifier: 'more_player_defense',
            text: 'More global Defense',
        },
        {
            identifier: 'more_player_magic',
            text: 'More global Magic',
        },
        {
            identifier: 'more_player_speed',
            text: 'More global Speed',
        },
    ];
}

export function shrines(userId) {
    if (!userId) {
        return null;
    }
    return [
        {
            identifier: 'fire',
            text: 'Shrine of Fire',
            icon: '🔥⛩️',
            description: 'Increase offensive Magic',
        },
        {
            identifier: 'ice',
            text: 'Shrine of Ice',
            icon: '️❄️⛩️',
            description: 'Require additional Speed',
        },
        {
            identifier: 'mist',
            text: 'Shrine of Mist',
            icon: '☁️⛩️️',
            description: 'Chance to miss Damage',
        },
        {
            identifier: 'nature',
            text: 'Shrine of Nature',
            icon: '🍂⛩️',
            description: 'Poison based on Health',
        },
    ];
}

export function specializations(userId) {
    if (!userId) {
        return null;
    }
    return [
        {
            identifier: 'rogue',
            icon: '🗡️️',
            name: 'Rogue',
            description: 'You never know what he does',
        },
        {
            identifier: 'cleric',
            icon: '📿',
            name: 'Cleric',
            description: 'Increase Health',
        },
        {
            identifier: 'assassin',
            icon: '🥷',
            name: 'Assassin',
            description: 'Faster and deadlier than average',
        },
        {
            identifier: 'necromancer',
            icon: '💀',
            name: 'Necro',
            description: 'Summons damaging undead every round',
        },
    ];
}

export function save(userId, heroId, data) {
}
