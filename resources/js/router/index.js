import { createRouter, createWebHistory } from 'vue-router'

import RecipesIndex from '../components/recipes/RecipesIndex.vue'
import RecipesCreate from '../components/recipes/RecipesCreate.vue'
import RecipesEdit from '../components/recipes/RecipesEdit.vue'

import IngredientsIndex from '../components/ingredients/IngredientsIndex.vue'

const routes = [
    // RECIPES Routes
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
        path: '/api/recipes/:id/edit',
        name: 'recipes.edit',
        component: RecipesEdit,
        props: true
    },

    // INGREDIENTS Routes
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
