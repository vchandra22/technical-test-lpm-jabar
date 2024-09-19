import { createRouter, createWebHashHistory, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";

const router = createRouter({
    history : createWebHistory('/'),
    routes: [
        {
            path : '/',
            name : 'home',
            component : Home
        },
        {
            path : '/profile',
            name : 'profile',
            component: () => import('../views/Profile.vue')
        }
    ]
});

export default router;
