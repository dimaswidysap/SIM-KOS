<!-- resources/js/Pages/Dashboard.vue -->
<script setup>
import MainLayout from "@/layouts/app.vue";
import { Link, router } from "@inertiajs/vue3";

defineOptions({
    layout: MainLayout,
});

defineProps({
    rooms: {
        type: Array,
        default: () => [],
    },
});

function handleDelete(id) {
    if (confirm("Apakah Anda yakin ingin menghapus ruangan ini?")) {
        router.delete(`/admin/rooms/${id}`, {
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <div>
        <!-- {{ rooms }} -->
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Kamar</h1>
        <Link href="/admin/rooms/create">Tambah Kamar</Link>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <p class="text-gray-600">Ini adalah halaman kamar.</p>
        </div>

        <div
            class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm"
        >
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th class="px-4 py-3">No. Kamar</th>
                        <th class="px-4 py-3">Lantai</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr
                        v-for="room in rooms"
                        :key="room.id"
                        class="hover:bg-gray-50 transition-colors"
                    >
                        <td class="px-4 py-3 font-medium text-gray-900">
                            {{ room.no_room }}
                        </td>
                        <td class="px-4 py-3">Lantai {{ room.floor }}</td>
                        <td class="px-4 py-3">
                            Rp {{ Number(room.price).toLocaleString("id-ID") }}
                        </td>
                        <td class="px-4 py-3">
                            <span
                                class="inline-block rounded-full px-2.5 py-0.5 text-xs font-semibold capitalize"
                                :class="{
                                    'bg-green-100 text-green-800':
                                        room.status_room === 'tersedia',
                                    'bg-red-100 text-red-800':
                                        room.status_room === 'tidak_tersedia',
                                    'bg-yellow-100 text-yellow-800':
                                        room.status_room === 'renovasi',
                                }"
                            >
                                {{ room.status_room.replace("_", " ") }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-sm text-center">
                            <button
                                @click="handleDelete(room.id)"
                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-medium transition"
                            >
                                Hapus
                            </button>
                            <Link
                                :href="`/admin/rooms/${room.id}`"
                                class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs font-medium transition inline-block"
                            >
                                Lihat Detail
                            </Link>
                        </td>
                    </tr>
                    <tr v-if="!rooms.length">
                        <td
                            colspan="4"
                            class="px-4 py-4 text-center text-gray-500"
                        >
                            Tidak ada data kamar.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
