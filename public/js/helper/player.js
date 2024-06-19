export default function (player) {
    let modifiers = '';
    player.data.modifiers.forEach((modifier) => {
        const numbers = Object.values(modifier).filter((value) => parseFloat(value));
        modifiers += `<tr><th>${modifier.text}</th><td>${numbers.join(', ')}</td></tr>`;
    });
    const health = player['data']['health'];
    const damage = player['data']['damage'];
    const defense = player['data']['defense'];
    const magic = player['data']['magic'];
    const speed = player['data']['speed'];
    return `
        <table>
            <tr><th>Position</th><td>${player.x}:${player.y}</td></tr>
            <tr><th>Modifier</th><td>${player['modifier'].text}</td></tr>
            <tr><th>Health</th><td>
                ${Math.max(health, 0)} ${health < 0 ? '(' + health + ')' : ''}
            </td></tr>
            <tr><th>Damage</th><td>
                ${Math.max(damage, 0)} ${damage < 0 ? '(' + damage + ')' : ''}
            </td></tr>
            <tr><th>Defense</th><td>
                ${Math.max(defense, 0)} ${defense < 0 ? '(' + defense + ')' : ''}
            </td></tr>
            <tr><th>Magic</th><td>
                ${Math.max(magic, 0)} ${magic < 0 ? '(' + magic + ')' : ''}
            </td></tr>
            <tr><th>Speed</th><td>
                ${Math.max(speed, 0)} ${speed < 0 ? '(' + speed + ')' : ''}
            </td></tr>
            ${modifiers}
        </table>
    `;
}
