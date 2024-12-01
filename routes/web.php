<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LabRequestController;
use App\Http\Controllers\AdminAuth\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\RegisterController as AdminRegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\TeachingAssistantController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\FeedbackQuestionController;
use App\Http\Controllers\ModuleController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Student Authentication and Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Student Authentication Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Admin Authentication and Registration Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::get('/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [AdminRegisterController::class, 'register']);
});

// Admin-Specific Routes
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/lab-requests', [LabRequestController::class, 'adminIndex'])->name('admin.lab-requests.index');

    
   
    Route::post('/enroll-student', [AdminController::class, 'enrollStudent'])->name('admin.enroll.student');
    Route::get('/enroll-student', [AdminController::class, 'showEnrollStudentForm'])->name('admin.enroll.student.form');
   
    
   

    // Display the form (GET)
   Route::get('admin/add-staff', [AdminController::class, 'showAddStaffForm'])->name('admin.add.staff.form');

   // Process the form submission (POST)
   Route::post('admin/add-staff', [AdminController::class, 'addStaff'])->name('admin.add.staff');



    
});

// Lecturer-Specific Routes
Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer')->group(function () {
    Route::get('/labs', [LecturerController::class, 'manageLabs'])->name('lecturer.labs');
    Route::post('/enroll-student', [LecturerController::class, 'enrollStudent'])->name('lecturer.enroll.student');
    Route::get('/feedback', [LecturerController::class, 'viewFeedback'])->name('lecturer.feedback');
});

// Teaching Assistant-Specific Routes
Route::middleware(['auth', 'role:teaching_assistant'])->prefix('ta')->group(function () {
    Route::get('/requests', [TeachingAssistantController::class, 'viewRequests'])->name('ta.requests');
    Route::post('/sign-off', [TeachingAssistantController::class, 'signOffWork'])->name('ta.signoff');
});

// Student-Specific Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/requests', [StudentController::class, 'viewRequests'])->name('student.requests');
    Route::post('/request', [StudentController::class, 'makeRequest'])->name('student.makeRequest');
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

// Lab Request Routes
Route::prefix('lab-requests')->group(function () {
    Route::get('/', [LabRequestController::class, 'index'])->name('lab-requests.index');
    Route::get('/create', [LabRequestController::class, 'create'])->name('lab-requests.create');
    Route::post('/', [LabRequestController::class, 'store'])->name('lab-requests.store');

    // Admin Lab Request Management
    Route::middleware('auth:admin')->prefix('admin')->group(function () {
        Route::get('/lab-requests/admin', [LabRequestController::class, 'adminIndex'])->name('lab-requests.admin.index');
        Route::get('/{id}', [LabRequestController::class, 'show'])->name('lab-requests.show');
        Route::post('/{id}/complete', [LabRequestController::class, 'markAsComplete'])->name('lab-requests.admin.complete');
    });

// Feedback for Students
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});

// Feedback for Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('admin.feedback');
    Route::resource('/feedback-questions', FeedbackQuestionController::class)->except(['show']);
});

// Feedback for Lecturer
Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer')->group(function () {
    Route::get('/feedback', [FeedbackController::class, 'lecturerIndex'])->name('lecturer.feedback');
});

// Feedback for Teaching Assistant
Route::middleware(['auth', 'role:teaching_assistant'])->prefix('ta')->group(function () {
    Route::get('/feedback', [FeedbackController::class, 'taIndex'])->name('ta.feedback');
});


// module 
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/modules', [ModuleController::class, 'index'])->name('admin.modules');
    Route::get('/modules/create', [ModuleController::class, 'create'])->name('admin.modules.create');
    Route::post('/modules', [ModuleController::class, 'store'])->name('admin.modules.store');
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/modules', [AdminController::class, 'indexModules'])->name('admin.modules.index');
    Route::get('/admin/modules/create', [AdminController::class, 'createModule'])->name('admin.modules.create');
    Route::post('/admin/modules', [AdminController::class, 'storeModule'])->name('admin.modules.store');
    Route::get('/admin/modules/{id}/edit', [AdminController::class, 'editModule'])->name('admin.modules.edit');
    Route::put('/admin/modules/{id}', [AdminController::class, 'updateModule'])->name('admin.modules.update');
    Route::delete('/admin/modules/{id}', [AdminController::class, 'deleteModule'])->name('admin.modules.delete');
});





    
});

// Auth routes for Laravel Breeze or Fortify
require __DIR__.'/auth.php';
