<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">HR Dashboard</h2>
    </x-slot>

    <!-- القسم العلوي: الإحصائيات -->
    <div class="p-6 bg-white rounded-lg shadow space-y-6">
        <p class="text-lg font-medium text-gray-700">Welcome back, {{ Auth::user()->first_name }}!</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- إجمالي عدد الموظفين -->
            <div class="bg-blue-100 border-l-4 border-blue-500 p-5 rounded-lg shadow">
                <p class="text-sm text-blue-700">Employees count</p>
                <p class="text-3xl font-bold text-blue-900 mt-1">{{ $employees_count }}</p>
            </div>

            <!-- عدد الطلبات المعلقة -->
            <div class="bg-yellow-100 border-l-4 border-yellow-500 p-5 rounded-lg shadow">
                <p class="text-sm text-yellow-700">Pending leave requests</p>
                <p class="text-3xl font-bold text-yellow-900 mt-1">{{ $pending_leaves_count }}</p>
            </div>
        </div>
    </div>

    <!-- كارد الطلبات -->
    <div class="p-6 mt-6 bg-white rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Leave Requests</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- الطلبات المعلقة -->
            <a href="{{ route('hr.leaverequest.index') }}"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition duration-300 shadow">
                Show pending leave requests
            </a>

            <!-- الطلبات الموافق عليها -->
            <a href="{{ route('hr.leaverequest.approvedRequests') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition duration-300 shadow">
                Accepted requests
            </a>

            <!-- الطلبات المرفوضة -->
            <a href="{{ route('hr.leaverequest.rejectedRequests') }}"
               class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition duration-300 shadow">
                Rejected requests
            </a>
        </div>
    </div>

    <!-- كارد الموظفين -->
    <div class="p-6 mt-6 bg-white rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Employee Management</h3>
        <div class="flex flex-col md:flex-row justify-center gap-4">
            <!-- زر إضافة موظف -->
            <a href="{{ route('hr.employees.create') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition duration-300 shadow">
                Add new employee
            </a>

            <!-- زر عرض الموظفين -->
            <a href="{{ route('hr.employees.index') }}"
               class="bg-gray-700 hover:bg-gray-800 text-white font-semibold py-3 px-6 rounded-lg text-center transition duration-300 shadow">
                Show employees information
            </a>
        </div>
    </div>
</x-app-layout>
