require('./bootstrap');

import { createApp } from 'vue';
//import router from './router';

import LoginComponent from './components/LoginComponent.vue';
import RegisterComponent from './components/RegisterComponent.vue';

createApp({
    components: {
        LoginComponent,
        RegisterComponent
    }
}).mount('#app')
//}).use(router).mount('#app')
