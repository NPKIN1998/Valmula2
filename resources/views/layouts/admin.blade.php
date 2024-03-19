<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Valmula') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-skin-fill font-sans antialiased">
    <div class="container mx-auto">
        <!-- Navigation Bar -->
        <nav class="bg-skin-primary p-4 mb-4">
            <div class=" flex justify-between items-center">
                <div class="font-semibold text-lg text-skin-secondary">{{ config('app.name') }}</div>
                <div class="flex space-x-4">
                    <a href="{{ route('admin-user.index') }}"
                        class="text-skin-secondary hover:text-lime-300">{{ __('User') }}</a>
                    <a href="{{ route('admin-deposit.index') }}"
                        class="text-skin-secondary hover:text-lime-300">{{ __('Deposit') }}</a>
                    <a href="{{ route('withdrawal.index') }}"
                        class="text-skin-secondary hover:text-lime-300">{{ __('Withdrawal') }}</a>
                    <a href="{{ route('admin-invest.index') }}"
                        class="text-skin-secondary hover:text-lime-300">{{ __('Invest') }}</a>
                </div>
            </div>
        </nav>
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>