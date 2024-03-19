<x-app-layout>
    <div class="container mx-auto w-full mt-2 flex gap-4  text-skin-primary flex-col items-center justify-center p-4">
        <div class="w-full grid grid-cols-3 divide-x divide-lime-800">
            <div class="col-span-1 bg-skin-fill p-4 flex flex-col items-center justify-center">
                <p class="text-lg font-medium">
                    {{ $referrals }}
                </p>
                <h5 class="text-xl font-bold uppercase">{{ __('Total Referrals') }}</h5>
            </div>
            <div class="col-span-1 bg-skin-fill p-4 flex flex-col items-center justify-center">
                <p class="text-lg font-medium"> {{ $activeDownlines }}</p>
                <h5 class="text-xl font-bold uppercase">{{ __('Active Referrals') }}</h5>
            </div>
            <div class="col-span-1 bg-skin-fill p-4 flex flex-col items-center justify-center">
                <p class="text-lg font-medium"> {{ $uplineBonus }}</p>
                <h5 class="text-xl font-bold uppercase">{{ __('Referral income') }}</h5>
            </div>
        </div>
        <div
            class="w-full p-4 text-center sm:p-8 ">
            <div class="space-y-3 mt-10 flex flex-col">
                <h1 class="text-xl text-pretty font-semibold leading-8">
                    Copy the link to create a team and from the team
                </h1>

                <div x-data="{ copied: false }" class="my-2">
                    <form
                        class="flex justify-between ring-2 ring-blue-900 bg-purple-50 rounded-xl shadow overflow-hidden p-0.5">
                        <input x-ref="copyInput" type="text"
                            class="flex-1 px-2 text-skin-secondary border-none outline-none focus:border-none focus:outline-none"
                            value="{{ Auth::user()->referral_link }}" readonly>
                        <button @click="copyToClipboard" :class="{ 'text-green-500': copied }"
                            class="px-4 py-2 font-medium bg-skin-primary text-skin-inverted rounded-xl">
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

        <!-- Assuming $downlineData is an array of referrals -->
        <table class="w-full mt-2 shadow-lg table-auto">
            <thead class="border-b-2 bg-lime-50 border-b-purple-200">
                <tr>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Username</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse($downlineData ?? [] as $index => $referral)
                    <tr class="bg-white border-b border-gray-200 dark:border-gray-700">
                        <td class="p-3 text-sm text-gray-700">{{ $referral->username }}</td>
                        <td class="p-3 text-sm text-gray-700">{{ $referral->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-sm text-gray-700 text-center">No referrals available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
    <script>
        function copyToClipboard() {
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
                timer: 2000
            });

            setTimeout(() => {
                this.copied = false;
            }, 2000);
        }
    </script>
</x-app-layout>
