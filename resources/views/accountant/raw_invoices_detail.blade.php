<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Raw Material Invoice Details') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <h3 class="text-xl font-bold mb-4">Invoice #{{ $invoice->invoice_number }}</h3>
                <p><strong>Date:</strong> {{ $invoice->date }}</p>
                <p><strong>Total:</strong> {{ $invoice->total_amount }}</p>
                <p><strong>Description:</strong> {{ $invoice->description }}</p>

                <hr class="my-6">

                <h4 class="text-lg font-semibold mb-2">Raw Materials</h4>
                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-[#2e3a89] text-white">
                        <tr>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Quantity</th>
                            <th class="border px-4 py-2">Unit</th>
                            <th class="border px-4 py-2">Price</th>
                            <th class="border px-4 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->rawMaterial->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $item->rawMaterial->size ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $item->quantity }}</td>
                            <td class="border px-4 py-2">{{ $item->unit }}</td>
                            <td class="border px-4 py-2">{{ $item->price }}</td>
                            <td class="border px-4 py-2">{{ $item->subtotal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    <a href="{{ route('import.all.invoice') }}" class="text-blue-600 hover:underline">← Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
