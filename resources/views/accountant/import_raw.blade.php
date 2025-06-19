<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 bg-white rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Create Raw Materials Invoice</h2>

        <form action="{{ route('accountant.import.storeRaw') }}" method="POST">
            @csrf

            {{-- Invoice Number --}}
            <div class="mb-4">
                <label for="invoice_number" class="block text-gray-700 font-semibold mb-2">Invoice Number</label>
                <input type="text" name="invoice_number" id="invoice_number" required
                       class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Date --}}
            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-semibold mb-2">Date</label>
                <input type="date" name="date" id="date" required
                       class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>

            {{-- Raw Materials Section --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">Raw Materials</h3>
                <div id="materials-container" class="space-y-4">
                    <div class="grid grid-cols-6 gap-4 items-end material-row">
                        {{-- Raw Material Select --}}
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Material</label>
                            <select name="materials[0][material_id]" required
                                    class="w-full p-2 border border-gray-300 rounded-md">
                                <option value="">-- Select material --</option>
                                @foreach ($rawMaterials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Quantity --}}
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Quantity</label>
                            <input type="number" name="materials[0][quantity]" min="0" step="0.01" required
                                   class="quantity-input w-full p-2 border border-gray-300 rounded-md">
                        </div>

                        {{-- Unit --}}
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Unit</label>
                            <select name="materials[0][unit]" required
                                    class="w-full p-2 border border-gray-300 rounded-md">
                                <option value="kg">Kg</option>
                                <option value="piece">Piece</option>
                            </select>
                        </div>

                        {{-- Price per Unit --}}
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Price</label>
                            <input type="number" name="materials[0][price]" min="0" step="0.01" required
                                   class="price-input w-full p-2 border border-gray-300 rounded-md">
                        </div>

                        {{-- Subtotal + Delete --}}
                        <div class="flex gap-2 items-center">
                            <input type="text" name="materials[0][subtotal]" readonly
                                   class="subtotal-input w-full p-2 border border-gray-300 rounded-md bg-gray-100"
                                   placeholder="Subtotal">
                            <button type="button" onclick="removeMaterialRow(this)"
                                    class="text-red-600 font-bold hover:text-red-800" title="Remove row">
                                🗑️
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" onclick="addMaterialRow()"
                        class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    + Add Material
                </button>
            </div>

            {{-- Total --}}
            <div class="mb-6 text-right">
                <label class="block text-gray-700 font-semibold mb-2">Total Amount</label>
                <input type="text" name="total_amount" id="total-amount" readonly
                       class="w-1/3 p-2 border border-gray-300 rounded-md bg-gray-100">
            </div>

            <div class="text-center">
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700">
                    Save Invoice
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

    {{-- Scripts --}}
    <script>
        let materialIndex = 1;

        function addMaterialRow() {
            const container = document.getElementById('materials-container');
            const newRow = document.createElement('div');
            newRow.classList.add('grid', 'grid-cols-6', 'gap-4', 'items-end', 'material-row', 'mt-2');

            newRow.innerHTML = `
                <div>
                    <select name="materials[${materialIndex}][material_id]" required
                            class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="">-- Select material --</option>
                        @foreach ($rawMaterials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <input type="number" name="materials[${materialIndex}][quantity]" min="0" step="0.01"
                           class="quantity-input w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <select name="materials[${materialIndex}][unit]" required
                            class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="kg">Kg</option>
                        <option value="piece">Piece</option>
                    </select>
                </div>
                <div>
                    <input type="number" name="materials[${materialIndex}][price]" min="0" step="0.01"
                           class="price-input w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div class="flex gap-2 items-center">
                    <input type="text" name="materials[${materialIndex}][subtotal]" readonly
                           class="subtotal-input w-full p-2 border border-gray-300 rounded-md bg-gray-100"
                           placeholder="Subtotal">
                    <button type="button" onclick="removeMaterialRow(this)"
                            class="text-red-600 font-bold hover:text-red-800" title="Remove row">🗑️</button>
                </div>
            `;

            container.appendChild(newRow);
            materialIndex++;
        }

        function removeMaterialRow(button) {
            const row = button.closest('.material-row');
            row.remove();
            updateTotal();
        }

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('quantity-input') || e.target.classList.contains('price-input')) {
                const row = e.target.closest('.material-row');
                const qty = parseFloat(row.querySelector('.quantity-input')?.value) || 0;
                const price = parseFloat(row.querySelector('.price-input')?.value) || 0;
                const subtotal = qty * price;
                row.querySelector('.subtotal-input').value = subtotal.toFixed(2);
                updateTotal();
            }
        });

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal-input').forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            document.getElementById('total-amount').value = total.toFixed(2);
        }
    </script>
</x-app-layout>
