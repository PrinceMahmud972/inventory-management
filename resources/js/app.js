import './bootstrap';

import Alpine from 'alpinejs';

import {createApp} from 'vue/dist/vue.esm-bundler.js';

import ExampleComponent from './Page/ExampleComponent.vue';

const app = createApp({});

app.component('ExampleComponent', ExampleComponent);

app.mount('#app');

window.Alpine = Alpine;

Alpine.start();
