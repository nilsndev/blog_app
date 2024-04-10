
import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js'

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import home from "./vue/home.vue";
import router from "./router/index.js"
import store from "./store/store.js"

const app = createApp(home)

app.use(router).use(store).use(bootstrap)

app.mount("#app")
