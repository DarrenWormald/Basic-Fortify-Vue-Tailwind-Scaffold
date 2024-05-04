import { ref, computed } from "vue";

const active = ref(false);
const toastOptions = ref({
    body: "",
    timeout: 2000,
});

let timer = null;

export default () => {
    const toast = (body, options) => {
        if (active.value == true) {
            clearTimeout(timer);
        }

        toastOptions.value = {
            ...toastOptions.value,
            ...options,
        };
        toastOptions.value.body = body;
        active.value = true;

        timer = setTimeout(() => {
            active.value = false;
            // toastOptions.value.body = "";
        }, toastOptions.value.timeout);
    };

    const hide = () => {
        clearInterval(timer);
        active.value = false;
        // toastOptions.value.body = "";
    };

    return {
        toast,
        hide,
        active,
        body: computed(() => toastOptions.value.body),
    };
};
