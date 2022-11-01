require('./bootstrap');

import { createApp } from 'vue';
import router from './router';

import LoginComponent from './components/LoginComponent.vue';
import RegisterComponent from './components/RegisterComponent.vue';
import RecipesIndex from './components/recipes/RecipesIndex.vue';
import IngredientsIndex from './components/ingredients/IngredientsIndex.vue';

createApp({
    components: {
        LoginComponent,
        RegisterComponent,
        RecipesIndex,
        IngredientsIndex
    }
}).use(router).mount('#app');
