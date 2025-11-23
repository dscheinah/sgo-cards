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

export async function training(userId, heroId, enemyId) {
    if (!userId) {
        return null;
    }
    const params = new URLSearchParams();
    params.set('user_id', userId);
    params.set('hero_id', heroId);
    params.set('enemy_id', enemyId);
    const result = await fetch('castle/hero/training?' + params.toString());
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
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
