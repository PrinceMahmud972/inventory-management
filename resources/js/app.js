import './bootstrap';

import Alpine from 'alpinejs';

import {createApp} from 'vue/dist/vue.esm-bundler.js';

import store from './store';

import ExampleComponent from './Page/ExampleComponent.vue';
import ProductAdd from './Page/Products/ProductAdd.vue';
import ProductEdit from './Page/Products/ProductEdit.vue';
import StockManage from './Page/stocks/StockManage.vue';
import ReturnProduct from './Page/return_products/ReturnProduct.vue';

const app = createApp({});

// Install vuex on vue app
app.use(store);

// Register Components
app.component('ExampleComponent', ExampleComponent);
app.component('ProductAdd', ProductAdd);
app.component('ProductEdit', ProductEdit);
app.component('StockManage', StockManage);
app.component('ReturnProduct', ReturnProduct);

app.mount('#app');

window.Alpine = Alpine;

Alpine.start();
