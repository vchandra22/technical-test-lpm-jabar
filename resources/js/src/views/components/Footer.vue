<template>
    <fwb-footer class="bg-slate-900 rounded-none h-8">
        <div class="max-w-screen-xl mx-auto flex justify-between w-full">
            <fwb-footer-copyright by="LPM Jawa Barat" class="text-slate-100" href="/"
                copyright-message="All Rights Reserved." />
            <fwb-footer-link-group class="text-slate-100 font-regular">
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
