<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post("/login", {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <div class="login-container">
        <h2>Login</h2>

        <Link href="/">Kembali</Link>

        <form @submit.prevent="submit">
            <!-- Field Email -->
            <div>
                <label for="email">Email</label>
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    autofocus
                />
                <span v-if="form.errors.email" class="error">{{
                    form.errors.email
                }}</span>
            </div>

            <!-- Field Password -->
            <div>
                <label for="password">Password</label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    required
                />
                <span v-if="form.errors.password" class="error">{{
                    form.errors.password
                }}</span>
            </div>

            <!-- Remember Me -->
            <div>
                <label>
                    <input v-model="form.remember" type="checkbox" /> Remember
                    Me
                </label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" :disabled="form.processing">
                    {{ form.processing ? "Memproses..." : "Masuk" }}
                </button>
            </div>
        </form>
    </div>
</template>

<style scoped>
.error {
    color: red;
    font-size: 0.875rem;
}
</style>
