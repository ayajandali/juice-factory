<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">طلبات الإجازة</h2>
    </x-slot>

    <div class="p-6 space-y-8 bg-white rounded shadow">

        <!-- المعلقة -->
        <div>
            <h3 class="text-lg font-bold mb-2 text-yellow-600">الطلبات المعلقة</h3>
            <x-table :requests="$pendingRequests" />
        </div>

        <!-- المقبولة -->
        <div>
            <h3 class="text-lg font-bold mb-2 text-green-600">الطلبات المقبولة</h3>
            <x-table :requests="$approvedRequests" />
        </div>

        <!-- المرفوضة -->
        <div>
            <h3 class="text-lg font-bold mb-2 text-red-600">الطلبات المرفوضة</h3>
            <x-table :requests="$rejectedRequests" />
        </div>

    </div>
</x-app-layout>