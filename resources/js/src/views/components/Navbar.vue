<template>
    <fwb-navbar sticky class="bg-slate-50">
        <template #logo>
            <fwb-navbar-logo alt="Flowbite logo"
                image-url="https://www.pikpng.com/pngl/m/441-4415375_logo-provinsi-jawa-barat-png-logo-provinsi-jawa.png"
                link="#" class="text-blue-700 font-bold tracking-wide">
                LPM Jawa Barat
            </fwb-navbar-logo>
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
                <fwb-button class="rounded-md">
                    <router-link class="px-3 font-bold tracking-wider" to="/login">Masuk</router-link>
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
