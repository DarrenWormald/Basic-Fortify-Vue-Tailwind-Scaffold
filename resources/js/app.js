import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { ZiggyVue } from "ziggy-js";
import { modal } from "momentum-modal";
import toast from "./Plugins/toast";

import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

const appName = import.meta.env.VITE_APP_NAME;

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob(`./Pages/**/*.vue`, { eager: true })
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(toast)
            .use(modal, {
                resolve: (name) =>
                    resolvePageComponent(
                        `./Modals/${name}.vue`,
                        import.meta.glob(`./Modals/**/*.vue`)
                    ),
            })
            .mount(el);
    },
});
