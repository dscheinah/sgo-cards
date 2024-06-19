export async function list() {
    const result = await fetch('league/list');
    if (result.ok) {
        return result.json();
    }
    throw new Error('League list could not be loaded. Please try again later.');
}

export async function information(id) {
    const result = await fetch('league/information?id=' + encodeURIComponent(id));
    if (result.ok) {
        return result.json();
    }
    throw new Error('League information could not be loaded. Please try again later.');
}
