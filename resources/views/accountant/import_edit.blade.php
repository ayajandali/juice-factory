<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Edit Salary Invoice #{{ $invoice->invoice_number }}</h2>

        <form action="{{ route('import.update.invoice', $invoice->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Invoice Number --}}
            <div class="mb-4">
                <label for="invoice_number" class="block text-gray-700 font-semibold mb-2">Invoice Number</label>
                <input type="text" name="invoice_number" id="invoice_number" required
                       value="{{ old('invoice_number', $invoice->invoice_number) }}"
                       class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Date --}}
            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-semibold mb-2">Date</label>
                <input type="date" name="date" id="date" required
                value="{{ old('date', optional($invoice->date)->format('Y-m-d')) }}"
                       class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500">{{ old('description', $invoice->description) }}</textarea>
            </div>

            {{-- Employees Section --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">Employees</h3>
                <div id="employees-container" class="space-y-4">
                    @foreach ($invoice->salaries as $index => $salaryEntry)
                        <div class="flex gap-4 items-center employee-row">
                            <div class="w-1/2">
                                <label class="block text-sm mb-1 text-gray-600">Select Employee</label>
                                <select name="salaries[{{ $index }}][user_id]" required
                                        class="user-select w-full p-2 border border-gray-300 rounded-md">
                                    <option value="">-- Select an employee --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" data-salary="{{ $user->salary }}"
                                            {{ $salaryEntry->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-1/2 flex gap-2">
                                <input type="text" name="salaries[{{ $index }}][salary]" readonly
                                       value="{{ $salaryEntry->salary }}"
                                       class="salary-input w-full p-2 border border-gray-300 rounded-md bg-gray-100">
                                <button type="button" onclick="removeEmployeeRow(this)"
                                        class="text-red-600 font-bold px-2 hover:text-red-800" title="Remove employee">
                                    🗑️
                                </button>
                            </div>
                            <input type="hidden" name="salaries[{{ $index }}][id]" value="{{ $salaryEntry->id }}">
                        </div>
                    @endforeach
                </div>

                <button type="button" onclick="addEmployeeRow()"
                        class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    + Add Employee
                </button>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700">
                    Update Invoice
                </button>
            </div>
        </form>
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
    </div>

    <script>
        let rowIndex = {{ $invoice->salaries->count() }};

        function addEmployeeRow() {
            const container = document.getElementById('employees-container');
            const newRow = document.createElement('div');
            newRow.classList.add('flex', 'gap-4', 'items-center', 'employee-row', 'mt-2');

            newRow.innerHTML = `
                <div class="w-1/2">
                    <select name="salaries[${rowIndex}][user_id]" required
                            class="user-select w-full p-2 border border-gray-300 rounded-md">
                        <option value="">-- Select an employee --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" data-salary="{{ $user->salary }}">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/2 flex gap-2">
                    <input type="text" name="salaries[${rowIndex}][salary]" readonly
                           class="salary-input w-full p-2 border border-gray-300 rounded-md bg-gray-100">
                    <button type="button" onclick="removeEmployeeRow(this)"
                            class="text-red-600 font-bold px-2 hover:text-red-800" title="Remove employee">
                        🗑️
                    </button>
                </div>
            `;

            container.appendChild(newRow);
            rowIndex++;
        }

        function removeEmployeeRow(button) {
            const row = button.closest('.employee-row');
            row.remove();
        }

        document.addEventListener('change', function (e) {
            if (e.target.matches('.user-select')) {
                const selectedOption = e.target.options[e.target.selectedIndex];
                const salary = selectedOption.getAttribute('data-salary');
                const salaryInput = e.target.closest('.employee-row').querySelector('.salary-input');
                salaryInput.value = salary || '';
            }
        });
    </script>
</x-app-layout>
