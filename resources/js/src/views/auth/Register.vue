<template>
    <fwb-alert type="danger" class="mt-20 pt-5 absolute w-full top-0 left-0" v-if="errorMessage">
        {{ errorMessage }}
    </fwb-alert>
    <div class="container px-4 min-h-screen mt-32 py-12 w-full mx-auto">
        <div class="w-full md:w-2/3 xl:w-1/3 border border-slate-200 bg-slate-50 h-auto flex mx-auto rounded-md">
            <div class="py-12 px-4 text-center w-full mx-auto">
                <h1 class="text-lg md:text-xl lg:text-2xl xl:text-4xl font-bold mb-4 text-blue-700">
                    Daftar Akun Baru
                </h1>
                <p class="text-xs px-8 md:text-xs lg:text-sm xl:text-base font-thin text-slate-500 tracking-tight">
                    Untuk membuat akun baru sebagai Admin Lembaga Pengembangan Masyarakat (LPM) Provinsi Jawa Barat,
                    silakan lengkapi formulir di bawah ini.
                </p>
                <div class="w-4/5 mx-auto my-6">
                    <form @submit.prevent="register">
                        <!-- Full Name -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-500 text-start" for="name">Nama
                                Lengkap</label>
                            <input v-model="name" type="text" id="name"
                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="John Doe" required autofocus />
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-slate-500 text-start" for="email">Email</label>
                            <input v-model="email" type="email" id="email"
                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="john_doe@yourdomain.com" required />
                        </div>

                        <!-- Password -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-slate-500 text-start"
                                for="password">Password</label>
                            <input v-model="password" type="password" id="password"
                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="********" required />
                        </div>

                        <!-- Confirmation Password -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-slate-500 text-start"
                                for="confirmation_password">Konfirmasi Password</label>
                            <input v-model="confirmation_password" type="password" id="confirmation_password"
                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="********" required />
                            <p v-if="passwordMismatch" class="text-red-500 text-start text-sm mt-1">Password tidak cocok!</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between">
                            <button type="submit" :disabled="loading"
                                class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring tracking-wide focus:ring-blue-300 disabled:opacity-50">
                                <span v-if="loading">Loading...</span>
                                <span v-else>Daftar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { FwbAlert } from 'flowbite-vue'
</script>

<script>
import { useAuthStore } from '../../stores/authStore';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
    name: "Register",
    data() {
        return {
            name: "",
            email: "",
            password: "",
            confirmation_password: "",
            errorMessage: "",
            loading: false,
            passwordMismatch: false
        };
    },
    methods: {
        async register() {
            const authStore = useAuthStore();
            const router = useRouter();

            this.errorMessage = ""; // Clear previous error messages
            this.loading = true; // Set loading to true during request

            // Cek apakah password dan konfirmasi password cocok
            if (this.password !== this.confirmation_password) {
                this.passwordMismatch = true;
                this.loading = false;
                return;
            } else {
                this.passwordMismatch = false;
            }

            try {
                const response = await axios.post('/users', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                });

                // If registration is successful, you might want to handle login or redirection
                const userData = response.data.data;

                // Redirect to login page or dashboard after registration
                window.location.href = '/login';
            } catch (error) {
                if (error.response && error.response.status === 400) {
                    const errors = error.response.data.errors;
                    let formattedErrors = '';

                    // Loop through each error and format it into a readable string
                    Object.keys(errors).forEach((field) => {
                        const fieldErrors = errors[field].join(', ');
                        formattedErrors += `${fieldErrors}\n`;
                    });

                    this.errorMessage = `\n${formattedErrors}`;
                } else {
                    this.errorMessage = "An error occurred. Please try again.";
                    console.error('Register error:', error.response ? error.response.data : error);
                }
            } finally {
                this.loading = false; // Reset loading state after request completes
            }
        }
    }
};
</script>

<style scoped></style>
