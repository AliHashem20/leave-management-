<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveRequestController extends Controller
{

    // Display a listing of leave requests
    public function index()
    {
        $user = Auth::user();

        // If admin, show all requests; if employee, show their own requests
        if ($user->role === 'admin') {
            $leaveRequests = LeaveRequest::with('user')
                ->orderBy('created_at', 'asc')
                ->get();
            $statistics = [
                'Approved' => LeaveRequest::where('status', 'Approved')->count(),
                'Pending' => LeaveRequest::where('status', 'Pending')->count(),
                'Rejected' => LeaveRequest::where('status', 'Rejected')->count(),
            ];
        } else {
            $leaveRequests = LeaveRequest::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            $statistics = [
                'Approved' => LeaveRequest::where('user_id', $user->id)->where('status', 'Approved')->count(),
                'Pending' => LeaveRequest::where('user_id', $user->id)->where('status', 'Pending')->count(),
                'Rejected' => LeaveRequest::where('user_id', $user->id)->where('status', 'Rejected')->count(),
            ];
        }

        return view('leaveRequests.index', compact('leaveRequests', 'statistics'));
    }

    // Show the form for creating a new leave request
    public function create()
    {
        // If user is an admin, redirect to the leave request index
        if (Auth::user()->role === 'admin') {
            return redirect()->route('leaveRequests.index')->with('error', 'Admins cannot create leave requests.');
        }

        return view('leaveRequests.create');
    }

    // Store a newly created leave request in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
        ]);

        $leaveRequest = new LeaveRequest();
        $leaveRequest->user_id = Auth::id();
        $leaveRequest->start_date = $request->start_date;
        $leaveRequest->end_date = $request->end_date;
        $leaveRequest->reason = $request->reason;
        // $leaveRequest->status = 'pending'; // Default status

        $leaveRequest->save();

        return redirect()->route('leaveRequests.index')->with('success', 'Leave request created successfully.');
    }

    // Show the form for editing the specified leave request
    public function edit($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);

        if (Auth::user()->role === 'employee') {
            return redirect()->route('leaveRequests.index')->with('error', 'You can\'t edit leave requests.');
        }

        return view('leaveRequests.edit', compact('leaveRequest'));
    }

    // Update the specified leave request in storage
    public function update(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);

        // Only the owner can edit their own pending request
        if (Auth::user()->role === 'employee') {
            return redirect()->route('leaveRequests.index')->with('error', 'You can\'t edit leave requests.');
        }

        // Validation rules
        $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
            'status' => 'required|in:Pending,Approved,Rejected'
        ]);

        // Update fields
        $leaveRequest->start_date = $request->start_date;
        $leaveRequest->end_date = $request->end_date;
        $leaveRequest->reason = $request->reason;

        // Only admin can update the status
        if (Auth::user()->role === 'admin' && $request->has('status')) {
            $leaveRequest->status = $request->status;
        }

        $leaveRequest->save();

        return redirect()->route('leaveRequests.index')->with('success', 'Leave request updated successfully.');
    }

    // Remove the specified leave request from storage
    public function destroy($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);

        // Ensure only admin can delete
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('leaveRequests.index')->with('error', 'Only admins can delete leave requests.');
        }

        $leaveRequest->delete();

        return redirect()->route('leaveRequests.index')->with('success', 'Leave request deleted successfully.');
    }
}
