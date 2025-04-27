<!-- Leave Request Form -->
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Request a Leave</h3>
    <form method="POST" action="{{ route('employee.leave-request') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Leave Type</label>
            <select name="leave_type" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                <option value="">-- Select Leave Type --</option>
                <option value="Sick leave">Sick Leave</option>
                <option value="Maternity leave">Maternity Leave</option>
                <option value="Paternity leave">Paternity Leave</option>
                <option value="Emergency leave">Emergency Leave</option>
                <option value="Marriage leave">Marriage Leave</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Start Date</label>
            <input type="date" name="start_date" class="form-input rounded-md shadow-sm mt-1 block w-full" required> 
        </div>

        <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">End Date</label>
            <input type="date" name="end_date" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Payment</label>
            <select name="is_paid" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                <option value="">-- Select if you want a paid leave--</option>
                <option value="paid">paid</option>
                <option value="not_paid">not paid</option>
            </select>
        </div>

        <x-primary-button>Submit Request</x-primary-button>

        @if (session('leave_success'))
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded">
            {{ session('leave_success') }}
        </div>
        @endif

        <!-- Display general errors in leave request form -->
        @if ($errors->has('start_date'))
        <div class="text-red-600 text-sm mt-1">{{ $errors->first('start_date') }}</div>
        @endif

        @if ($errors->has('end_date'))
        <div class="text-red-600 text-sm mt-1">{{ $errors->first('end_date') }}</div>
        @endif
    </form>
</div>

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4 text-right">
    <a href="{{ route('requests') }}" class="text-blue-500">Show All Requests</a>
</div>