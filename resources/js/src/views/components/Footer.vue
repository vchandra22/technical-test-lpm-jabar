<template>
    <fwb-footer class="bg-gray-900 rounded-none">
        <div
            class="max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-2xl mx-auto w-full grid grid-cols-1 md:grid-cols-2">
            <fwb-footer-link-group
                class="text-slate-100 font-regular mx-auto md:mx-0 flex justify-center md:justify-start">
                <fwb-footer-link>
                    <router-link to="/beranda">Beranda</router-link>
                </fwb-footer-link>
                <fwb-footer-link>
                    <router-link to="/layanan">Layanan</router-link>
                </fwb-footer-link>
                <fwb-footer-link>
                    <router-link to="/kontak-darurat">Kontak Darurat</router-link>
                </fwb-footer-link>
                <fwb-footer-link>
                    <router-link to="/laporan-kegiatan">Laporan Kegiatan</router-link>
                </fwb-footer-link>
            </fwb-footer-link-group>
            <fwb-footer-copyright by=" LPM Jawa Barat " class="text-slate-100 flex md:justify-end justify-center"
                href="/" copyright-message=" All Rights Reserved." />
        </div>
    </fwb-footer>
</template>

<script setup>
import {
    FwbFooter,
    FwbFooterCopyright,
    FwbFooterLink,
    FwbFooterLinkGroup,
} from 'flowbite-vue'
</script>
