export async function get(userId) {
    const result = await fetch('user/get?user_id=' + encodeURIComponent(userId));
    if (result.ok) {
        return result.json();
    }
}

export async function create(body) {
    const result = await fetch('user/create', {method: 'POST', body});
    if (result.ok) {
        return result.json();
    }
}

export async function logout(userId) {
    const result = await fetch('user/logout?user_id=' + encodeURIComponent(userId));
    if (result.ok) {
        return;
    }
    throw new Error('An error occurred. Please reload and try again.');
}
