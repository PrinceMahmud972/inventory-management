import * as mutations from '../../mutation-types'

export default {
    [mutations.SET_CATEGORIES](state, payload){
        state.categories = payload;
    }
}