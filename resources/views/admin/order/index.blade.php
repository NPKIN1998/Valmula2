<x-admin-layout>
    <div class="container w-full min-h-screen mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-skin-fill shadow-sm sm:rounded-lg">
            <div class="container relative w-full p-4">
                <div class="flex justify-between items-center">
                    <h5 class="font-black text-2xl text-center text-skin-primary uppercase mb-10">
                        {{ __('Admin index orders') }}
                    </h5>
                    <a href="{{ route('admin.order.create') }}"
                        class="bg-skin-primary text-skin-secondary text-xl uppercase tracking-wide py-1 px-4 rounded-lg">Create
                        Orders</a>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Amount</th>
                                <th scope="col" class="px-6 py-3">Rate</th>
                                <th scope="col" class="px-6 py-3">Return</th>
                                <th scope="col" class="px-6 py-3">Daily Income</th>
                                <th scope="col" class="px-6 py-3">Days</th>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $order->id }}
                                    </td>
                                    <td class="px-6 py-4">{{ $order->amount }}</td>
                                    <td class="px-6 py-4">{{ $order->rate }}</td>
                                    <td class="px-6 py-4">{{ $order->return }}</td>
                                    <td class="px-6 py-4">{{ $order->daily_income }}</td>
                                    <td class="px-6 py-4">{{ $order->days }}</td>
                                    <td class="px-6 py-4">{{ $order->created_at }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.order.edit', $order) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Add pagination links below the table -->
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
