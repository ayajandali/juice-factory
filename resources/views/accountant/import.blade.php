<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-800 leading-tight">
            Add Import Invoice
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-6 lg:px-8 bg-white shadow-lg rounded-2xl">
        <form action="{{ route('accountant.import.store') }}" method="POST">
            @csrf

            <!-- Invoice Number -->
            <div>
                <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                <input
                    type="text"
                    name="invoice_number"
                    id="invoice_number"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required
                >
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required
                >
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                ></textarea>
            </div>

            <!-- Invoice Type -->
            <div class="mb-6">
                <label for="type" class="block text-blue-700 font-semibold mb-2">Invoice Type</label>
                <select
                    id="type"
                    name="type"
                    class="form-select w-full border border-blue-300 rounded-md px-3 py-2"
                >
                    <option value="">-- Select Type --</option>
                    <option value="salary" {{ old('type') == 'salary' ? 'selected' : '' }}>Salary</option>
                    <option value="raw materials" {{ old('type') == 'raw materials' ? 'selected' : '' }}>Raw Materials</option>
                </select>
            </div>

            <!-- Raw Materials Section -->
            <div id="raw-materials-section" class="hidden mb-6">
                <h3 class="text-xl font-semibold text-blue-700 mb-4 border-b border-blue-200 pb-2">Raw Materials</h3>

                <div id="materials-wrapper">
                    <div class="material-item flex flex-wrap gap-4 mb-4">
                        <select name="materials[0][name]" class="form-select w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
                            <option value="">-- Select Material --</option>
                            @foreach ($rawMaterials as $material)
                                <option value="{{ $material->name }}">{{ $material->name }}</option>
                            @endforeach
                        </select>

                        <select name="materials[0][size]" class="form-select border border-blue-300 rounded-md px-3 py-2">
                            <option value="">Size</option>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>

                        <input
                            type="number"
                            name="materials[0][quantity]"
                            placeholder="Quantity"
                            min="1"
                            class="form-input border border-blue-300 rounded-md px-3 py-2 w-24"
                            required
                        />

                        <select name="materials[0][unit]" class="form-select border border-blue-300 rounded-md px-3 py-2" required>
                            <option value="kg">Kg</option>
                            <option value="piece">Piece</option>
                        </select>

                        <input
                            type="number"
                            name="materials[0][price]"
                            placeholder="Price"
                            step="0.01"
                            min="0"
                            class="form-input border border-blue-300 rounded-md px-3 py-2 w-28 price-field"
                            required
                        />

                        <input
                            type="text"
                            name="materials[0][subtotal]"
                            placeholder="Subtotal"
                            readonly
                            class="form-input bg-gray-100 border border-blue-300 rounded-md px-3 py-2 w-32 subtotal-field"
                        />

                        <button type="button" class="remove-btn text-red-600 hover:underline self-center">Remove</button>
                    </div>
                </div>

                <button type="button" id="add-material-btn" class="bg-blue-600 text-white px-4 py-2 rounded-md">Add Material</button>

                <div class="mt-4 text-right">
                    <input type="hidden" name="total_amount" id="total_amount_input" value="0.00">
                    <span class="font-semibold text-lg">Total Amount:</span>
                    <span id="total_amount" class="text-xl text-blue-700 ml-2">0.00</span> $
                </div>
            </div>

            <!-- Salary Section -->
            <div id="salary-section" class="hidden mb-6">
                <h3 class="text-xl font-semibold text-blue-700 mb-4 border-b border-blue-200 pb-2">Employee Salaries</h3>

                <div id="salary-wrapper">
                    <div class="salary-item flex flex-wrap gap-4 mb-4">
                        <select name="salaries[0][user_id]" class="form-select border border-blue-300 rounded-md px-3 py-2 " required>
                            <option value="">-- Select Employee --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" data-salary="{{ $user->salary }}">{{ $user->first_name }} {{$user->last_name}}</option>
                            @endforeach
                        </select>

                        <input
                            type="number"
                            name="salaries[0][salary]"
                            placeholder="Salary"
                            readonly
                            class="form-input bg-gray-100 border border-blue-300 rounded-md px-3 py-2 w-32 salary-field"
                        />

                        <button type="button" class="remove-salary-btn text-red-600 hover:underline self-center">Remove</button>
                    </div>
                </div>

                <button type="button" id="add-salary-btn" class="bg-blue-600 text-white px-4 py-2 rounded-md">Add Another Employee Salary</button>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="bg-blue-700 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition">Save Invoice</button>
            </div>
        </form>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mt-4 p-4 text-sm text-green-600 bg-green-100 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
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
    const invoiceTypeSelect = document.getElementById('type');
    const rawMaterialsSection = document.getElementById('raw-materials-section');
    const salarySection = document.getElementById('salary-section');

    invoiceTypeSelect.addEventListener('change', function() {
    if (this.value === 'raw materials') {
        rawMaterialsSection.classList.remove('hidden');
        salarySection.classList.add('hidden');

        // Enable required only for raw materials
        toggleRequiredFields(rawMaterialsSection, true);
        toggleRequiredFields(salarySection, false);

    } else if (this.value === 'salary') {
        salarySection.classList.remove('hidden');
        rawMaterialsSection.classList.add('hidden');

        // Enable required only for salaries
        toggleRequiredFields(rawMaterialsSection, false);
        toggleRequiredFields(salarySection, true);

    } else {
        salarySection.classList.add('hidden');
        rawMaterialsSection.classList.add('hidden');

        // Disable all required fields
        toggleRequiredFields(rawMaterialsSection, false);
        toggleRequiredFields(salarySection, false);
    }
});

