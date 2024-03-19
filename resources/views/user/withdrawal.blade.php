<x-app-layout>
    <div class="container w-full mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="container relative w-full p-4">
                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="() => { setTimeout(() => show = false, 5000) }" id="toast-default"
                        class="absolute top-0 right-0 flex items-center w-full max-w-xs p-4 text-white bg-rose-600 rounded-lg shadow dark:text-white dark:bg-rose-800"
                        role="alert">
                        <div
                            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-rose-500 bg-rose-100 rounded-lg dark:bg-rose-800 dark:text-rose-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                            data-dismiss-target="#toast-default" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="() => { setTimeout(() => show = false, 5000) }" id="toast-success"
                        class="absolute top-0 right-0 flex items-center w-full max-w-xs p-4 text-white bg-green-500 rounded-lg shadow dark:text-white dark:bg-green-800"
                        role="alert">
                        <div
                            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-200 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                            @click="show = false">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                <div class="w-full p-4">
                    <h5 class="font-black text-2xl text-center text-skin-primary uppercase">{{ __('Cashout your income') }}</h5>
                    <form method="POST" action="{{ route('cashout.store') }}" class="space-y-2">
                        @csrf
                        <!-- Phone -->
                        <div>
                            <x-input-label for="phone" :value="__('Phone:')" />
                            <x-text-input id="phone" class="block w-full mt-1 placeholder:text-skin-secondary"
                                type="tel" name="phone" value="{{ Auth::user()->phone }}" readonly autofocus
                                autocomplete="phone" aria-placeholder="1000" placeholder="254712345678" />
                            <small class="text-[#0d0d1a]">The you register with</small>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                        <!-- Capital -->
                        <div>
                            <x-input-label for="amount" :value="__('Enter amount:')" />
                            <x-text-input id="amount" class="block w-full mt-1 placeholder:text-skin-secondary"
                                type="text" name="amount" :value="old('amount')" required autofocus
                                autocomplete="capital" aria-placeholder="1000" min="200" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>
                        <div class="text-center">
                            <x-primary-button class="mt-4">
                                {{ __('Cashout') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
                <table class="w-full mt-2 shadow-lg">
                    <thead class="border-b-2 bg-lime-50 border-b-purple-200">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">No</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Amount</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="w-full h-auto">
                        @forelse($withdrawals ?? [] as $index => $withdrawal)
                            <tr class="bg-white border-b border-gray-200 dark:border-gray-700">
                                <th scope="row" class="p-3 text-sm text-gray-700">
                                    {{ $index + 1 }}
                                </th>
                                <td class="p-3 text-sm text-gray-700">
                                    Ksh {{ $withdrawal->amount }}
                                </td>
                                <td class="p-3 text-sm text-purple-700">
                                    <span
                                        class="p-1.5 text-sm font-medium uppercase tracking-wider rounded-lg
                                                {{ $withdrawal->status === 'pending' ? 'bg-yellow-200' : 'bg-green-200' }}">
                                        {{ $withdrawal->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-3 text-sm text-gray-700 text-center">No withdrawals
                                    available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Add pagination links below the table -->
                <div class="mt-4">
                    {{ $withdrawals->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
