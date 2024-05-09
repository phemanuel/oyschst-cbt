<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    //------Reset Password Route
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');
    Route::post('/forgot-password', [CustomForgotPasswordController::class, 'forgotPassword'])
        ->middleware('guest')
        ->name('password.email');
    Route::get('/reset-password/{token}/{email}', function ($token,$email) {
        return view('auth.user-reset-password', ['token' => $token , 'email' => $email]);
    })->middleware('guest')->name('password.reset');
    Route::post('/reset-password', [CustomForgotPasswordController::class, 'resetPassword'])
        ->middleware('guest')
        ->name('password.update');

    // Home route
    Route::get('/', [AuthController::class, 'home'])->name('home');
    // Login and signup routes
    Route::get('user-login', [AuthController::class, 'login'])->name('login');
    Route::post('user-login', [AuthController::class, 'loginAction'])->name('login.action');
    Route::post('user-locked', [AuthController::class, 'userLocked'])->name('user-locked');
    Route::get('admin', [AuthController::class, 'adminLogin'])->name('admin-login');
    Route::post('admin', [AuthController::class, 'adminLoginAction'])->name('admin-login.action');
    //-----Dashboard routes-----
    Route::get('user-dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(StudentAuth::class);    

    Route::get('signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('signup', [AuthController::class, 'signupAction'])->name('signup.action');
     

    //----Auth routes--

    Route::middleware('auth')->group(function () {
    
        // Logout route
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        //Admin Dashboard----
        Route::get('admin-dashboard', [DashboardController::class, 'indexAdmin'])
        ->name('admin-dashboard');   
        Route::get('admin-account-setting/{id}', [AuthController::class, 'profileUpdateAdmin'])
        ->name('admin-account-setting'); 
        //--exam setting
        Route::get('exam-setting', [DashboardController::class, 'examSetting'])
        ->name('exam-setting');
        Route::put('exam-setting', [DashboardController::class, 'examSettingAction'])
        ->name('exam-setting.action');
        Route::get('exam-type', [DashboardController::class, 'examType'])
        ->name('exam-type');
        Route::post('exam-type', [DashboardController::class, 'examTypeAction'])
        ->name('exam-type.action');
        //--student list
        Route::get('student', [DashboardController::class, 'student'])
        ->name('student');
        Route::get('student-import', [DashboardController::class, 'studentImport'])
        ->name('student-import');
        Route::get('student-create', [DashboardController::class, 'studentCreate'])
        ->name('student-create');
        Route::post('student-create', [DashboardController::class, 'studentCreateAction'])
        ->name('student-create.action');
        Route::get('student-edit/{id}', [DashboardController::class, 'studentEdit'])
        ->name('student-edit');
        Route::put('student-edit/{id}', [DashboardController::class, 'studentEditAction'])
        ->name('student-edit.action');
        Route::delete('student/{id}', [DashboardController::class, 'studentDelete'])
        ->name('student-delete.action');
        //--change course
        Route::get('change-course', [DashboardController::class, 'changeCourse'])
        ->name('change-course');
        Route::post('change-course-view', [DashboardController::class, 'changeCourseView'])
        ->name('change-course-view');
        Route::post('change-course/{id}', [DashboardController::class, 'changeCourseAction'])
        ->name('change-course.action');
        Route::get('add-course', [DashboardController::class, 'addCourse'])
        ->name('add-course');
        Route::post('add-course', [DashboardController::class, 'addCourseAction'])
        ->name('add-course.action');
        Route::post('add-course-college', [DashboardController::class, 'addCourseCollegeAction'])
        ->name('add-course-college.action');
        //--Add class/level--        
        Route::post('add-class', [DashboardController::class, 'addClassAction'])
        ->name('add-class.action');
        //--student login status
        Route::get('login-status', [DashboardController::class, 'loginStatus'])
        ->name('login-status');
        Route::post('login-status-view', [DashboardController::class, 'loginStatusView'])
        ->name('login-status-view');
        Route::post('login-status/{id}', [DashboardController::class, 'loginStatusAction'])
        ->name('login-status.action');
        //--college update
        Route::get('college-setup', [DashboardController::class, 'collegeSetup'])
        ->name('college-setup');
        Route::put('college-setup', [DashboardController::class, 'collegeSetupAction'])
        ->name('college-setup.action');
        //--exam upload
        Route::get('question-upload', [DashboardController::class, 'questionUpload'])
        ->name('question-upload');
        //--report
        Route::get('report', [DashboardController::class, 'report'])
        ->name('report');
        //--create users
        Route::get('users', [DashboardController::class, 'Users'])
        ->name('users'); 
        Route::get('add-user', [DashboardController::class, 'addUser'])
        ->name('add-user'); 
        Route::post('add-user', [DashboardController::class, 'addUserAction'])
        ->name('add-user.action'); 
        

        //--Send mail routes
        Route::get('send-mail-fail/{transaction_id}', [MailController::class, 'mailFailed'])
        ->name('send-mail-fail');
        Route::get('send-mail-success/{transaction_id}', [MailController::class, 'mailSuccess'])
        ->name('send-mail-success');
        //---User change password --------------------------------
        Route::get('change-password', [AuthController::class, 'changePassword'])
            ->name('change-password');  
    });

     
        //===========Verify email address routes================================
    Route::get('email-verify', [MailController::class, 'emailVerify'])
    ->name('email-verify');
    Route::get('email-verify-done/{token}', [MailController::class, 'emailVerifyDone'])
    ->name('email-verify-done');
    Route::post('resend-verification-email', [MailController::class, 'resendEmailVerification'])
    ->name('resend-verification-email');
    Route::post('resend-verification', [MailController::class, 'resendVerification'])
    ->name('resend-verification');
    Route::post('email-not-verify', [MailController::class, 'emailNotVerify'])
    ->name('email-not-verify');
    
    //----send mail route
    Route::get('send-mail', [MailController::class, 'index'])
    ->name('send-mail');

    Route::get('user-check', [DashboardController::class, 'userCheck'])
        ->name('user-check');

