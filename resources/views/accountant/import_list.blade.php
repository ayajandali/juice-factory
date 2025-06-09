<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Imported Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">

                @if (session('success'))
                    <div class="mt-4 p-4 text-sm text-green-600 bg-green-100 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="p-6">
                    <!-- جدول فواتير الرواتب -->
                    <h3 class="text-xl font-semibold text-olive-800 mb-6 border-b pb-2">All Salary invoices</h3>

                    <div class="overflow-x-auto mb-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-[#2e3a89] text-white">
                                <tr>
                                    <th class="border px-4 py-2">Invoice #</th>
                                    <th class="border px-4 py-2">Date</th>
                                    <th class="border px-4 py-2">Total</th>
                                    <th class="border px-4 py-2">Type</th>
                                    <th class="border px-4 py-2">Description</th>
                                    <th class="border px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($salaryInvoices as $invoice)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $invoice->invoice_number }}</td>
                                        <td class="border px-4 py-2">{{ $invoice->date }}</td>
                                        <td class="border px-4 py-2">{{ $invoice->total_amount }}</td>
                                        <td class="border px-4 py-2">{{ $invoice->type }}</td>
                                        <td class="border px-4 py-2">{{ $invoice->description }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('import.edit.invoice', $invoice->id) }}" class="text-[#011491] hover:underline">Edit</a>
                                            <a href="{{ route('import_salary_details', $invoice->id) }}" class="text-[#011491] hover:underline">Show</a>
                                            <form action="{{ route('import.destroy.invoice', $invoice->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline ml-2">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>

                    <!-- جدول فواتير المواد الخام -->
                    <h3 class="text-xl font-semibold text-olive-800 mb-6 border-b pb-2">All Raw Materials invoices</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-[#2e3a89] text-white">
                                <tr>
                                    <th class="border px-4 py-2">Invoice #</th>
                                    <th class="border px-4 py-2">Date</th>
                                    <th class="border px-4 py-2">Total</th>
                                    <th class="border px-4 py-2">Type</th>
                                    <th class="border px-4 py-2">Description</th>
                                    <th class="border px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rawMaterialInvoices as $invoice)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $invoice->invoice_number }}</td>
                                        <td class="border px-4 py-2">{{ $invoice->date }}</td>
                                        <td class="border px-4 py-2">{{ $invoice->total_amount }}</td>
                                        <td class="border px-4 py-2">{{ $invoice->type }}</td>
                                        <td class="border px-4 py-2">{{ $invoice->description }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('import_raw_details', $invoice->id) }}" class="text-[#011491] hover:underline">show</a>
                                            <form action="{{ route('import.rawDestroy.invoice', $invoice->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline ml-2">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
