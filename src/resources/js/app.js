// import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';

import ExampleComponent from './components/ExampleComponent.vue';
import GuestMenuComponent from './components/GuestMenuComponent.vue';
import AppMenuComponent from './components/AppMenuComponent.vue';
import FavoriteButtonComponent from './components/FavoriteButtonComponent.vue';
import ShopSearchComponent from './components/ShopSearchComponent.vue';
import ReservationFormComponent from './components/ReservationFormComponent.vue';
import ReservationListComponent from './components/ReservationListComponent.vue';
import ReservationEditFormComponent from './components/ReservationEditFormComponent.vue';

createApp({
    components: {
        ExampleComponent,
        GuestMenuComponent,
        AppMenuComponent,
        FavoriteButtonComponent,
        ShopSearchComponent,
        ReservationFormComponent,
        ReservationListComponent,
        ReservationEditFormComponent,
    }
}).mount('#app');
