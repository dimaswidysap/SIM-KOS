<script setup>
import MainLayout from "@/layouts/app.vue";
import { Link, useForm } from "@inertiajs/vue3";

defineOptions({
    layout: MainLayout,
});

const form = useForm({
    room_no: "",
    room_floor: "",
    room_price: "",
    room_status: "tersedia",
});

const submit = () => {
    form.post("/admin/roomsStore", {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <div>
        <h1>Tambahkan Kamar</h1>
        <div
            class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 max-w-xl"
        >
            <form @submit.prevent="submit">
                <!-- Input Nama Kamar -->
                <div class="mb-5">
                    <label
                        for="room_no"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Nomor room <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="room_no"
                        v-model="form.room_no"
                        type="text"
                        placeholder="Contoh: Kolam Renang, WiFi, Gym..."
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm transition-colors"
                        :class="
                            form.errors.room_no
                                ? 'border-red-500 focus:ring-red-500'
                                : 'border-gray-300'
                        "
                    />
                    <p
                        v-if="form.errors.room_no"
                        class="text-red-500 text-xs mt-1.5"
                    >
                        {{ form.errors.room_no }}
                    </p>
                </div>
                <div class="mb-5">
                    <label
                        for="room_floor"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Lantai kamar <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="room_floor"
                        v-model="form.room_floor"
                        type="number"
                        min="1"
                        max="3"
                        placeholder="Contoh: Kolam Renang, WiFi, Gym..."
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm transition-colors"
                        :class="
                            form.errors.room_floor
                                ? 'border-red-500 focus:ring-red-500'
                                : 'border-gray-300'
                        "
                    />
                    <p
                        v-if="form.errors.room_floor"
                        class="text-red-500 text-xs mt-1.5"
                    >
                        {{ form.errors.floor_room }}
                    </p>
                </div>
                <div class="mb-5">
                    <label
                        for="room_price"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Harga kamar <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="room_price"
                        v-model="form.room_price"
                        type="number"
                        min="1"
                        placeholder="Contoh: Kolam Renang, WiFi, Gym..."
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm transition-colors"
                        :class="
                            form.errors.room_price
                                ? 'border-red-500 focus:ring-red-500'
                                : 'border-gray-300'
                        "
                    />
                    <p
                        v-if="form.errors.room_price"
                        class="text-red-500 text-xs mt-1.5"
                    >
                        {{ form.errors.room_name }}
                    </p>
                </div>
                <div class="mb-5">
                    <label
                        for="room_status"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Status kamar <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="room_status"
                        v-model="form.room_status"
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm transition-colors"
                        :class="
                            form.errors.room_status
                                ? 'border-red-500 focus:ring-red-500'
                                : 'border-gray-300'
                        "
                    >
                        <option value="tersedia">Tersedia</option>
                        <option value="tidak_tersedia">Tidak Tersedia</option>
                        <option value="renovasi">Renovasi</option>
                    </select>

                    <p
                        v-if="form.errors.room_status"
                        class="text-red-500 text-xs mt-1.5"
                    >
                        {{ form.errors.room_status }}
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
