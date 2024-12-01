<?php


namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\LabRequest; // Ensure LabRequest model is imported
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Handle admin login
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login with the 'admin' guard
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed, regenerate session to prevent fixation
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        // Login failed, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle admin logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // Invalidate session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // View lab requests (example method for admin to review requests)
    public function index()
    {
        // Retrieve lab requests
        $labRequests = LabRequest::orderBy('created_at', 'desc')->get();
        return view('lab-requests.index', compact('labRequests'));
    }
}


