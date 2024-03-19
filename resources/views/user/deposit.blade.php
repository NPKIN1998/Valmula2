<x-app-layout>
    <div class="container min-h-screen mx-auto space-y-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="w-full p-4 mt-2 border border-purple-200 rounded-lg sm:p-8 bg-purple-50">
                <h5 class="font-bold text-center text-purple-600 uppercase">{{ __('Deposit to unlock financial freedom ') }}</h5>
                <form method="POST" class="space-y-2">
                    <!-- Phone -->
                    <div>
                        <x-input-label for="phone" :value="__('Phone:')" />
                        <x-text-input id="phone" class="block w-full mt-1 placeholder:text-purple-500" type="tel"
                            name="phone" value="{{ Auth::user()->phone }}" readonly autofocus autocomplete="phone"
                            aria-placeholder="1000" placeholder="254712345678" />
                        <small class="text-[#0d0d1a]">The you register with</small>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <!-- Capital -->
                    <div>
                        <x-input-label for="capital" :value="__('Enter amount:')" />
                        <x-text-input id="capital" class="block w-full mt-1 placeholder:text-purple-500"
                            type="text" name="capital" :value="old('capital')" required autofocus autocomplete="capital"
                            aria-placeholder="1000"/>
                        <x-input-error :messages="$errors->get('capital')" class="mt-2" />
                    </div>
                    <div class="text-center">
                        <x-primary-button class="mt-4">
                            {{ __('Deposit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div
                class="w-full p-4 my-4  text-center text-purple-800 rounded-lg shadow  sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="space-y-3 mt-10 flex flex-col">
                    <h1 class="text-xl text-pretty font-semibold leading-8">
                        Deposit manually using this number
                    </h1>

                    <div x-data="{ copied: false }" class="my-2">
                        <form
                            class="flex justify-between ring-2 ring-purple-500 bg-purple-50 rounded-xl shadow overflow-hidden p-0.5">
                            <input x-ref="copyInput" type="text"
                                class="flex-1 px-2 text-purple-600 border-none outline-none focus:border-none focus:outline-none"
                                value="{{ config('app.num_deposit') }}" readonly>
                            <button @click="copyToNumClipboard" :class="{ 'text-green-500': copied }"
                                class="px-4 py-2 font-medium bg-purple-500 text-purple-50 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                                </svg>
                            </button>
                        </form>
                    </div>

                     <div x-data="{ copied: false }" class="my-2">
                        <form
                            class="flex justify-between ring-2 ring-purple-500 bg-purple-50 rounded-xl shadow overflow-hidden p-0.5">
                            <input x-ref="copyInput" type="text"
                                class="flex-1 px-2 text-purple-600 border-none outline-none focus:border-none focus:outline-none"
                                value="{{ config('app.name_deposit') }}" readonly>
                            <button @click="copyToNameClipboard" :class="{ 'text-green-500': copied }"
                                class="px-4 py-2 font-medium bg-purple-500 text-purple-50 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <table class="w-full mt-2 shadow-lg">
                <thead class="border-b-2 bg-purple-50 border-b-purple-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">No</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Phone</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Amount</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deposits as $deposit)
                        <tr class="bg-white border-b border-gray-200 dark:border-gray-700">
                            <th scope="row" class="p-3 text-sm text-gray-700">
                                {{ $loop->index + 1 }}
                            </th>
                            <td class="p-3 text-sm text-gray-700">
                                {{ $deposit->user->phone }}
                            </td>
                            <td class="p-3 text-sm text-gray-700">
                                Ksh {{ $deposit->amount }}
                            </td>
                            <td class="p-3 text-sm text-gray-700">
                                {{ $deposit->status }}
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b border-gray-200 dark:border-gray-700">
                            <td colspan="4" class="p-3 text-sm text-gray-700 text-center">
                                No deposits available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function copyToNumClipboard() {
            const input = this.$refs.copyInput;
            input.select();
            input.setSelectionRange(0, 99999);
            document.execCommand("copy");
            this.copied = true;

            // Get the copied value
            const copiedValue = input.value;

            // Using SweetAlert for the success alert
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: `${copiedValue} has been copied to clipboard.`,
                showConfirmButton: false,
                timer: 5000
            });

            setTimeout(() => {
                this.copied = false;
            }, 2000);
        }
         function copyToNameClipboard() {
            const input = this.$refs.copyInput;
            input.select();
            input.setSelectionRange(0, 99999);
            document.execCommand("copy");
            this.copied = true;

            // Get the copied value
            const copiedValue = input.value;

            // Using SweetAlert for the success alert
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: `${copiedValue} has been copied to clipboard.`,
                showConfirmButton: false,
                timer: 5000
            });

            setTimeout(() => {
                this.copied = false;
            }, 2000);
        }
    </script>
</x-app-layout>
