<!-- resources/js/Pages/Dashboard.vue -->
<script setup>
import MainLayout from "@/layouts/app.vue";

defineOptions({
    layout: MainLayout,
});
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard Utama</h1>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-gray-600">Ini adalah konten utama Anda.</p>
        </div>
    </div>
</template>
