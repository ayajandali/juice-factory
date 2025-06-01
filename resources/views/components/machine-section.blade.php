@props(['title', 'machines'])

<div class="mb-12">
    <h3 class="text-xl font-semibold text-blue-800 mb-4">{{ $title }}</h3>

    <div class="overflow-x-auto rounded-xl shadow-lg bg-white">
        <table class="min-w-full divide-y divide-blue-200">
            <thead class="bg-blue-50">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-blue-900 uppercase">#</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-blue-900 uppercase">Name</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-blue-900 uppercase">Last Maintenance</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-blue-900 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($machines as $machine)
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $machine->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $machine->last_maintenance_date ? \Carbon\Carbon::parse($machine->last_maintenance_date)->format('Y-m-d') : 'N/A' }}
                        </td>
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
                        <td colspan="4" class="px-6 py-6 text-center text-gray-500 text-sm">
                            No machines found in this category.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
