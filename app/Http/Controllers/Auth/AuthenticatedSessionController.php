<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login'); // Student login form
    }

    public function store(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in with the 'web' guard
        if (Auth::guard('web')->attempt($credentials)) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            // Redirect to student dashboard or any desired route
            return redirect()->intended('dashboard');
        }

        // If login attempt fails, return error
        throw ValidationException::withMessages([
            'email' => __('auth.failed'), // Default message: "These credentials do not match our records."
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();  // Log the user out

        $request->session()->invalidate();  // Invalidate the session

        $request->session()->regenerateToken();  // Regenerate the CSRF token


        return redirect('/'); // Redirect to login after logout
    }
}
