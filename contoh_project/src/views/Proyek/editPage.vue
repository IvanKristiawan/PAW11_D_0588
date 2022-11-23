<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>EDIT POST</h4>
                        <hr>
                        <form @submit.prevent="update">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama
                                    Proyek</label>
                                <input type="text" class="form-control" v-model="departemen.nama_proyek"
                                    placeholder="Masukkan Nama Proyek">
                                <!-- validation -->
                                <div v-if="validation.nama_proyek" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nama_proyek[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Id Departemen</label>
                                <input class="form-control" v-model="departemen.departemen_id"
                                    placeholder="Masukkan Id Departemen">
                                <!-- validation -->
                                <div v-if="validation.departemen_id" class="mt-2 alert alert-danger">
                                    {{ validation.departemen_id[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Waktu Mulai</label>
                                <input class="form-control" v-model="departemen.waktu_mulai"
                                    placeholder="Masukkan Waktu Mulai" type="date">
                                <!-- validation -->
                                <div v-if="validation.waktu_mulai" class="mt-2 alert alert-danger">
                                    {{ validation.waktu_mulai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Waktu Selesai</label>
                                <input class="form-control" v-model="departemen.waktu_selesai"
                                    placeholder="Masukkan Waktu Selesai" type="date">
                                <!-- validation -->
                                <div v-if="validation.waktu_selesai" class="mt-2 alert alert-danger">
                                    {{ validation.waktu_selesai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Status</label>
                                <input class="form-control" v-model="departemen.status"
                                    placeholder="Masukkan Status">
                                <!-- validation -->
                                <div v-if="validation.status" class="mt-2 alert alert-danger">
                                    {{ validation.status[0]
                                    }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'
export default {
    setup() {
        const route = useRoute()
        const id = route.params.id
        //state departemen
        const departemen = reactive({
            nama_proyek: '',
            departemen_id: '',
            waktu_mulai: '',
            waktu_selesai: '',
            status: ''
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()

        onMounted(() => {
            //get API from Laravel Backend
            axios.get(`http://localhost:8000/api/proyeks/${id}`)
                .then(response => {
                    //assign state posts with response data
                    departemen.nama_proyek = response.data.data.nama_proyek
                    departemen.departemen_id = response.data.data.departemen_id
                    departemen.waktu_mulai = response.data.data.waktu_mulai
                    departemen.waktu_selesai = response.data.data.waktu_selesai
                    departemen.status = response.data.data.status
                }).catch(error => {
                    console.log(error.response.data)
                })
        })
        function update() {
            let nama_proyek = departemen.nama_proyek
            let departemen_id = departemen.departemen_id
            let waktu_mulai = departemen.waktu_mulai
            let waktu_selesai = departemen.waktu_selesai
            let status = departemen.status
            axios.put(`http://localhost:8000/api/proyeks/${id}`, {
                nama_proyek: nama_proyek,
                departemen_id: departemen_id,
                waktu_mulai: waktu_mulai,
                waktu_selesai: waktu_selesai,
                status: status
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'proyek.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }
        //return
        return {
            departemen,
            validation,
            router,
            update,
        }
    }
}
</script>
<style>

</style>