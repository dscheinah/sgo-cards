import * as user from '../repository/user.js';

const create = {
    create: true,
};

export default function (state) {
    state.handle('user', async (payload, next) => {
        state.dispatch('loading', true);
        if (payload.id) {
            return await user.get(payload.id) || create;
        }
        return next(payload);
    })
    state.handle('user', async (payload, next) => {
        const result = await user.create(payload);
        state.dispatch('loading', false);
        if (!result) {
            return {...create, error: true};
        }
        return next(result);
    });
    state.handle('user', (payload) => {
        window.localStorage.setItem('user-id', payload.id);
        return payload;
    });

    const id = window.localStorage.getItem('user-id');
    if (id) {
        state.dispatch('user', {id});
    } else {
        state.set('user', create);
    }
}
