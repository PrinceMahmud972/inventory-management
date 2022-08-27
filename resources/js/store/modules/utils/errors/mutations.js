import * as mutations from '../../../mutation-types';

export default {
    [mutations.SET_ERRORS](state, payload) {
        state.is_errors = true;
        state.errors = payload;
    }
}