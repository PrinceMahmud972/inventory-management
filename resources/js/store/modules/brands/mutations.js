import * as mutations from '../../mutation-types'

export default {
    [mutations.SET_BRANDS](state, payload){
        state.brands = payload;
    }
}