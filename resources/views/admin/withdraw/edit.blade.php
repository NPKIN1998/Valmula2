<x-admin-layout>
    <div class="container mx-auto">
        <div class="overflow-x-auto">
            <form method="POST" action="{{ route('withdrawal.update', $withdrawal->id) }}">
                @csrf
                @method('PUT')
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
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $withdrawal->user->username }}
                            </td>
                            <td class="px-6 py-4">{{ $withdrawal->user->phone }}</td>
                            <td class="px-6 py-4"><input type="text" name="balance" value="{{ $withdrawal->user->balance }}"></td>
                            <td class="px-6 py-4"><input type="text" name="withdrawal_amount" value="{{ $withdrawal->amount ?? '00.0' }}"></td>
                            <td class="px-6 py-4">
                                <select name="status">
                                    <option value="pending" {{ $withdrawal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $withdrawal->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="completed" {{ $withdrawal->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>    
                            </td>
                            <td class="px-6 py-4">{{ $withdrawal->created_at}}</td>
                            <td class="px-6 py-4">
                                <button type="submit">Save</button>
                                <a href="{{ route('withdrawal.index') }}">Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</x-admin-layout>
