export function rankings(userId) {
    if (userId) {
        return [
            [
                '1. Logen',
                '2. Mandragoran',
                '3. Mill',
                '...',
                '11. Anomander',
                '12. Kholin',
                '13. Beric',
            ],
            [
                '1. Logen',
                '2. Mandragoran',
                '3. Mill',
                '4. Kholin',
                '5. Emhyr',
            ],
            [
                '1. Logen',
                '2. Emhyr',
                '3. Mill',
            ],
        ];
    }
    return [
        [
            '1. Logen',
            '2. Mandragoran',
            '3. Mill',
        ],
        [
            '1. Logen',
            '2. Mandragoran',
            '3. Mill',
        ],
        [
            '1. Logen',
            '2. Emhyr',
            '3. Mill',
        ],
    ];
}

export function tournament() {
    return {
        modifier: {text: "More global Buff and Curse effectivity"},
        area: {icon: "🕳️", name: "Trapped Dungeons", description: "Reflect back the dealt Damage."},
        hours: 112,
    }
}

export function results(userId) {
    if (!userId) {
        return null;
    }
    return [
        {
            win: 10,
            loose: 5,
            last: 13,
            current: 12,
        },
        {
            loose: 10,
            win: 5,
            last: 4,
            current: 4,
        },
    ];
}

export function heroes(userId) {
    if (!userId) {
        return null;
    }
    return [
        {
            name: 'Tattersail',
            health: 100,
            damage: 50,
            defense: 50,
            magic: 20,
            speed: 10,
            curse: -12,
            shrine: { icon: "🍂⛩️", text: "Shrine of Nature"},
            specialization: {icon: "🤺", name: "Warrior"},
        },
        {
            name: 'Weatherwax',
            health: 10,
            damage: 20,
            defense: 30,
            magic: 40,
            speed: 50,
            curse: 0,
        },
        null,
    ];
}
