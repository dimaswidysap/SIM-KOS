<script setup>
import MainLayout from "@/layouts/app.vue";
import { Head, Link, router } from "@inertiajs/vue3";

defineOptions({
    layout: MainLayout,
});

// Menerima prop 'room' dari controller pageDetailRoom
const props = defineProps({
    room: Object,
});

function handleDelete(id) {
    if (confirm("Apakah Anda yakin ingin menghapus kamar ini?")) {
        router.delete(`/admin/rooms/${id}`, {
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <!-- {{ room }} -->
    <div class="max-w-4xl mx-auto p-6">
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden"
        >
            <!-- Header -->
            <div
                class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4"
            >
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Detail Kamar {{ room.no_room }}
                    </h1>
                    <p class="text-sm text-gray-500 mt-0.5">
                        Informasi lengkap dan status ruangan
                    </p>
                </div>

                <Link
                    href="/admin/rooms"
                    class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors"
                >
                    &larr; Kembali
                </Link>
            </div>

            <!-- Detail Data Kamar -->
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Nomor Kamar -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <span
                        class="text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >Nomor Kamar</span
                    >
                    <p class="text-xl font-bold text-gray-800 mt-1">
                        {{ room.no_room }}
                    </p>
                </div>

                <!-- Lantai -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <span
                        class="text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >Lantai</span
                    >
                    <p class="text-xl font-bold text-gray-800 mt-1">
                        Lantai {{ room.floor }}
                    </p>
                </div>

                <!-- Harga Per Bulan -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <span
                        class="text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >Harga Per Bulan</span
                    >
                    <p class="text-xl font-bold text-emerald-600 mt-1">
                        Rp {{ Number(room.price).toLocaleString("id-ID") }}
                    </p>
                </div>

                <!-- Status Kamar -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <span
                        class="text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >Status Ruangan</span
                    >
                    <div class="mt-1">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold capitalize"
                            :class="{
                                'bg-emerald-100 text-emerald-800':
                                    room.status_room === 'tersedia',
                                'bg-rose-100 text-rose-800':
                                    room.status_room === 'tidak_tersedia',
                                'bg-amber-100 text-amber-800':
                                    room.status_room === 'renovasi',
                            }"
                        >
                            <span
                                class="w-1.5 h-1.5 rounded-full mr-1.5"
                                :class="{
                                    'bg-emerald-500':
                                        room.status_room === 'tersedia',
                                    'bg-rose-500':
                                        room.status_room === 'tidak_tersedia',
                                    'bg-amber-500':
                                        room.status_room === 'renovasi',
                                }"
                            ></span>
                            {{
                                room.status_room
                                    ? room.status_room.replace("_", " ")
                                    : "-"
                            }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div
                class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3"
            >
                <Link
                    :href="`/admin/rooms/${room.id}/edit`"
                    class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors"
                >
                    Edit Kamar
                </Link>

                <button
                    @click="handleDelete(room.id)"
                    class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-lg transition-colors"
                >
                    Hapus Kamar
                </button>
            </div>
        </div>
    </div>
</template>
