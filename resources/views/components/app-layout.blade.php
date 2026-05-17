<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'OpenBook - La Academia Digital' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#2563EB',
                        'primary-dark': '#1E40AF',
                        'primary-container': '#2563EB',
                        'on-primary': '#ffffff',
                        'secondary': '#14B8A6',
                        'secondary-container': '#14B8A6',
                        'accent': '#14B8A6',
                        'surface': '#F8FAFC',
                        'surface-container': '#F1F5F9',
                        'surface-container-low': '#F8FAFC',
                        'surface-container-high': '#E2E8F0',
                        'surface-container-highest': '#CBD5E1',
                        'surface-container-lowest': '#FFFFFF',
                        'on-surface': '#0F172A',
                        'on-surface-variant': '#64748B',
                        'outline-variant': '#E2E8F0',
                        'muted': '#64748B',
                        'border': '#E2E8F0',
                        'success': '#16A34A',
                        'warning': '#F59E0B',
                        'danger': '#DC2626',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom Static Styles -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
@props(['showSidebarToggleOnDesktop' => false])
<body class="antialiased bg-surface" x-data="{ sidebarOpen: false }">
    <x-navbar :showSidebarToggleOnDesktop="$showSidebarToggleOnDesktop" />

    <main class="pt-20">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
