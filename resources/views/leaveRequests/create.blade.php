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
@endsection
