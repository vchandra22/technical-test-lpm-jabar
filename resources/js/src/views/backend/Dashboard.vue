<template>
    <div class="container px-4 min-h-screen mt-20 pt-12">
        <h1 class="text-2xl md:text-4xl lg:text-6xl xl:text-7xl font-bold mb-1 text-blue-700">
            Dashboard
        </h1>
        <h2 class="text-xl font-bold mb-1 text-blue-700">
            {{ user.name }}
        </h2>
        <h2 class="text-xl font-bold mb-1 text-blue-700">
            {{ user.email }}
        </h2>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Dashboard",
    data() {
        return {
            AuthStr: 'Bearer ' + localStorage.getItem('token'),
            user: {
                name: '',
                email: '',
            }
        };
    },
    mounted() {
        this.fetchUser()
    },
    methods: {
        async fetchUser() {
            try {
                const response = await axios.get('/users/current', {
                    headers: {
                        Authorization: this.AuthStr
                    }
                });
                this.user = response.data.data;
            } catch (error) {
                console.error('Error fetching user:', error);
            }
        }
    }
}
</script>

<style scoped></style>
