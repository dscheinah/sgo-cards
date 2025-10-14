export async function list(userId) {
    if (!userId) {
        return [];
    }
    const result = await fetch('achievement/list?user_id=' + encodeURIComponent(userId));
    if (result.ok) {
        return result.json();
    }
    throw new Error('An error occurred. Please reload and try again.');
}
