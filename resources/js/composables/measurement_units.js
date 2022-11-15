import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import Swal from 'sweetalert2'

export default function useMeasurementUnits() {
    const measurementUnit = ref([])
    const measurementUnits = ref([])

    const errors = ref('')
    const router = useRouter()

    const getMeasurementUnits = async () => {
        let response = await axios.get('/api/measurement_units')
        measurementUnits.value = response.data.data
    }

    const getMeasurementUnit = async (id) => {
        let response = await axios.get(`/api/measurement_units/${id}`)
        measurementUnit.value = response.data.data
    }

    const storeMeasurementUnit = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/measurement_units', data)
                    .then((response) => {
                        let iconType = (response.data.success) ? 'success' : 'error'
                        Swal.fire({
                            icon: iconType,
                            title: response.data.message
                        })
                    })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const updateMeasurementUnit = async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/measurement_units/${id}`, measurementUnit.value)
                    .then((response) => {
                        let iconType = (response.data.success) ? 'success' : 'error'
                        Swal.fire({
                            icon: iconType,
                            title: response.data.message
                        })
                    })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destroyMeasurementUnit = async (id) => {
        await axios.delete(`/api/measurement_units/${id}`)
    }

    return {
        errors,
        measurementUnit,
        measurementUnits,
        getMeasurementUnit,
        getMeasurementUnits,
        storeMeasurementUnit,
        updateMeasurementUnit,
        destroyMeasurementUnit
    }
}
