<template>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ingredientes</h1>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary float-right">
                        Novo Ingrediente
                </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 col-md-3">
                <label for="description" class="form-label">Descrição</label>
                <input type="text" name="description" id="description" class="form-control"
                    v-model="ingredient.description">
            </div>
            <div class="form-group col-sm-6 col-md-3">
                <label for="measurement_unit_id" class="form-label">Un. Medida</label>
                <select name="measurement_unit_id" id="measurement_unit_id"
                        class="form-control" v-model="ingredient.measurement_unit_id">
                    <option v-for="measurementUnit in measurementUnits"
                            :key="measurementUnit.id" value="{{ measurementUnit.id }}">
                        {{ measurementUnit.description }} ({{ measurementUnit.abbreviation }})
                    </option>
                </select>
            </div>
            <div class="form-group col-sm-6 col-md-3">
                <label for="qty" class="form-label">Quantidade</label>
                <input type="number" min="0.01" step="0.01"
                        name="qty" id="qty" class="form-control"
                        v-model="ingredient.qty">
            </div>
            <div class="form-group col-sm-6 col-md-3">
                <label for="price" class="form-label">Preço</label>
                <input type="number" min="0.01" step="0.01"
                        name="price" id="price" class="form-control"
                        v-model="ingredient.price">
            </div>
            <div class="form-group col-sm-12 d-flex justify-content-center">
                <input type="hidden" name="id" v-model="ingredient.id">
                <button class="btn btn-success w-50">Salvar</button>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table" id="ingredients-table">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Un. Medida</th>
                                <th>Preço</th>
                                <th colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="ingredient in ingredients" :key="ingredient.id">
                                <td>{{ ingredient.description }}</td>
                                <td>{{ ingredient.qty }} {{ ingredient.measurement_unit_abbreviation }}</td>
                                <td>R$ {{ ingredient.price }}</td>
                                <td width="120">
                                    <div class='btn-group'>
                                        <button class='btn btn-default btn-xs'>
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button class='btn btn-danger btn-xs' @click="deleteIngredient(ingredient.id)">
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
import useIngredients from '../../composables/ingredients';
import useMeasurementUnits from '../../composables/measurement_units';
import { onMounted } from 'vue';

const { ingredients, ingredient, getIngredients, getIngredient, destroyIngredient } = useIngredients()
const { measurementUnits, getMeasurementUnits } = useMeasurementUnits()

const deleteIngredient = async (id) => {
    if (!window.confirm('Tem certeza que deseja deletar este ingrediente?')) {
        return
    }
    await destroyIngredient(id)
    await getIngredients()
}

onMounted(() => {
    getIngredients()
    getMeasurementUnits()
})

</script>
