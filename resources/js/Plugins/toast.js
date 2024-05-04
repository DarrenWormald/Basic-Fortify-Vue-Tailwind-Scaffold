import { router, usePage } from "@inertiajs/vue3";
import useToast from "@/Composables/useToast";
const { toast } = useToast();

export default () => {
    router.on("finish", () => {
        const msg = usePage().props.toast;
        if (msg) {
            toast(msg, {
                timeout: 2000,
            });
        }
    });
};
