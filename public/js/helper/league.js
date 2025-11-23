const tiers = [
    {
        icon: '🐰',
        name: 'Rabbit-League',
        tier: 'Tier 1',
    },
    {
        icon: '🦊',
        name: 'Fox-League',
        tier: 'Tier 2',
    },
    {
        icon: '🐼',
        name: 'Panda-League',
        tier: 'Tier 3',
    },
];

export default function (index, type) {
    return tiers[index][type];
}
