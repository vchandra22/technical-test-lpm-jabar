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
        meta: { title: 'Kontak Darurat' }  // Title halaman Kontak Darurat
    },
    {
        path: '/laporan-kegiatan',
        component: () => import('../views/Laporan.vue'),
        meta: { title: 'Laporan Kegiatan' }  // Title halaman Laporan
    },
    {
        path: '/login',
        component: () => import('../views/auth/Login.vue'),
        meta: {
            title: 'Masuk', // Title halaman Login
            requiresAuth: false
        }
    },
    {
        path: '/dashboard',
        component: () => import('../views/backend/Dashboard.vue'),
        meta: {
            title: 'Dashboard', // Title halaman Dashboard
            requiresAuth: true
        }
    },
];

    const router = createRouter({
        history: createWebHistory(),
        routes,
    });

    // Route guard untuk mengecek autentikasi sebelum mengakses halaman tertentu
    router.beforeEach((to, from, next) => {
        document.title = to.meta.title;  // Mengubah title halaman

        const isAuthenticated = !!localStorage.getItem("token");  // Cek apakah token ada

        if (to.meta.requiresAuth && !isAuthenticated) {
            // Jika halaman butuh autentikasi dan user belum login
            next('/login');  // Redirect ke halaman login
        } else if (to.path === '/login' && isAuthenticated) {
            // Jika user sudah login dan mencoba ke halaman login, redirect ke dashboard
            next('/dashboard');
        } else {
            next();  // Lanjutkan ke halaman yang dituju
        }
    });

export default router;
