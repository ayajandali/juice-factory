<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-blue-900">Add New Machine</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow-md max-w-xl mx-auto">
        <form action="{{ route('manager.machine.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Machine Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-blue-900">Machine Name</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full border border-blue-300 rounded-md shadow-sm focus:ring-blue-800 focus:border-blue-800">
            </div>

            <!-- Machine Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-blue-900">Machine Status</label>
                <select name="status" id="status" required
                        class="mt-1 block w-full border border-blue-300 rounded-md shadow-sm focus:ring-blue-800 focus:border-blue-800">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="under_maintenance">Under Maintenance</option>
                </select>
            </div>

            <!-- Last Maintenance Date -->
            <div>
                <label for="last_maintenance_date" class="block text-sm font-medium text-blue-900">Last Maintenance Date</label>
                <input type="date" name="last_maintenance_date" id="last_maintenance_date"
                       class="mt-1 block w-full border border-blue-300 rounded-md shadow-sm focus:ring-blue-800 focus:border-blue-800">
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                        class="bg-blue-900 text-white px-6 py-2 rounded hover:bg-blue-800 transition">
                    Add Machine
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
