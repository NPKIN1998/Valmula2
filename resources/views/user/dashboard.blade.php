<x-app-layout>
    <div class="container w-full min-h-screen  mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="container w-full p-4 text-center">
                    <h2 class="mb-2 text-xl font-bold leading-tight text-purple-800 uppercase">
                        {{ Auth::user()->username }}
                    </h2>
                    <h1 class="text-2xl font-black text-purple-600 uppercase">Account Balance</h1>
                    <p class="text-lg font-semibold text-purple-500">
                        {{ Auth::user()->balance }}
                    </p>
                    <div class="grid grid-flow-col gap-2 px-2 py-1 rounded-lg">
                        <a href="{{ route('deposit') }}"
                            class="px-4 py-2 border-2 rounded-lg border-blue-900 uppercase font-semibold text-blue-900">deposit</a>
                        <a href="{{ route('cashout') }}"
                            class="px-4 py-2 rounded-lg bg-blue-900 text-white uppercase">cashout</a>
                    </div>
                </div>
                <div class="w-full grid grid-cols-3 my-4">
                    <div class="col-span-1  p-4 flex flex-col items-center justify-center">
                        <a href="{{ config('app.call_support') }}">
                            <img src="public/build/assets/phone-B66cBlct.png" class="size-70">
                            <!--<img src="public/build//images/phone-B66cBlct.png') }}" class="size-70">-->
                        </a>
                    </div>
                    <div class="col-span-1  p-4 flex flex-col items-center justify-center">
                        <a href="{{ config('app.group_telegram') }}">
                            <img src="public/build/assets/telegram-DdurED4T.png" class="size-70">
                            <!--<img src="{{ Vite::asset('resources/images/telegram.png') }}" class="size-70">-->
                        </a>
                    </div>
                    <div class="col-span-1 p-4 flex flex-col items-center justify-center">
                        <a href="{{ config('app.group_whatsapp') }}">
                            <img src="public/build/assets/whatsapp-Cks0hE5c.png" class="size-70">
                            <!--<img src="{{ Vite::asset('resources/images/whatsapp.png') }}" class="size-70">-->
                        </a>
                    </div>
                </div>
                
                <div
                    class="w-full p-4 text-center border border-purple-200 rounded-lg shadow bg-lime-50 sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <p class="mb-5 text-base font-bold text-skin-base sm:text-lg">
                        Downlod our application
                    </p>
                    <div
                        class="w-full items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                        <a href="{{ config('app.app_download') }}"
                            class="w-full bg-lime-600 hover:bg-lime-700 focus:ring-4 focus:outline-none focus:ring-purple-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-purple-600 dark:focus:ring-purple-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>

                            <div class="text-left rtl:text-right">
                                <div class="mb-1 text-xs tracking-wide font-medium">Get the app</div>
                                <div class="-mt-1 font-sans text-sm font-bold uppercase tracking-wider">{{ __('Downlod') }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="container w-full p-4 mb-10">
                    <form method="POST" class="w-full" action="{{ route('logout') }}">
                        @csrf
                        <button :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            class="w-full bg-skin-button-accent hover:bg-skin-button-accent-hover focus:ring-4 focus:outline-none focus:ring-purple-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-purple-600 dark:focus:ring-purple-700">
                            <div class="text-left rtl:text-right">
                                <div class="-mt-1 font-sans text-xl font-semibold uppercase">{{ __('Logout') }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-8 h-8 ml-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
