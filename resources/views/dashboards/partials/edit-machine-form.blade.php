<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-blue-900">Edit Machine Information</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-xl shadow max-w-2xl mx-auto mt-6">
        <form action="{{ route('manager.machine.update', $machine->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Machine Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-blue-900 mb-1">Machine Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $machine->name) }}"
                       required
                       class="w-full border border-blue-300 rounded-md shadow-sm focus:ring-blue-800 focus:border-blue-800 px-3 py-2">
            </div>

            <!-- Machine Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-blue-900 mb-1">Machine Status</label>
                <select name="status" id="status" required
                        class="w-full border border-blue-300 rounded-md shadow-sm focus:ring-blue-800 focus:border-blue-800 px-3 py-2">
                    <option value="active" {{ $machine->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $machine->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="under_maintenance" {{ $machine->status === 'under_maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                </select>
            </div>

            <!-- Last Maintenance Date -->
            <div>
                <label for="last_maintenance_date" class="block text-sm font-medium text-blue-900 mb-1">Last Maintenance Date</label>
                <input type="date" name="last_maintenance_date" id="last_maintenance_date"
                       value="{{ old('last_maintenance_date', $machine->last_maintenance_date ? \Carbon\Carbon::parse($machine->last_maintenance_date)->format('Y-m-d') : '') }}"
                       class="w-full border border-blue-300 rounded-md shadow-sm focus:ring-blue-800 focus:border-blue-800 px-3 py-2">
                <p class="text-xs text-blue-700 mt-1">Leave blank if no maintenance has been performed yet.</p>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                        class="bg-blue-900 text-white px-6 py-2 rounded-md hover:bg-blue-800 transition">
                    Update Machine
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
