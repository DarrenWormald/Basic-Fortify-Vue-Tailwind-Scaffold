<script setup>
import { ref, computed, watch } from "vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import Default from "@/Layouts/Default.vue";
import Account from "@/Layouts/Account.vue";

defineOptions({ layout: [Default, Account] });

const page = usePage();

const form = useForm({
    _method: "PUT",
    current_password: null,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.post(route("user-password.update"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
<template>
    <div class="">
        <h2 class="font-bold text-gray-900 font-mono">Change Password</h2>
        <form class="mt-10 space-y-6" v-on:submit.prevent="submit">
            <div>
                <label
                    for="current_password"
                    class="text-sm font-medium text-gray-900"
                    >Current Password</label
                >
                <div class="mt-2">
                    <input
                        type="password"
                        id="current_password"
                        class="w-full py-2 text-gray-900 border-gray-300 text-sm"
                        v-model="form.current_password"
                    />
                    <div
                        v-if="form.errors.current_password"
                        class="text-sm text-red-500 mt-2"
                    >
                        {{ form.errors.current_password }}
                    </div>
                </div>
            </div>
            <div>
                <label for="password" class="text-sm font-medium text-gray-900"
                    >New Password</label
                >
                <div class="mt-2">
                    <input
                        type="password"
                        id="password"
                        class="w-full py-2 text-gray-900 border-gray-300 text-sm"
                        v-model="form.password"
                    />
                    <div
                        v-if="form.errors.password"
                        class="text-sm text-red-500 mt-2"
                    >
                        {{ form.errors.password }}
                    </div>
                </div>
            </div>
            <div>
                <label
                    for="password_confirmation"
                    class="text-sm font-medium text-gray-900"
                    >Confirm New Password</label
                >
                <div class="mt-2">
                    <input
                        type="password"
                        id="password_confirmation"
                        class="w-full py-2 text-gray-900 border-gray-300 text-sm"
                        v-model="form.password_confirmation"
                    />
                    <div
                        v-if="form.errors.password_confirmation"
                        class="text-sm text-red-500 mt-2"
                    >
                        {{ form.errors.password_confirmation }}
                    </div>
                </div>
            </div>
            <div>
                <button
                    type="submit"
                    class="flex w-full justify-center bg-blue-500 px-3 py-2 text-sm font-semibold text-white disabled:opacity-50"
                    :disabled="form.processing"
                >
                    Change Password
                </button>
            </div>
        </form>
    </div>
</template>
