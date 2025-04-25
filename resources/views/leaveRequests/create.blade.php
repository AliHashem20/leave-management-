@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold mb-4">Request New Leave</h2>

        <form action="{{ route('leaveRequests.store') }}" method="POST" id="leaveRequestForm">
            @csrf

            <div class="form-group mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control p-2 w-full" required>
            </div>

            <div class="form-group mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control p-2 w-full" required>
            </div>

            <div class="form-group mb-4">
                <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                <textarea name="reason" id="reason" class="form-control p-2 w-full" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-md">Submit Leave
                Request</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            // Set the minimum start date to tomorrow
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1); // Tomorrow
            const formattedDate = tomorrow.toISOString().split('T')[0];
            startDateInput.setAttribute('min', formattedDate);

            // When start date changes, update end date validation
            startDateInput.addEventListener('change', function() {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);

                // If end date is less than start date, set it to start date
                if (endDate < startDate) {
                    endDateInput.value = startDateInput.value;
                }

                // Also ensure the end date is not before the start date
                endDateInput.setAttribute('min', startDateInput.value);
            });
        });
    </script>
@endsection
