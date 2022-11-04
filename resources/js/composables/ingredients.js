import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useIngredients() {
    const ingredient = ref([])
    const ingredients = ref([])

    const errors = ref('')
    const router = useRouter()

    const getIngredients = async () => {
        let response = await axios.get('/api/ingredients')
        ingredients.value = response.data.data
    }

    const getIngredient = async (id) => {
        let response = await axios.get(`/api/ingredients/${id}`)
        ingredient.value = response.data.data
    }

    const storeIngredient = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/ingredients', data)
            await router.push({ name: 'ingredients.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const updateIngredient = async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/ingredients/${id}`, ingredient.value)
            await router.push({ name: 'ingredients.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destroyIngredient = async (id) => {
        await axios.delete(`/api/ingredients/${id}`)
    }

    return {
        errors,
        ingredient,
        ingredients,
        getIngredient,
        getIngredients,
        storeIngredient,
        updateIngredient,
        destroyIngredient
    }
}
