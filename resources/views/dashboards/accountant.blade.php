<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Accountant Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-700">New Invoice</h1>
                <div class="flex gap-6">
                    <form action="{{ route('accountant.export') }}" method="get">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                            Export
                        </button>
                    </form>

                    <form action="{{ route('accountant.import') }}" method="get">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                            Import
                        </button>
                    </form>
                </div>
            </div>

            <!-- Divider -->
            <hr class="my-6 border-t-2 border-gray-300">

            <!-- Add more content here as needed -->
        </div>
    </div>
</x-app-layout>
