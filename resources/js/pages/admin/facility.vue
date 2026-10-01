<script setup>
import MainLayout from "@/layouts/app.vue";
import { Link } from "@inertiajs/vue3";

defineOptions({
    layout: MainLayout,
});

// Menerima data facilities dari controller
defineProps({
    facilities: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <div>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Fasilitas</h1>

            <Link
                href="/admin/facilities/create"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
            >
                + Tambah fasilitas
            </Link>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <!-- Jika belum ada data fasilitas -->
            <div
                v-if="!facilities || facilities.length === 0"
                class="text-center py-6 text-gray-500"
            >
                Belum ada data fasilitas. Silakan tambah data baru.
            </div>

            <!-- Tabel Data Fasilitas -->
            <div v-else class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b text-gray-600 bg-gray-50 text-sm">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Nama Fasilitas</th>
                            <th class="py-3 px-4">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr
                            v-for="(item, index) in facilities"
                            :key="item.id"
                            class="hover:bg-gray-50 transition"
                        >
                            <td class="py-3 px-4 text-sm text-gray-500">
                                {{ index + 1 }}
                            </td>
                            <td
                                class="py-3 px-4 text-sm font-medium text-gray-800"
                            >
                                {{ item.facility_name }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">
                                {{ item.description || "-" }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
