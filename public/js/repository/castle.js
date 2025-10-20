export async function rankings(userId) {
    if (userId) {
        return [
            [
                '1. Logen',
                '2. Mandragoran',
                '3. Mill',
                '...',
                '11. Anomander',
                '12. Kholin',
                '13. Beric',
            ],
            [
                '1. Logen',
                '2. Mandragoran',
                '3. Mill',
                '4. Kholin',
                '5. Emhyr',
            ],
            [
                '1. Logen',
                '2. Emhyr',
                '3. Mill',
            ],
        ];
    }
    return [
        [
            '1. Logen',
            '2. Mandragoran',
            '3. Mill',
        ],
        [
            '1. Logen',
            '2. Mandragoran',
            '3. Mill',
        ],
        [
            '1. Logen',
            '2. Emhyr',
            '3. Mill',
        ],
    ];
}

export async function tournament() {
    return {
        modifier: {text: "More global Buff and Curse effectivity"},
        area: {icon: "🕳️", name: "Trapped Dungeons", description: "Reflect back the dealt Damage."},
        hours: 112,
    }
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
            health: 100,
            damage: 50,
            defense: 50,
            magic: 20,
            speed: 10,
            curse: -12,
            shrine: {icon: "🍂⛩️", text: "Shrine of Nature"},
            specialization: {icon: "🤺", name: "Warrior"},
        },
        {
            hero_id: heroId,
            enemy_id: 2,
            name: 'Weatherwax',
            health: 10,
            damage: 20,
            defense: 30,
            magic: 40,
            speed: 50,
            curse: 0,
        },
        {
            hero_id: heroId,
            enemy_id: 3,
            name: 'Celebrimbor',
            health: 40,
            damage: 20,
            defense: 20,
            magic: 10,
            speed: 0,
            curse: -24,
            specialization: {icon: "🤺", name: "Warrior"},
        },
        {
            hero_id: heroId,
            enemy_id: 4,
            name: 'Beric',
            health: 10,
            damage: 20,
            defense: 30,
            magic: 40,
            speed: 50,
            curse: -60,
            shrine: {icon: "🍂⛩️", text: "Shrine of Nature"},
        },
    ];
}

export async function training(heroId, enemyId) {
    return {
        hero_id: heroId,
        enemy_id: enemyId,
        winner: false,
        duration: 4,
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
            health: 100,
            damage: 50,
            defense: 50,
            magic: 20,
            speed: 10,
            curse: -12,
            shrine: {icon: "🍂⛩️", text: "Shrine of Nature"},
            specialization: {icon: "🤺", name: "Warrior"},
            active: heroId === 1,
        },
        {
            id: 2,
            name: 'Weatherwax',
            health: 10,
            damage: 20,
            defense: 30,
            magic: 40,
            speed: 50,
            curse: 0,
            active: heroId === 2,
        },
        null,
    ];
}
