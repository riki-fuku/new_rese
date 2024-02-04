// import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

createApp({
    components: {
        ExampleComponent
    }
}).mount('#app');
