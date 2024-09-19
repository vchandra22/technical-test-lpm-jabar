<template>
    <fwb-navbar class="bg-slate-100">
        <template #logo>
            <fwb-navbar-logo alt="Flowbite logo"
                image-url="https://www.pikpng.com/pngl/m/441-4415375_logo-provinsi-jawa-barat-png-logo-provinsi-jawa.png"
                link="#">
                LPM Jawa Barat
            </fwb-navbar-logo>
        </template>
        <template #default="{ isShowMenu }">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-navbar-link is-active>
                    <router-link to="/profile">Beranda</router-link>
                </fwb-navbar-link>
                <fwb-navbar-link link="#">
                    Layanan
                </fwb-navbar-link>
                <fwb-navbar-link link="#">
                    Kontak Darurat
                </fwb-navbar-link>
                <fwb-navbar-link link="#">
                    Contact
                </fwb-navbar-link>
            </fwb-navbar-collapse>
        </template>
    </fwb-navbar>
</template>

<script setup>
import {
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
} from 'flowbite-vue'
</script>
