<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Imported Invoices') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <table class="min-w-full table-auto border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Invoice #</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Total</th>
                        <th class="border px-4 py-2">Tax</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td class="border px-4 py-2">{{ $invoice->invoice_number }}</td>
                            <td class="border px-4 py-2">{{ $invoice->date }}</td>
                            <td class="border px-4 py-2">{{ $invoice->total_amount }}</td>
                            <td class="border px-4 py-2">{{ $invoice->tax }}</td>
                            <td class="border px-4 py-2">{{ $invoice->description }}</td>
                            <td class="border px-4 py-2">
                               
                                <a href="{{ route('export.edit.invoice', $invoice->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
