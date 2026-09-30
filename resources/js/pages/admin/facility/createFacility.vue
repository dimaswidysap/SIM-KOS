<script setup>
import MainLayout from "@/layouts/app.vue";
import { Link, useForm } from "@inertiajs/vue3";

defineOptions({
    layout: MainLayout,
});

// Inisialisasi form Inertia dengan data inputan
const form = useForm({
    facility_name: "",
});

// Fungsi untuk menangani submit form
const submit = () => {
    // Mengirim data ke endpoint route 'facility.store' (/facilityStore)
    form.post("/admin/facilityStore", {
        onSuccess: () => {
            // Opsional: Reset form jika berhasil
            form.reset();
        },
    });
};
</script>

<template>
    <div>
        <!-- Header & Navigasi -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Fasilitas</h1>

            <Link
                href="/admin/facility"
                class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors duration-200"
            >
                Kembali
            </Link>
        </div>

        <!-- Card Form -->
        <div
            class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 max-w-xl"
        >
            <form @submit.prevent="submit">
                <!-- Input Nama Fasilitas -->
                <div class="mb-5">
                    <label
                        for="facility_name"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Nama Fasilitas <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="facility_name"
                        v-model="form.facility_name"
                        type="text"
                        placeholder="Contoh: Kolam Renang, WiFi, Gym..."
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm transition-colors"
                        :class="
                            form.errors.facility_name
                                ? 'border-red-500 focus:ring-red-500'
                                : 'border-gray-300'
                        "
                    />

                    <!-- Tampilan Pesan Error Validasi -->
                    <p
                        v-if="form.errors.facility_name"
                        class="text-red-500 text-xs mt-1.5"
                    >
                        {{ form.errors.facility_name }}
                    </p>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-3">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                    >
                        <span v-if="form.processing">Menyimpan...</span>
                        <span v-else>Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
