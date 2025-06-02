

<script>
    const rawMaterials = @json($rawMaterials);
    const products = @json($products);
</script>


<form method="POST" action="{{ route('super-employee.store') }}">
    @csrf


    <!-- Raw Materials -->
    <div class="mb-4">
        <label>Raw Materials Used</label>
        <div id="raw-materials-section">
            <div class="flex gap-2 mb-2">
                <select name="raw_materials[0][id]" class="form-select">
                    @foreach ($rawMaterials as $material)
                        <option value="{{ $material->id }}">{{ $material->name }} ({{ $material->quantity }} {{ $material->unit }})</option>
                    @endforeach
                </select>
                <input type="number" name="raw_materials[0][quantity]" class="form-input" placeholder="Quantity used">
            </div>
        </div>
        <button type="button" onclick="addRawMaterial()">+ Add another</button>
    </div>

    <!-- Products Produced -->
    <div class="mb-4">
        <label>Products Produced</label>
        <div id="products-section">
            <div class="flex gap-2 mb-2">
                <select name="products[0][id]" class="form-select">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="products[0][quantity]" class="form-input" placeholder="Quantity produced">
            </div>
        </div>
        <button type="button" onclick="addProduct()">+ Add another</button>
    </div>

     <!-- Notes -->
    <div class="mb-4">
        <label for="notes">Notes</label>
        <textarea name="notes" id="notes" rows="3" class="form-input w-full"></textarea>
    </div>

    <!-- Submit -->
    <x-primary-button>Submit Status</x-primary-button>
</form>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif



<script>
let rawIndex = 1;
let productIndex = 1;

function addRawMaterial() {
    const section = document.getElementById('raw-materials-section');
    let options = '';
    rawMaterials.forEach(material => {
        options += `<option value="${material.id}">${material.name} (${material.quantity} ${material.unit})</option>`;
    });

    const newField = `
        <div class="flex gap-2 mb-2">
            <select name="raw_materials[${rawIndex}][id]" class="form-select">
                ${options}
            </select>
            <input type="number" name="raw_materials[${rawIndex}][quantity]" class="form-input" placeholder="Quantity used">
        </div>`;
    section.insertAdjacentHTML('beforeend', newField);
    rawIndex++;
}


function addProduct() {
    const section = document.getElementById('products-section');
    let options = '';
    products.forEach(product => {
        options += `<option value="${product.id}">${product.name}</option>`;
    });

    const newField = `
        <div class="flex gap-2 mb-2">
            <select name="products[${productIndex}][id]" class="form-select">
                ${options}
            </select>
            <input type="number" name="products[${productIndex}][quantity]" class="form-input" placeholder="Quantity produced">
        </div>`;
    section.insertAdjacentHTML('beforeend', newField);
    productIndex++;
}

</script>

