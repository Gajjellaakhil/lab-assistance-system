<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LabRequest;

class LabRequestController extends Controller
{
    // Display the form for creating a new lab request
    public function create()
    {
        return view('lab-requests.create');
    }

    // Display all lab requests for the user
    public function index()
    {
        // Retrieve all lab requests, ordered by the creation date
        $labRequests = LabRequest::orderBy('created_at', 'desc')->get();
        
        // Return the view and pass the lab requests
        return view('lab-requests.index', compact('labRequests'));
    }

    // Store a new lab request
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the screenshot if provided
        $screenshot = null;
        if ($request->hasFile('screenshot')) {
            $screenshot = $request->file('screenshot')->store('screenshots', 'public');
        }

        // Create the lab request
        LabRequest::create([
            'user_id' => auth()->id(),
            'description' => $request->description,
            'screenshot' => $screenshot,
        ]);

        return redirect()->route('lab-requests.index')->with('success', 'Lab request created successfully.');
    }

    // Display all uncompleted lab requests for the admin
    public function adminIndex()
    {
        // Retrieve all uncompleted lab requests
        $labRequests = LabRequest::where('completed', false)->orderBy('created_at', 'desc')->get();
        return view('lab-requests.admin-index', compact('labRequests'));
    }

    // Mark a lab request as complete
    public function markAsComplete($id)
    {
        $labRequest = LabRequest::findOrFail($id);
        $labRequest->completed = true; // Mark as completed
        $labRequest->save();

        return redirect()->route('lab-requests.admin.index')->with('success', 'Lab request marked as complete.');
    }

    // Display a specific lab request
    public function show($id)
    {
        $labRequest = LabRequest::findOrFail($id);
        return view('lab-requests.show', compact('labRequest'));
    }
}
