<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Pending Leave Requests</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">List of Pending Requests</h3>

        @if($pendingRequests->isEmpty())
            <p class="text-gray-500">No pending leave requests at the moment.</p>
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
                            <th class="px-4 py-3 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingRequests as $index => $request)
                            <tr class="hover:bg-gray-50 text-sm text-gray-800">
                                <td class="px-4 py-3 border-b">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 border-b">{{ $request->user->first_name }} {{ $request->user->last_name }}</td>
                                <td class="px-4 py-3 border-b">{{ $request->start_date }}</td>
                                <td class="px-4 py-3 border-b">{{ $request->end_date }}</td>
                                <td class="px-4 py-3 border-b">{{ $request->leave_type }}</td>
                                <td class="px-4 py-3 border-b space-x-2">
                                    <!-- Approve -->
                                    <form action="{{ route('hr.leaverequest.approve', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">Approve</button>
                                    </form>

                                    <!-- Reject -->
                                    <form action="{{ route('hr.leaverequest.reject', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
