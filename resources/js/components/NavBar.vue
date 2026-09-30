<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const page = usePage();

const logout = () => {
    router.post("/logout"); // Bisa menggunakan route('logout') jika pakai Ziggy
};
</script>

<template>
    <nav
        class="bg-slate-900 text-white px-6 py-4 flex justify-between items-center shadow"
    >
        <h1 class="font-black text-3xl text-yellow-200">KOST INDAH</h1>
        <Link href="/admin/submit">Tambah pelanggan</Link>
        <button @click="logout" type="button" class="btn-logout">Logout</button>
    </nav>
</template>
