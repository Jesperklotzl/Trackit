import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import { VitePWA } from 'vite-plugin-pwa'

export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        VitePWA({
            registerType: 'autoUpdate',
            includeAssets: ['favicon.svg','apple-touch-icon.png'],
            manifest: {
                name: 'Your App Name',
                short_name: 'App',
                start_url: '/',
                display: 'standalone',
                background_color: '#ffffff',
                theme_color: '#4B5563',
                icons: [
                    { src: '/pwa-192x192.png', sizes: '192x192', type:'image/png' },
                    { src: '/pwa-512x512.png', sizes: '512x512', type:'image/png' },
                ],
            },
            devOptions: {
                enabled: true,
                type: 'module',
            },
        }),
        laravel({
            input: ['resources/js/app.ts'],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        tailwindcss(),
        wayfinder({
            formVariants: true,
        }),
    ],
});
