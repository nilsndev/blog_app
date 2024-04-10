<script setup>
import { ref } from 'vue'
import axios from 'axios'

const data = ref({
  name: '',
  email: '',
  password: ''
})

const register = async () => {
  axios.post('/api/register', {
    id: 0,
    name: data.value.name,
    email: data.value.email,
    password: data.value.password
  })
  .then(function(response) {
    console.log(response);
  })
  .catch(function(error) {
    console.log(error);
  });
}
</script>

<template>
    <div id="form" class="container mt-5 " >
        <h1 class="mb-4">Register</h1>
        <div class="mb-3">
            <label for="name" class="form-label">Username:</label>
            <input v-model="data.name" type="text" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input v-model="data.email" type="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input v-model="data.password" type="password" class="form-control" id="password" required>
        </div>
        <button type="button" class="btn btn-success" @click="register()">Register</button>
    </div>
  </template>
  <style scoped>
    #form{
        max-width: 400px;
    }
  </style>

