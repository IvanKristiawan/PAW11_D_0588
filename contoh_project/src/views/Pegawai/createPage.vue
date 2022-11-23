<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH POST</h4>
                        <hr>
                        <form @submit.prevent="store">
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
                                    placeholder="Masukkan nama pegawai">
                                <!-- validation -->
                                <div v-if="validation.nama_pegawai" class="mt-2 alert alert-danger">
                                    {{ validation.nama_pegawai[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Id Departemen</label>
                                <input class="form-control" v-model="departemen.id_departemen"
                                    placeholder="Masukkan id departemen">
                                <!-- validation -->
                                <div v-if="validation.id_departemen" class="mt-2 alert alert-danger">
                                    {{ validation.id_departemen[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Email</label>
                                <input class="form-control" v-model="departemen.email"
                                    placeholder="Masukkan email">
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ validation.email[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Telepon</label>
                                <input class="form-control" v-model="departemen.telepon"
                                    placeholder="Masukkan telepon">
                                <!-- validation -->
                                <div v-if="validation.telepon" class="mt-2 alert alert-danger">
                                    {{ validation.telepon[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Gender</label>
                                <input class="form-control" v-model="departemen.gender"
                                    placeholder="Masukkan gender">
                                <!-- validation -->
                                <div v-if="validation.gender" class="mt-2 alert alert-danger">
                                    {{ validation.gender[0]
                                    }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Status</label>
                                <input class="form-control" v-model="departemen.status"
                                    placeholder="Masukkan status">
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
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    setup() {
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
        //method store
        function store() {
            let nomor_induk_pegawai = departemen.nomor_induk_pegawai
            let nama_pegawai = departemen.nama_pegawai
            let id_departemen = departemen.id_departemen
            let email = departemen.email
            let telepon = departemen.telepon
            let gender = departemen.gender
            let status = departemen.status
            axios.post('http://localhost:8000/api/pegawais', {
                nomor_induk_pegawai: nomor_induk_pegawai,
                nama_pegawai: nama_pegawai,
                id_departemen: id_departemen,
                email: email,
                telepon: telepon,
                gender: gender,
                status: status
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
            store
        }
    }
}
</script>
<style>

</style>