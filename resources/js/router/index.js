import { createRouter, createWebHistory } from 'vue-router'

import RecipesIndex from '../components/recipes/RecipesIndex.vue'
import IngredientsIndex from '../components/ingredients/IngredientsIndex.vue'

const routes = [
    {
        path: '/home',
        name: 'recipes.index',
        component: RecipesIndex
    },
    {
        path: '/api/recipes',
        name: 'recipes.inndex',
        component: RecipesIndex
    },
    {
        path: '/api/ingredients',
        name: 'ingredients.inndex',
        component: IngredientsIndex
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
