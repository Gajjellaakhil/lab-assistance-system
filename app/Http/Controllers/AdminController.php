<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Module;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\Role;

class AdminController extends Controller
{
    // Show the Admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

   

    // Show the form to enroll a student
    public function showEnrollStudentForm()
    {
        return view('admin.enroll-student');
    }

    // Enroll a student in the system
    public function enrollStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student',
        ]);

        return redirect()->route('admin.enroll.student.form')->with('success', 'Student enrolled successfully.');
    }

    // Show the form to add staff (Lecturer or Teaching Assistant)
    public function showAddStaffForm()
    {
        return view('admin.add-staff');
    }

    // Add staff to the system
    public function addStaff(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:lecturer,teaching_assistant',
    ]);

    // Create the user and save the role in the 'role' column
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role, // Dynamically set role
    ]);

    // Find the role in the roles table and attach it to the user
    $role = Role::where('name', $request->role)->first();
    if ($role) {
        $user->roles()->attach($role->id); // Attach role to the pivot table
    }

    return redirect()->route('admin.add.staff.form')->with('success', 'Staff added successfully.');



    
}
}