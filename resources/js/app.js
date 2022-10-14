require('./bootstrap');

import { createApp } from 'vue';
//import router from './router';

import LoginComponent from './components/LoginComponent.vue';

createApp({
    components: {
        LoginComponent
    }
}).mount('#app')
//}).use(router).mount('#app')
