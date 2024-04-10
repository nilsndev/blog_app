<script setup>
import { ref,onMounted} from 'vue';
import LoginSite from './views/LoginView.vue'
import RegSite from './views/RegisterView.vue'
import HeadLine from './components/HeadLine.vue'


import { RouterView } from 'vue-router'
import axios from 'axios'
import { useStore } from 'vuex';
    const headerKey = ref(0)
    const store = useStore();
    onMounted( async ()=>{
        await axios.get('/api/user',{
            headers:{'Content-Type': 'application/json'},
            withCredentials: true,
        })
        .then(response =>{
           console.log(response.data);
           store.dispatch("setActiveUserID",response.data.id);
           headerKey.value += 1
        }).catch(error =>{
            console.error(error);
        })
    })
</script>
<template>
    <div>
        <HeadLine :key="headerKey" />
        <div id="main">
            <router-view />

        </div>
    </div>
</template>

