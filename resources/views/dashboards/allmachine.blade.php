{{-- resources/views/manager/machines/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-blue-900">
            Machine List
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <!-- Add New Machine Button -->
        <div class="mb-6 text-right">
            <a href="{{ route('manager.machine.create') }}"
               class="inline-block bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition duration-200 shadow">
                + Add New Machine
            </a>
        </div>

        <!-- Machines Table -->
        <div class="overflow-x-auto rounded-xl shadow-lg bg-white">
            <table class="min-w-full divide-y divide-blue-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-900 uppercase">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-900 uppercase">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-900 uppercase">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-900 uppercase">Last Maintenance</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-900 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($machines as $machine)
                        <tr class="hover:bg-blue-50">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $machine->name }}</td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-sm">
                                @if($machine->status === 'active')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded">Active</span>
                                @elseif($machine->status === 'inactive')
                                    <span class="px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded">Inactive</span>
                                @elseif($machine->status === 'under_maintenance')
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded">Under Maintenance</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-gray-500 bg-gray-100 rounded">Unknown</span>
                                @endif
                            </td>

                            <!-- Last Maintenance Date -->
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $machine->last_maintenance_date ? \Carbon\Carbon::parse($machine->last_maintenance_date)->format('Y-m-d') : 'N/A' }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('manager.machine.edit', $machine->id) }}"
                                   class="inline-block bg-blue-700 text-white px-4 py-1.5 rounded-md hover:bg-blue-800 transition">
                                    Edit
                                </a>
                                <form action="{{ route('manager.machine.destroy', $machine->id) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this machine?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 text-white px-4 py-1.5 rounded-md hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-500 text-sm">
                                No machines found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
