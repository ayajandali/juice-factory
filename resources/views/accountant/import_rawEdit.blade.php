<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Raw Materials Invoice
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('import.rawUpdate.invoice', $invoice->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium">Invoice Number</label>
                        <input type="text" name="invoice_number" class="w-full border rounded p-2"
                            value="{{ $invoice->invoice_number }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Date</label>
                        <input type="date" name="date" class="w-full border rounded p-2"
                            value="{{ $invoice->date }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Description</label>
                        <textarea name="description" class="w-full border rounded p-2">{{ $invoice->description }}</textarea>
                    </div>

                    <h3 class="font-semibold text-lg mb-4">Invoice Items</h3>

                    <div id="items-container">
                        @foreach($invoice->items as $index => $item)
                        <div class="border p-4 mb-4 rounded bg-gray-50 item-entry">
                            <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">

                            <div class="mb-2">
                                <label class="block font-medium">Raw Material</label>
                                <select name="items[{{ $index }}][raw_material_id]" class="w-full border rounded p-2" required>
                                    @foreach($rawMaterials as $material)
                                        <option value="{{ $material->id }}" {{ $material->id == $item->raw_material_id ? 'selected' : '' }}>
                                            {{ $material->name }} - {{ $material->type }} - {{ $material->size }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="block font-medium">Quantity</label>
                                    <input type="number" name="items[{{ $index }}][quantity]" class="w-full border rounded p-2"
                                        value="{{ $item->quantity }}" step="0.01" required>
                                </div>
                                <div>
                                    <label class="block font-medium">Unit</label>
                                    <input type="text" name="items[{{ $index }}][unit]" class="w-full border rounded p-2"
                                        value="{{ $item->unit }}" required>
                                </div>
                                <div>
                                    <label class="block font-medium">Price</label>
                                    <input type="number" name="items[{{ $index }}][price]" class="w-full border rounded p-2"
                                        value="{{ $item->price }}" step="0.01" required>
                                </div>
                            </div>

                            <button type="button" onclick="this.closest('.item-entry').remove()"
                                class="mt-3 bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">Remove</button>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <button type="button" onclick="addItem()"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            + Add New Item
                        </button>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        let itemCount = {{ count($invoice->items) }};
        const rawMaterials = @json($rawMaterials);

        function addItem() {
            const container = document.getElementById('items-container');

            const entry = document.createElement('div');
            entry.classList.add('border', 'p-4', 'mb-4', 'rounded', 'bg-gray-50', 'item-entry');

            let materialOptions = '<option value="">-- Choose Material --</option>';
            rawMaterials.forEach(material => {
                materialOptions += `<option value="${material.id}">${material.name} - ${material.type} - ${material.size}</option>`;
            });

            entry.innerHTML = `
                <div class="mb-2">
                    <label class="block font-medium">Raw Material</label>
                    <select name="items[new_${itemCount}][raw_material_id]" class="w-full border rounded p-2" required>
                        ${materialOptions}
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block font-medium">Quantity</label>
                        <input type="number" name="items[new_${itemCount}][quantity]" class="w-full border rounded p-2" step="0.01" required>
                    </div>
                    <div>
                        <label class="block font-medium">Unit</label>
                        <input type="text" name="items[new_${itemCount}][unit]" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-medium">Price</label>
                        <input type="number" name="items[new_${itemCount}][price]" class="w-full border rounded p-2" step="0.01" required>
                    </div>
                </div>
                <button type="button" onclick="this.closest('.item-entry').remove()"
                    class="mt-3 bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">Remove</button>
            `;

            container.appendChild(entry);
            itemCount++;
        }
    </script>
</x-app-layout>
