<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">All Employees</h2>

            @if(auth()->user()->role === 'HR')
                <a href="{{ route('hr.employees.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Add New Employee
                </a>
            @endif
        </div>
    </x-slot>

    <div class="p-6 bg-white rounded shadow overflow-x-auto">
        @if($employees->count() > 0)
            <table class="table-auto w-full border text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">First Name</th>
                        <th class="px-4 py-2">Last Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Salary</th>
                        <th class="px-4 py-2">Machine Name</th>
                        @if(auth()->user()->role === 'HR')
                            <th class="px-4 py-2">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach($employees as $employee)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $employee->first_name }}</td>
                            <td class="px-4 py-2">{{ $employee->last_name }}</td>
                            <td class="px-4 py-2">{{ $employee->email }}</td>
                            <td class="px-4 py-2">{{ $employee->role }}</td>
                            <td class="px-4 py-2">{{ $employee->salary }}</td>
                            <td class="px-4 py-2">{{ $employee->machine->name ?? 'Not Assigned' }}</td>

                            @if(auth()->user()->role === 'HR')
                                <td class="px-4 py-2 whitespace-nowrap space-x-2">
                                    <a href="{{ route('hr.employees.edit', $employee->id) }}" class="text-blue-600 hover:underline">Edit</a>

                                    <form action="{{ route('hr.employees.destroy', $employee->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $employees->links() }}
            </div>

        @else
            <p class="text-center text-gray-500">No employees found.</p>
        @endif
    </div>
</x-app-layout>
