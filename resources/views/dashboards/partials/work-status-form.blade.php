<script>
    const rawMaterials = @json($rawMaterials);
    const products = @json($products);
</script>

<form method="POST" action="{{ route('super-employee.store') }}" class="space-y-6 bg-white p-6 rounded-2xl shadow-md max-w-3xl mx-auto">
    @csrf

    <!-- Raw Materials Section -->
    <div>
        <h2 class="text-xl font-semibold text-blue-800 mb-2">Raw Materials Consumed:</h2>
        <div id="raw-materials-section" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-50 p-4 rounded-xl shadow-sm relative">
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Material</label>
                    <select name="raw_materials[0][id]" class="w-full p-2 border rounded-md">
                        @foreach ($rawMaterials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }} ({{ $material->quantity }} {{ $material->unit }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity Used</label>
                    <input type="number" name="raw_materials[0][quantity]" class="w-full p-2 border rounded-md" placeholder="Quantity used">
                </div>
            </div>
        </div>
        <button type="button" onclick="addRawMaterial()" class="mt-2 text-sm text-blue-700 hover:text-blue-900 hover:underline transition">+ Add another</button>
    </div>

    <!-- Products Produced Section -->
    <div>
        <h2 class="text-xl font-semibold text-blue-800 mb-2">Products Produced:</h2>
        <div id="products-section" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-blue-50 p-4 rounded-xl shadow-sm relative">
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                    <select name="products[0][id]" class="w-full p-2 border rounded-md">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }} {{ $product->size }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity Produced</label>
                    <input type="number" name="products[0][quantity]" class="w-full p-2 border rounded-md" placeholder="Quantity produced">
                </div>
                <div class="w-full">
                    <label for="expiry_date_0" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                    <input type="date" name="products[0][expiry_date]" id="expiry_date_0" class="w-full p-2 border rounded-md">
                </div>
            </div>
        </div>
        <button type="button" onclick="addProduct()" class="mt-2 text-sm text-blue-700 hover:text-blue-900 hover:underline transition">+ Add another</button>
    </div>

    <!-- Notes -->
    <div>
        <label for="notes" class="block text-lg font-medium text-gray-700 mb-1">Notes</label>
        <textarea name="notes" id="notes" rows="3" class="w-full p-2 border rounded-md"></textarea>
    </div>

    <!-- Submit Button -->
    <x-primary-button class="mt-4 bg-blue-500 hover:bg-blue-900 text-white">Submit Status</x-primary-button>

    <!-- Success / Error Messages -->
    @if (session('success'))
        <div class="mt-4 bg-green-100 text-green-800 p-3 rounded-md">
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
</form>

<script>
    let rawIndex = 1;
    let productIndex = 1;

    function addRawMaterial() {
        const section = document.getElementById('raw-materials-section');
        let options = '';
        rawMaterials.forEach(material => {
            options += `<option value="${material.id}">${material.name} (${material.quantity} ${material.unit})</option>`;
        });

        const newField = document.createElement('div');
        newField.className = "grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-50 p-4 rounded-xl shadow-sm relative";
        newField.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Material</label>
                <select name="raw_materials[${rawIndex}][id]" class="w-full p-2 border rounded-md">
                    ${options}
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity Used</label>
                <input type="number" name="raw_materials[${rawIndex}][quantity]" class="w-full p-2 border rounded-md" placeholder="Quantity used">
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 text-sm absolute top-2 right-2" title="Remove">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 3v1H4v2h16V4h-5V3H9zm3 4c.6 0 1 .4 1 1v11c0 .6-.4 1-1 1s-1-.4-1-1V8c0-.6.4-1 1-1zm-4 0c.6 0 1 .4 1 1v11c0 .6-.4 1-1 1s-1-.4-1-1V8c0-.6.4-1 1-1zm8 0c.6 0 1 .4 1 1v11c0 .6-.4 1-1 1s-1-.4-1-1V8c0-.6.4-1 1-1z"/></svg>
            </button>
        `;
        section.appendChild(newField);
        rawIndex++;
    }

    function addProduct() {
        const section = document.getElementById('products-section');
        let options = '';
        products.forEach(product => {
            options += `<option value="${product.id}">${product.product_name} ${product.size}</option>`;
        });

        const newField = document.createElement('div');
        newField.className = "grid grid-cols-1 md:grid-cols-3 gap-4 bg-blue-50 p-4 rounded-xl shadow-sm relative";
        newField.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                <select name="products[${productIndex}][id]" class="w-full p-2 border rounded-md">
                    ${options}
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity Produced</label>
                <input type="number" name="products[${productIndex}][quantity]" class="w-full p-2 border rounded-md" placeholder="Quantity produced">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                <input type="date" name="products[${productIndex}][expiry_date]" class="w-full p-2 border rounded-md">
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 text-sm absolute top-2 right-2" title="Remove">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 3v1H4v2h16V4h-5V3H9zm3 4c.6 0 1 .4 1 1v11c0 .6-.4 1-1 1s-1-.4-1-1V8c0-.6.4-1 1-1zm-4 0c.6 0 1 .4 1 1v11c0 .6-.4 1-1 1s-1-.4-1-1V8c0-.6.4-1 1-1zm8 0c.6 0 1 .4 1 1v11c0 .6-.4 1-1 1s-1-.4-1-1V8c0-.6.4-1 1-1z"/></svg>
            </button>
        `;
        section.appendChild(newField);
        productIndex++;
    }
</script>
