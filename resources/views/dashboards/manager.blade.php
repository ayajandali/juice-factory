<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Manager Dashboard</h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">

            {{-- Employees Card --}}
            <div class="bg-white border border-blue-200 rounded-2xl shadow p-6 hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-blue-700 mb-1">Employees</h3>
                <p class="text-3xl font-bold text-blue-900 mb-4">{{ $employees_count }}</p>
                <div class="space-y-2">
                    <a href="{{ route('manager.employees.index') }}"
                       class="inline-block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                        Show All Employees
                    </a>
                </div>
            </div>

            {{-- Machines Card --}}
            <div class="bg-white border border-green-200 rounded-2xl shadow p-6 hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-green-700 mb-1">Machines</h3>
                <p class="text-3xl font-bold text-green-900 mb-4">{{ $machine_count }}</p>
                <div class="space-y-2">
                    <a href="{{ route('manager.machine.create') }}"
                       class="inline-block w-full text-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                        Add Machine
                    </a>
                    <a href="{{ route('manager.machine.index') }}"
                       class="inline-block w-full text-center bg-green-100 text-green-800 py-2 rounded-lg hover:bg-green-200 transition">
                        Show All
                    </a>
                    
                </div>
            </div>

            {{-- Products Card --}}
            <div class="bg-white border border-yellow-200 rounded-2xl shadow p-6 hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-yellow-700 mb-1">Products and Materials</h3>
                <p class="text-3xl font-bold text-yellow-900 mb-4">{{ $product_count ?? '--' }}</p>
                <div class="space-y-2">
                    <a href="{{ route('manager.product.create') }}"
                       class="inline-block w-full text-center bg-yellow-600 text-white py-2 rounded-lg hover:bg-yellow-700 transition">
                        Add New Product 
                    </a>
                    
                    <a href="{{ route('manager.product.index') }}"
                       class="inline-block w-full text-center bg-yellow-100 text-yellow-800 py-2 rounded-lg hover:bg-yellow-200 transition">
                        Show All Products
                    </a>
                    <a href="{{ route('manager.product.available') }}"
                       class="inline-block w-full text-center bg-yellow-100 text-yellow-800 py-2 rounded-lg hover:bg-yellow-200 transition">
                        Available Products
                    </a>
                    <a href="{{ route('manager.rawmaterials.available') }}"
                       class="inline-block w-full text-center bg-yellow-100 text-yellow-800 py-2 rounded-lg hover:bg-yellow-200 transition">
                        Raw Materials
                    </a>
                </div>
            </div>

            {{-- Daily Work Checkup Card --}}
            <div class="bg-white border border-purple-200 rounded-2xl shadow p-6 hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-purple-700 mb-1">Daily Work Checkup</h3>
                <p class="text-3xl font-bold text-purple-900 mb-4">Status</p>
                <a href="{{ route('manager.dailyworkstatus.index') }}"
                   class="inline-block w-full text-center bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">
                    View Daily Work Status
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
