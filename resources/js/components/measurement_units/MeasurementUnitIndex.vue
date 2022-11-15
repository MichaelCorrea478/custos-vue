<template>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Unidades de Medida</h1>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary float-right" @click="openCreateModal">
                        Nova Unidade
                    </button>
                </div>
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
                                <th>Abreviação</th>
                                <th colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="unit in measurementUnits" :key="unit.id">
                                <td>{{ unit.description }}</td>
                                <td>{{ unit.abbreviation }}</td>
                                <td width="120">
                                    <div class='btn-group'>
                                        <button class='btn btn-default btn-xs' @click="openUpdateModal" >
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button class='btn btn-danger btn-xs' @click="deleteMeasurementUnit(unit.id)">
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

    <!-- Criar Unidade de Medida -->
    <div class="modal" tabindex="-1" id="modal-create-measurement-unit">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar nova Unidade de Medida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-header">
                <div v-for="(value, k) in errors" :key="k" class="alert alert-warning">
                    <p v-for="error in value" :key="error" class="fw-bold">
                        {{ error }}
                    </p>
                </div>
            </div>
                <div class="card-body">
                    <form @submit.once.prevent="saveMeasurementUnit">
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label for="description" class="form-label">Nome:</label>
                                <input type="text" name="description" id="description" class="form-control" v-model="form.description">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="abbreviation" class="form-label">Abreviação:</label>
                                <input type="text" name="abbreviation" id="abbreviation" class="form-control" v-model="form.abbreviation">
                            </div>
                            <div class="form-group col-sm-12 d-flex justify-content-center">
                                <button class="btn btn-success w-50">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Atualizar Unidade de Medida -->
    <div class="modal" tabindex="-1" id="modal-update-measurement-unit">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atualizar Unidade de Medida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-header">
                    <div v-for="(value, k) in errors" :key="k" class="alert alert-warning">
                        <p v-for="error in value" :key="error" class="fw-bold">
                            {{ error }}
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.once.prevent="submitUpdateForm(measurementUnit.id)">
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label for="description" class="form-label">Nome:</label>
                                <input type="text" name="description" id="description" class="form-control"
                                    v-model="measurementUnit.description">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="abbreviation" class="form-label">Abreviação:</label>
                                <input type="text" name="abbreviation" id="abbreviation" class="form-control"
                                    v-model="measurementUnit.abbreviation">
                            </div>
                            <div class="form-group col-sm-12 d-flex justify-content-center">
                                <button class="btn btn-success w-50">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import useMeasurementUnits from '../../composables/measurement_units';
import { onMounted, reactive } from 'vue';
import Swal from 'sweetalert2';

const { measurementUnit, measurementUnits, errors, getMeasurementUnit, getMeasurementUnits, destroyMeasurementUnit, storeMeasurementUnit, updateMeasurementUnit } = useMeasurementUnits()

let createModal = $('#modal-create-measurement-unit')
let updateModal = $('#modal-update-measurement-unit')

const form = reactive({
    description: measurementUnit.description,
    abbreviation: measurementUnit.abbreviation
})

const openCreateModal = function() {
    createModal.modal('show')
}

const openUpdateModal = async function(id) {
    await getMeasurementUnit(unit.id)
    updateModal.modal('show')
}

const saveMeasurementUnit = async () => {
    await storeMeasurementUnit(form)
    await getMeasurementUnits()
    createModal.modal('hide')
}

const submitUpdateForm = async (id) => {
    await updateMeasurementUnit(id)
    await getMeasurementUnits()
    updateModal.modal('hide')
}

const deleteMeasurementUnit = async (id) => {
    Swal.fire({
        title: 'Tem certeza que deseja deletar esta unidade?',
        showCancelButton: true,
        calcelButtonText: 'Cancelar',
        confirmButtonText: 'Deletar',
    }).then(async (result) => {
        if (result.isConfirmed) {
            await destroyMeasurementUnit(id)
            await getMeasurementUnits()
            Swal.fire('Deletado!', '', 'success')
        }
    })
}

onMounted(() => {
    getMeasurementUnits()
})

</script>
