// import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import GuestMenuComponent from './components/GuestMenuComponent.vue';

createApp({
    components: {
        ExampleComponent,
        GuestMenuComponent
    }
}).mount('#app');
