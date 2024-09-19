    <script>
    import Navbar from './views/components/Navbar.vue';
    export default {
        name: "App",
        components: {
            Navbar
        }
    }
</script>

    <template>
        <Navbar />
        <div class="max-w-screen-2xl mx-auto">
            <router-view></router-view>
        </div>
    </template>


<style scoped></style>
