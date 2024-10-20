function compareForClassString(key, reference, data) {
    if (!reference || reference[key] === data[key]) {
        return '';
    }
    return reference[key] > data[key] ? 'sx-error' : 'sx-highlight';
}

export default function (player, calculation, reference) {
    let modifiers = '';
    player.data.modifiers.forEach((modifier) => {
        modifiers += `<tr><th>${modifier.text}</th><td>${modifier.count}</td></tr>`;
    });
    return `
        <table>
            <tr><th>Position</th><td>${player.x}:${player.y}</td></tr>
            <tr><th>Modifier</th><td>${player['modifier'].text}</td></tr>
            <tr>
                <th>Health</th>
                <td class="${compareForClassString('health', reference, calculation)}">
                    ${Math.max(parseInt(calculation['health']), 0)} (${player['data']['health']})
                </td>
            </tr>
            <tr>
                <th>Damage</th>
                <td class="${compareForClassString('damage', reference, calculation)}">
                    ${Math.max(parseInt(calculation['damage']), 0)} (${player['data']['damage']})
                </td>
            </tr>
            <tr>
                <th>Defense</th>
                <td class="${compareForClassString('defense', reference, calculation)}">
                    ${Math.max(parseInt(calculation['defense']), 0)} (${player['data']['defense']})
                </td>
            </tr>
            <tr>
                <th>Magic</th>
                <td class="${compareForClassString('magic', reference, calculation)}">
                    ${Math.max(parseInt(calculation['magic']), 0)} (${player['data']['magic']})
                </td>
            </tr>
            <tr>
                <th>Speed</th>
                <td class="${compareForClassString('speed', reference, calculation)}">
                    ${Math.max(parseInt(calculation['speed']), 0)} (${player['data']['speed']})
                </td>
            </tr>
            ${modifiers}
        </table>
    `;
}
