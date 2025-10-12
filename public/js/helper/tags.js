const icons = {
    health: '❤️',
    damage: '⚔️',
    defense: '🛡️',
    magic: '🪄',
    speed: '🥾',
    base: '➕',
    modifier: '❇️',
    curse: '🔻',
    conversion: '💥',
}

export default function(tags) {
    return tags.map((tag) => icons[tag]).join(' ');
}
