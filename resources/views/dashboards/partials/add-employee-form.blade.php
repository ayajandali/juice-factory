<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">إضافة موظف جديد</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <form action="{{ route('hr.employees.store') }}" method="POST">
            @csrf

                   <!-- الاسم الأول -->
                   <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">الاسم الأول</label>
                <input type="text" name="first_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- الاسم الأخير -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">الاسم الأخير</label>
                <input type="text" name="last_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- البريد الإلكتروني -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- كلمة المرور -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- الدور -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">الدور</label>
                <select name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="HR">HR</option>
                    <option value="Manager">Manager</option>
                    <option value="Employee">Employee</option>
                    <option value="Accountant">Accountant</option>
                    <option value="super-employee">super Employee</option>
                </select>
            </div>

            <!-- رقم الهاتف -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">رقم الهاتف</label>
                <input type="text" name="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- تاريخ الميلاد -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">تاريخ الميلاد</label>
                <input type="date" name="birth_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- الراتب -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">الراتب</label>
                <input type="number" name="salary" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- العنوان -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">العنوان</label>
                <input type="text" name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- الجنس -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">الجنس</label>
                <select name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="male">ذكر</option>
                    <option value="female">أنثى</option>
                </select>
            </div>

            <!-- معرف الجهاز -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">معرف الجهاز</label>
                <input type="text" name="machine_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">إضافة</button>
        </form>
    </div>
</x-app-layout>