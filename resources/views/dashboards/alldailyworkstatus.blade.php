<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-blue-900">Daily Work Schedule</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow-md">
        @if($dailyworkstatus->isEmpty())
            <p class="text-gray-600">No daily work records available at the moment.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-blue-300 text-center rounded-lg overflow-hidden">
                    <thead class="bg-blue-50 text-blue-900">
                        <tr>
                            <th class="border border-blue-300 px-4 py-2 text-sm font-semibold">Employee Name</th>
                            <th class="border border-blue-300 px-4 py-2 text-sm font-semibold">Date</th>
                            <th class="border border-blue-300 px-4 py-2 text-sm font-semibold">Description</th>
                            <th class="border border-blue-300 px-4 py-2 text-sm font-semibold">Actions</th> 

                        </tr>
                    </thead>
                    <tbody class="text-blue-800">
                        @foreach($dailyworkstatus as $status)
                            <tr class="hover:bg-blue-50">
                                <td class="border border-blue-300 px-4 py-2 text-sm">
                                    {{ $status->user->first_name  }} {{$status->user->last_name}}
                                </td>
                                <td class="border border-blue-300 px-4 py-2 text-sm">
                                    {{ \Carbon\Carbon::parse($status->date)->format('Y-m-d') }}
                                </td>
                                <td class="border border-blue-300 px-4 py-2 text-sm">
                                    {{ $status->notes }}
                                </td>

                                <td class="border border-blue-300 px-4 py-2 text-sm">
                                    <a href="{{ route('dailyworkstatus.show', $status->id) }}" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                        Show
                                    </a>
                                </td>

                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
