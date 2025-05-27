<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            قائمة المنتجات
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('manager.product.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + إضافة منتج جديد
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">الاسم</th>
                        <th class="px-4 py-2">الوصف</th>
                        <th class="px-4 py-2">الكمية</th>
                        <th class="px-4 py-2">الحجم</th>
                        <th class="px-4 py-2">تاريخ الإنتاج</th>
                        <th class="px-4 py-2">تاريخ الانتهاء</th>
                        <th class="px-4 py-2">صورة</th>
                        <th class="px-4 py-2">التحكم</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-4 py-2">{{ $product->product_name }}</td>
                            <td class="px-4 py-2">{{ $product->description }}</td>
                            <td class="px-4 py-2">{{ $product->quantity }}</td>
                            <td class="px-4 py-2">{{ $product->size }}</td>
                            <td class="px-4 py-2">{{ $product->production_date }}</td>
                            <td class="px-4 py-2">{{ $product->expiry_date }}</td>
                            <td class="px-4 py-2">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" class="w-16 h-16 object-cover">
                                @else
                                    لا يوجد
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('manager.machine.edit', $product->id) }}" class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">تعديل</a>
                                <form action="{{ route('manager.product.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>