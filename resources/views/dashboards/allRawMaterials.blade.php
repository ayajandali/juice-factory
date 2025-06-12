<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Raw Materials List
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4 flex justify-end">
            <a href="{{ route('raw-materials.create') }}"
               class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                + Add Raw Material
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Quantity</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Unit</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($rawMaterials as $material)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $material->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $material->quantity }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $material->unit }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800 space-x-2">
                               
                                <form action="{{ route('manager.rawMaterial.destroy', $material->id) }}"
                                      method="POST" class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this material?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($rawMaterials->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">No raw materials found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
