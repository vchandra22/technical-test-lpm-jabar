<template>
    <!-- citizen form crate -->
    <section class="container px-4 min-h-screen mt-14 py-12 w-full">
        <div class="w-full md:w-5/6 xl:w-10/12 border border-slate-200 bg-white h-auto flex mx-auto rounded-md">
            <div class="w-full p-8 mx-auto">
                <h1 class="text-lg md:text-xl lg:text-2xl xl:text-4xl font-bold mb-12 text-center text-blue-700">
                    Edit Data
                </h1>
                <form @submit.prevent="submitUpdateCitizen">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="nama">Nama
                                    Lengkap</label>
                                <input v-model="citizen.nama" type="text" id="nama"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan Nama Lengkap" required />
                                <p v-if="errors.nama" class="mt-2 text-sm text-red-600">{{ errors.nama[0] }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="nik">NIK</label>
                                <input v-model="citizen.nik" type="number" id="nik"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan Nomor KTP" required />
                                <p v-if="errors.nik" class="mt-2 text-sm text-red-600">{{ errors.nik[0] }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="email">No. Kartu
                                    Keluarga</label>
                                <input v-model="citizen.no_kk" type="number" id="no_kk"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan Nomor Kartu Keluarga" required />
                                <p v-if="errors.no_kk" class="mt-2 text-sm text-red-600">{{ errors.no_kk[0] }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start"
                                    for="umur">Umur</label>
                                <input v-model="citizen.umur" type="number" id="umur"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Umur" required />
                                <p v-if="errors.umur" class="mt-2 text-sm text-red-600">{{ errors.umur[0] }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="jenis_kelamin">
                                    Jenis Kelamin
                                </label>
                                <select v-model="citizen.jenis_kelamin" id="jenis_kelamin"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                                    <option value="" selected disabled>Pilih jenis kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <p v-if="errors.jenis_kelamin" class="mt-2 text-sm text-red-600">{{
                                    errors.jenis_kelamin[0] }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="provinsi">
                                    Provinsi
                                </label>
                                <select v-model="selectedProvince" id="province" @change="fetchRegencies"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                                    <option v-for="province in provinces" :key="province.id" :value="province.id">
                                        {{ province.name }}
                                    </option>
                                </select>
                                <p v-if="errors.provinsi" class="mt-2 text-sm text-red-600">{{ errors.provinsi[0] }}</p>
                            </div>

                            <div class="mb-4" v-if="regencies.length > 0">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="regency">
                                    Kab / Kota
                                </label>
                                <select v-model="selectedRegency" id="kab_kota" @change="fetchDistrict" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm
                                    focus:outline-none focus:ring focus:border-blue-300" required>
                                    <option v-for="regency in regencies" :key="regency.id" :value="regency.id">
                                        {{ regency.name }}
                                    </option>
                                </select>
                                <p v-if="errors.kab_kota" class="mt-2 text-sm text-red-600">{{ errors.kab_kota[0] }}</p>
                            </div>

                            <div class="mb-4" v-if="districts.length > 0">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="kecamatan">
                                    Kecamatan
                                </label>
                                <select v-model="selectedDistrict" id="kecamatan" @change="fetchVillage"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                                    <option v-for="district in districts" :key="district.id" :value="district.id">
                                        {{ district.name }}
                                    </option>
                                </select>
                                <p v-if="errors.kecamatan" class="mt-2 text-sm text-red-600">{{ errors.kecamatan[0] }}
                                </p>
                            </div>

                            <div class="mb-4" v-if="villages.length > 0">
                                <!-- Use villages.length to conditionally show the dropdown -->
                                <label class="block text-sm font-medium text-slate-500 text-start" for="kelurahan">
                                    Kelurahan
                                </label>
                                <select v-model="selectedVillage" id="kelurahan"
                                    @change="selectVillage(selectedVillage)"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                                    <option v-for="village in villages" :key="village.id" :value="village.id">
                                        {{ village.name }}
                                    </option>
                                </select>
                                <p v-if="errors.kelurahan" class="mt-2 text-sm text-red-600">{{ errors.kelurahan[0] }}
                                </p>
                            </div>

                            <div class="flex justify-between gap-4 w-full">
                                <div class="mb-4 w-full">
                                    <label class="block text-sm font-medium text-slate-500 text-start"
                                        for="rt">RT</label>
                                    <input v-model="citizen.rt" type="number" id="rt"
                                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                        placeholder="001" required />
                                    <p v-if="errors.rt" class="mt-2 text-sm text-red-600">{{ errors.rt[0] }}
                                    </p>
                                </div>

                                <div class="mb-4 w-full">
                                    <label class="block text-sm font-medium text-slate-500 text-start"
                                        for="rw">RW</label>
                                    <input v-model="citizen.rw" type="number" id="rw"
                                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                        placeholder="001" required />
                                    <p v-if="errors.rw" class="mt-2 text-sm text-red-600">{{ errors.rw[0] }}
                                    </p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="alamat"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                <textarea v-model="citizen.alamat" id="alamat" rows="5"
                                    class="mt-1 p-2 block w-full border bg-white border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan alamat"></textarea>
                                <p v-if="errors.alamat" class="mt-2 text-sm text-red-600">{{ errors.alamat[0] }}</p>
                            </div>
                        </div>

                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start"
                                    for="b_penghasilan">Penghasilan Sebelum Pandemi</label>
                                <input v-model="citizen.b_penghasilan" type="number" id="b_penghasilan"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan penghasilan sebelum pandemi" required />
                                <p v-if="errors.b_penghasilan" class="mt-2 text-sm text-red-600">{{
                                    errors.b_penghasilan[0] }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start"
                                    for="s_penghasilan">Penghasilan Setelah Pandemi</label>
                                <input v-model="citizen.s_penghasilan" type="number" id="s_penghasilan"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan penghasilan sesudah pandemi" required />
                                <p v-if="errors.s_penghasilan" class="mt-2 text-sm text-red-600">{{
                                    errors.s_penghasilan[0] }}</p>
                            </div>

                            <!-- File Uploads -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="foto_ktp">
                                    Foto KTP
                                </label>
                                <input type="file" id="foto_ktp"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    @change="onFileChange($event, 'ktp')" />
                                <p v-if="errors.foto_ktp" class="mt-2 text-sm text-red-600">{{ errors.foto_ktp[0] }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="foto_kk">
                                    Foto KK
                                </label>
                                <input type="file" id="foto_kk"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    @change="onFileChange($event, 'kk')" />
                                <p v-if="errors.foto_kk" class="mt-2 text-sm text-red-600">{{ errors.foto_kk[0] }}</p>
                            </div>

                            <div class="mb-4">
                                <label for="alasan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alasan</label>
                                <textarea v-model="citizen.alasan" id="alasan" rows="5"
                                    class="mt-1 p-2 block w-full border bg-white border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan alasan"></textarea>
                                <p v-if="errors.alasan" class="mt-2 text-sm text-red-600">{{ errors.alasan[0] }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mt-8">
                            <button type="submit" :disabled="loading"
                                class="bg-blue-700 w-full hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring tracking-wide focus:ring-blue-300 disabled:opacity-50">
                                <span v-if="loading">Loading...</span>
                                <span v-else>Simpan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';


export default {
    data() {
        return {
            provinces: [],
            regencies: [],
            districts: [],
            villages: [],
            selectedProvince: '',
            selectedRegency: '',
            selectedDistrict: '',
            selectedVillage: '',
            citizen: {
                nama: '',
                nik: '',
                no_kk: '',
                umur: '',
                jenis_kelamin: '',
                provinsi: '',
                kab_kota: '',
                kecamatan: '',
                kelurahan: '',
                rt: '',
                rw: '',
                alamat: '',
                b_penghasilan: '',
                s_penghasilan: '',
                alasan: ''
            },
            ktpFile: null,
            kkFile: null,
            errors: {}
        };
    },
    mounted() {
        this.fetchCitizenData();
        this.getProvinces(); // Fetch provinces when the component is mounted
    },
    methods: {
        // Fetch the provinces from the external API
        async getProvinces() {
            try {
                const response = await axios.get(
                    'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json'
                );
                this.provinces = response.data;
            } catch (error) {
                console.error('Error fetching provinces:', error);
            }
        },
        // Fetch regencies based on the selected province id
        async fetchRegencies() {
            try {
                const provinceId = this.selectedProvince; // Get the selected province id

                const response = await axios.get(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`
                );
                this.regencies = response.data;

                // Set the province name in the citizen object
                const selectedProvince = this.provinces.find(province => province.id === provinceId);
                if (selectedProvince) {
                    this.citizen.provinsi = selectedProvince.name;
                }
            } catch (error) {
                console.error('Error fetching regencies:', error);
            }
        },
        // Fetch district based on the selected regencies id
        async fetchDistrict() {
            try {
                const regencyId = this.selectedRegency; // Get the selected regency id

                const response = await axios.get(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyId}.json` // Update endpoint as needed
                );
                this.districts = response.data; // Store the fetched districts

                // Set the regency name in the citizen object
                const selectedRegency = this.regencies.find(regency => regency.id === regencyId);
                if (selectedRegency) {
                    this.citizen.kab_kota = selectedRegency.name;
                }
            } catch (error) {
                console.error('Error fetching districts:', error);
            }
        },
        // Fetch villages based on the selected district id
        async fetchVillage() {
            try {
                const districtId = this.selectedDistrict; // Get the selected regency id

                const response = await axios.get(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtId}.json` // Update endpoint as needed
                );
                this.villages = response.data; // Store the fetched districts

                // Set the district name in the citizen object
                const selectedDistrict = this.districts.find(district => district.id === districtId);
                if (selectedDistrict) {
                    this.citizen.kecamatan = selectedDistrict.name;
                }
            } catch (error) {
                console.error('Error fetching districts:', error);
            }
        },

        // Method to handle the selection of a village
        selectVillage(villageId) {
            const selectedVillage = this.villages.find(village => village.id === villageId);
            if (selectedVillage) {
                this.citizen.kelurahan = selectedVillage.name; // Store the village name in the citizen object
            }
        },

        onFileChange(event, type) {
            const file = event.target.files[0]; // Get the selected file
            if (file) {
                // Store the file based on type and update citizen object
                if (type === 'ktp') {
                    this.ktpFile = file;
                    this.citizen.foto_ktp = file; // Update citizen object
                } else if (type === 'kk') {
                    this.kkFile = file;
                    this.citizen.foto_kk = file; // Update citizen object
                }
            }
        },
        // Submit the citizen data to your Laravel API
        async submitUpdateCitizen() {
            try {
                console.log('Data yang akan dikirim:', this.citizen);
                const formData = new FormData();

                // Append each field of the citizen object individually
                Object.keys(this.citizen).forEach(key => {
                    const value = this.citizen[key];

                    // Check if value is an object and handle accordingly
                    if (typeof value === 'object' && value !== null) {
                        // Convert objects/arrays to JSON string if necessary
                        formData.append(key, JSON.stringify(value));
                    } else {
                        formData.append(key, value);
                    }
                });

                // Append the files if they exist
                if (this.ktpFile) {
                    formData.append('foto_ktp', this.ktpFile);
                }
                if (this.kkFile) {
                    formData.append('foto_kk', this.kkFile);
                }

                formData.append('_method', 'PUT');

                const citizenId = this.$route.params.id;

                // Send the data to the backend
                const response = await axios.post(`/citizens/${citizenId}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                });

                if (response.status === 200) {
                    this.$router.push('/dashboard');
                    this.errors = {};
                    // Optionally, redirect
                }
            } catch (error) {
                if (error.response && error.response.status === 400) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error('Error updating citizen data:', error);
                }
            }
        },

        async fetchCitizenData() {
            const citizenId = this.$route.params.id; // Get the citizen ID from the route parameters
            try {
                const response = await axios.get(`/citizens/${citizenId}`, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }); // Fetch the citizen data from the API
                this.citizen = response.data.data; // Set the data to the citizen object
            } catch (error) {
                console.error('Error fetching citizen data:', error);
            }
        },
    }
};
</script>
