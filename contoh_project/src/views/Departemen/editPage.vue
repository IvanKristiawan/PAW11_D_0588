<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH POST</h4>
                        <hr>
                        <form @submit.prevent="update">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama
                                    Departemen</label>
                                <input type="text" class="form-control" v-model="departemen.nama_departemen"
                                    placeholder="Masukkan nama departemen">
                                <!-- validation -->
                                <div v-if="validation.nama_departemen" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nama_departemen[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Nama Manager</label>
                                <input class="form-control" v-model="departemen.nama_manager"
                                    placeholder="Masukkan nama manager">
                                <!-- validation -->
                                <div v-if="validation.nama_manager" class="mt-2 alert alert-danger">
                                    {{ validation.nama_manager[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Jumlah Pegawai</label>
                                <input class="form-control" type="number" v-model="departemen.jumlah_pegawai"
                                    placeholder="Masukkan jumlah pegawai">
                                <!-- validation -->
                                <div v-if="validation.jumlah_pegawai" class="mt-2 alert alert-danger">
                                    {{ validation.jumlah_pegawai[0] }}
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
            nama_departemen: '',
            nama_manager: '',
            jumlah_pegawai: ''
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()

        onMounted(() => {
            //get API from Laravel Backend
            axios.get(`http://localhost:8000/api/departemens/${id}`)
                .then(response => {
                    //assign state posts with response data
                    departemen.nama_departemen = response.data.data.nama_departemen
                    departemen.nama_manager = response.data.data.nama_manager
                    departemen.jumlah_pegawai = response.data.data.jumlah_pegawai
                }).catch(error => {
                    console.log(error.response.data)
                })
        })
        function update() {
            let nama_departemen = departemen.nama_departemen
            let nama_manager = departemen.nama_manager
            let jumlah_pegawai = departemen.jumlah_pegawai
            axios.put(`http://localhost:8000/api/departemens/${id}`, {
                nama_departemen: nama_departemen,
                nama_manager: nama_manager,
                jumlah_pegawai: jumlah_pegawai
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'departemen.index'
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