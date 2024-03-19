<x-admin-layout>
<div>
   <h1> Admin withdrawal page</h1>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
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
                @foreach($withdrawals as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->username }}
                    </td>
                    <td class="px-6 py-4">{{ $user->phone }}</td>
                    <td class="px-6 py-4">{{ $user->balance }}</td>
                    <td class="px-6 py-4">{{ $user->withdrawal_amount ?? '00.0' }}</td>
                    <td class="px-6 py-4">{{ $user->withdrawal_status ?? '00.0' }}</td>
                    <td class="px-6 py-4">{{ $user->created_at}}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('withdrawal.edit', $user->id) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>

</x-admin-layout>