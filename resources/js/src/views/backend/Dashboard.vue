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
                <fwb-table-head-cell>
                    <span>Action</span>
                </fwb-table-head-cell>
            </fwb-table-head>
            <fwb-table-body>
                <fwb-table-row>
                    <fwb-table-cell>1</fwb-table-cell>
                    <fwb-table-cell>John Doe</fwb-table-cell>
                    <fwb-table-cell>35051803111111</fwb-table-cell>
                    <fwb-table-cell>3505 1834 1111</fwb-table-cell>
                    <fwb-table-cell>27</fwb-table-cell>
                    <fwb-table-cell>Laki-Laki</fwb-table-cell>
                    <fwb-table-cell>Jawa Barat</fwb-table-cell>
                    <fwb-table-cell>Cikeas</fwb-table-cell>
                    <fwb-table-cell>Cikeas</fwb-table-cell>
                    <fwb-table-cell>Sukamaju</fwb-table-cell>
                    <fwb-table-cell>Jl. Bunga Matahari No. 119</fwb-table-cell>
                    <fwb-table-cell>004/012</fwb-table-cell>
                    <fwb-table-cell>Rp. 3.486.903</fwb-table-cell>
                    <fwb-table-cell>Rp. 2.566.095</fwb-table-cell>
                    <fwb-table-cell>
                        <fwb-a href="#">
                            Edit
                        </fwb-a>
                    </fwb-table-cell>
                </fwb-table-row>
                <fwb-table-row>
                    <fwb-table-cell>1</fwb-table-cell>
                    <fwb-table-cell>John Doe</fwb-table-cell>
                    <fwb-table-cell>35051803111111</fwb-table-cell>
                    <fwb-table-cell>3505 1834 1111</fwb-table-cell>
                    <fwb-table-cell>27</fwb-table-cell>
                    <fwb-table-cell>Laki-Laki</fwb-table-cell>
                    <fwb-table-cell>Jawa Barat</fwb-table-cell>
                    <fwb-table-cell>Cikeas</fwb-table-cell>
                    <fwb-table-cell>Cikeas</fwb-table-cell>
                    <fwb-table-cell>Sukamaju</fwb-table-cell>
                    <fwb-table-cell>Jl. Bunga Matahari No. 119</fwb-table-cell>
                    <fwb-table-cell>004/012</fwb-table-cell>
                    <fwb-table-cell>Rp. 3.486.903</fwb-table-cell>
                    <fwb-table-cell>Rp. 2.566.095</fwb-table-cell>
                    <fwb-table-cell>
                        <fwb-a href="#">
                            Edit
                        </fwb-a>
                    </fwb-table-cell>
                </fwb-table-row>
                <fwb-table-row>
                    <fwb-table-cell>1</fwb-table-cell>
                    <fwb-table-cell>John Doe</fwb-table-cell>
                    <fwb-table-cell>35051803111111</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">3505 1834 1111</fwb-table-cell>
                    <fwb-table-cell>27</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">Laki-Laki</fwb-table-cell>
                    <fwb-table-cell>Jawa Barat</fwb-table-cell>
                    <fwb-table-cell>Cikeas</fwb-table-cell>
                    <fwb-table-cell>Cikeas</fwb-table-cell>
                    <fwb-table-cell>Sukamaju</fwb-table-cell>
                    <fwb-table-cell>Jl. Bunga Matahari No. 119</fwb-table-cell>
                    <fwb-table-cell>004/012</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">Rp. 3.486.903</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">Rp. 2.566.095</fwb-table-cell>
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
} from 'flowbite-vue'
</script>

<script>
import axios from 'axios';

export default {
    name: "Dashboard",
    data() {
        return {
            user: null
        };
    },
    created() {
        this.getCurrentUser();
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
                    // Server responded with a status code outside the range of 2xx
                    if (error.response.status === 401) { // Correctly check for 401 status
                        alert('Unauthorized access. Please log in again.');
                        localStorage.removeItem('token'); // Clear token
                        window.location.href = '/login'; // Redirect to login
                    } else {
                        console.error('Error fetching user data:', error.response.data);
                        alert('An error occurred: ' + (error.response.data.message || 'Please try again.'));
                    }
                } else if (error.request) {
                    // The request was made but no response was received
                    console.error('No response received:', error.request);
                    alert('No response from the server. Please check your connection.');
                } else {
                    // Something happened in setting up the request that triggered an error
                    console.error('Error:', error.message);
                    alert('Error: ' + error.message);
                }
            }
        }
    }
}
</script>

<style scoped></style>
