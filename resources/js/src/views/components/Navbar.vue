<template>
    <fwb-navbar sticky class="bg-slate-50">
        <template #logo>
            <div class="flex items-center gap-2 px-0 lg:px-4">
                <img class="w-8 md:w-10 lg:w-12 xl:w-14" src="../../assets/images/logo.png" width="100" height="100"
                    alt="logo" />
                <p alt="logo provinsi jawa barat"
                    class="text-blue-700 font-bold tracking-wide text-sm md:text-md lg:text-2xl xl:text-4xl">
                    LPM Jawa Barat
                </p>
            </div>
        </template>
        <template #default="{ isShowMenu }">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-navbar-link link="#" class="my-auto text-md tracking-wide">
                    <router-link to="/" activeClass="text-blue-700 font-semibold">Beranda</router-link>
                </fwb-navbar-link>
                <fwb-navbar-link link="#" class="my-auto text-md tracking-wide">
                    <router-link to="/layanan" activeClass="text-blue-700 font-semibold">Layanan</router-link>
                </fwb-navbar-link>
                <fwb-navbar-link link="#" class="my-auto text-md tracking-wide">
                    <router-link to="/kontak-darurat" activeClass="text-blue-700 font-semibold">Kontak
                        Darurat</router-link>
                </fwb-navbar-link>
                <fwb-navbar-link link="#" class="my-auto text-md tracking-wide">
                    <router-link to="/laporan-kegiatan" activeClass="text-blue-700 font-semibold">Laporan
                        Kegiatan</router-link>
                </fwb-navbar-link>
                <fwb-navbar-link v-if="authStore.isLoggedIn" link="#" class="my-auto text-md tracking-wide">
                    <router-link to="/dashboard" activeClass="text-blue-700 font-semibold">Dashboard</router-link>
                </fwb-navbar-link>
                <router-link v-if="!authStore.isLoggedIn" class="font-bold tracking-wider" to="/login">
                    <fwb-button class="rounded-md px-8">
                        Masuk
                    </fwb-button>
                </router-link>
                <button class="text-gray-700" v-else @click="logout">
                    <div class="px-0 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                    </div>
                </button>
            </fwb-navbar-collapse>
        </template>
    </fwb-navbar>
</template>

<script setup>
import { useAuthStore } from '../../stores/authStore'; // Import your auth store
import { ref } from 'vue';
import axios from 'axios';
import {
    FwbButton,
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
} from 'flowbite-vue';

const authStore = useAuthStore(); // Access the auth store

async function logout() {
    try {
        const token = localStorage.getItem("token"); // Get the token from localStorage
        await axios.delete('/users/logout', {
            headers: {
                Authorization: `Bearer ${token}`  // Include the Authorization header
            }
        });
        authStore.logout();
        window.location.href = '/login'; // Redirect to login page
    } catch (error) {
        console.error("Logout failed:", error);
        // Handle any error responses here (optional)
    }
}
</script>
