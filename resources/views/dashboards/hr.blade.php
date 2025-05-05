<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">لوحة تحكم الموارد البشرية</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <p>مرحباً {{ Auth::user()->first_name }}!</p>
        <p>عدد الموظفين: {{ $employees_count }}</p>
        <p>طلبات الإجازة المعلقة: {{ $pending_leaves_count }}</p>
    </div>
        
        <a href="{{ route('hr.employees.index') }}" 
   class="inline-block mt-4 bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
    عرض جميع الموظفين
</a>

<!-- رابط عرض طلبات الإجازة -->
<a href="{{ route('hr.leaverequest.index') }}" 
   class="inline-block mt-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
    عرض طلبات الإجازة
</a>
</x-app-layout>