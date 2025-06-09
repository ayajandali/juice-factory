<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-indigo-700">Salary Invoice Details</h2>

        {{-- Invoice Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-sm text-gray-500">Invoice Number</p>
                <p class="font-semibold text-lg">{{ $invoice->invoice_number }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Date</p>
                <p class="font-semibold text-lg">{{ $invoice->date }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-gray-500">Description</p>
                <p class="font-medium">{{ $invoice->description ?? '—' }}</p>
            </div>
        </div>

        {{-- Employee Salaries --}}
        <div>
            <h3 class="text-xl font-semibold mb-4 text-gray-700">Employees</h3>

            <div class="overflow-x-auto">
                <table class="w-full table-auto border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">#</th>
                            <th class="border px-4 py-2 text-left">Employee Name</th>
                            <th class="border px-4 py-2 text-left">Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->salaries as $index => $salaryItem)
                            <tr>
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">
                                    {{ $salaryItem->user->first_name }} {{ $salaryItem->user->last_name }}
                                </td>
                                <td class="border px-4 py-2">{{ number_format($salaryItem->salary, 2) }} $</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Back Button --}}
        <div class="mt-6 text-center">
            <a href="{{ route('import.all.invoice') }}"
               class="inline-block px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Back to Invoices
            </a>
        </div>
    </div>
</x-app-layout>
