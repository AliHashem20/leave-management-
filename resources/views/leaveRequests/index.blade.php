@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold mb-4">Leave Requests</h2>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold">{{ $statistics['Approved'] }}</div>
                    <div class="text-sm">Approved Requests</div>
                </div>
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold">{{ $statistics['Pending'] }}</div>
                    <div class="text-sm">Pending Requests</div>
                </div>
                <div class="bg-red-100 text-red-800 p-4 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold">{{ $statistics['Rejected'] }}</div>
                    <div class="text-sm">Rejected Requests</div>
                </div>
            </div>

            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        @if (Auth::user()->role === 'admin')
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Employee</th>
                        @endif
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Start Date</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">End Date</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Reason</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                        @if (Auth::user()->role === 'admin')
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaveRequests as $request)
                        <tr class="border-t hover:bg-gray-50">
                            @if (Auth::user()->role === 'admin')
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $request->user->name ?? 'N/A' }}</td>
                            @endif
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $request->start_date }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $request->end_date }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $request->reason }}</td>
                            <td class="px-4 py-2 text-sm">
                                <span
                                    class="
                                    {{ $request->status == 'Approved'
                                        ? 'bg-green-500 text-white'
                                        : ($request->status == 'Pending'
                                            ? 'bg-yellow-500 text-white'
                                            : 'bg-red-500 text-white') }} 
                                    px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            @if (Auth::user()->role === 'admin')
                                <td class="px-4 py-2 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('leaveRequests.edit', $request->id) }}"
                                            class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-xs">
                                            Edit
                                        </a>
                                        <form action="{{ route('leaveRequests.destroy', $request->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-xs">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- New Leave Request Button -->
        @if (Auth::user()->role === 'employee')
            <div class="mt-6 text-right">
                <a href="{{ route('leaveRequests.create') }}"
                    class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-md text-sm">
                    Request New Leave
                </a>
            </div>
        @endif
    </div>
@endsection
