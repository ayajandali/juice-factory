<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">جميع الموظفين</h2>
            <a href="{{ route('hr.employees.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                إضافة موظف جديد
            </a>
        </div>
    </x-slot>

    <div class="p-6 bg-white rounded shadow overflow-x-auto">
        <table class="table-auto w-full border">
            <thead class="bg-gray-100">
                <tr>
                    @foreach(array_keys($employees->first()->makeHidden('password')->toArray()) as $key)
                        <th class="px-4 py-2">{{ $key }}</th>
                    @endforeach
                    <th class="px-4 py-2">الخيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr class="border-t">
                        @foreach($employee->makeHidden('password')->toArray() as $value)
                            <td class="px-4 py-2">{{ $value }}</td>
                        @endforeach
                        <td class="px-4 py-2">
                            <a href="{{ route('hr.employees.edit', $employee->id) }}" class="text-blue-500 hover:underline">تعديل</a>
                            |
                            <form action="{{ route('hr.employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>