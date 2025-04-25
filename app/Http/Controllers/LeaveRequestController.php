<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
   
    // Display a listing of leave requests
    public function index()
    {
        $user = Auth::user();

        // If admin, show all requests; if employee, show their own requests
        if ($user->role === 'admin') {
            $leaveRequests = LeaveRequest::all();
        } else {
            $leaveRequests = LeaveRequest::where('user_id', $user->id)->get();
        }

        return view('leaveRequests.index', compact('leaveRequests'));
    }

    // Show the form for creating a new leave request
    public function create()
    {
        return view('leaveRequests.create');
    }

    // Store a newly created leave request in storage
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'required|string|max:255',
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
        
        // Ensure employee can only edit their own pending requests
        if (Auth::user()->role === 'employee' && $leaveRequest->user_id !== Auth::id()) {
            return redirect()->route('leaveRequests.index')->with('error', 'You can only edit your own leave requests.');
        }

        if ($leaveRequest->status !== 'pending' && Auth::user()->role === 'employee') {
            return redirect()->route('leaveRequests.index')->with('error', 'You can only edit pending leave requests.');
        }

        return view('leaveRequests.edit', compact('leaveRequest'));
    }

    // Update the specified leave request in storage
    public function update(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        
        // Ensure employee can only update their own pending requests
        if (Auth::user()->role === 'employee' && $leaveRequest->user_id !== Auth::id()) {
            return redirect()->route('leaveRequests.index')->with('error', 'You can only edit your own leave requests.');
        }

        if ($leaveRequest->status !== 'pending' && Auth::user()->role === 'employee') {
            return redirect()->route('leaveRequests.index')->with('error', 'You can only edit pending leave requests.');
        }

        $leaveRequest->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
        ]);

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