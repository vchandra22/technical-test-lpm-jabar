import { createRouter, createWebHashHistory, createWebHistory } from "vue-router";
import Beranda from "../views/Beranda.vue";

const routes = [
    {
        path: '/',
        component: Beranda,
        meta: { title: 'Beranda' }  // Title halaman Beranda
    },
    {
        path: '/layanan',
        component: () => import('../views/Layanan.vue'),
        meta: { title: 'Layanan' }  // Title halaman Layanan
    },
    {
        path: '/kontak-darurat',
        component: () => import('../views/Kontak.vue'),
        meta: { title: 'Kontak Darurat' }  // Title halaman Layanan
    },
    {
        path: '/laporan-kegiatan',
        component: () => import('../views/Laporan.vue'),
        meta: { title: 'Laporan Kegiatan' }  // Title halaman Layanan
    },
    {
        path: '/login',
        component: () => import('../views/Auth/Login.vue'),
        meta: { title: 'Masuk' }  // Title halaman Layanan
    },
];

    const router = createRouter({
    history: createWebHistory(),
    routes,
    });

    router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next();
    });

export default router;
