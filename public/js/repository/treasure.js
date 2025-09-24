export async function activate(userId, body, league) {
    body.set('league', league);
    const result = await fetch('treasure/activate?user_id=' + encodeURIComponent(userId), {method: 'POST', body});
    if (result.ok) {
        return;
    }
    throw new Error('An error occurred. Please reload and try again.');
}
