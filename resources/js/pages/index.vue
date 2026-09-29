<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="bg-white p-8 rounded-xl shadow-lg text-center">
            <h1 class="text-4xl font-bold text-blue-600 mb-4">
                Halo, Inertia + Vue!
            </h1>
            <p class="text-gray-600">
                Proyek bersih berhasil diinstal dengan Tailwind CSS v4.
            </p>

            <button
                @click="fetchData"
                class="mt-6 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
            >
                Test Axios
            </button>
            <p v-if="message" class="mt-4 text-green-500 font-medium">
                {{ message }}
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const message = ref("");

const fetchData = async () => {
    try {
        // Pastikan Anda membuat rute GET '/api/test' di routes/api.php jika ingin mengetesnya sepenuhnya
        const response = await axios.get("/");
        message.value = "Axios berfungsi! Status: " + response.status;
    } catch (error) {
        console.error(error);
    }
};
</script>
