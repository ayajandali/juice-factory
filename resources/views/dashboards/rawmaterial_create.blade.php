<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Raw Material
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded p-6">
            <form action="{{ route('raw-materials.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring"
                        required>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="quantity" step="0.01"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring"
                        required>
                </div>

                <div class="mb-4">
                    <label for="unit" class="block text-gray-700">Unit</label>
                    <select name="unit" id="unit" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring" required>
                        <option value="kg">Kg</option>
                        <option value="piece">Piece</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('manager.rawmaterials.available') }}" class="bg-gray-400 text-white px-4 py-2 rounded mr-2 hover:bg-gray-500">Cancel</a>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
