// import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';

// 管理者用
import AdminGuestMenuComponent from './components/Admin/GuestMenuComponent.vue';
import AdminMenuComponent from './components/Admin/MenuComponent.vue';
import ManagementAgentComponent from './components/Admin/ManagementAgentComponent.vue';
import AdminMailComponent from './components/Admin/MailComponent.vue';

// 店舗代表者用
import AgentGuestMenuComponent from './components/Agent/GuestMenuComponent.vue';
import AgentMenuComponent from './components/Agent/MenuComponent.vue';

// 一般ユーザー用
import AppMenuComponent from './components/User/AppMenuComponent.vue';
import FavoriteButtonComponent from './components/User/FavoriteButtonComponent.vue';
import GuestMenuComponent from './components/User/GuestMenuComponent.vue';
import ReservationEditFormComponent from './components/User/ReservationEditFormComponent.vue';
import ReservationFormComponent from './components/User/ReservationFormComponent.vue';
import ReservationListComponent from './components/User/ReservationListComponent.vue';
import ShopSearchComponent from './components/User/ShopSearchComponent.vue';

createApp({
    components: {
        AdminGuestMenuComponent,
        AdminMenuComponent,
        AgentGuestMenuComponent,
        AdminMailComponent,
        AgentMenuComponent,
        AppMenuComponent,
        ManagementAgentComponent,
        FavoriteButtonComponent,
        GuestMenuComponent,
        ReservationEditFormComponent,
        ReservationFormComponent,
        ReservationListComponent,
        ShopSearchComponent,
    }
}).mount('#app');
