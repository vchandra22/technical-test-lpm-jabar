<template>
    <Navbar />
    <div class="mx-auto w-full max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl">
        <router-view></router-view>
    </div>
    <Footer />
</template>

<script>
import Navbar from './views/components/Navbar.vue';
import Footer from './views/components/Footer.vue';

export default {
    name: "App",
    components: {
        Navbar,
        Footer
    }
}
</script>

<style scoped></style>
