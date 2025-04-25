@extends('layouts.app')

@section('content')
    <h2>Leave Requests</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                @if(Auth::user()->role === 'admin')
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($leaveRequests as $request)
                <tr>
                    <td>{{ $request->start_date }}</td>
                    <td>{{ $request->end_date }}</td>
                    <td>{{ $request->reason }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    @if(Auth::user()->role === 'admin')
                        <td>
                            <a href="{{ route('leaveRequests.edit', $request->id) }}" class="btn btn-warning btn-sm">Edit</a> |
                            <form action="{{ route('leaveRequests.destroy', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $leaveRequests->links() }}

    <a href="{{ route('leaveRequests.create') }}" class="btn btn-primary">Request New Leave</a>
@endsection
