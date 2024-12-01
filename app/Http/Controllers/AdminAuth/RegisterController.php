<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show the admin registration form
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    // Handle the registration request
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = $this->create($request->all());

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.assignments.index');
    }

    // Validate the form inputs
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Create a new admin instance
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
