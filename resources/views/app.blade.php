<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        {{-- Theme / Dark-mode bootstrap --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';
                if (appearance === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                }
            })();
        </script>

        {{-- Background color for light/dark before Vue loads --}}
        <style>
            html { background-color: oklch(1 0 0); }
            html.dark { background-color: oklch(0.145 0 0); }
        </style>

        {{-- PWA meta tags --}}
        <link rel="manifest" href="/manifest.webmanifest">
        <meta name="theme-color" content="#4B5563">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        {{-- Icons --}}
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        {{-- ⚡️ Main assets compiled by Vite --}}
        {{-- This automatically loads app.ts/app.js from the Vite dev server in dev mode --}}
        @vite(['resources/js/app.ts'])

        {{-- Inertia head (page titles, meta from components) --}}
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        {{-- Inertia mounts your Vue app here --}}
        @inertia
    </body>
</html>
