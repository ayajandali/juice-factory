<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product Update</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('manager.product.update', $product->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <!-- اسم المنتج -->
                <div class="mb-4">
                    <label class="block text-gray-700">Product Name</label>
                    <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" class="w-full mt-1 border-gray-300 rounded">
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label class="block text-gray-700">Price</label>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}" class="w-full mt-1 border-gray-300 rounded">
                </div>

                <!-- الوصف -->
                <div class="mb-4">
                    <label class="block text-gray-700">Description</label>
                    <textarea name="description" class="w-full mt-1 border-gray-300 rounded">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- الآلة -->
                <div class="mb-4">
                    <label class="block text-gray-700">Machine</label>
                    <select name="machine_id" class="w-full mt-1 border-gray-300 rounded" required>
                        @foreach ($machines as $machine)
                            <option value="{{ $machine->id }}" {{ $machine->id == $product->machine_id ? 'selected' : '' }}>
                                {{ $machine->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- الحجم -->
                <div class="mb-4">
                    <label class="block text-gray-700">Size</label>
                    <select name="size" class="w-full mt-1 border-gray-300 rounded" required>
                        <option value="small" {{ $product->size == 'small' ? 'selected' : '' }}>small</option>
                        <option value="medium" {{ $product->size == 'medium' ? 'selected' : '' }}>medium</option>
                        <option value="large" {{ $product->size == 'large' ? 'selected' : '' }}>large</option>
                    </select>
                </div>

                <!-- صورة المنتج -->
                <div class="mb-4">
                    <label class="block text-gray-700">Product Image</label>
                    <input type="file" name="image" class="w-full mt-1">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="mt-2 h-20">
                    @endif
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Product</button>
            </form>

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
    </div>
</x-app-layout>