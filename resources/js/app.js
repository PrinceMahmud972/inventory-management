import './bootstrap';

import Alpine from 'alpinejs';

import {createApp} from 'vue/dist/vue.esm-bundler.js';

import store from './store';

import ExampleComponent from './Page/ExampleComponent.vue';
import ProductAdd from './Page/Products/ProductAdd.vue';

const app = createApp({});

// Install vuex on vue app
app.use(store);

// Register Components
app.component('ExampleComponent', ExampleComponent);
app.component('ProductAdd', ProductAdd);

app.mount('#app');

window.Alpine = Alpine;

Alpine.start();
