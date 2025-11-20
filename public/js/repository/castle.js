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
    const result = await fetch('castle/result?user_id=' + encodeURIComponent(userId));
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}

export async function enemies(userId, heroId) {
    if (!userId) {
        return null;
    }
    const params = new URLSearchParams();
    params.set('user_id', userId);
    const result = await fetch('castle/hero/enemies?' + params.toString());
    if (result.ok) {
        const enemies = await result.json();
        return enemies.map(enemy => ({...enemy, hero_id: heroId}));
    }
    throw new Error('An error occurred. Please reload and try again.');
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
    const params = new URLSearchParams();
    params.set('user_id', userId);
    if (heroId) {
        params.set('hero_id', heroId);
    }
    const result = await fetch('castle/hero/list?' + params.toString());
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}

export async function hero(userId, heroId) {
    if (!userId) {
        return null;
    }
    const params = new URLSearchParams();
    params.set('user_id', userId);
    if (heroId) {
        params.set('hero_id', heroId);
    }
    const result = await fetch('castle/hero/get?' + params.toString());
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}

export async function modifiers(userId) {
    if (!userId) {
        return null;
    }
    const result = await fetch('castle/hero/modifier?user_id=' + encodeURIComponent(userId));
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}

export async function shrines(userId) {
    if (!userId) {
        return null;
    }
    const result = await fetch('castle/hero/shrine?user_id=' + encodeURIComponent(userId));
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}

export async function specializations(userId) {
    if (!userId) {
        return null;
    }
    const result = await fetch('castle/hero/specialization?user_id=' + encodeURIComponent(userId));
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}

export async function save(userId, heroId, body) {
    if (!userId) {
        return null;
    }
    const params = new URLSearchParams();
    params.set('user_id', userId);
    params.set('hero_id', heroId);
    const result = await fetch('castle/hero/save?' + params.toString(), {method: 'POST', body});
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}
