<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Import Invoice') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg sm:rounded-lg p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Invoice #{{ $invoice->invoice_number }}</h1>

            <form action="{{ route('import.update.invoice', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Invoice Number -->
                    <div>
                        <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                        <input type="text" name="invoice_number" id="invoice_number" value="{{ old('invoice_number', $invoice->invoice_number) }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date" value="{{ old('date', $invoice->date) }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- Total Amount -->
                    <div>
                        <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
                        <input type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $invoice->total_amount) }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- Tax -->
                    <div>
                        <label for="tax" class="block text-sm font-medium text-gray-700">Tax</label>
                        <input type="number" name="tax" id="tax" value="{{ old('tax', $invoice->tax) }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md">
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" id="type" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md" required>
                            <option value="raw materials" {{ $invoice->type == 'raw materials' ? 'selected' : '' }}>Raw Materials</option>
                            <option value="salary" {{ $invoice->type == 'salary' ? 'selected' : '' }}>Salary</option>
                            <option value="maintanance" {{ $invoice->type == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md">{{ old('description', $invoice->description) }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit" class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-md">
                            Update Invoice
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
