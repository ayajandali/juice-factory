<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            إضافة منتج جديد
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
            <form action="{{ route('manager.machine.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700">اسم المنتج</label>
                    <input type="text" name="product_name" class="w-full border-gray-300 rounded mt-1" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">الوصف</label>
                    <textarea name="description" rows="3" class="w-full border-gray-300 rounded mt-1" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">تاريخ الإنتاج</label>
                    <input type="date" name="production_date" class="w-full border-gray-300 rounded mt-1" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">تاريخ الانتهاء</label>
                    <input type="date" name="expiry_date" class="w-full border-gray-300 rounded mt-1" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">الكمية</label>
                    <input type="number" name="quantity" class="w-full border-gray-300 rounded mt-1" required>
                </div>

                <!-- حقل الآلة -->
<div class="mb-4">
    <label for="machine_id" class="block font-medium text-sm text-gray-700">اختر الآلة</label>
    <select name="machine_id" id="machine_id" class="mt-1 block w-full border-gray-300 rounded-md">
        @foreach ($machines as $machine)
            <option value="{{ $machine->id }}">{{ $machine->name }}</option>
        @endforeach
    </select>
</div>

<!-- حقل الحجم -->
<div class="mb-4">
    <label for="size" class="block font-medium text-sm text-gray-700">الحجم</label>
    <select name="size" id="size" class="mt-1 block w-full border-gray-300 rounded-md">
        <option value="Small">صغير</option>
        <option value="Medium">متوسط</option>
        <option value="Large">كبير</option>
    </select>
</div>

                <div class="mb-4">
                    <label class="block text-gray-700">صورة المنتج</label>
                    <input type="file" name="image" class="w-full border-gray-300 rounded mt-1">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        حفظ المنتج
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>