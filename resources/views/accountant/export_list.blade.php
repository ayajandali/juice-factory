<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Exported Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-olive-800 mb-6 border-b pb-2">All export invoices</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-[#011491] text-white">
                        <tr>
                        <th class="border px-4 py-2">Invoice #</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Total</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($invoices as $invoice)
                    <tr class="odd:bg-gray-50 even:bg-white hover:bg-gray-100 hover:shadow-md transition duration-200">
                        <td class="border px-4 py-2">{{ $invoice->invoice_number }}</td>
                            <td class="border px-4 py-2">{{ $invoice->date }}</td>
                            <td class="border px-4 py-2">{{ $invoice->total_amount }}</td>
                            <td class="border px-4 py-2">{{ $invoice->description }}</td>
                            <td class="border px-4 py-2">
                               
                                <a href="{{ route('export.edit.invoice', $invoice->id) }}" class="text-[#011491] hover:underline">Edit</a>
                                <form action="{{ route('export.destroy.invoice', $invoice->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline ml-2">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    @if (session('export_delete'))
                            <div class="mt-4 p-4 text-sm text-green-600 bg-green-100 rounded-md">
                                {{ session('export_delete') }}
                            </div>
                    @endif
                </tbody>
            </table>
            <div class="mt-4">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
