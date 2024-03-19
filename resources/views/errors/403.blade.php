<x-app-layout>
    <div class="container mx-auto flex items-center justify-center text-center min-h-screen">
        <div class="bg-purple-100 border rounded-lg text-center">
            <div class="p-6">
                <h2 class="text-3xl font-semibold text-purple-800">403 Forbidden</h2>
                <p class="mt-4 text-purple-600">{{ $error }}</p>
                <div class="mt-6">
                    <a href="javascript:history.back()" class="text-blue-500 hover:underline">Go back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
