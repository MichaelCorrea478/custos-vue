<template>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Receitas</h1>
                </div>
                <div class="col-sm-6">
                    <router-link :to="{ name: 'recipes.create'}" class="btn btn-primary float-right">
                        Nova Receita
                    </router-link>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table" id="recipes-table">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Custo</th>
                                <th>Custo Méd.</th>
                                <th colspan="3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="recipe in recipes" :key="recipe.id">
                                <td>{{ recipe.description }}</td>
                                <td>{{ recipe.price }}</td>
                                <td>{{ recipe.stock_qty }}</td>
                                <td>{{ recipe.cost }}</td>
                                <td>{{ recipe.avg_cost }}</td>
                                <td width="120">
                                    <div class='btn-group'>
                                        <button class='btn btn-default btn-xs'>
                                            <i class="far fa-eye"></i>
                                        </button>
                                        <button class='btn btn-default btn-xs'>
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button class='btn btn-danger btn-xs' @click="deleteRecipe(recipe.id)">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script setup>
import useRecipes from '../../composables/recipes';
import { onMounted } from 'vue';

const { recipes, getRecipes, destroyRecipe } = useRecipes()

const deleteRecipe = async (id) => {
    if (!window.confirm('Tem certeza que deseja deletar esta receita?')) {
        return
    }
    await destroyRecipe(id)
    await getRecipes()
}

onMounted(getRecipes)

</script>
