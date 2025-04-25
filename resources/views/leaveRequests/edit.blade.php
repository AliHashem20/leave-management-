@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold mb-4">Edit Leave Request</h2>

        <form action="{{ route('leaveRequests.update', $leaveRequest->id) }}" method="POST" id="editLeaveForm">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="start_date" id="start_date"
                    class="form-control p-2 w-full @error('start_date') border-red-500 @enderror"
                    value="{{ old('start_date', $leaveRequest->start_date) }}" required>
                @error('start_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="end_date" id="end_date"
                    class="form-control p-2 w-full @error('end_date') border-red-500 @enderror"
                    value="{{ old('end_date', $leaveRequest->end_date) }}" required>
                @error('end_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                <textarea name="reason" id="reason" rows="4"
                    class="form-control p-2 w-full @error('reason') border-red-500 @enderror" required>{{ old('reason', $leaveRequest->reason) }}</textarea>
                @error('reason')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if (Auth::user()->role === 'admin')
                <div class="form-group mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="form-control p-2 w-full" required>
                        <option value="Pending" {{ $leaveRequest->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Approved" {{ $leaveRequest->status == 'Approved' ? 'selected' : '' }}>Approved
                        </option>
                        <option value="Rejected" {{ $leaveRequest->status == 'Rejected' ? 'selected' : '' }}>Rejected
                        </option>
                    </select>
                </div>
            @endif

            <button type="submit" class="btn bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-md">
                Update Leave Request
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            // Set minimum start date to tomorrow
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const formattedDate = tomorrow.toISOString().split('T')[0];
            startDateInput.setAttribute('min', formattedDate);

            // When start date changes, validate end date
            startDateInput.addEventListener('change', function() {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);

                if (endDate < startDate) {
                    endDateInput.value = startDateInput.value;
                }

                endDateInput.setAttribute('min', startDateInput.value);
            });
        });
    </script>
@endsection
