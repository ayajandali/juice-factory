{{-- resources/views/manager/machines/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            قائمة الآلات
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- زر إضافة آلة جديدة -->
        <div class="mb-4">
            <a href="{{ route('manager.machine.create') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                إضافة آلة جديدة
            </a>
        </div>

        <!-- جدول عرض الآلات -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">اسم الآلة</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">العمليات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($machines as $machine)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $machine->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 space-x-2 space-x-reverse">
                                <a href="{{ route('manager.machine.edit', $machine->id) }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    تعديل
                                </a>
                                <form action="{{ route('manager.machine.destroy', $machine->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذه الآلة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">لا توجد آلات حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>