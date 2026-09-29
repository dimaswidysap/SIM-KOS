<template>
    <div class="w-full h-screen bg-red-400">
        <Link href="/">Kembali</Link>

        <!-- Form Login -->
        <form @submit.prevent="login">
            <!-- Input Email -->
            <div>
                <label for="email">Alamat Email:</label><br />
                <input
                    v-model="form.email"
                    type="email"
                    id="email"
                    name="email"
                    placeholder="nama@email.com"
                    required
                />
            </div>

            <br />

            <!-- Input Password -->
            <div>
                <label for="password">Kata Sandi:</label><br />
                <input
                    v-model="form.password"
                    type="password"
                    id="password"
                    name="password"
                    required
                />
            </div>

            <br />

            <!-- Tombol Submit -->
            <div>
                <button type="submit">Masuk</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import axios from "axios";
import { Link, router } from "@inertiajs/vue3";

const form = reactive({
    email: "",
    password: "",
});

const login = () => {
    axios
        .post("http://localhost:8000/login", {
            email: form.email,
            password: form.password,
        })
        .then((response) => {
            const resData = response.data.data;

            // Simpan data pengguna dan token ke localStorage
            localStorage.setItem("name", resData.user.name);
            localStorage.setItem("email", resData.user.email);
            localStorage.setItem("role_id", resData.user.role);
            localStorage.setItem("token", resData.token);
            router.visit("/dashboard");
        })
        .catch((error) => {
            console.error("Login gagal:", error);
        });
};
</script>
