import Axios from 'axios';

import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';

export default {
    [actions.SUBMIT_STOCK]({commit}, payload){
        Axios.post('/stocks', payload)
            .then(res => {
                if(res.data.success == true) {
                    window.location.href = '/stocks';
                }
            })
            .catch(err => {
                commit(mutations.SET_ERRORS, err.response.data.errors);
            })
    },


}