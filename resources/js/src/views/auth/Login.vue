<template>
    <div class="container px-4 min-h-screen mt-32 pt-12 w-full mx-auto">
        <div class="w-5/6 md:w-2/3 xl:w-1/3 border border-slate-200 bg-slate-50 h-auto flex mx-auto rounded-md">
            <div class="py-12 px-4 text-center w-full mx-auto">
                <h1 class="text-lg md:text-xl lg:text-2xl xl:text-4xl font-bold mb-4 text-blue-700">
                    Selamat Datang,
                </h1>
                <p class="text-xs px-8 md:text-xs lg:text-sm xl:text-base font-thin text-slate-500 tracking-tight">
                    Silakan masuk untuk mengelola data dan informasi sebagai Admin Lembaga Pengembangan Masyarakat (LPM)
                    Provinsi Jawa Barat. Pastikan Anda menggunakan akun resmi yang terdaftar.
                </p>
                <div class="w-4/5 mx-auto my-6">
                    <form @submit.prevent="login">
                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-500 text-start" for="email">Email</label>
                            <input v-model="email" type="email" id="email"
                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="Email" required />
                        </div>

                        <!-- Password -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-slate-500 text-start"
                                for="password">Password</label>
                            <input v-model="password" type="password" id="password"
                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="Password" required />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring tracking-wide focus:ring-blue-300">
                                Masuk
                            </button>
                        </div>
                    </form>
                </div>

                <p class="text-center text-sm text-slate-500 mt-4">
                    Tidak punya akun? <a href="#" class="text-blue-700 hover:underline">Mendaftar</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login"
}
</script>

<style scoped></style>
