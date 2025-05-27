<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-olive-700 leading-tight">
            {{ __('Leave Requests') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-olive-800 mb-6 border-b pb-2">All Leave Requests</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-[#011491] text-white">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Leave Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Start Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">End Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Payment</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($leaveRequests as $leaveRequest)
                                <tr class="odd:bg-gray-50 even:bg-white hover:bg-gray-100 hover:shadow-md transition duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $leaveRequest->leave_type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $leaveRequest->start_date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $leaveRequest->end_date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                                            {{ $leaveRequest->is_paid === 'paid' ? 'Paid' : 'Not Paid' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $leaveRequest->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                                                   ($leaveRequest->status === 'refused' ? 'bg-red-100 text-red-800' : 
                                                   'bg-yellow-100 text-yellow-800') }}">
                                                {{ $leaveRequest->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No leave requests found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $leaveRequests->links() }}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
