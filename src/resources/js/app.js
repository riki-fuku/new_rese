// import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';

import AdminGuestMenuComponent from './components/AdminGuestMenuComponent.vue';
import AgentGuestMenuComponent from './components/AgentGuestMenuComponent.vue';
import AppMenuComponent from './components/AppMenuComponent.vue';
import FavoriteButtonComponent from './components/FavoriteButtonComponent.vue';
import GuestMenuComponent from './components/GuestMenuComponent.vue';
import ReservationEditFormComponent from './components/ReservationEditFormComponent.vue';
import ReservationFormComponent from './components/ReservationFormComponent.vue';
import ReservationListComponent from './components/ReservationListComponent.vue';
import ShopSearchComponent from './components/ShopSearchComponent.vue';

createApp({
    components: {
        AdminGuestMenuComponent,
        AgentGuestMenuComponent,
        AppMenuComponent,
        FavoriteButtonComponent,
        GuestMenuComponent,
        ReservationEditFormComponent,
        ReservationFormComponent,
        ReservationListComponent,
        ShopSearchComponent,
    }
}).mount('#app');
