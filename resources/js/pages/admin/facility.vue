<script setup>
import MainLayout from "@/layouts/app.vue";
import { Link, usePage } from "@inertiajs/vue3";

defineOptions({
    layout: MainLayout,
});
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Fasilitas</h1>

        <Link href="/admin/facility/create">Tambah fasilitas</Link>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-gray-600">Ini adalah halaman fasilitas.</p>
        </div>
    </div>
</template>
