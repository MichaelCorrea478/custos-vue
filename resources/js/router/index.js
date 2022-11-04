import { createRouter, createWebHistory } from 'vue-router'

import RecipesIndex from '../components/recipes/RecipesIndex.vue'
import RecipesCreate from '../components/recipes/RecipesCreate.vue'
import RecipesEdit from '../components/recipes/RecipesEdit.vue'
import RecipeView from '../components/recipes/RecipeView.vue'

import IngredientsIndex from '../components/ingredients/IngredientsIndex.vue'

import MeasurementUnitIndex from '../components/measurement_units/MeasurementUnitIndex.vue'

const routes = [
    // RECIPES Routes
    {
        path: '/recipes',
        name: 'recipes.index',
        component: RecipesIndex
    },
    {
        path: '/recipes/create',
        name: 'recipes.create',
        component: RecipesCreate
    },
    {
        path: '/recipes/:id/edit',
        name: 'recipes.edit',
        component: RecipesEdit,
        props: true
    },
    {
        path: '/recipes/:id',
        name: 'recipes.view',
        component: RecipeView,
        props: true
    },

    // INGREDIENTS Routes
    {
        path: '/ingredients',
        name: 'ingredients.index',
        component: IngredientsIndex
    },

    // MEASUREMENT UNITS Routes
    {
        path: '/measurement_units',
        name: 'measurement_units.index',
        component: MeasurementUnitIndex
    },

];

export default createRouter({
    history: createWebHistory(),
    routes
})
