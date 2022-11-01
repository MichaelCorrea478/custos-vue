import { createRouter, createWebHistory } from 'vue-router'

import RecipesIndex from '../components/recipes/RecipesIndex.vue'
import RecipesCreate from '../components/recipes/RecipesCreate.vue'

import IngredientsIndex from '../components/ingredients/IngredientsIndex.vue'

const routes = [
    {
        path: '/api/recipes',
        name: 'recipes.index',
        component: RecipesIndex
    },
    {
        path: '/api/recipes/create',
        name: 'recipes.create',
        component: RecipesCreate
    },
    {
        path: '/api/ingredients',
        name: 'ingredients.index',
        component: IngredientsIndex
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
