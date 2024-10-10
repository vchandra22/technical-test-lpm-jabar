<template>
    <div class="container px-4 min-h-screen mt-14 py-12 w-full">
        <!-- User Info -->
        <div class="flex w-full justify-between items-end">
            <div>
                <h1 class="text-2xl md:text-4xl lg:text-6xl xl:text-7xl font-bold mb-1 text-blue-700">Dashboard</h1>
                <p class="text-xl font-bold mb-1 text-blue-700 break-words">{{ user?.name }}</p>
                <p class="text-md font-bold mb-1 text-blue-700 break-words">{{ user?.email }}</p>
            </div>
            <div
                class="text-gray-700 hover:text-blue-700 hover:font-bold hover:bg-gray-100 md:hover:bg-transparent rounded-md">
                <router-link class="font-bold tracking-wider pl-3 md:pl-0 py-1 md:py-0" to="/tambah-data">
                    <fwb-button class="rounded-md px-8">
                        Tambah Data
                    </fwb-button>
                </router-link>
            </div>
        </div>

        <!-- Search Form -->
        <div class="my-4">
            <fwb-input v-model="searchQuery" @input="debouncedSearch" placeholder="Cari. . .">
                <template #prefix>
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </template>
            </fwb-input>
        </div>

        <!-- Citizen Table -->
        <fwb-table striped class="shadow-none rounded-md border">
            <fwb-table-head>
                <!-- Table Head Cells -->
                <fwb-table-head-cell>No.</fwb-table-head-cell>
                <fwb-table-head-cell>Nama Lengkap</fwb-table-head-cell>
                <fwb-table-head-cell></fwb-table-head-cell>
                <fwb-table-head-cell></fwb-table-head-cell>
                <fwb-table-head-cell>NIK</fwb-table-head-cell>
                <fwb-table-head-cell>No.KK</fwb-table-head-cell>
                <fwb-table-head-cell>Usia</fwb-table-head-cell>
                <fwb-table-head-cell>Jenis Kelamin</fwb-table-head-cell>
                <fwb-table-head-cell>Provinsi</fwb-table-head-cell>
                <fwb-table-head-cell class="whitespace-pre">Kab / Kota</fwb-table-head-cell>
                <fwb-table-head-cell>Kecamatan</fwb-table-head-cell>
                <fwb-table-head-cell>Kelurahan</fwb-table-head-cell>
                <fwb-table-head-cell>Alamat</fwb-table-head-cell>
                <fwb-table-head-cell></fwb-table-head-cell>
                <fwb-table-head-cell></fwb-table-head-cell>
                <fwb-table-head-cell class="whitespace-pre">RT / RW</fwb-table-head-cell>
                <fwb-table-head-cell>Penghasilan Sebelum Pandemi</fwb-table-head-cell>
                <fwb-table-head-cell>Penghasilan Setelah Pandemi</fwb-table-head-cell>
                <fwb-table-head-cell>Action</fwb-table-head-cell>
            </fwb-table-head>
            <fwb-table-body>
                <!-- Table Rows -->
                <fwb-table-row v-if="citizens.length > 0" v-for="(citizen, index) in citizens" :key="citizen.id">
                    <fwb-table-cell>{{ (pagination.current_page - 1) * pageSize + index + 1 }}</fwb-table-cell>
                    <fwb-table-cell colspan="3">{{ citizen.nama }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.nik }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.no_kk }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.umur }}</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">{{ citizen.jenis_kelamin }}</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">{{ citizen.provinsi }}</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">{{ citizen.kab_kota }}</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">{{ citizen.kecamatan }}</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">{{ citizen.kelurahan }}</fwb-table-cell>
                    <fwb-table-cell colspan="3">{{ citizen.alamat }}</fwb-table-cell>
                    <fwb-table-cell class="whitespace-pre">{{ citizen.rt }} / {{ citizen.rw }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.b_penghasilan }}</fwb-table-cell>
                    <fwb-table-cell>{{ citizen.s_penghasilan }}</fwb-table-cell>
                    <fwb-table-cell>
                        <fwb-a :href="`/edit-data/${citizen.id}`">Edit</fwb-a>
                    </fwb-table-cell>
                </fwb-table-row>
                <fwb-table-row v-else>
                    <td :colspan="19" class="text-center py-12 w-full">
                        <span>
                            No data available
                        </span>
                    </td>
                </fwb-table-row>
            </fwb-table-body>
        </fwb-table>

        <!-- Pagination -->
        <fwb-pagination class="py-4 w-full mx-auto flex justify-center" v-model="pagination.current_page"
            :total-pages="pagination.last_page" :total="pagination.total" show-icons @page-changed="getAllCitizens" />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { debounce } from 'lodash';
import {
    FwbA,
    FwbButton,
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
    FwbInput,
    FwbPagination
} from 'flowbite-vue';

const citizens = ref([])
const pagination = ref({
    current_page: 1,
    last_page: 1,
    total: 0
})
const pageSize = ref(10)
const searchQuery = ref('')

// Fetch citizens and pagination data
const getAllCitizens = async (page = 1) => {
    try {
        const response = await axios.get('/citizens', {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            },
            params: {
                page,
                search: searchQuery.value,
                size: pageSize.value
            }
        })

        citizens.value = response.data.data;

        // Update pagination
        pagination.value = {
            current_page: response.data.meta.current_page,
            last_page: response.data.meta.last_page,
            total: response.data.meta.total
        }
    } catch (error) {
        console.error('Error fetching citizens data:', error)
        alert('An error occurred while fetching data.')
    }
}

const debouncedSearch = debounce(() => {
    pagination.value.current_page = 1; // Reset to first page
    getAllCitizens(pagination.value.current_page);
}, 300);

onMounted(() => {
    getAllCitizens(pagination.value.current_page)
})
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
                this.handleError(error);
            }
        },
        handleError(error) {
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
    }
}
</script>
