import Axios from 'axios';

import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';

export default {
    [actions.GET_SIZES]({commit}){
        Axios.get('/api/sizes')
            .then(res => {
                if(res.data.success == true) {
                    commit(mutations.SET_SIZES, res.data.data)
                }
            })
            .catch(err => {
                console.log(err.response);
            })
    }
}