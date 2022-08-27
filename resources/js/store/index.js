import { createStore } from 'vuex';

import errors from './modules/utils/errors';
import categories from './modules/categories';
import brands from './modules/brands';
import sizes from './modules/sizes';
import products from './modules/products';

const store = createStore({
    modules: {
        errors,
        categories,
        brands,
        sizes,
        products
    }
});

export default store;