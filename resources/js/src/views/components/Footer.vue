<template>
    <fwb-footer class="bg-gray-900 rounded-none">
        <div
            class="max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-2xl mx-auto w-full grid grid-cols-1 md:grid-cols-2">
            <fwb-footer-copyright by="LPM Jawa Barat" class="text-slate-100 flex md:justify-start justify-center break-words"
                href="/" copyright-message="All Rights Reserved." />
            <fwb-footer-link-group
                class="text-slate-100 font-regular mx-auto md:mx-0 flex justify-center md:justify-end">
                <fwb-footer-link href="#">
                    Beranda
                </fwb-footer-link>
                <fwb-footer-link href="#">
                    Layanan
                </fwb-footer-link>
                <fwb-footer-link href="#">
                    Kontak Darurat
                </fwb-footer-link>
                <fwb-footer-link href="#">
                    Laporan Keuangan
                </fwb-footer-link>
            </fwb-footer-link-group>
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
