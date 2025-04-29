<table class="min-w-full border rounded">
    <thead>
        <tr class="bg-gray-100 text-right">
            <th class="px-4 py-2">الموظف</th>
            <th class="px-4 py-2">من</th>
            <th class="px-4 py-2">إلى</th>
            <th class="px-4 py-2">الحالة</th>
            @if ($requests->first()?->status === 'pending')
                <th class="px-4 py-2">إجراء</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @forelse ($requests as $request)
        <tr class="border-t text-right">
            <td class="px-4 py-2">{{ $request->user->first_name }} {{ $request->user->last_name }}</td>
            <td class="px-4 py-2">{{ $request->start_date }}</td>
            <td class="px-4 py-2">{{ $request->end_date }}</td>
            <td class="px-4 py-2">{{ $request->status }}</td>

            @if ($request->status === 'pending')
                <td class="px-4 py-2 space-x-2">
                    <form action="{{ route('hr.leave_requests.approve', $request->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">قبول</button>
                    </form>
                    <form action="{{ route('hr.leave_requests.reject', $request->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded-lg shadow-md border border-red-700"> رفض</button>
                    </form>
                </td>
            @endif
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center p-4 text-gray-500">لا يوجد طلبات.</td>
        </tr>
    @endforelse
</tbody>
</table>