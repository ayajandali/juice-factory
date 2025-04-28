<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Accountant Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg sm:rounded-lg p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-700">Export Invoice</h1>
            </div>

            <!-- Start Form -->
            <form action="{{ route('accountant.export.store') }}" method="POST">
                @csrf
                <div class="space-y-6">

                    <!-- Invoice Number -->
                    <div>
                        <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                        <input type="text" name="invoice_number" id="invoice_number" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Total Amount -->
                    <div>
                        <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
                        <input type="number" name="total_amount" id="total_amount" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Tax -->
                    <div>
                        <label for="tax" class="block text-sm font-medium text-gray-700">Tax</label>
                        <input type="number" name="tax" id="tax" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-md transition duration-300">
                            Submit Invoice
                        </button>
                    </div>

                </div>
            </form>
            <!-- End Form -->

            @if (session('status'))
            <div class="mt-4 p-4 text-sm text-green-600 bg-green-100 rounded-md">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
