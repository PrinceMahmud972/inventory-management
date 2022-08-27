import Axios from 'axios';

import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';

export default {
    [actions.ADD_PRODUCTS]({commit}, payload){
        Axios.post('/products', payload)
            .then(res => {

            })
            .catch(err => {
                commit(mutations.SET_ERRORS, err.response.data.errors);
            })
    }
}