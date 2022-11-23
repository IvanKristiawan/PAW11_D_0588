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
                                <label class="form-label">NIM</label>
                                <input type="text" class="form-control" v-model="departemen.nomor_induk_pegawai"
                                    placeholder="Masukkan NIM">
                                <!-- validation -->
                                <div v-if="validation.nomor_induk_pegawai" class="mt-2 alert alert-danger">
                                    {{
                                            validation.nomor_induk_pegawai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Nama Pegawai</label>
                                <input class="form-control" v-model="departemen.nama_pegawai"
                                    placeholder="Masukkan nama Pegawai">
                                <!-- validation -->
                                <div v-if="validation.nama_pegawai" class="mt-2 alert alert-danger">
                                    {{ validation.nama_pegawai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Id Departemen</label>
                                <input class="form-control" v-model="departemen.id_departemen"
                                    placeholder="Masukkan Id Departemen">
                                <!-- validation -->
                                <div v-if="validation.id_departemen" class="mt-2 alert alert-danger">
                                    {{ validation.id_departemen[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Email</label>
                                <input class="form-control" v-model="departemen.email"
                                    placeholder="Masukkan Email">
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ validation.email[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Telepon</label>
                                <input class="form-control" v-model="departemen.telepon"
                                    placeholder="Masukkan Telepon">
                                <!-- validation -->
                                <div v-if="validation.telepon" class="mt-2 alert alert-danger">
                                    {{ validation.telepon[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Gender</label>
                                <input class="form-control" v-model="departemen.gender"
                                    placeholder="Masukkan Gender">
                                <!-- validation -->
                                <div v-if="validation.gender" class="mt-2 alert alert-danger">
                                    {{ validation.gender[0]
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
            nomor_induk_pegawai: '',
            nama_pegawai: '',
            id_departemen: '',
            email: '',
            telepon: '',
            gender: '',
            status: ''
        })
        //state validation
        const validation = ref([])
        //vue router
        const router = useRouter()

        onMounted(() => {
            //get API from Laravel Backend
            axios.get(`http://localhost:8000/api/pegawais/${id}`)
                .then(response => {
                    //assign state posts with response data
                    departemen.nomor_induk_pegawai = response.data.data.nomor_induk_pegawai
                    departemen.nama_pegawai = response.data.data.nama_pegawai
                    departemen.id_departemen = response.data.data.id_departemen
                    departemen.email = response.data.data.email
                    departemen.telepon = response.data.data.telepon
                    departemen.gender = response.data.data.gender
                    departemen.status = response.data.data.status
                }).catch(error => {
                    console.log(error.response.data)
                })
        })
        function update() {
            let nomor_induk_pegawai = departemen.nomor_induk_pegawai
            let nama_pegawai = departemen.nama_pegawai
            let id_departemen = departemen.id_departemen
            let email = departemen.email
            let telepon = departemen.telepon
            let gender = departemen.gender
            let status = departemen.status
            axios.put(`http://localhost:8000/api/pegawais/${id}`, {
                nomor_induk_pegawai: nomor_induk_pegawai,
                nama_pegawai: nama_pegawai,
                id_departemen: id_departemen,
                email: email,
                telepon: telepon,
                gender: gender,
                status: status,
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'pegawai.index'
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