<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Module;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
 // Method for rendering feedback form
 public function create()
 {
     $modules = Module::all(); // Retrieve all modules
     return view('feedback.create', compact('modules'));
 }
 

 // Method for storing feedback
 public function store(Request $request)
 {
     $request->validate([
         'module_id' => 'required|exists:modules,id',
         'content' => 'required|string',
     ]);

     Feedback::create([
         'user_id' => auth()->id(),
         'module_id' => $request->module_id,
         'content' => $request->content,
     ]);

     return redirect()->route('dashboard')->with('success', 'Feedback submitted successfully.');
 }

    // Show all feedback for Admin
    public function index()
    {
        $feedbacks = Feedback::with('user', 'module')->get();
        return view('admin.feedback.index', compact('feedbacks'));
    }

    // Show feedback for Lecturer
    public function lecturerIndex()
    {
        $feedbacks = Feedback::whereHas('module', function ($query) {
            $query->where('lecturer_id', auth()->id());
        })->get();

        return view('lecturer.feedback.index', compact('feedbacks'));
    }

    // Show feedback for Teaching Assistant
    public function taIndex()
    {
        $feedbacks = Feedback::whereHas('module', function ($query) {
            $query->whereHas('teachingAssistants', function ($q) {
                $q->where('user_id', auth()->id());
            });
        })->get();

        return view('ta.feedback.index', compact('feedbacks'));
    }
}
