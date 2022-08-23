import { createStore } from 'vuex';

import categories from './modules/categories';
import brands from './modules/brands';

const store = createStore({
    modules: {
        categories,
        brands
    }
});

export default store;