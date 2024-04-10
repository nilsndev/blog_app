
import HomeSiteView from '../vue/views/HomeView.vue'
import LoginSiteView from '../vue/views/LoginView.vue'
import RegisterSiteView from '../vue/views/RegisterView.vue'
import PersonalBlogsView from '../vue/views/PersonalBlogsView.vue'
import OneBlogView from '../vue/views/OneBlogView.vue'

import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path:'/',
        component: HomeSiteView,
    },
    {

        path:'/login',
        component: LoginSiteView,
    },
    {
        path:'/register',
        component: RegisterSiteView,
    },
    {
        path:'/personalBlogs',
        component: PersonalBlogsView,
    },
    {
        path:'/oneBlog/:title/:text:',
        component: OneBlogView,
    },
];

const router = createRouter({
    history:createWebHistory(),
    routes
});

export default router;
