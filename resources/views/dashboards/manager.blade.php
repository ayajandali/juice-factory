{{-- resources/views/manager/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لوحة تحكم المدير
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- عدد الموظفين -->
            <div class="bg-blue-600 text-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-2">عدد الموظفين</h3>
                <p class="text-4xl font-bold mb-4">{{ $employees_count }}</p>
                <a href="{{ route('manager.employees.index') }}" class="inline-block bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">
                    عرض الموظفين
                </a>
            </div>

            <!-- عدد الآلات -->
            <div class="bg-green-600 text-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-2">عدد الآلات</h3>
                <p class="text-4xl font-bold mb-4">{{ $machine_count }}</p>
                <a href="{{ route('manager.machine.index') }}" class="inline-block bg-white text-green-600 px-4 py-2 rounded hover:bg-green-100">
                    عرض الآلات
                </a>
            </div>
        </div>

        <!-- زر عرض حالة الأعمال اليومية -->
        <div>
            <a href="{{ route('manager.dailyworkstatus.index') }}" class="inline-block border border-blue-500 text-blue-500 px-4 py-2 rounded hover:bg-blue-50">
                عرض جدول الأعمال اليومية
            </a>
        </div>
         <div>
            <a href="{{ route('manager.product.index') }}" class="inline-block border border-blue-500 text-blue-500 px-4 py-2 rounded hover:bg-blue-50">
                عرض كل المنتجات في المعمل 
            </a>
        </div>
    </div>
</x-app-layout>