function toggleRequiredFields(section, isRequired) {
    section.querySelectorAll('[required]').forEach(el => {
        if (isRequired) {
            el.setAttribute('required', 'required');
        } else {
            el.removeAttribute('required');
        }
    });
}


    // ==========================
    // Raw Materials Logic
    // ==========================
    let index = 1;

    document.getElementById('add-material-btn').addEventListener('click', function () {
        const wrapper = document.getElementById('materials-wrapper');

        const newItem = document.createElement('div');
        newItem.className = 'material-item flex flex-wrap gap-4 mb-4';
        newItem.innerHTML = `
            <select name="materials[${index}][name]" class="form-select border border-blue-300 rounded-md px-3 py-2" required>
                <option value="">-- Select Material --</option>
                @foreach ($rawMaterials as $material)
                    <option value="{{ $material->name }}">{{ $material->name }}</option>
                @endforeach
            </select>

            <select name="materials[${index}][size]" class="form-select border border-blue-300 rounded-md px-3 py-2">
                <option value="">Size</option>
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
            </select>

            <input type="number" name="materials[${index}][quantity]" placeholder="Quantity" min="1" class="form-input border border-blue-300 rounded-md px-3 py-2 w-24" required />

            <select name="materials[${index}][unit]" class="form-select border border-blue-300 rounded-md px-3 py-2" required>
                <option value="kg">Kg</option>
                <option value="piece">Piece</option>
            </select>

            <input type="number" name="materials[${index}][price]" placeholder="Price" step="0.01" min="0" class="form-input border border-blue-300 rounded-md px-3 py-2 w-28 price-field" required />

            <input type="text" name="materials[${index}][subtotal]" placeholder="Subtotal" readonly class="form-input bg-gray-100 border border-blue-300 rounded-md px-3 py-2 w-32 subtotal-field" />

            <button type="button" class="remove-btn text-red-600 hover:underline self-center">Remove</button>
        `;

        wrapper.appendChild(newItem);
        index++;
        updatePriceListeners();
    });

    document.getElementById('materials-wrapper').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-btn')) {
            e.target.parentElement.remove();
            calculateTotal();
        }
    });

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.material-item').forEach(item => {
            const quantity = parseFloat(item.querySelector('input[name$="[quantity]"]').value) || 0;
            const price = parseFloat(item.querySelector('input[name$="[price]"]').value) || 0;
            const subtotalField = item.querySelector('.subtotal-field');
            const subtotal = quantity * price;
            subtotalField.value = subtotal.toFixed(2);
            total += subtotal;
        });
        document.getElementById('total_amount').textContent = total.toFixed(2);
        document.getElementById('total_amount_input').value = total.toFixed(2);
    }

    function updatePriceListeners() {
        document.querySelectorAll('.price-field, input[name$="[quantity]"]').forEach(input => {
            input.removeEventListener('input', calculateTotal);
            input.addEventListener('input', calculateTotal);
        });
    }

    updatePriceListeners();

    // ==========================
    // Salary Section Logic
    // ==========================
    let salaryIndex = 1;

    document.getElementById('add-salary-btn').addEventListener('click', function () {
        const wrapper = document.getElementById('salary-wrapper');
        const newItem = document.createElement('div');
        newItem.className = 'salary-item flex flex-wrap gap-4 mb-4';
        newItem.innerHTML = `
            <select name="salaries[${salaryIndex}][user_id]" class="form-select border border-blue-300 rounded-md px-3 py-2" required>
                <option value="">-- Select Employee --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" data-salary="{{ $user->salary }}">{{ $user->first_name }} {{$user->last_name}}</option>
                @endforeach
            </select>

            <input type="number" name="salaries[${salaryIndex}][salary]" placeholder="Salary" readonly class="form-input bg-gray-100 border border-blue-300 rounded-md px-3 py-2 w-32 salary-field" />

            <button type="button" class="remove-salary-btn text-red-600 hover:underline self-center">Remove</button>
        `;
        wrapper.appendChild(newItem);
        salaryIndex++;
    });

    document.getElementById('salary-wrapper').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-salary-btn')) {
            e.target.parentElement.remove();
        }
    });

    document.getElementById('salary-wrapper').addEventListener('change', function (e) {
        if (e.target.tagName === 'SELECT') {
            const salary = e.target.selectedOptions[0].getAttribute('data-salary') || '';
            const salaryInput = e.target.parentElement.querySelector('.salary-field');
            if (salaryInput) {
                salaryInput.value = salary;
            }
        }
    });

    
</script>

</x-app-layout>
