<script setup>
import { RouterLink } from 'vue-router';

import {computed, reactive} from 'vue';
import { useStore } from 'vuex';

const store = useStore();


const isAuthenticated = reactive(() => {
  return store.getters.getActiveUserID !== 0 && store.getters.getActiveUserID !== undefined;
})


const logOut = async () => {

  try {
    await fetch("/api/logout",{
        method:"POST",
        headers: { 'Content-Type': 'application/json' },
        credentials:'include',
    });
    store.dispatch("setActiveUserID", 0);
    }
    catch(error){
        console.log(error)
    }
};
</script>

<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand custom-margin" href="#">Blog App</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <RouterLink class="nav-link custom-margin" to="/">Home</RouterLink>
          </li>
          <li class="nav-item" v-if="isAuthenticated()">
            <RouterLink class="nav-link custom-margin" to="/personalBlogs">PersonalBlogs</RouterLink>
          </li>
          <li class="nav-item"  v-if="!isAuthenticated()">
            <RouterLink class="nav-link custom-margin" to="/login">Login</RouterLink>
          </li>
          <li class="nav-item" v-if="!isAuthenticated()">
            <RouterLink class="nav-link custom-margin" to="/register">Register</RouterLink>
          </li>
          <li class="nav-item" v-if="isAuthenticated()">
            <a class="nav-link custom-margin" @click="logOut">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<style scoped>
/* Headline CSS Code */
.custom-margin {
  margin-left: 20px;
}
/*==================*/
</style>
