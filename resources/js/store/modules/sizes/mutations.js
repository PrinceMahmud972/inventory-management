import * as mutations from '../../mutation-types'

export default {
    [mutations.SET_SIZES](state, payload){
        state.sizes = payload;
    }
}