<template>
    <fwb-navbar sticky class="bg-slate-50">
        <template #logo>
            <div class="flex items-center gap-4 px-4">
                <img class="w-14" src="../../assets/images/logo.png" width="100" height="100" alt="logo" />
                <p alt="logo provinsi jawa barat" class="text-blue-700 font-bold tracking-wide text-2xl">
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
                <fwb-button class="rounded-md" v-if="!isLoggedIn">
                    <router-link class="px-3 font-bold tracking-wider" to="/login">Masuk</router-link>
                </fwb-button>
                <fwb-button class="rounded-md" v-else @click="logout">
                    <span class="px-3 font-bold tracking-wider">Logout</span>
                </fwb-button>
            </fwb-navbar-collapse>
        </template>
    </fwb-navbar>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import {
    FwbButton,
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
} from 'flowbite-vue';

const isLoggedIn = ref(!!localStorage.getItem("token")); // Check if user is logged in

async function logout() {
    try {
        const token = localStorage.getItem("token"); // Get the token from localStorage
        await axios.delete('/users/logout', {
            headers: {
                Authorization: `Bearer ${token}`  // Include the Authorization header
            }
        });
        localStorage.removeItem("token"); // Clear the token
        isLoggedIn.value = false; // Update login status
        window.location.href = '/login'; // Redirect to login page
    } catch (error) {
        console.error("Logout failed:", error);
        // Handle any error responses here (optional)
    }
}
</script>
