import { createStore } from 'vuex';

import categories from './modules/categories';

const store = createStore({
    modules: {
        categories
    }
});

export default store;