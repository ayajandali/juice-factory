<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-800 leading-tight">
            Invoice Details - #{{ $invoice->invoice_number }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-6 lg:px-8 bg-white shadow-lg rounded-2xl">
        <div class="mb-8">
            <h3 class="text-xl font-bold text-blue-700 border-b border-blue-200 pb-2 mb-4">Invoice Information</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
                <p><span class="font-semibold text-blue-600">Invoice Number:</span> {{ $invoice->invoice_number }}</p>
                <p><span class="font-semibold text-blue-600">Date:</span> {{ \Carbon\Carbon::parse($invoice->date)->format('d/m/Y') }}</p>
                <p><span class="font-semibold text-blue-600">Description:</span> {{ $invoice->description ?? 'No description' }}</p>
                <p><span class="font-semibold text-blue-600">User:</span> {{ $invoice->user->name ?? 'Unknown' }}</p>
                <p><span class="font-semibold text-blue-600">Total Amount:</span> ${{ number_format($invoice->total_amount, 2) }}</p>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-bold text-blue-700 border-b border-blue-200 pb-2 mb-4">Products</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-blue-200 rounded-lg shadow">
                    <thead class="bg-blue-50 text-blue-800 font-semibold">
                        <tr>
                            <th class="border border-blue-200 px-4 py-3">Product Name</th>
                            <th class="border border-blue-200 px-4 py-3">Price</th>
                            <th class="border border-blue-200 px-4 py-3">Quantity</th>
                            <th class="border border-blue-200 px-4 py-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->items as $item)
                            <tr class="hover:bg-blue-100 transition duration-200">
                                <td class="border border-blue-100 px-4 py-2">{{ $item->product->product_name ?? 'Deleted Product' }}</td>
                                <td class="border border-blue-100 px-4 py-2">${{ number_format($item->price, 2) }}</td>
                                <td class="border border-blue-100 px-4 py-2">{{ $item->quantity }}</td>
                                <td class="border border-blue-100 px-4 py-2">${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
