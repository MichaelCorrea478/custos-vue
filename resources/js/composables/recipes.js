import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useRecipes() {
    const recipe = ref([])
    const recipes = ref([])

    const errors = ref('')
    const router = useRouter()

    const getRecipes = async () => {
        let response = await axios.get('/api/recipes')
        recipes.value = response.data.data
    }

    const getRecipe = async (id) => {
        let response = await axios.get(`/api/recipes/${id}`)
        recipe.value = response.data.data
    }

    const storeRecipe = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/recipes', data)
            await router.push({ name: 'recipes.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const updateRecipe = async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/recipes/${id}`, recipe.value)
            await router.push({ name: 'recipes.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destroyRecipe = async (id) => {
        await axios.delete(`/api/recipes/${id}`)
    }

    return {
        errors,
        recipe,
        recipes,
        getRecipe,
        getRecipes,
        storeRecipe,
        updateRecipe,
        destroyRecipe
    }
}
