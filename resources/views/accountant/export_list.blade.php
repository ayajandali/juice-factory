<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-900 leading-tight">
            {{ __('Exported Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-blue-800 mb-6 border-b border-blue-200 pb-3">
                        All Export Invoices
                    </h3>

                    @if (session('export_delete'))
                        <div class="mb-6 p-4 text-sm text-green-800 bg-green-100 rounded-lg shadow-sm">
                            {{ session('export_delete') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg">
                        <table class="min-w-full text-sm text-left border border-blue-100">
                            <thead class="bg-[#011491] text-white text-sm uppercase tracking-wide">
                                <tr>
                                    <th class="px-4 py-3 border border-blue-100">Invoice #</th>
                                    <th class="px-4 py-3 border border-blue-100">Date</th>
                                    <th class="px-4 py-3 border border-blue-100">Total</th>
                                    <th class="px-4 py-3 border border-blue-100">Description</th>
                                    <th class="px-4 py-3 border border-blue-100">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-blue-100">
                                @foreach ($invoices as $invoice)
                                    <tr class="hover:bg-blue-100 transition duration-200">
                                        <td class="px-4 py-2">{{ $invoice->invoice_number }}</td>
                                        <td class="px-4 py-2">{{ $invoice->date }}</td>
                                        <td class="px-4 py-2">${{ number_format($invoice->total_amount, 2) }}</td>
                                        <td class="px-4 py-2">{{ $invoice->description }}</td>
                                        <td class="px-4 py-2 space-x-2">
                                            <a href="{{ route('export.show.invoice', $invoice->id) }}"
                                               class="text-blue-700 font-medium hover:underline">Show</a>
                                            <form action="{{ route('export.destroy.invoice', $invoice->id) }}"
                                                  method="POST"
                                                  class="inline-block"
                                                  onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 font-medium hover:underline ml-2">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
