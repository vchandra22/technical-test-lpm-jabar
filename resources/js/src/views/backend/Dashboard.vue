<template>
    <div class="container px-4 min-h-screen mt-20 py-12 bg-red-200 w-full">
        <h1 class="text-2xl md:text-4xl lg:text-6xl xl:text-7xl font-bold mb-1 text-blue-700">
            Dashboard
        </h1>
        <p class="text-xl font-bold mb-1 text-blue-700 break-words">
            {{ user?.name }}
        </p>
        <p class="text-md font-bold mb-1 text-blue-700 break-words">
            {{ user?.email }}
        </p>
    </div>
</template>

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
