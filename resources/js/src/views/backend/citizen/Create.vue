<template>
    <!-- citizen form crate -->
    <section class="container px-4 min-h-screen mt-14 py-12 w-full">
        <div class="w-full md:w-5/6 xl:w-10/12 border border-slate-200 bg-slate-50 h-auto flex mx-auto rounded-md">
            <div class="w-full p-8 mx-auto">
                <h1 class="text-lg md:text-xl lg:text-2xl xl:text-4xl font-bold mb-12 text-center text-blue-700">
                    Tambah Data Baru
                </h1>
                <form submit.prevent="createCitizen">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="nama">Nama
                                    Lengkap</label>
                                <input v-model="nama" type="text" id="nama"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="John Doe" required />
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="nik">NIK</label>
                                <input v-model="nik" type="number" id="nik"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan Nomor KTP" required />
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="email">No. Kartu
                                    Keluarga</label>
                                <input v-model="no_kk" type="number" id="no_kk"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan Nomor Kartu Keluarga" required />
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start"
                                    for="umur">Umur</label>
                                <input v-model="umur" type="number" id="umur"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="27" required />
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="jenis_kelamin">
                                    Jenis Kelamin
                                </label>
                                <select v-model="jenis_kelamin" id="jenis_kelamin"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                                    <option value="" selected disabled>Pilih jenis kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="provinsi">
                                    Provinsi
                                </label>
                                <select v-model="selectedProvince" id="province" @change="fetchRegencies"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                                    <option v-for="province in provinces" :key="province.id" :value="province.name">
                                        {{ province.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="mb-4" v-if="regencies.length > 0">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="regency">
                                    Kab / Kota
                                </label>
                                <select v-model="selectedRegency" id="kab_kota"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                                    <option v-for="regency in regencies" :key="regency.id" :value="regency.name">
                                        {{ regency.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="kelurahan">
                                    Kelurahan
                                </label>
                                <select v-model="kelurahan" id="kelurahan"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                                    <option value="" selected disabled>Pilih Kelurahan</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="flex justify-between gap-4 w-full">
                                <div class="mb-4 w-full">
                                    <label class="block text-sm font-medium text-slate-500 text-start"
                                        for="rt">RT</label>
                                    <input v-model="rt" type="number" id="rt"
                                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                        placeholder="001" required />
                                </div>

                                <div class="mb-4 w-full">
                                    <label class="block text-sm font-medium text-slate-500 text-start"
                                        for="rw">RW</label>
                                    <input v-model="rw" type="number" id="rw"
                                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                        placeholder="001" required />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="alamat"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                <textarea v-model="alamat" id="alamat" rows="5"
                                    class="mt-1 p-2 block w-full border bg-white border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan alamat"></textarea>
                            </div>
                        </div>

                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start"
                                    for="b_penghasilan">Penghasilan Sebelum Pandemi</label>
                                <input v-model="b_penghasilan" type="number" id="b_penghasilan"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan penghasilan sebelum pandemi" required />
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start"
                                    for="s_penghasilan">Penghasilan Setelah Pandemi</label>
                                <input v-model="s_penghasilan" type="number" id="s_penghasilan"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Masukkan penghasilan sesudah pandemi" required />
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="foto_ktp">
                                    Foto KTP
                                </label>
                                <input type="file" id="foto_ktp"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    @change="onFileChange" />
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-500 text-start" for="foto_kk">
                                    Foto KK
                                </label>
                                <input type="file" id="foto_kk"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                    @change="onFileChange" />
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
            selectedProvince: '',
            selectedRegency: '',
            citizen: {
                nama: '',
                nik: '',
                umur: '',
                provinsi: '' // Holds the province to be posted
            }
        };
    },
    mounted() {
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
            } catch (error) {
                console.error('Error fetching regencies:', error);
            }
        },
        // Submit the citizen data to your Laravel API
        async submitCitizen() {
            try {
                // Update the citizen's province before submission
                this.citizen.provinsi = this.selectedProvince;

                // Send the citizen data to the backend
                const response = await axios.post('/citizens', this.citizen, {
                    headers: {
                        Authorization: `Bearer YOUR_AUTH_TOKEN` // Replace with actual token if needed
                    }
                });

                if (response.status === 201) {
                    alert('Citizen data saved successfully');
                }
            } catch (error) {
                console.error('Error posting citizen data:', error);
            }
        }
    }
};
</script>
