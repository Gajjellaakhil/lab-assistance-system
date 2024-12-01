<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackQuestion;
use Illuminate\Http\Request;

class FeedbackQuestionController extends Controller
{
    public function index()
    {
        $questions = FeedbackQuestion::all();
        return view('admin.feedback-questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.feedback-questions.create');
    }

    public function store(Request $request)
    {
        $request->validate(['question_text' => 'required|string']);
        FeedbackQuestion::create($request->all());
        return redirect()->route('feedback-questions.index')->with('success', 'Feedback question added.');
    }

    public function edit(FeedbackQuestion $feedbackQuestion)
    {
        return view('admin.feedback-questions.edit', compact('feedbackQuestion'));
    }

    public function update(Request $request, FeedbackQuestion $feedbackQuestion)
    {
        $request->validate(['question_text' => 'required|string']);
        $feedbackQuestion->update($request->all());
        return redirect()->route('feedback-questions.index')->with('success', 'Feedback question updated.');
    }

    public function destroy(FeedbackQuestion $feedbackQuestion)
    {
        $feedbackQuestion->delete();
        return redirect()->route('feedback-questions.index')->with('success', 'Feedback question deleted.');
    }
}
