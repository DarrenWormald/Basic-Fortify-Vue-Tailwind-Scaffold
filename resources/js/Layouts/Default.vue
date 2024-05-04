<script setup>
import Navigation from "@/Components/Navigation.vue";
import { Modal } from "momentum-modal";
import Toast from "@/Components/Toast.vue";
</script>
<template>
    <Toast />
    <!--<div>-->
    <header>
        <Navigation />
    </header>
    <div>
        <slot />
    </div>
    <Modal />
    <!--</div>-->
</template>
