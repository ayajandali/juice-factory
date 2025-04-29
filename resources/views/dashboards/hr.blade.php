<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">لوحة تحكم الموارد البشرية</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <p>مرحباً {{ Auth::user()->first_name }}!</p>
        <p>عدد الموظفين: {{ $employees_count }}</p>
        <p>طلبات الإجازة المعلقة: {{ $pending_leaves_count }}</p>
    </div>

    <!-- رابط عرض جميع الموظفين -->
    <a href="{{ route('hr.employees.index') }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        عرض جميع الموظفين
    </a>

    <!-- رابط عرض طلبات الإجازة -->
    <a href="{{ route('hr.leaveRequest.index') }}" class="inline-block mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
        عرض طلبات الإجازة
    </a>
</x-app-layout>