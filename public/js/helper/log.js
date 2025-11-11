export default function (entries) {
    if (!entries || !entries.length) {
        return '';
    }
    const xScale = window.innerWidth / (entries.length - 1);
    const max = Math.max(...entries.map((entry) => Object.values(entry)).flat());
    const yScale = Math.max(.5, Math.min(window.innerHeight / 3 / max, 3));

    const pht = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['player_health'])}`);
    const pdt = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['player_damage'])}`);
    const pmt = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['player_magic'])}`);
    const pdr = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['player_real_damage'])}`);
    const pmr = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['player_real_magic'])}`);
    const eht = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['enemy_health'])}`);
    const edt = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['enemy_damage'])}`);
    const emt = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['enemy_magic'])}`);
    const edr = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['enemy_real_damage'])}`);
    const emr = entries.map((entry, index) => `${index * xScale},${yScale * (max - entry['enemy_real_magic'])}`);

    const width = (entries.length - 1) * xScale;
    const height = max * yScale;

    const axis = `
        <line x1="-10" y1="${height + 1}" x2="${width + 10}" y2="${height + 1}" stroke="black" stroke-width="1"/>
        <line x1="-1" y1="-10" x2="-1" y2="${height + 10}" stroke="black" stroke-width="1"/>
    `;

    return `
        <h2>Battle-Log</h2>
        <p><strong style="color:#d3273e;">Health</strong> - <strong style="color:#1d4289;">Damage</strong> - <strong style="color:#ffc845;">Magic</strong></p>
        <h3>Player</h3>
        <svg viewBox="-10 -10 ${width + 20} ${height + 20}" xmlns="http://www.w3.org/2000/svg" stroke-width="2">
            <polyline points="${pdt.join(' ')}" fill="none" stroke="#1d4289" opacity=".25"/>
            <polyline points="${pmt.join(' ')}" fill="none" stroke="#ffc845" opacity=".25"/>
            <polyline points="${pdr.join(' ')}" fill="none" stroke="#1d4289"/>
            <polyline points="${pmr.join(' ')}" fill="none" stroke="#ffc845"/>
            <polyline points="${pht.join(' ')}" fill="none" stroke="#d3273e"/>
            ${axis}
        </svg>
        <h3>Enemy</h3>
        <svg viewBox="-10 -10 ${width + 20} ${height + 20}" xmlns="http://www.w3.org/2000/svg" stroke-width="2">
            <polyline points="${edt.join(' ')}" fill="none" stroke="#1d4289" opacity=".25"/>
            <polyline points="${emt.join(' ')}" fill="none" stroke="#ffc845" opacity=".25"/>
            <polyline points="${edr.join(' ')}" fill="none" stroke="#1d4289"/>
            <polyline points="${emr.join(' ')}" fill="none" stroke="#ffc845"/>
            <polyline points="${eht.join(' ')}" fill="none" stroke="#d3273e"/>
            ${axis}
        </svg>
    `;
}
