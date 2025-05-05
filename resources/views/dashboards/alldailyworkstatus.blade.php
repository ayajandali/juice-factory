<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">جدول الأعمال اليومية</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        @if($dailyworkstatus->isEmpty())
            <p class="text-gray-600">لا توجد أعمال يومية لعرضها حالياً.</p>
        @else
            <table class="min-w-full table-auto border-collapse border border-gray-300 text-center">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">اسم الموظف</th>
                        <th class="border border-gray-300 px-4 py-2">التاريخ</th>
                        <th class="border border-gray-300 px-4 py-2">الوصف</th>
                        <th class="border border-gray-300 px-4 py-2">الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyworkstatus as $status)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $status->employee->first_name ?? 'غير معروف' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ \Carbon\Carbon::parse($status->date)->format('Y-m-d') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $status->notes }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $status->work_status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>