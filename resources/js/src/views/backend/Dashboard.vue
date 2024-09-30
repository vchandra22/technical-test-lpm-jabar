<template>
    <div class="container px-4 min-h-screen mt-14 py-12 w-full">
        <h1 class="text-2xl md:text-4xl lg:text-6xl xl:text-7xl font-bold mb-1 text-blue-700">
            Dashboard
        </h1>
        <p class="text-xl font-bold mb-1 text-blue-700 break-words">
            {{ user?.name }}
        </p>
        <p class="text-md font-bold mb-1 text-blue-700 break-words">
            {{ user?.email }}
        </p>

        <!-- form search -->
        <div class="my-4">
            <fwb-input v-model="name" placeholder="Cari. . .">
                <template #prefix>
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </template>
            </fwb-input>
        </div>

        <!-- table section -->
        <fwb-table striped class="shadow-none rounded-md border">
            <fwb-table-head>
                <fwb-table-head-cell>No.</fwb-table-head-cell>
                <fwb-table-head-cell>Nama Lengkap</fwb-table-head-cell>
                <fwb-table-head-cell>NIK</fwb-table-head-cell>
                <fwb-table-head-cell>No.KK</fwb-table-head-cell>
                <fwb-table-head-cell>Usia</fwb-table-head-cell>
                <fwb-table-head-cell>Jenis Kelamin</fwb-table-head-cell>
                <fwb-table-head-cell>Provinsi</fwb-table-head-cell>
                <fwb-table-head-cell>Kab / Kota</fwb-table-head-cell>
                <fwb-table-head-cell>Kecamatan</fwb-table-head-cell>
                <fwb-table-head-cell>Kelurahan</fwb-table-head-cell>
                <fwb-table-head-cell>Alamat</fwb-table-head-cell>
                <fwb-table-head-cell>RT / RW</fwb-table-head-cell>
                <fwb-table-head-cell>Penghasilan Sebelum Pandemi</fwb-table-head-cell>
                <fwb-table-head-cell>Penghasilan Setelah Pandemi</fwb-table-head-cell>
                <fwb-table-head-cell>Action</fwb-table-head-cell>
            </fwb-table-head>
            <fwb-table-body>
                <!-- Loop through the citizens array and render each row -->
                <fwb-table-row v-for="(citizen, index) in citizens" :key="citizen.id">
                    <fwb-table-cell>{{ index + 1 }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.nama }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.nik }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.no_kk }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.umur }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.jenis_kelamin }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.provinsi }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.kab_kota }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.kecamatan }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.kelurahan }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.alamat }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.rt }} {{ citizen.rw }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.b_penghasilan }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.s_penghasilan }}</fwb-table-cell>
                    <fwb-table-cell>
                        <fwb-a href="#">
                            Edit
                        </fwb-a>
                    </fwb-table-cell>
                </fwb-table-row>
            </fwb-table-body>
        </fwb-table>
    </div>
</template>

<script setup>
import {
    FwbA,
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
    FwbInput
} from 'flowbite-vue';
</script>

<script>
import axios from 'axios';

export default {
    name: "Dashboard",
    data() {
        return {
            user: null,
            citizens: [], // To store the data to be shown in the table
            name: '', // For search functionality
        };
    },
    created() {
        this.getCurrentUser();
        this.getAllCitizens(); // Fetch the list of citizens when the component is created
    },
    methods: {
        async getCurrentUser() {
            try {
                const response = await axios.get('/users/current', {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                });

                this.user = response.data.data; // Set user data
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 401) {
                        alert('Unauthorized access. Please log in again.');
                        localStorage.removeItem('token');
                        window.location.href = '/login';
                    } else {
                        console.error('Error fetching user data:', error.response.data);
                        alert('An error occurred: ' + (error.response.data.message || 'Please try again.'));
                    }
                } else if (error.request) {
                    console.error('No response received:', error.request);
                    alert('No response from the server. Please check your connection.');
                } else {
                    console.error('Error:', error.message);
                    alert('Error: ' + error.message);
                }
            }
        },
        async getAllCitizens() {
            try {
                const response = await axios.get('/citizens', {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                });

                this.citizens = response.data.data; // Set the list of citizens
            } catch (error) {
                console.error('Error fetching citizens data:', error);
                alert('An error occurred while fetching data.');
            }
        }
    }
}
</script>

<style scoped></style>
