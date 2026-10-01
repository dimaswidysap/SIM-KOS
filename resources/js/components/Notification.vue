```vue
<script setup>
import { ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const show = ref(false);
const message = ref("");
const type = ref("success");

let timer = null;

watch(
    () => page.props.flash,
    (flash) => {
        if (flash?.success) {
            triggerNotification(flash.success, "success");
        } else if (flash?.error) {
            triggerNotification(flash.error, "error");
        } else if (flash?.warning) {
            triggerNotification(flash.warning, "warning");
        }
    },
    {
        deep: true,
        immediate: true,
    },
);

function triggerNotification(msg, msgType) {
    message.value = msg;
    type.value = msgType;
    show.value = true;

    if (timer) {
        clearTimeout(timer);
    }

    timer = setTimeout(() => {
        show.value = false;
    }, 4000);
}
</script>

<template>
    <Transition
        enter-active-class="transform ease-out duration-300 transition"
        enter-from-class="scale-90 opacity-0"
        enter-to-class="scale-100 opacity-100"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="scale-100 opacity-100"
        leave-to-class="scale-90 opacity-0"
    >
        <div
            v-if="show"
            class="fixed top-6 left-1/2 -translate-x-1/2 z-[9999] flex items-center justify-between px-6 py-4 rounded-xl shadow-2xl text-white min-w-[320px] max-w-lg"
            :class="{
                'bg-emerald-600': type === 'success',
                'bg-rose-600': type === 'error',
                'bg-amber-500': type === 'warning',
            }"
        >
            <span class="text-sm font-medium">
                {{ message }}
            </span>

            <button
                @click="show = false"
                class="ml-4 text-white hover:text-gray-200 focus:outline-none font-bold text-base"
            >
                ✕
            </button>
        </div>
    </Transition>
</template>
```
