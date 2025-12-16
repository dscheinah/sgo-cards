function treasure(payload, update) {
    const hash = payload['treasures'].map((treasure) => treasure['trigger'] > 0 ? 1 : 0).join('');
    if (update) {
        window.localStorage.setItem('notify-treasure', hash);
    }
    return window.localStorage.getItem('notify-treasure') !== hash;
}

function specialization(payload, update) {
    const hash = payload['player']['specializations'].length.toString();
    if (update) {
        window.localStorage.setItem('notify-specialization', hash);
    }
    return window.localStorage.getItem('notify-specialization') !== hash;
}

function achievement(payload, update) {
    if (!payload.length) {
        return false;
    }
    if (update) {
        window.localStorage.setItem('notify-achievement', payload.amount);
    }
    return window.localStorage.getItem('notify-achievement') !== payload.amount;
}

export default function (state) {
    state.handle('round', (payload, next) => {
        state.set('notify-treasure', treasure(payload, false));
        return next(payload) || payload;
    });
    state.handle('notify-treasure', (payload) => {
        return payload && treasure(payload, true);
    });

    state.handle('round', (payload, next) => {
        state.set('notify-specialization', specialization(payload, false));
        return next(payload) || payload;
    });
    state.handle('notify-specialization', (payload) => {
        return payload && specialization(payload, true);
    });

    state.handle('achievements', (payload, next) => {
        state.set('notify-achievement', achievement(payload, false));
        return next(payload) || payload;
    });
    state.handle('notify-achievement', (payload) => {
        return payload && achievement(payload, true);
    });
}
