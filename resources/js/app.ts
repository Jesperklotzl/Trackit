import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { initializeTheme } from './composables/useAppearance';
import { useRegisterSW } from 'virtual:pwa-register/vue'


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

const { needRefresh, updateServiceWorker } = useRegisterSW({
    onNeedRefresh() {
        console.log('A new version of the app is available!')
        // Optional: show a custom UI element or trigger a global event
        const confirmed = confirm('A new version is available. Update now?')
        if (confirmed) {
            updateServiceWorker(true) // activate new service worker
            window.location.reload() // reload app to new version
        }
    },
    onOfflineReady() {
        console.log('App ready to work offline')
    },
})


// This will set light / dark mode on page load...
initializeTheme();
