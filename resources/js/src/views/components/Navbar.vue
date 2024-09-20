<template>
    <fwb-navbar sticky class="bg-slate-50">
        <template #logo>
            <fwb-navbar-logo alt="Flowbite logo"
                image-url="https://www.pikpng.com/pngl/m/441-4415375_logo-provinsi-jawa-barat-png-logo-provinsi-jawa.png"
                link="#">
                LPM Jawa Barat
            </fwb-navbar-logo>
        </template>
        <template #default="{ isShowMenu }">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-navbar-link link="#" class="my-auto">
                    <router-link to="/" activeClass="text-blue-700">Beranda</router-link>
                </fwb-navbar-link>
                <fwb-navbar-link link="#" class="my-auto">
                    <router-link to="/layanan" activeClass="text-blue-700">Layanan</router-link>
                </fwb-navbar-link>
                <fwb-navbar-link link="#" class="my-auto">
                    <router-link to="/kontak-darurat">Kontak Darurat</router-link>
                </fwb-navbar-link>
                <fwb-navbar-link link="#" class="my-auto">
                    <router-link to="/laporan-kegiatan">Laporan Kegiatan</router-link>
                </fwb-navbar-link>
                <fwb-button class="rounded-md">
                    <router-link class="px-3" to="/login">Masuk</router-link>
                </fwb-button>
            </fwb-navbar-collapse>
        </template>
    </fwb-navbar>
</template>

<script setup>
import {
    FwbButton,
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
} from 'flowbite-vue'
</script>
