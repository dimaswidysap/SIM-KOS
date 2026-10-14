<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    rooms: {
        type: Array,
        default: () => [],
    },
});

// Helper untuk format angka ke Rupiah
const formatRupiah = (value) => {
    if (!value) return "Rp 0";
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0,
    }).format(value);
};
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Header / Navbar -->
        <header class="bg-white shadow-sm border-b sticky top-0 z-10">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between"
            >
                <div class="flex items-center gap-2">
                    <span class="text-2xl">🏠</span>
                    <span class="text-xl font-bold text-gray-800"
                        >Kos Management</span
                    >
                </div>
                <Link
                    href="/login"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition duration-200 shadow-sm"
                >
                    Login
                </Link>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Title & Description -->
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900">
                    Daftar Kamar Kos
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Temukan kamar kos yang sesuai dengan kebutuhan Anda.
                </p>
            </div>

            <!-- Empty State jika kamar kosong -->
            <div
                v-if="!rooms || rooms.length === 0"
                class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100"
            >
                <p class="text-gray-500 font-medium">
                    Belum ada data kamar kos yang tersedia.
                </p>
            </div>

            <!-- Cards Grid -->
            <div
                v-else
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
            >
                <div
                    v-for="room in rooms"
                    :key="room.id"
                    class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col justify-between"
                >
                    <!-- Card Banner / No. Kamar -->
                    <div
                        class="relative bg-gradient-to-r from-blue-600 to-indigo-600 h-36 flex items-center justify-center p-4"
                    >
                        <div class="text-center">
                            <span
                                class="text-xs uppercase tracking-widest text-blue-100 font-semibold block mb-0.5"
                            >
                                Nomor Kamar
                            </span>
                            <span class="text-4xl font-black text-white">
                                {{ room.no_room }}
                            </span>
                        </div>

                        <!-- Status Badge -->
                        <span
                            :class="[
                                'absolute top-3 right-3 px-3 py-1 text-xs font-bold rounded-full capitalize shadow-sm',
                                room.status_room === 'tersedia'
                                    ? 'bg-emerald-100 text-emerald-800 border border-emerald-200'
                                    : 'bg-rose-100 text-rose-800 border border-rose-200',
                            ]"
                        >
                            {{ room.status_room }}
                        </span>

                        <!-- Floor Badge -->
                        <span
                            class="absolute bottom-3 left-3 bg-black/30 backdrop-blur-sm text-white text-xs px-2.5 py-1 rounded-md font-medium"
                        >
                            Lantai {{ room.floor }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <!-- Harga Kamar -->
                            <div class="mb-5 pb-4 border-b border-gray-100">
                                <span
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1"
                                >
                                    Harga Sewa
                                </span>
                                <div
                                    class="text-2xl font-extrabold text-gray-900"
                                >
                                    {{ formatRupiah(room.price) }}
                                    <span
                                        class="text-xs font-normal text-gray-500"
                                        >/ bulan</span
                                    >
                                </div>
                            </div>

                            <!-- List Fasilitas -->
                            <div>
                                <span
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2"
                                >
                                    Fasilitas
                                </span>
                                <div
                                    v-if="
                                        room.facilities &&
                                        room.facilities.length > 0
                                    "
                                    class="flex flex-wrap gap-1.5"
                                >
                                    <span
                                        v-for="facility in room.facilities"
                                        :key="facility.id"
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-700 capitalize"
                                    >
                                        <span class="text-blue-500 text-xs"
                                            >✓</span
                                        >
                                        {{ facility.facility_name }}
                                    </span>
                                </div>
                                <p v-else class="text-xs text-gray-400 italic">
                                    Tidak ada fasilitas terdaftar
                                </p>
                            </div>
                        </div>

                        <!-- Card Action Footer -->
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <Link
                                :href="`/rooms/${room.id}`"
                                class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white font-semibold text-sm rounded-xl transition-all duration-200 text-center"
                            >
                                Detail Kamar
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
