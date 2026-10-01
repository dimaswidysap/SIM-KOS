<script setup>
import { Link } from "@inertiajs/vue3";

const linkNavigasi = [
    {
        name: "Dashboard",
        href: "/admin/dashboard",
    },
    {
        name: "Pelanggan",
        href: "/admin/pelanggan",
    },
    {
        name: "Fasilitas",
        href: "/admin/facilities",
    },
    {
        name: "Kamar",
        href: "/admin/rooms",
    },
];
</script>

<template>
    <nav class="flex items-center p-4 rounded-lg flex-col gap-4">
        <Link
            v-for="(item, index) in linkNavigasi"
            :key="index"
            :href="item.href"
            class="px-4 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-white hover:text-blue-600 transition"
        >
            {{ item.name }}
        </Link>
    </nav>
</template>
