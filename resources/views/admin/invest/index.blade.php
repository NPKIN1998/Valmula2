<x-admin-layout>
    <div class="container w-full min-h-screen mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-skin-fill shadow-sm sm:rounded-lg">
            <div class="container relative w-full p-4">
                    <h5 class="font-black text-2xl text-center text-skin-primary uppercase mb-10">
                        {{ __('Admin investment page') }}
                    </h5>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">User</th>
                                    <th scope="col" class="px-6 py-3">Capital</th>
                                    <th scope="col" class="px-6 py-3">Daily Income</th>
                                    <th scope="col" class="px-6 py-3">Returns</th>
                                    <th scope="col" class="px-6 py-3">Rate</th>
                                    <th scope="col" class="px-6 py-3">Days</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Start Date</th>
                                    <th scope="col" class="px-6 py-3">End Date</th>
                                    {{-- <th scope="col" class="px-6 py-3">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invests as $invest)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $invest->id }}
                                    </td>
                                    <td class="px-6 py-4">{{ $invest->user->username }}</td>
                                    <td class="px-6 py-4">{{ $invest->capital }}</td>
                                    <td class="px-6 py-4">{{ $invest->daily_income }}</td>
                                    <td class="px-6 py-4">{{ $invest->returns }}</td>
                                    <td class="px-6 py-4">{{ $invest->rate }}</td>
                                    <td class="px-6 py-4">{{ $invest->days }}</td>
                                    <td class="px-6 py-4">{{ $invest->status }}</td>
                                    <td class="px-6 py-4">{{ $invest->start_date }}</td>
                                    <td class="px-6 py-4">{{ $invest->end_date }}</td>
                                    {{-- <td class="px-6 py-4">
                                        <a href="{{ route('admin.invest.edit', $invest) }}">Edit</a>
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

