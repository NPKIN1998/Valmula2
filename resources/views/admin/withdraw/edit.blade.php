<x-admin-layout>
    <div class="container w-full min-h-screen mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-skin-fill shadow-sm sm:rounded-lg">
            <div class="container relative w-full p-4">
                <div class="w-full p-4 mt-2 sm:p-8 ">
                    <h5 class="font-black text-2xl text-center text-skin-primary uppercase mb-10">{{ __('Edit Withdrawal of User') }}
                    </h5>
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
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
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
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.withdrawal.update', $withdrawal->id) }}">
                        @csrf
                        @method('PUT')
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                    <td class="px-6 py-4"><input type="text" name="balance"
                                            value="{{ $withdrawal->user->balance }}"></td>
                                    <td class="px-6 py-4"><input type="text" name="amount"
                                            value="{{ $withdrawal->amount ?? '00.0' }}"></td>
                                    <td class="px-6 py-4">
                                        <select name="status" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="pending"
                                                {{ $withdrawal->status == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="approved"
                                                {{ $withdrawal->status == 'approved' ? 'selected' : '' }}>Approved
                                            </option>
                                            <option value="completed"
                                                {{ $withdrawal->status == 'completed' ? 'selected' : '' }}>Completed
                                            </option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4">{{ $withdrawal->created_at }}</td>
                                    <td class="px-6 py-4">
                                        <button type="submit">Save</button>
                                        <a href="{{ route('admin.withdrawal.index') }}" class="text-rose-500">Cancel</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
