<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">تعديل معلومات الآلة</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <form action="{{ route('manager.machine.update', $machine->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- اسم الآلة -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">اسم الآلة</label>
                <input type="text" name="name" value="{{ old('name', $machine->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- حالة الآلة -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">حالة الآلة</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="active" {{ $machine->status === 'active' ? 'selected' : '' }}>فعالة</option>
                    <option value="inactive" {{ $machine->status === 'inactive' ? 'selected' : '' }}>غير فعالة</option>
                    <option value="maintenance" {{ $machine->status === 'maintenance' ? 'selected' : '' }}>تحت الصيانة</option>
                </select>
            </div>

            <!-- آخر تاريخ صيانة -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">آخر تاريخ صيانة</label>
                <input type="date" name="last_maintenance_date" value="{{ old('last_maintenance_date', $machine->last_maintenance_date ? $machine->last_maintenance_date->format('Y-m-d') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">تحديث</button>
        </form>
    </div>
</x-app-layout>