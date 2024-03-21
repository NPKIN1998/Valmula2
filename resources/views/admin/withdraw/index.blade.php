<x-admin-layout>
    <div class="container w-full min-h-screen mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-skin-fill shadow-sm sm:rounded-lg">
            <div class="container relative w-full p-4">
                    <h5 class="font-black text-2xl text-center text-skin-primary uppercase mb-10">
                        {{ __('Admin withdrawal page') }}
                    </h5>
                    <div class="relative overflow-x-auto">
                        <form action="{{ route('admin.withdrawal.search') }}" method="post">
                            @csrf
                            <div class="my-2 flex flex-row justify-center items-center gap-4">
                                <label class="text-xl uppercase font-semibold">Search</label>
                                <input type="text" name="search" class="w-64 py-2 px-4 rounded-full">    
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
                            </div>
                        </form>
                        
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Username</th>
                                    <th scope="col" class="px-6 py-3">Phone</th>
                                    <th scope="col" class="px-6 py-3">Balance</th>
                                    <th scope="col" class="px-6 py-3">Withdrawal Amount</th>
                                    <th scope="col" class="px-6 py-3">Withdrawal Status</th>
                                    <th scope="col" class="px-6 py-3">Date</th>
                                    <th scope="col" class="px-6 py-3">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdrawals as $withdrawal)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $withdrawal->id }}
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $withdrawal->user->username }}
                                        </td>
                                        <td class="px-6 py-4">{{ $withdrawal->user->phone }}</td>
                                        <td class="px-6 py-4">{{ $withdrawal->user->balance }}</td>
                                        <td class="px-6 py-4">{{ $withdrawal->amount ?? '00.0' }}</td>
                                        <td class="px-6 py-4">{{ $withdrawal->status ?? '00.0' }}</td>
                                        <td class="px-6 py-4">{{ $withdrawal->created_at }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.withdrawal.edit', $withdrawal) }}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
            </div>
        </div>
    </div>
</x-admin-layout>
