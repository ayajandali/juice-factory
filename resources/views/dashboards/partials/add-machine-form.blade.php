<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">إضافة آلة جديدة</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <form action="{{ route('manager.machine.store') }}" method="POST">
            @csrf

            <!-- اسم الآلة -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">اسم الآلة</label>
                <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- حالة الآلة -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">حالة الآلة</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="active">شغالة</option>
                    <option value="inactive">معطلة</option>
                    <option value="under_maintenance">تحت الصيانة</option>
                </select>
            </div>

            <!-- آخر تاريخ تصليح -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">آخر تاريخ تصليح</label>
                <input type="date" name="last_maintenance_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <small class="text-gray-500">اتركه فارغًا إذا لم يتم التصليح من قبل</small>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">إضافة</button>
        </form>
    </div>
</x-app-layout>