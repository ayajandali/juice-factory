<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-blue-900">Machine List</h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">

        <!-- Add New Machine Button -->
        <div class="mb-6 text-right">
            <a href="{{ route('manager.machine.create') }}"
               class="inline-block bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition duration-200 shadow">
                + Add New Machine
            </a>
        </div>

        {{-- ===== Section: Active Machines ===== --}}
        <x-machine-section title="Active Machines" :machines="$activeMachines" />

        {{-- ===== Section: Inactive Machines ===== --}}
        <x-machine-section title="Inactive Machines" :machines="$inactiveMachines" />

        {{-- ===== Section: Machines Under Maintenance ===== --}}
        <x-machine-section title="Under Maintenance" :machines="$underMaintenanceMachines" />

    </div>
</x-app-layout>
