<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Rejected Leave Requests</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">List of Rejected Requests</h3>

        @if($rejectedRequests->isEmpty())
            <p class="text-gray-500">No approved leave requests found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-left text-sm uppercase tracking-wider">
                            <th class="px-4 py-3 border-b">#</th>
                            <th class="px-4 py-3 border-b">Employee Name</th>
                            <th class="px-4 py-3 border-b">Start Date</th>
                            <th class="px-4 py-3 border-b">End Date</th>
                            <th class="px-4 py-3 border-b">Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rejectedRequests as $index => $request)
                            <tr class="hover:bg-gray-50 text-sm text-gray-800">
                                <td class="px-4 py-3 border-b">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 border-b">{{ $request->user->first_name }} {{ $request->user->last_name }}</td>
                                <td class="px-4 py-3 border-b">{{ $request->start_date }}</td>
                                <td class="px-4 py-3 border-b">{{ $request->end_date }}</td>
                                <td class="px-4 py-3 border-b">{{ $request->leave_type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
