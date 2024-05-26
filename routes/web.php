<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExamController;
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
    // Route::get('/forgot-password', function () {
    //     return view('auth.forgot-password');
    // })->middleware('guest')->name('password.request');
    // Route::post('/forgot-password', [CustomForgotPasswordController::class, 'forgotPassword'])
    //     ->middleware('guest')
    //     ->name('password.email');
    // Route::get('/reset-password/{token}/{email}', function ($token,$email) {
    //     return view('auth.user-reset-password', ['token' => $token , 'email' => $email]);
    // })->middleware('guest')->name('password.reset');
    // Route::post('/reset-password', [CustomForgotPasswordController::class, 'resetPassword'])
    //     ->middleware('guest')
    //     ->name('password.update');

    // Home route
    Route::get('/', [AuthController::class, 'login'])->name('home');
    // Login and signup routes
    Route::get('user-login', [AuthController::class, 'login'])->name('login');
    Route::post('user-login', [AuthController::class, 'loginAction'])->name('login.action');
    Route::post('user-locked', [AuthController::class, 'userLocked'])->name('user-locked');
    Route::get('admin', [AuthController::class, 'adminLogin'])->name('admin-login');
    Route::post('admin', [AuthController::class, 'adminLoginAction'])->name('admin-login.action');

    //--Student routes
    Route::group(['middleware' => ['student.auth']], function () {
       //-----Dashboard routes-----
    Route::get('user-dashboard/{admission_no}', [DashboardController::class, 'index'])
    ->name('dashboard');
    // ->middleware(StudentAuth::class);  
    //----Computer Based Test--------
    Route::post('cbt/{id}', [ExamController::class, 'cbtCheck'])
    ->name('cbt-check');
    Route::get('cbt-process/{id}', [ExamController::class, 'cbtProcess'])
    ->name('cbt-process');   
    Route::get('cbt-page/{id}', [ExamController::class, 'cbtPage'])
    ->name('cbt-page');  
    Route::get('cbt/{id}/page1', [ExamController::class, 'cbtPage1'])
    ->name('cbt-page1');
    Route::get('cbt/{id}/page2', [ExamController::class, 'cbtPage2'])
    ->name('cbt-page2');
    Route::get('cbt/{id}/page3', [ExamController::class, 'cbtPage3'])
    ->name('cbt-page3');
    Route::get('cbt/{id}/page4', [ExamController::class, 'cbtPage4'])
    ->name('cbt-page4');
    Route::get('cbt/{id}/page5', [ExamController::class, 'cbtPage5'])
    ->name('cbt-page5');
    Route::get('cbt/{id}/page6', [ExamController::class, 'cbtPage6'])
    ->name('cbt-page6');
    Route::get('cbt/{id}/page7', [ExamController::class, 'cbtPage7'])
    ->name('cbt-page7');
    Route::get('cbt/{id}/page8', [ExamController::class, 'cbtPage8'])
    ->name('cbt-page8');
    Route::get('cbt/{id}/page9', [ExamController::class, 'cbtPage9'])
    ->name('cbt-page9');
    Route::get('cbt/{id}/page10', [ExamController::class, 'cbtPage10'])
    ->name('cbt-page10');
    Route::get('cbt/{admission_no}', [ExamController::class, 'cbtContinue'])
    ->name('cbt-continue');
    //----Update Answers---
    Route::get('fetch-answers/{id}/{pageNo}', [ExamController::class, 'fetchAnswers'])
    ->name('fetch-answers');
    Route::get('fetch-questions/{id}/{pageNo}', [ExamController::class, 'fetchQuestions'])
    ->name('fetch-questions');
    Route::post('update-answers/{id}/{pageNo}', [ExamController::class, 'updateAnswersForPage'])
    ->name('update-answers');
    //--Submit Test
    Route::get('cbt/{id}/submit', [ExamController::class, 'cbtSubmit'])
    ->name('cbt-submit');
    //---Display result
    Route::get('cbt/{admission_no}/result', [ExamController::class, 'cbtResult'])
    ->name('cbt-result'); 
    Route::post('/update-remaining-time/{id}', [ExamController::class, 'updateRemainingTime'])
    ->name('exam.updateRemainingTime');  
    Route::get('signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('signup', [AuthController::class, 'signupAction'])->name('signup.action');    
    // Logout route
    Route::get('student-logout', [AuthController::class, 'studentLogout'])->name('student-logout'); 
    });

    //----Admin routes--
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
        Route::get('student-list', [StudentController::class, 'student'])
        ->name('student-list');
        Route::get('student-create', [StudentController::class, 'studentCreate'])
        ->name('student-create');
        Route::post('student-create', [StudentController::class, 'studentCreateAction'])
        ->name('student-create.action');
        Route::get('student-edit/{id}', [StudentController::class, 'studentEdit'])
        ->name('student-edit');
        Route::put('student-edit/{id}', [StudentController::class, 'studentEditAction'])
        ->name('student-edit.action');
        Route::get('student/{id}', [StudentController::class, 'studentDelete'])
        ->name('student-delete.action');        
        Route::get('student-import', [StudentController::class, 'studentImport'])
        ->name('student-import');
        Route::post('student-import', [StudentController::class, 'studentImportAction'])
        ->name('student-import.action');
        Route::get('download-student-csv', [StudentController::class, 'downloadStudentCsv'])
        ->name('download-student-csv');
        //--student login status
        Route::get('login-status', [StudentController::class, 'loginStatus'])
        ->name('login-status');
        Route::post('login-status-view', [StudentController::class, 'loginStatusView'])
        ->name('login-status-view');
        Route::post('login-status/{id}', [StudentController::class, 'loginStatusAction'])
        ->name('login-status.action');
        //--change course
        Route::get('change-course', [StudentController::class, 'changeCourse'])
        ->name('change-course');
        Route::post('change-course-view', [StudentController::class, 'changeCourseView'])
        ->name('change-course-view');
        Route::post('change-course/{id}', [StudentController::class, 'changeCourseAction'])
        ->name('change-course.action');
        Route::post('search', [StudentController::class, 'search'])
        ->name('search'); 
        //---Add programmes
        Route::get('add-course', [DashboardController::class, 'addCourse'])
        ->name('add-course');
        Route::post('add-course', [DashboardController::class, 'addCourseAction'])
        ->name('add-course.action');
        Route::post('add-course-college', [DashboardController::class, 'addCourseCollegeAction'])
        ->name('add-course-college.action');
        Route::get('course/{id}', [DashboardController::class, 'deleteDeptAction'])
        ->name('delete-dept.action'); 
        //--Add class/level--        
        Route::post('add-class', [DashboardController::class, 'addClassAction'])
        ->name('add-class.action'); 
        Route::get('class/{id}', [DashboardController::class, 'deleteClassAction'])
        ->name('delete-class.action'); 
        //--Add subject/course--        
        Route::post('add-subject', [DashboardController::class, 'addSubjectAction'])
        ->name('add-subject.action'); 
        Route::get('subject/{id}', [DashboardController::class, 'deleteSubjectAction'])
        ->name('delete-subject.action'); 
        //--college update
        Route::get('college-setup', [DashboardController::class, 'collegeSetup'])
        ->name('college-setup');
        Route::put('college-setup', [DashboardController::class, 'collegeSetupAction'])
        ->name('college-setup.action');
        //--Questions
        Route::get('question', [QuestionController::class, 'question'])
        ->name('question');
        Route::get('question-upload', [QuestionController::class, 'questionUpload'])
        ->name('question-upload');
        Route::get('download-question-csv', [QuestionController::class, 'downloadQuestionCsv'])
        ->name('download-question-csv');        
        Route::get('question-edit/{questionId}', [QuestionController::class, 'questionEdit'])
        ->name('question-edit.action');
        //-----Questions Objectives
        Route::get('question-upload-obj', [QuestionController::class, 'questionUploadObj'])
        ->name('question-upload-obj');
        Route::post('question-upload-obj-import', [QuestionController::class, 'questionUploadObjImportAction'])
        ->name('question-upload-obj-import.action');
        Route::post('question-upload-obj', [QuestionController::class, 'questionUploadObjAction'])
        ->name('question-upload-obj.action');
        Route::get('question-view/{questionId}', [QuestionController::class, 'questionView'])
        ->name('question-view');
        Route::get('question-edit/{questionId}', [QuestionController::class, 'questionEdit'])
        ->name('question-edit');
        Route::get('question-enable/{questionId}', [QuestionController::class, 'questionEnable'])
        ->name('question-enable');
        Route::get('question-next/{id}', [QuestionController::class, 'questionNext'])
        ->name('question-next');
        Route::get('question-previous/{id}', [QuestionController::class, 'questionPrevious'])
        ->name('question-previous');
        Route::post('question-search/{id}', [QuestionController::class, 'questionSearch'])
        ->name('question-search');
        Route::post('question-save/{id}', [QuestionController::class, 'questionSave'])
        ->name('question-save');
        Route::post('question-setting-search', [QuestionController::class, 'questionSettingSearch'])
        ->name('question-setting-search');
        Route::post('question-image-upload/{id}', [QuestionController::class, 'uploadQuestionImage'])
        ->name('question-image-upload');
        Route::get('question-image-upload/{id}', [QuestionController::class, 'uploadQuestionImage'])
        ->name('question-image-upload');

        //---Questions Fill in the Gaps
        Route::get('question-upload-fill-gap', [QuestionController::class, 'questionUploadFillGap'])
        ->name('question-upload-fill-gap');
        Route::post('question-upload-fill-gap', [QuestionController::class, 'questionUploadFillGapAction'])
        ->name('question-upload-fill-gap.action');
        //----Questions theory
        Route::get('question-upload-theory', [QuestionController::class, 'questionUploadTheory'])
        ->name('question-upload-theory');
        Route::post('question-upload-theory', [QuestionController::class, 'questionUploadTheoryAction'])
        ->name('question-upload-theory.action');
        //--report
        Route::get('report', [ReportController::class, 'index'])
        ->name('report');
        Route::get('report-view/{id}', [ReportController::class, 'reportView'])
        ->name('report-view');
        Route::post('report-search', [ReportController::class, 'reportSearch'])
        ->name('report-search');
        Route::get('exam-sheet/{id}/Page1', [ReportController::class, 'examSheetPage1'])
        ->name('exam-sheet-page1');
        Route::get('exam-sheet/{id}/Page2', [ReportController::class, 'examSheetPage2'])
        ->name('exam-sheet-page2');
        Route::get('exam-sheet/{id}/Page3', [ReportController::class, 'examSheetPage3'])
        ->name('exam-sheet-page3');
        Route::get('exam-sheet/{id}/Page4', [ReportController::class, 'examSheetPage4'])
        ->name('exam-sheet-page4');
        Route::get('exam-sheet/{id}/Page5', [ReportController::class, 'examSheetPage5'])
        ->name('exam-sheet-page5');
        Route::get('exam-sheet/{id}/Page6', [ReportController::class, 'examSheetPage6'])
        ->name('exam-sheet-page6');
        Route::get('exam-sheet/{id}/Page7', [ReportController::class, 'examSheetPage7'])
        ->name('exam-sheet-page7');
        Route::get('exam-sheet/{id}/Page8', [ReportController::class, 'examSheetPage8'])
        ->name('exam-sheet-page8');
        Route::get('exam-sheet/{id}/Page9', [ReportController::class, 'examSheetPage9'])
        ->name('exam-sheet-page9');
        Route::get('exam-sheet/{id}/Page10', [ReportController::class, 'examSheetPage10'])
        ->name('exam-sheet-page10');
        Route::get('student-result/{id}', [ReportController::class, 'studentResult'])
        ->name('student-result');
        Route::post('result-search', [ReportController::class, 'resultSearch'])
        ->name('result-search'); 
        Route::get('/exam-dates', [ExamController::class, 'getExamDates'])
        ->name('exam-dates');
        //--create users
        Route::get('users', [DashboardController::class, 'Users'])
        ->name('users'); 
        Route::get('add-user', [DashboardController::class, 'addUser'])
        ->name('add-user'); 
        Route::post('add-user', [DashboardController::class, 'addUserAction'])
        ->name('add-user.action');               
  
    });
     
      

