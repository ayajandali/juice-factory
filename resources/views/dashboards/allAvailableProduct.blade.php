<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Available Products
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Product Name</th>
                        <th class="px-4 py-2">Size</th>
                        <th class="px-4 py-2">Machine ID</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Production Date</th>
                        <th class="px-4 py-2">Expiry Date</th>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Actions</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($availableProducts as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->product->product_name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $item->product->size ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $item->product->machine_id ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $item->product->price }}</td>
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <td class="px-4 py-2">{{ $item->production_date }}</td>
                            <td class="px-4 py-2">{{ $item->expiry_date }}</td>
                            <td class="px-4 py-2">
                                    @if ($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <span class="text-gray-400 italic">No image</span>
                                    @endif
                             </td>


                            <td class="px-4 py-2">
                                <form action="{{ route('manager.available-products.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
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
