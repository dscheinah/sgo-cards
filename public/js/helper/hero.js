import escape from './escape.js';
import tags from './tags.js';

function compareForClassString(key, reference, data) {
    if (!reference || reference[key] === data[key]) {
        return '';
    }
    return reference[key] > data[key] ? 'sx-error' : 'sx-highlight';
}

export default function (hero, compare) {
    const specialization = hero.specialization ? `&ndash; ${hero.specialization.icon} ${hero.specialization.name}` : '';
    const shrine = hero.shrine ? `&ndash; ${hero.shrine.icon} ${hero.shrine.text}` : '';
    return `<span class="hero">
        ${hero.active ? '⭐️' : ''} <strong>${escape(hero.name)}</strong> <span>${shrine}</span> <span>${specialization}</span><br/>
        <span class="hero-stat ${compareForClassString('health', compare, hero)}">${tags(['health'])} ${hero.health}</span>
        <span class="hero-stat ${compareForClassString('damage', compare, hero)}">${tags(['damage'])} ${hero.damage}</span>
        <span class="hero-stat ${compareForClassString('defense', compare, hero)}">${tags(['defense'])} ${hero.defense}</span>
        <span class="hero-stat ${compareForClassString('magic', compare, hero)}">${tags(['magic'])} ${hero.magic}</span>
        <span class="hero-stat ${compareForClassString('speed', compare, hero)}">${tags(['speed'])} ${hero.speed}</span>
        <span class="hero-stat ${compareForClassString('curse', compare, hero)}">${tags(['curse'])} ${hero.curse}</span><br/>
    </span>`;
}
