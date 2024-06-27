<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamTheoryController;
use App\Http\Controllers\AIController;
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

    //--User routes
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
    Route::get('cbt/{admission_no}', [ExamController::class, 'cbtContinue'])
    ->name('cbt-continue');    
    //---Objective Module--------      
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
    ->name('update-remaining-time'); 
    //-----Theory Module---------    
    Route::get('cbt-theory/{id}', [ExamTheoryController::class, 'cbtTheory'])
    ->name('cbt-theory');
    Route::get('cbt-theory-page/{id}', [ExamTheoryController::class, 'cbtTheoryPage'])
    ->name('cbt-theory-page');
    Route::post('/update-remaining-time-theory/{id}', [ExamTheoryController::class, 'updateRemainingTimeTheory'])
    ->name('update-remaining-time-theory');  
    //---Save theory answers ---
    Route::get('answer-next/{id}', [ExamTheoryController::class, 'answerNext'])
    ->name('answer-next');
    Route::get('answer-previous/{id}', [ExamTheoryController::class, 'answerPrevious'])
    ->name('answer-previous');    
    Route::post('answer-save/{id}', [ExamTheoryController::class, 'answerSave'])
    ->name('answer-save');
    Route::post('save-answer/{id}', [ExamTheoryController::class, 'saveAnswer'])
    ->name('save-answer');
    //--Submit Test
    Route::get('cbt-theory/{id}/submit', [ExamTheoryController::class, 'cbtSubmit'])
    ->name('cbt-theory-submit');
    //----result
    Route::get('cbt/{admission_no}/result', [ExamTheoryController::class, 'cbtTheoryResult'])
    ->name('cbt-theory-result'); 
    //-------------------------
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
        Route::get('exam-setting-edit/{id}', [DashboardController::class, 'examSettingEdit'])
        ->name('exam-setting-edit');
        Route::put('exam-setting-edit/{id}', [DashboardController::class, 'examSettingAction'])
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
        Route::get('login-status-all', [StudentController::class, 'loginStatusAll'])
        ->name('login-status-all');
        Route::post('exam-status-view', [StudentController::class, 'examStatusView'])
        ->name('exam-status-view');
        Route::post('exam-status/{id}', [StudentController::class, 'examStatusAction'])
        ->name('exam-status.action');
        // Route::get('exam-status-all', [StudentController::class, 'examStatusAll'])
        // ->name('exam-status-all');
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
        Route::get('add-department', [DashboardController::class, 'addDepartment'])
        ->name('add-department');
        Route::get('add-course', [DashboardController::class, 'addCourse'])
        ->name('add-course');
        Route::post('add-course', [DashboardController::class, 'addCourseAction'])
        ->name('add-course.action');
        Route::post('add-course-college', [DashboardController::class, 'addCourseCollegeAction'])
        ->name('add-course-college.action');
        Route::get('course/{id}', [DashboardController::class, 'deleteDeptAction'])
        ->name('delete-dept.action'); 
        //--Add class/level--  
        Route::get('add-class', [DashboardController::class, 'addClass'])
        ->name('add-class');      
        Route::post('add-class', [DashboardController::class, 'addClassAction'])
        ->name('add-class.action'); 
        Route::get('class/{id}', [DashboardController::class, 'deleteClassAction'])
        ->name('delete-class.action'); 
        //--Add subject/course--  
        Route::get('add-subject', [DashboardController::class, 'addSubject'])
        ->name('add-subject');       
        Route::post('add-subject', [DashboardController::class, 'addSubjectAction'])
        ->name('add-subject.action'); 
        Route::get('subject/{id}', [DashboardController::class, 'deleteSubjectAction'])
        ->name('delete-subject.action'); 
        //--college update
        Route::get('admin-setup', [DashboardController::class, 'adminSetup'])
        ->name('admin-setup');
        Route::get('college-setup', [DashboardController::class, 'collegeSetup'])
        ->name('college-setup');
        Route::put('college-setup', [DashboardController::class, 'collegeSetupAction'])
        ->name('college-setup.action');
        //--Questions
        Route::get('question', [QuestionController::class, 'question'])
        ->name('question');
        Route::get('question-obj-upload', [QuestionController::class, 'questionObjUpload'])
        ->name('question-obj-upload');
        Route::get('question-theory-upload', [QuestionController::class, 'questionTheoryUpload'])
        ->name('question-theory-upload');
        Route::get('download-question-csv', [QuestionController::class, 'downloadQuestionCsv'])
        ->name('download-question-csv');  
        Route::get('download-question-theory-csv', [QuestionController::class, 'downloadQuestionTheoryCsv'])
        ->name('download-question-theory-csv');       
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
        Route::post('delete-obj-image/{id}', [QuestionController::class, 'deleteObjImage'])
        ->name('delete-obj-image');    
        Route::get('question-enable/{questionId}', [QuestionController::class, 'questionEnable'])
        ->name('question-enable');    
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
        Route::post('question-upload-theory-import', [QuestionController::class, 'questionUploadTheoryImportAction'])
        ->name('question-upload-theory-import.action');   
        Route::get('question-theory-view/{questionId}', [QuestionController::class, 'questionTheoryView'])
        ->name('question-theory-view');     
        Route::post('question-theory-search/{id}', [QuestionController::class, 'questionTheorySearch'])
        ->name('question-theory-search');
        Route::post('question-theory-image-upload/{id}', [QuestionController::class, 'uploadQuestionTheoryImage'])
        ->name('question-theory-image-upload');
        Route::get('question-theory-image-upload/{id}', [QuestionController::class, 'uploadQuestionTheoryImage'])
        ->name('question-theory-image-upload');
        Route::post('question-theory-save/{id}', [QuestionController::class, 'questionTheorySave'])
        ->name('question-theory-save');
        Route::post('delete-theory-image/{id}', [QuestionController::class, 'deleteTheoryImage'])
        ->name('delete-theory-image');
        Route::get('question-theory-enable/{questionId}', [QuestionController::class, 'questionTheoryEnable'])
        ->name('question-theory-enable');
        //--report
        Route::get('report', [ReportController::class, 'index'])
        ->name('report');
        //----Objective
        Route::get('report-objective', [ReportController::class, 'reportObjective'])
        ->name('report-objective');
        Route::get('report-objective-view/{id}', [ReportController::class, 'reportObjectiveView'])
        ->name('report-objective-view');
        Route::get('report-objective-csv/{id}', [ReportController::class, 'reportObjCsv'])
        ->name('report-objective-csv');
        //-----Theory
        Route::get('report-theory', [ReportController::class, 'reportTheory'])
        ->name('report-theory');
        Route::get('report-theory-view/{id}', [ReportController::class, 'reportTheoryView'])
        ->name('report-theory-view');
        Route::get('report-theory-csv/{id}', [ReportController::class, 'reportTheoryCsv'])
        ->name('report-theory-csv');
        Route::get('exam-theory-sheet/{qstId}/{id}', [ReportController::class, 'examTheorySheet'])
        ->name('exam-theory-sheet');
        Route::get('student-theory-result/{qstId}/{id}', [ReportController::class, 'studentTheoryResult'])
        ->name('student-theory-result');
        Route::post('save-score/{qstId}/{id}', [ReportController::class, 'saveScore'])
        ->name('save-score');
        Route::get('grading/{qstId}/{id}', [ReportController::class, 'grading'])
        ->name('grading');

        //-----Fill in Gap
        Route::get('report-fill-gap', [ReportController::class, 'reportFillGap'])
        ->name('report-fill-gap');
        Route::get('report-fill-gap-view/{id}', [ReportController::class, 'reportFillGapView'])
        ->name('report-fill-gap-view');
        //------
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
        Route::get('/exam-dates', [DashboardController::class, 'getExamDates'])
        ->name('exam-dates');
        //--create users
        Route::get('users', [DashboardController::class, 'Users'])
        ->name('users'); 
        Route::get('add-user', [DashboardController::class, 'addUser'])
        ->name('add-user'); 
        Route::post('add-user', [DashboardController::class, 'addUserAction'])
        ->name('add-user.action');   
        Route::get('edit-user/{id}', [DashboardController::class, 'editUser'])
        ->name('edit-user'); 
        Route::put('edit-user/{id}', [DashboardController::class, 'editUserAction'])
        ->name('edit-user.action'); 
        Route::get('deactivate-user/{id}', [DashboardController::class, 'deactivateUser'])
        ->name('deactivate-user');  
        Route::get('activate-user/{id}', [DashboardController::class, 'activateUser'])
        ->name('activate-user');  
        Route::post('user-search', [DashboardController::class, 'userSearch'])
        ->name('user-search');   
        
        Route::post('lock-exam/{id}', [DashboardController::class, 'lockExam'])
        ->name('lock-exam');   
        Route::post('unlock-exam/{id}', [DashboardController::class, 'unlockExam'])
        ->name('unlock-exam');          
  
    });

    Route::get('test-chatgpt', [AIController::class, 'testOpenAI'])
        ->name('test-chatgpt'); 
     
      

