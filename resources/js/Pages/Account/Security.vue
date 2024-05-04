<script setup>
import { Head } from "@inertiajs/vue3";
import Account from "@/Layouts/Account.vue";
import Default from "@/Layouts/Default.vue";
import ChangePasswordForm from "./Form/ChangePasswordForm.vue";
import TwoFactorForm from "./Form/TwoFactorForm.vue";

defineOptions({ layout: [Default, Account] });
</script>
<template>
    <div class="spce-y-12">
        <ChangePasswordForm v-if="$page.props.features['update-passwords']" />
        <TwoFactorForm
            class=""
            v-if="$page.props.features['two-factor-authentication']"
        />
    </div>
    <Head title="Security" />
</template>
