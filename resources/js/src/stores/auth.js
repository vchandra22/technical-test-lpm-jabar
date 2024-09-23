// src/stores/auth.js
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthStore = defineStore('auth', () => {
    const isLoggedIn = ref(!!localStorage.getItem("token"));

    function login(token) {
        localStorage.setItem("token", token);
        isLoggedIn.value = true;
    }

    function logout() {
        localStorage.removeItem("token");
        isLoggedIn.value = false;
    }

    return { isLoggedIn, login, logout };
});
