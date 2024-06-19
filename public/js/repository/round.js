export async function load(userId) {
    const result = await fetch('round/load?user_id=' + encodeURIComponent(userId));
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}

export async function next(userId, card) {
    const body = new FormData();
    body.set('card', card);
    const result = await fetch('round/next?user_id=' + encodeURIComponent(userId), {method: 'POST', body});
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}
