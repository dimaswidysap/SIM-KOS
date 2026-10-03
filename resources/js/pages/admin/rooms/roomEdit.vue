<script setup>
import MainLayout from "@/layouts/app.vue";
import { useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";

defineOptions({ layout: MainLayout });

const props = defineProps({
    room: Object,
    facilities: Array,
});

const form = useForm({
    room_no: props.room?.no_room ?? "",
    room_floor: props.room?.floor ?? "",
    room_price: props.room?.price ?? "",
    room_status: props.room?.status_room ?? "tersedia",
    facilities: props.room?.facilities
        ? props.room.facilities.map((f) => f.id)
        : [],
});

const submit = () => {
    form.put(`/admin/rooms/${props.room.id}`);
};
</script>

<template>
    <div>
        <h1 class="text-xl font-bold mb-4">Halaman Edit Kamar</h1>

        <div
            class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 max-w-xl"
        >
            <form @submit.prevent="submit">
                <!-- Input Nomor Kamar -->
                <div class="mb-5">
                    <label
                        for="room_no"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Nomor Room <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="room_no"
                        v-model="form.room_no"
                        type="text"
                        placeholder="Contoh: A2"
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

                <!-- Input Lantai Kamar -->
                <div class="mb-5">
                    <label
                        for="room_floor"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Lantai Kamar <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="room_floor"
                        v-model="form.room_floor"
                        type="number"
                        min="1"
                        placeholder="Contoh: 1"
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
                        {{ form.errors.room_floor }}
                    </p>
                </div>

                <!-- Input Harga Kamar -->
                <div class="mb-5">
                    <label
                        for="room_price"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Harga Kamar <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="room_price"
                        v-model="form.room_price"
                        type="number"
                        min="1"
                        placeholder="Contoh: 600000"
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
                        {{ form.errors.room_price }}
                    </p>
                </div>

                <!-- Input Status Kamar -->
                <div class="mb-5">
                    <label
                        for="room_status"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Status Kamar <span class="text-red-500">*</span>
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

                <!-- Input Fasilitas Kamar -->
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fasilitas Kamar
                    </label>

                    <div class="flex flex-wrap gap-4">
                        <div
                            v-for="item in facilities"
                            :key="item.id"
                            class="flex items-center gap-2"
                        >
                            <input
                                type="checkbox"
                                :id="'facility-' + item.id"
                                :value="item.id"
                                v-model="form.facilities"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                            />
                            <label
                                :for="'facility-' + item.id"
                                class="text-sm font-medium text-gray-700 cursor-pointer select-none"
                            >
                                {{ item.facility_name }}
                            </label>
                        </div>
                    </div>
                    <p
                        v-if="form.errors.facilities"
                        class="text-red-500 text-xs mt-1.5"
                    >
                        {{ form.errors.facilities }}
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
                        <span v-else>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
