<template>
    <Navbar />
    <div class="max-w-screen-2xl mx-auto">
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

<style scoped>
</style>
