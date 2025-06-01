<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-blue-900">All Employees</h2>

            @if(auth()->user()->role === 'HR')
                <a href="{{ route('hr.employees.create') }}" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                    Add New Employee
                </a>
            @endif
        </div>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow-md overflow-x-auto">
        @if($employees->count() > 0)
            <table class="table-auto w-full border-collapse text-sm text-left">
                <thead class="bg-blue-100 text-blue-1000">
                    <tr>
                        <th class="px-4 py-2 border-b">First Name</th>
                        <th class="px-4 py-2 border-b">Last Name</th>
                        <th class="px-4 py-2 border-b">Email</th>
                        <th class="px-4 py-2 border-b">Role</th>
                        <th class="px-4 py-2 border-b">Salary</th>
                        <th class="px-4 py-2 border-b">Machine Name</th>
                        @if(auth()->user()->role === 'HR')
                            <th class="px-4 py-2 border-b">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-blue-900">
                    @foreach($employees as $employee)
                        <tr class="hover:bg-blue-50 border-b">
                            <td class="px-4 py-2">{{ $employee->first_name }}</td>
                            <td class="px-4 py-2">{{ $employee->last_name }}</td>
                            <td class="px-4 py-2">{{ $employee->email }}</td>
                            <td class="px-4 py-2">{{ $employee->role }}</td>
                            <td class="px-4 py-2">{{ $employee->salary }}</td>
                            <td class="px-4 py-2">{{ $employee->machine->name ?? 'Not Assigned' }}</td>

                            @if(auth()->user()->role === 'HR')
                                <td class="px-4 py-2 whitespace-nowrap space-x-3">
                                    <a href="{{ route('hr.employees.edit', $employee->id) }}"
                                       class="text-blue-700 hover:underline">Edit</a>

                                    <form action="{{ route('hr.employees.destroy', $employee->id) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this employee?');">
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
            <div class="mt-6">
                {{ $employees->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-center text-blue-700 mt-4">No employees found.</p>
        @endif
    </div>
</x-app-layout>
