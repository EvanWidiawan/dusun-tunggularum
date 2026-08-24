import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    title: (title) => title ? `${title} - Desa Merapi` : 'Website Profil Desa Merapi',
    resolve: (name) => {
        const pages = import.meta.glob([
            './pages/**/*.vue',
            './Pages/**/*.vue'
        ]);
        return resolvePageComponent(`./pages/${name}.vue`, pages)
            .catch(() => resolvePageComponent(`./Pages/${name}.vue`, pages));
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    progress: {
        color: '#A44A2C',
    },
});