<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">تعديل المنتج</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('manager.product.update', $product->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <!-- اسم المنتج -->
                <div class="mb-4">
                    <label class="block text-gray-700">اسم المنتج</label>
                    <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" class="w-full mt-1 border-gray-300 rounded" required>
                </div>

                <!-- الوصف -->
                <div class="mb-4">
                    <label class="block text-gray-700">الوصف</label>
                    <textarea name="description" class="w-full mt-1 border-gray-300 rounded">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- تاريخ الإنتاج -->
                <div class="mb-4">
                    <label class="block text-gray-700">تاريخ الإنتاج</label>
                    <input type="date" name="production_date" value="{{ old('production_date', $product->production_date) }}" class="w-full mt-1 border-gray-300 rounded" required>
                </div>

                <!-- تاريخ الانتهاء -->
                <div class="mb-4">
                    <label class="block text-gray-700">تاريخ الانتهاء</label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', $product->expiry_date) }}" class="w-full mt-1 border-gray-300 rounded" required>
                </div>

                <!-- الكمية -->
                <div class="mb-4">
                    <label class="block text-gray-700">الكمية</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full mt-1 border-gray-300 rounded" required>
                </div>

                <!-- الآلة -->
                <div class="mb-4">
                    <label class="block text-gray-700">اختر الآلة</label>
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
                    <label class="block text-gray-700">الحجم</label>
                    <select name="size" class="w-full mt-1 border-gray-300 rounded" required>
                        <option value="Small" {{ $product->size == 'Small' ? 'selected' : '' }}>صغير</option>
                        <option value="Medium" {{ $product->size == 'Medium' ? 'selected' : '' }}>متوسط</option>
                        <option value="Large" {{ $product->size == 'Large' ? 'selected' : '' }}>كبير</option>
                    </select>
                </div>

                <!-- صورة المنتج -->
                <div class="mb-4">
                    <label class="block text-gray-700">صورة المنتج (اختياري)</label>
                    <input type="file" name="image" class="w-full mt-1">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" class="mt-2 h-20">
                    @endif
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">تحديث المنتج</button>
            </form>
        </div>
    </div>
</x-app-layout>