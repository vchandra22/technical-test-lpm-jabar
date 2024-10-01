import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from '../stores/authStore'; // Import your auth store
import Beranda from "../views/Beranda.vue";

const routes = [
    {
        path: '/',
        component: Beranda,
        meta: { title: 'Beranda' }
    },
    {
        path: '/layanan',
        component: () => import('../views/Layanan.vue'),
        meta: { title: 'Layanan' }
    },
    {
        path: '/kontak-darurat',
        component: () => import('../views/Kontak.vue'),
        meta: { title: 'Kontak Darurat' }
    },
    {
        path: '/laporan-kegiatan',
        component: () => import('../views/Laporan.vue'),
        meta: { title: 'Laporan Kegiatan' }
    },
    {
        path: '/login',
        component: () => import('../views/auth/Login.vue'),
        meta: {
            title: 'Masuk',
            requiresAuth: false
        }
    },
    {
        path: '/register',
        component: () => import('../views/auth/Register.vue'),
        meta: {
            title: 'Mendaftar',
            requiresAuth: false
        }
    },
    {
        path: '/dashboard',
        component: () => import('../views/backend/Dashboard.vue'),
        meta: {
            title: 'Dashboard',
            requiresAuth: true
        }
    },
    {
        path: '/tambah-data',
        component: () => import('../views/backend/citizen/Create.vue'),
        meta: {
            title: 'Tambah Data',
            requiresAuth: true
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Route guard for authentication and title handling
router.beforeEach((to, from, next) => {
    // Set document title from meta property
    document.title = to.meta.title || 'LPM Jawa Barat';

    const authStore = useAuthStore(); // Access the auth store
    const isAuthenticated = authStore.isLoggedIn; // Get the authentication state from the store

    // Check if route requires authentication and user is not authenticated
    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login');  // Redirect to login page
    } else if (to.path === '/login' && isAuthenticated) {
        next('/dashboard');  // If authenticated, redirect to dashboard
    } else {
        next();  // Proceed to the route
    }
});

export default router;
