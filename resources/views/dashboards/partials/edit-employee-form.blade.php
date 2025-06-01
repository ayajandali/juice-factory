<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Employee</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <form action="{{ route('hr.employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- First Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <!-- Last Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $employee->email) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                    @foreach (['HR', 'Manager', 'Employee', 'Accountant', 'super-employee'] as $role)
                        <option value="{{ $role }}" {{ old('role', $employee->role) === $role ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <!-- Birth Date -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Birth Date</label>
                <input type="date" name="birth_date"
                       value="{{ old('birth_date', \Carbon\Carbon::parse($employee->birth_date)->format('Y-m-d')) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <!-- Salary -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Salary</label>
                <input type="number" name="salary" value="{{ old('salary', $employee->salary) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" value="{{ old('address', $employee->address) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                    <option value="male" {{ old('gender', $employee->gender) === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $employee->gender) === 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <!-- Machine Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Machine</label>
                <select name="machine_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                    <option value="">-- None --</option>
                    @foreach ($machines as $machine)
                        <option value="{{ $machine->id }}"
                            {{ old('machine_id', $employee->machine_id) == $machine->id ? 'selected' : '' }}>
                            {{ $machine->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-6">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
