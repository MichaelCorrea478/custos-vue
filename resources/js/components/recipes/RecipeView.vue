<template>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ recipe.description }}</h1>
                </div>
                <div class="col-sm-6">
                    <router-link :to="{ name: 'recipes.index' }" class="btn btn-default float-right">
                        Voltar
                    </router-link>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Preço:</h5>
                                <p class="card-text fw-bold">R$ {{ recipe.price }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Estoque:</h5>
                                <p class="card-text fw-bold">{{ recipe.stock_qty }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Custo:</h5>
                                <p class="card-text fw-bold">R$ {{ recipe.cost }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Lucro:</h5>
                                <p class="card-text fw-bold">{{ recipe.profit_margin }} %</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h4>Ingredientes:</h4>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary float-right">
                        Novo Ingrediente
                    </button>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table" id="recipes-ingredients-table">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Custo</th>
                                <th colspan="3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="ingredient in recipe.ingredients" :key="ingredient.id">
                                <td>{{ ingredient.description }} ({{ ingredient.qty }} {{ ingredient.measurement_unit_abbreviation }})</td>
                                <td>R$ {{ ingredient.price }}</td>
                                <td>{{ ingredient.qty_in_recipe }}  {{ ingredient.measurement_unit_abbreviation }}</td>
                                <td>R$ {{ ingredient.cost_in_recipe }}</td>
                                <td width="120">
                                    <div class='btn-group'>
                                        <button class='btn btn-default btn-xs'>
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button class='btn btn-danger btn-xs' >
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

const { recipe, getRecipe } = useRecipes()
const props = defineProps({
    id: {
        required: true,
        type: String
    }
})

onMounted(() => getRecipe(props.id))


</script>
