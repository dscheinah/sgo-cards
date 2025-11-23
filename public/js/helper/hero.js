import escape from './escape.js';
import league from './league.js';
import tags from './tags.js';

function compareForClassString(key, reference, data) {
    if (!reference || !data || reference[key] === data[key]) {
        return '';
    }
    return reference[key] > data[key] ? 'sx-error' : 'sx-highlight';
}

export default function (hero, compare) {
    const specialization = hero.specialization ? `&ndash; ${hero.specialization.icon} ${hero.specialization.name}` : '';
    const shrine = hero.shrine ? `&ndash; ${hero.shrine.icon} ${hero.shrine.text}` : '';
    const tiers = [];
    hero.tiers.forEach((tier, index) => tiers.push(`<tr>
        <th>${league(index, 'icon')}</th>
        <td class="${compareForClassString('health', compare?.tiers[index], tier)}">${tier.health}</td>
        <td class="${compareForClassString('damage', compare?.tiers[index], tier)}">${tier.damage}</td>
        <td class="${compareForClassString('defense', compare?.tiers[index], tier)}">${tier.defense}</td>
        <td class="${compareForClassString('magic', compare?.tiers[index], tier)}">${tier.magic}</td>
        <td class="${compareForClassString('speed', compare?.tiers[index], tier)}">${tier.speed}</td>
        <td class="${compareForClassString('curse', compare?.tiers[index], tier)}">${tier.curse}</td>
    </tr>`));
    return `
        <p class="hero">
            ${hero.active ? '⭐️' : ''} <strong>${escape(hero.name)}</strong> <span>${shrine}</span> <span>${specialization}</span>
        </p>
        <table class="hero-table">
            <tr>
                <th></th>
                <th>${tags(['health'])}</th>
                <th>${tags(['damage'])}</th>
                <th>${tags(['defense'])}</th>
                <th>${tags(['magic'])}</th>
                <th>${tags(['speed'])}</th>
                <th>${tags(['curse'])}</th>
            </tr>
            ${tiers.join('')}
        </table>
    `;
}
