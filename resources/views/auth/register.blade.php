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
    <link rel="preload" as="style" href="public/build/assets/app-BIG_-P4-.css" public="" build="" assets="">
    <link rel="modulepreload" href="public/build/assets/app-ZDKuOaA1.js">
    <link rel="stylesheet" href="public/build/assets/app-BIG_-P4-.css">
    <script type="module" src="public/build/assets/app-ZDKuOaA1.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <!-- Container -->
    <div class="container mx-auto">
        <h1 class="text-center mt-20 text-3xl uppercase font-bold text-skin-secondary tracking-widest">{{config('app.name')}}</h1>
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
                    style="background-image: url('https://images.unsplash.com/photo-1511883040705-6011fad9edfc?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGZpbmFuY2V8ZW58MHx8MHx8fDA%3D')">
                </div>
                <!-- Col -->
                <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <form x-data="{ passwordVisibility: false }" method="POST" action="{{ route('register') }}">
                        @csrf
                
                
                        <!-- Username -->
                        <div class="mt-2">
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                                required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>
                
                        <!-- Name -->
                        <div class="mt-2">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                                required autofocus autocomplete="phone" />
                            <small class="text-gray-500">phone in format 254712345678</small>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                
                        <!-- Password -->
                
                        <div class="mt-2">
                            <x-input-label for="password" :value="__('Password')" />
                            <div class="relative">
                                <x-text-input type="password" class="block mt-1 w-full" id="password" name="password" required
                                    x-bind:type="passwordVisibility ? 'text' : 'password'" autocomplete="current-password" />
                                <button type="button" @click="passwordVisibility = !passwordVisibility"
                                    class="absolute inset-y-0 right-0 flex items-center px-3">
                                    <svg x-show="!passwordVisibility" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M1 12h13M17 16H21M21 8H17"></path>
                                    </svg>
                                    <svg x-show="passwordVisibility" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12L22 12">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                       
                        <!-- Confirm Password -->
                        <div class="mt-2">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                
                            <div class="relative">
                                <x-text-input type="password" class="block mt-1 w-full" id="password_confirmation" name="password_confirmation" required
                                    x-bind:type="passwordVisibility ? 'text' : 'password'" autocomplete="current-password" />
                                <button type="button" @click="passwordVisibility = !passwordVisibility"
                                    class="absolute inset-y-0 right-0 flex items-center px-3">
                                    <svg x-show="!passwordVisibility" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M1 12h13M17 16H21M21 8H17"></path>
                                    </svg>
                                    <svg x-show="passwordVisibility" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12L22 12">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                      
                        <div class="mt-2">
                            <div class="flex items-center justify-center w-full mt-4 mx-6">
                                <div class="flex flex-col items-center w-full justify-center mt-4 gap-2">
                                    
                                    <button
                                        class="w-full px-4 py-2 font-bold text-skin-inverted bg-skin-button-accent rounded-full hover:bg-skin-button-accent-hover focus:outline-none focus:shadow-outline"
                                        type="submit">
                                        {{ __('Register') }}
                                    </button>
                                    <a href="{{ route('login') }}"
                                        class="outline outline-2 text-sm font-medium uppercase tracking-widest text-center outline-lime-500 px-5 py-2 hover:bg-lime-500 hover:text-skin-inverted rounded-full w-full text-lime-600">
                                        {{ __('Login') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


