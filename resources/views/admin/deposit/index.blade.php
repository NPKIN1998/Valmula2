<x-admin-layout>
    <div class="container w-full min-h-screen mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-skin-fill shadow-sm sm:rounded-lg">
            <div class="container relative w-full p-4">
                    <h5 class="font-black text-2xl text-center text-skin-primary uppercase mb-10">
                        {{ __('Admin deposit page') }}
                    </h5>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Username</th>
                                    <th scope="col" class="px-6 py-3">Phone</th>
                                    <th scope="col" class="px-6 py-3">Balance</th>
                                    <th scope="col" class="px-6 py-3">Amount</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Date</th>
                                    {{-- <th scope="col" class="px-6 py-3">Action</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deposits as $deposit)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $deposit->id }}
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $deposit->user->username }}
                                        </td>
                                        <td class="px-6 py-4">{{ $deposit->user->phone }}</td>
                                        <td class="px-6 py-4">{{ $deposit->user->balance }}</td>
                                        <td class="px-6 py-4">{{ $deposit->amount ?? '00.0' }}</td>
                                        <td class="px-6 py-4">{{ $deposit->status ?? '00.0' }}</td>
                                        <td class="px-6 py-4">{{ $deposit->created_at }}</td>
                                        {{-- <td class="px-6 py-4">
                                            <a href="{{ route('admin.deposit.edit', $deposit) }}">Edit</a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
            </div>
        </div>
    </div>
</x-admin-layout>