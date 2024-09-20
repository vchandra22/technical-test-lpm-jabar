<template>
    <fwb-footer class="bg-gray-900 rounded-none">
        <div class="max-w-screen-xl mx-auto flex-none md:flex justify-start md:justify-between w-full">
            <fwb-footer-copyright by="LPM Jawa Barat" class="text-slate-100" href="/"
                copyright-message="All Rights Reserved." />
            <fwb-footer-link-group class="text-slate-100 font-regular mx-auto md:mx-0">
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
