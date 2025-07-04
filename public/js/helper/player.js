function totals(stats) {
    return stats['health'] + stats['damage'] + stats['defense'] + stats['magic'] + stats['speed'];
}

function compareForClassString(key, reference, data) {
    if (!reference || reference[key] === data[key]) {
        return '';
    }
    return reference[key] > data[key] ? 'sx-error' : 'sx-highlight';
}

export default function (player, reference) {
    player['data'].total = totals(player['data']);
    player['calculation'].total = totals(player['calculation']);
    if (reference) {
        reference.total = totals(reference);
    }

    let modifiers = '';
    player.modifiers.forEach((modifier) => {
        modifiers += `<tr><th>${modifier.text}</th><td>${modifier.value}</td></tr>`;
    });
    return `
        <table>
            <tr><th>Position</th><td>${player.x}:${player.y}</td></tr>
            <tr><th>Modifier</th><td>${player['modifier'].text}</td></tr>
            <tr>
                <th>Total</th>
                <td class="${compareForClassString('total', reference, player['calculation'])}">
                    ${player['calculation']['total']} (${player['data']['total']})
                </td>
            </tr>
            <tr>
                <th>Health</th>
                <td class="${compareForClassString('health', reference, player['calculation'])}">
                    ${player['calculation']['health']} (${player['data']['health']})
                </td>
            </tr>
            <tr>
                <th>Damage</th>
                <td class="${compareForClassString('damage', reference, player['calculation'])}">
                    ${player['calculation']['damage']} (${player['data']['damage']})
                </td>
            </tr>
            <tr>
                <th>Defense</th>
                <td class="${compareForClassString('defense', reference, player['calculation'])}">
                    ${player['calculation']['defense']} (${player['data']['defense']})
                </td>
            </tr>
            <tr>
                <th>Magic</th>
                <td class="${compareForClassString('magic', reference, player['calculation'])}">
                    ${player['calculation']['magic']} (${player['data']['magic']})
                </td>
            </tr>
            <tr>
                <th>Speed</th>
                <td class="${compareForClassString('speed', reference, player['calculation'])}">
                    ${player['calculation']['speed']} (${player['data']['speed']})
                </td>
            </tr>
            ${modifiers}
        </table>
    `;
}
