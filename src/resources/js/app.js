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
import AgentHomeComponent from './components/Agent/HomeComponent.vue';
import AgentGuestMenuComponent from './components/Agent/GuestMenuComponent.vue';
import AgentMenuComponent from './components/Agent/MenuComponent.vue';
import AgentCreateShopComponent from './components/Agent/CreateShopComponent.vue';
import AgentEditShopComponent from './components/Agent/EditShopComponent.vue';
import AgentMailComponent from './components/Agent/MailComponent.vue';
import AgentReservationDetailComponent from './components/Agent/ReservationDetailComponent.vue';
import AgentReservationListComponent from './components/Agent/ReservationListComponent.vue';

// 一般ユーザー用
import AppMenuComponent from './components/User/AppMenuComponent.vue';
import FavoriteButtonComponent from './components/User/FavoriteButtonComponent.vue';
import GuestMenuComponent from './components/User/GuestMenuComponent.vue';
import PaymentFormComponent from './components/User/PaymentFormComponent.vue';
import ReservationEditFormComponent from './components/User/ReservationEditFormComponent.vue';
import ReservationFormComponent from './components/User/ReservationFormComponent.vue';
import ReservationListComponent from './components/User/ReservationListComponent.vue';
import ShopSearchComponent from './components/User/ShopSearchComponent.vue';

createApp({
    components: {
        AdminGuestMenuComponent,
        AdminMenuComponent,
        AdminMailComponent,
        AgentHomeComponent,
        AgentGuestMenuComponent,
        AgentMenuComponent,
        AgentCreateShopComponent,
        AgentEditShopComponent,
        AgentMailComponent,
        GuestMenuComponent,
        PaymentFormComponent,
        AgentReservationDetailComponent,
        AgentReservationListComponent,
        AppMenuComponent,
        ManagementAgentComponent,
        FavoriteButtonComponent,
        ReservationEditFormComponent,
        ReservationFormComponent,
        ReservationListComponent,
        ShopSearchComponent,
    }
}).mount('#app');
