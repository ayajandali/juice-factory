<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">جميع الموظفين</h2>

            @if(auth()->user()->role === 'HR')
                <a href="{{ route('hr.employees.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    إضافة موظف جديد
                </a>
            @endif
        </div>
    </x-slot>

    <div class="p-6 bg-white rounded shadow overflow-x-auto">
        @if($employees->count() > 0)
            <table class="table-auto w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">الاسم</th>
                        <th class="px-4 py-2">البريد الإلكتروني</th>
                        <th class="px-4 py-2">الدور</th>
                        @if(auth()->user()->role === 'HR')
                            <th class="px-4 py-2">الخيارات</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $employee->name }}</td>
                            <td class="px-4 py-2">{{ $employee->email }}</td>
                            <td class="px-4 py-2">{{ $employee->role }}</td>

                            @if(auth()->user()->role === 'HR')
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <a href="{{ route('hr.employees.edit', $employee->id) }}" class="text-blue-500 hover:underline">تعديل</a>
                                    |
                                    <form action="{{ route('hr.employees.destroy', $employee->id) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">حذف</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-gray-500">لا يوجد موظفين حالياً.</p>
        @endif
    </div>
</x-app-layout>