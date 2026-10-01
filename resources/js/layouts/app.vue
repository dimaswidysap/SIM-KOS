<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import AdminSideBar from "../components/AdminSideBar.vue";
import Notification from "../components/Notification.vue";

const page = usePage();
const isSidebarOpen = ref(false);
</script>

<template>
    <div class="min-h-screen flex bg-gray-100">
        <!-- Komponen Notifikasi Global -->
        <Notification />

        <!-- Overlay: Diubah dari 'md:hidden' ke 'lg:hidden' -->
        <div
            v-if="isSidebarOpen"
            @click="isSidebarOpen = false"
            class="fixed inset-0 bg-black/50 z-20 lg:hidden"
        ></div>

        <!-- 1. SIDEBAR -->
        <aside
            :class="[
                'fixed lg:static inset-y-0 left-0 z-30 w-[20rem] bg-slate-900 text-white flex flex-col transition-transform duration-300 lg:translate-x-0',
                isSidebarOpen ? 'translate-x-0' : '-translate-x-full',
            ]"
        >
            <!-- Logo / Nama Aplikasi -->
            <div
                class="h-16 flex items-center px-6 border-b border-slate-800 font-bold text-lg text-white"
            >
                KOST JIWAN
            </div>

            <AdminSideBar />

            <!-- Profile Info -->
            <div
                v-if="page.props.auth?.user"
                class="p-4 border-t border-slate-800 flex items-center justify-between"
            >
                <div class="truncate">
                    <p class="text-sm font-medium text-white truncate">
                        {{ page.props.auth.user.name }}
                    </p>
                    <p class="text-xs text-slate-400 truncate">
                        {{ page.props.auth.user.email }}
                    </p>
                </div>
            </div>
        </aside>

        <!-- 2. MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
            <!-- Top Navbar -->
            <header
                class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 flex-shrink-0"
            >
                <!-- Tombol Hamburger -->
                <button
                    @click="isSidebarOpen = true"
                    class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <div class="font-semibold text-gray-700">Admin Panel</div>

                <div>
                    <Link
                        href="/logout"
                        method="post"
                        as="button"
                        class="text-sm font-medium text-red-600 hover:text-red-800"
                    >
                        Logout
                    </Link>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <slot />
            </main>
        </div>
    </div>
</template>
