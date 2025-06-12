<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products List
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- زر إضافة منتج جديد -->
        <div class="mb-4 flex justify-end">
            <a href="{{ route('manager.product.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + Add new product
            </a>
        </div>

        <!-- جدول المنتجات -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">Product Name</th>
                        <th class="px-4 py-2 text-left">Price</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Size</th>
                        <th class="px-4 py-2 text-left">Machine Name</th>
                        <th class="px-4 py-2 text-left">Image</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-4 py-2">{{ $product->product_name }}</td>
                            <td class="px-4 py-2">{{ $product->price }}</td>
                            <td class="px-4 py-2">{{ $product->description }}</td>
                            <td class="px-4 py-2">{{ $product->size }}</td>
                            <td class="px-4 py-2">{{ $product->machine->name }}</td>
                            <td class="px-4 py-2">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                                @else
                                    <span class="text-gray-400 italic">No image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('manager.product.edit', $product->id) }}" class="bg-blue-400 px-3 py-1 rounded text-white hover:bg-blue-500">
                                    Edit
                                </a>
                                <form action="{{ route('manager.product.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
