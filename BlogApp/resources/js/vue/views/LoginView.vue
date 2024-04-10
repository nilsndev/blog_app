<script setup>
    import { ref } from 'vue'
    import axios from 'axios'
    import { useStore } from 'vuex';
    import { useRouter } from 'vue-router';

    const store = useStore();
    const router = useRouter();
    const data = ref({
        email: '',
        password: ''
    })
    const login = async() =>{
        axios.post('api/login',{
            id: 0,
            name: '',
            email: data.value.email,
            password: data.value.password,
        })
        .then(response =>{
            store.dispatch("setActiveUserID",response.data.user_id);
            router.push("/")
        })
        .catch(error =>{
            console.log(error);
        })
    }
</script>
<template>
    <div>

        <div id="form" class="container mt-5" >
            <h1 class="mb-4">Login</h1>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input v-model="data.email" class="form-control" type="email" id="email" required>
            </div>
            <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input v-model="data.password" class="form-control" type="password" id="password" required>
            </div>
            <button type="button" class="btn btn-success" @click="login()">Login</button>
        </div>
    </div>
</template>
<style scoped>
    #form{
        max-width: 400px;
    }
</style>
