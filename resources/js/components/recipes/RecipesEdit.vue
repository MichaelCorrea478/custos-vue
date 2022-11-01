<template>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Recipe</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="card">

            <form @submit.prevent="saveRecipe">

                <div class="card-header">
                    <div v-for="(value, k) in errors" :key="k" class="alert alert-warning">
                        <p v-for="error in value" :key="error" class="fw-bold">
                            {{ error }}
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="description" class="form-label">Descrição</label>
                            <input type="text" class="form-control" name="description"
                                    id="description" placeholder="nome da receita..."
                                    v-model="recipe.description">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="price" class="form-label">Preço</label>
                            <input type="number" min="0.01" step="0.01"
                                    class="form-control" name="price" id="price"
                                    v-model="recipe.price">
                        </div>

                        <div class="col-12 mx-auto">
                            <button type="submit" class="btn btn-block btn-success w-50 mx-auto">Salvar</button>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <router-link :to="{ name: 'recipes.index'}" class="btn btn-default">
                        Cancelar
                    </router-link>
                </div>

            </form>

        </div>
    </div>
</template>

<script setup>
import useRecipes from '../../composables/recipes';
import { onMounted } from 'vue';

const { errors, recipe, updateRecipe, getRecipe } = useRecipes()
const props = defineProps({
    id: {
        required: true,
        type: String
    }
})

onMounted(() => getRecipe(props.id))

const saveRecipe = async () => {
    await updateRecipe(props.id)
}

</script>
