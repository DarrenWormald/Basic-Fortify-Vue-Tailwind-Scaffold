<script setup>
import { Link, router } from "@inertiajs/vue3";
</script>

<template>
    <Link :href="route('home')" class="text-center">
        <img
            src="../../../images/logos/Butterflywhite.png"
            alt="Incandescent Shine Ltd Logo"
            class="w-1/4 md:w-1/6 hover:cursor-pointer inline"
        />
    </Link>
</template>
