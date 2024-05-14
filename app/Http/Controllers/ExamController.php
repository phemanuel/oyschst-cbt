<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use App\Models\User;
use App\Models\Department;
use App\Models\Question;
use App\Models\AcademicSession;
use App\Models\SoftwareVersion;
use App\Models\ExamType;
use App\Models\ExamSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CollegeSetup;
use App\Models\CbtClass;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Models\QuestionSetting;
use Illuminate\Support\Facades\Session;
use App\Models\CbtEvaluation;
use App\Models\CbtEvaluation1;
use App\Models\CbtEvaluation2;



class ExamController extends Controller
{
    //
    public function cbtCheck($id)
    {
        try {
            $examSetting = ExamSetting::first();
            $studentData = StudentAdmission::where('id', $id)->first();
            $examSetting = ExamSetting::first();
            // Check if the question for current exam setting is available
            $existingQuestion = Question::where('exam_type', $examSetting->exam_type)
                                                ->where('exam_category', $examSetting->exam_category)
                                                ->where('exam_mode', $examSetting->exam_mode)
                                                ->where('department', $examSetting->department)
                                                ->where('level', $examSetting->level)
                                                ->where('session1', $examSetting->session1)
                                                ->where('no_of_qst', $examSetting->no_of_qst)
                                                ->first();

            if(!$existingQuestion){
                return redirect()->back()->with('error', 'Question is unavailable.');
            }
            //----Check if student can access the current exam setting--- 
            $studentDept = $studentData->department;
            $studentLevel = $studentData->level;
            $examDept = $examSetting->department;
            $examLevel = $examSetting->level;

            if($studentDept !== $examDept || $studentLevel !== $examLevel){
                return redirect()->back()->with('error', 'You cannot access this exam.');
            }
                                            
            return redirect()->route('cbt-process', ['id' => $studentData->id]);
        } catch (ValidationException $e) {
            // Handle the validation exception
            // You can redirect back with errors or do other appropriate error handling
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Handle other exceptions, log them, and redirect to an error page
            Log::error('Error during login: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred accessing this exam.');
        }

    }

    public function cbtProcess($id)
    {
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        //--setup student cbt data
            $noOfQuestions = $examSetting->no_of_qst;
            $studentName = $studentData->surname . " " . $studentData->first_name . " " . $studentData->other_name;
            $studentNo = $studentData->admission_no;
            $department = $studentData->department;
            $level = $studentData->level;
            $course = $examSetting->course;
            $examCategory = $examSetting->exam_category;
            $examMode = $examSetting->exam_mode;
            $examType = $examSetting->exam_type;
            $semester = $examSetting->semester;
            $session1 = $examSetting->session1;  
            $noOfQuestions  = $examSetting->no_of_qst;          

            // Generate a random set of numbers representing the questions
            $questionNumbers = range(1, $noOfQuestions);
            shuffle($questionNumbers);
            $randomizedQuestions = array_slice($questionNumbers, 0, $noOfQuestions);

            $studentDataExist = CbtEvaluation::where('studentno', $studentData->admission_no)
            ->where('exam_mode', $examMode)
            ->where('exam_type', $examType)
            ->where('exam_category', $examCategory)
            ->where('department', $department)
            ->where('level', $level)
            ->where('course', $course)
            ->where('noofquestion', $noOfQuestions)
            ->first();
            if($studentDataExist){
                return redirect()->back();
            }
            // Create or update the student record
            $student = CbtEvaluation::firstOrCreate([
                'session1' => $session1,
                'studentname' => $studentName,
                'studentno' => $studentNo,
                'department' => $department,
                'level' => $level,
                'course' => $course,
                'exam_category' => $examCategory,
                'exam_mode' => $examMode,
                'exam_type' => $examType,
                'semester' => $semester,
                'correct' => 0,
                'wrong' => 0,
                'hour' => 0,
                'minute' => 0,
                'pageno' => 1,
                'msgstatus' => 0,
                'examdate' => date('Y-m-d H:i:s'),
                'starttime' => date('Y-m-d H:i:s'),
                'endtime' => date('Y-m-d H:i:s'),
                'noofquestion' => $noOfQuestions,
                'examstatus' => 1,
            ]);
            // Save the shuffled question numbers along with the student record
            foreach ($randomizedQuestions as $index => $questionNumber) {
                $field = 'A' . ($index + 1); // Generate field name like A1, A2, A3, etc.
                $student->{$field} = $questionNumber;
            }
            // Save the changes
            $student->save();

            $studentDataExist1 = CbtEvaluation1::where('studentno', $studentData->admission_no)
            ->where('exam_mode', $examMode)
            ->where('exam_type', $examType)
            ->where('exam_category', $examCategory)
            ->where('department', $department)
            ->where('level', $level)
            ->where('course', $course)
            ->where('noofquestion', $noOfQuestions)
            ->first();
            if($studentDataExist1){
                return redirect()->back();
            }
            //---Save answers of the shuffled questions----
            $student1 = CbtEvaluation1::firstOrCreate([
                'session1' => $session1,
                'studentname' => $studentName,
                'studentno' => $studentNo,
                'department' => $department,
                'level' => $level,
                'course' => $course,
                'exam_category' => $examCategory,
                'exam_mode' => $examMode,
                'exam_type' => $examType,
                'semester' => $semester,
                'correct' => 0,
                'wrong' => 0,
                'hour' => 0,
                'minute' => 0,
                'pageno' => 1,
                'msgstatus' => 0,
                'examdate' => date('Y-m-d H:i:s'),
                'starttime' => date('Y-m-d H:i:s'),
                'endtime' => date('Y-m-d H:i:s'),
                'noofquestion' => $noOfQuestions,
            ]);
            //----Save answers for all the questions ----                   
            foreach ($randomizedQuestions as $index => $questionNumber) {
                // Retrieve answer for the current question number and exam mode
                $answer = Question::where('question_no', $questionNumber)
                    ->where('exam_mode', $examMode)
                    ->where('exam_type', $examType)
                    ->where('exam_category', $examCategory)
                    ->where('department', $department)
                    ->where('level', $level)
                    ->where('course', $course)
                    ->where('no_of_qst', $noOfQuestions)
                    ->value('answer');

                // If answer is found, save it in the corresponding field in CbtEvaluation1 model
                if ($answer !== null) {
                    $field = 'OK' . ($index + 1); // Generate field name like OK1, OK2, OK3, etc.
                    $student1->{$field} = $answer;
                }
            }

            // Save the changes in CbtEvaluation1 model
            $student1->save();

            $studentDataExist2 = CbtEvaluation2::where('studentno', $studentData->admission_no)
            ->where('exam_mode', $examMode)
            ->where('exam_type', $examType)
            ->where('exam_category', $examCategory)
            ->where('department', $department)
            ->where('level', $level)
            ->where('course', $course)
            ->where('noofquestion', $noOfQuestions)
            ->first();
            if($studentDataExist2){
                return redirect()->back();
            }
            //-----Save dummy answers for the student----------
            $student2 = CbtEvaluation2::firstOrCreate([
                'session1' => $session1,
                'studentname' => $studentName,
                'studentno' => $studentNo,
                'department' => $department,
                'level' => $level,
                'course' => $course,
                'exam_category' => $examCategory,
                'exam_mode' => $examMode,
                'exam_type' => $examType,
                'semester' => $semester,
                'correct' => 0,
                'wrong' => 0,
                'hour' => 0,
                'minute' => 0,
                'pageno' => 1,
                'msgstatus' => 0,
                'examdate' => date('Y-m-d H:i:s'),
                'starttime' => date('Y-m-d H:i:s'),
                'endtime' => date('Y-m-d H:i:s'),
                'noofquestion' => $noOfQuestions,
            ]);

            foreach ($randomizedQuestions as $index => $questionNumber) {
                $field = 'OK' . ($index + 1); // Generate field name like A1, A2, A3, etc.
                $student2->{$field} = "Nill";
            }
            // Save the changes in CbtEvaluation1 model
            $student2->save();
            $pageNo = 1;
            return redirect()->to(route('cbt-page1', ['id' => $studentData->id]));
    }

    public function cbtPage1($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        if($examSetting->no_of_qst < 10){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A1, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A2, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A3, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A4, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A5, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A6, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A7, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A8, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A9, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A10, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 1, 'q2' => 2, 'q3' => 3, 'q4' => 4, 'q5' => 5, 'q6' => 6, 'q7' => 7, 'q8' => 8,
            'q9' => 9, 'q10' => 10,
            'a1' => 1, 'a2' => 2, 'a3' => 3, 'a4' => 4, 'a5' => 5, 'a6' => 6, 'a7' => 7, 'a8' => 8,
            'a9' => 9, 'a10' => 10
        ];
        $pageNo = 1;
        return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','question1','question2','question3','question4','question5','question6','question7',
        'question8','question9','question10', 'questionNo','studentAnswer','pageNo'));
    
    }

    public function cbtPage2($id)
    {
        $noOfQst = 10;
        $collegeSetup = CollegeSetup::first();
        $softwareVersion = SoftwareVersion::first();
        $studentData = StudentAdmission::where('id', $id)->first();
        $examSetting = ExamSetting::first();

        if($examSetting->no_of_qst < 10){
            return redirect()->back()->with('error', 'You have exceeded the no of questions to attempt. 
            Please submit.');
        }

        // Retrieve shuffled question numbers from CbtEvaluation model
        $cbtEvaluation = CbtEvaluation::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
                        ->where('session1', $examSetting->session1)
                        ->where('department', $studentData->department)
                        ->where('level', $studentData->level)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();
                        
        //---Qst1
        $question1 = Question::commonConditionsQst($cbtEvaluation->A11, $examSetting, $studentData)->first();        
        //---Qst2
        $question2 = Question::commonConditionsQst($cbtEvaluation->A12, $examSetting, $studentData)->first();
        //---Qst3
        $question3 = Question::commonConditionsQst($cbtEvaluation->A13, $examSetting, $studentData)->first();
        //---Qst4
        $question4 = Question::commonConditionsQst($cbtEvaluation->A14, $examSetting, $studentData)->first();
        //---Qst5
        $question5 = Question::commonConditionsQst($cbtEvaluation->A15, $examSetting, $studentData)->first();
        //---Qst6
        $question6 = Question::commonConditionsQst($cbtEvaluation->A16, $examSetting, $studentData)->first();
        //---Qst7
        $question7 = Question::commonConditionsQst($cbtEvaluation->A17, $examSetting, $studentData)->first();
        //---Qst8
        $question8 = Question::commonConditionsQst($cbtEvaluation->A18, $examSetting, $studentData)->first();
        //---Qst9
        $question9 = Question::commonConditionsQst($cbtEvaluation->A19, $examSetting, $studentData)->first();
        //---Qst10
        $question10 = Question::commonConditionsQst($cbtEvaluation->A20, $examSetting, $studentData)->first();
        
        $questionNo = [
            'q1' => 11, 'q2' => 12, 'q3' => 13, 'q4' => 14, 'q5' => 15, 'q6' => 16, 'q7' => 17, 'q8' => 18,
            'q9' => 19, 'q10' => 20,
            'a1' => 11, 'a2' => 12, 'a3' => 13, 'a4' => 14, 'a5' => 15, 'a6' => 16, 'a7' => 17, 'a8' => 18,
            'a9' => 19, 'a10' => 20
        ];
        $pageNo = 2;
        return view('student.pages.cbt-page', compact('collegeSetup', 'softwareVersion', 'studentData',
        'examSetting','question1','question2','question3','question4','question5','question6','question7',
        'question8','question9','question10', 'questionNo','studentAnswer','pageNo'));
    
    }

    public function updateAnswerNow(Request $request, $id)
    {
        $examSetting = ExamSetting::first();
        // Retrieve the question number and selected answer from the request
        $questionNumber = $request->input('questionNumber');
        $selectedAnswer = $request->input('answer');

        // Update the corresponding attribute in the CbtEvaluation2 model
        $cbtEvaluation = CbtEvaluation2::where('studentno', $id)
                         ->where('session1', $examSetting->session1)
                        ->where('department', $examSetting->department)
                        ->where('level', $examSetting->level)
                        ->where('course', $examSetting->course)
                        ->where('exam_mode', $examSetting->exam_mode)
                        ->where('exam_type', $examSetting->exam_type)
                        ->where('exam_category', $examSetting->exam_category)
                        ->where('noofquestion' , $examSetting->no_of_qst)
                        ->first();

        $cbtEvaluation->{"OK" . $questionNumber} = $selectedAnswer;
        $cbtEvaluation->save();

        // Return a response indicating success
        return response()->json(['message' => 'Answer updated successfully']);
    }

    public function processAnswer($optionName, $questionNo)
    {
        $option = "Nill"; // Default value if none of the options are selected

        // Check which option is selected
        if (request()->has($optionName . 'A')) {
            $option = 'A';
        } elseif (request()->has($optionName . 'B')) {
            $option = 'B';
        } elseif (request()->has($optionName . 'C')) {
            $option = 'C';
        } elseif (request()->has($optionName . 'D')) {
            $option = 'D';
        }

        return [
            'option' => $option,
            'questionNo' => request()->get($questionNo),
        ];
    }


    public function updateAnswer(Request $request, $id)
    {
        //---get the question nos
        $q1 = $request->get('q1');
        $q2 = $request->get('q2');
        $q3 = $request->get('q3');
        $q4 = $request->get('q4');
        $q5 = $request->get('q5');
        $q6 = $request->get('q6');
        $q7 = $request->get('q7');
        $q8 = $request->get('q8');
        $q9 = $request->get('q9');
        $q10 = $request->get('q10');
        
        //----get default answers
        $studentAnswer = CbtEvaluation2::where('studentno', $id)
        ->where('session1', $examSetting->session1)->where('department', $examSetting->department)
        ->where('level', $examSetting->level)->where('course', $examSetting->course)
        ->where('exam_mode', $examSetting->exam_mode)->where('exam_type', $examSetting->exam_type)
        ->where('exam_category', $examSetting->exam_category)->where('noofquestion' , $examSetting->no_of_qst)
        ->first();

        $a1 = $studentAnswer->OK . $q1;
        $a2 = $studentAnswer->OK . $q2;
        $a3 = $studentAnswer->OK . $q3;
        $a4 = $studentAnswer->OK . $q4;
        $a5 = $studentAnswer->OK . $q5;
        $a6 = $studentAnswer->OK . $q6;
        $a7 = $studentAnswer->OK . $q7;
        $a8 = $studentAnswer->OK . $q8;
        $a9 = $studentAnswer->OK . $q9;
        $a10 = $studentAnswer->OK . $q10;
        //-1
        if (request()->has('option1A')) {
            $option1 = 'A';            
        } elseif (request()->has('option1B')) {
            $option1 = 'B';
        } elseif (request()->has('option1C')) {
            $option1 = 'C';
        } elseif (request()->has('option1D')) {
            $option1 = 'D';
        } else {
            $option1 = $a1;
        }
        //-2
        if (request()->has('option2A')) {
            $option2 = 'A';            
        } elseif (request()->has('option2B')) {
            $option2 = 'B';
        } elseif (request()->has('option2C')) {
            $option2 = 'C';
        } elseif (request()->has('option2D')) {
            $option2 = 'D';
        } else {
            $option2 = $a2;
        }
        //-3
        if (request()->has('option3A')) {
            $option3 = 'A';            
        } elseif (request()->has('option3B')) {
            $option3 = 'B';
        } elseif (request()->has('option3C')) {
            $option3 = 'C';
        } elseif (request()->has('option3D')) {
            $option3 = 'D';
        } else {
            $option3 = $a3;
        }
        //-4
        if (request()->has('option4A')) {
            $option4 = 'A';            
        } elseif (request()->has('option4B')) {
            $option4 = 'B';
        } elseif (request()->has('option4C')) {
            $option4 = 'C';
        } elseif (request()->has('option4D')) {
            $option4 = 'D';
        } else {
            $option4 = $a4;
        }
        //-5
        if (request()->has('option5A')) {
            $option5 = 'A';            
        } elseif (request()->has('option5B')) {
            $option5 = 'B';
        } elseif (request()->has('option5C')) {
            $option5 = 'C';
        } elseif (request()->has('option5D')) {
            $option5 = 'D';
        } else {
            $option5 = $a5;
        }
        //-6
        if (request()->has('option6A')) {
            $option6 = 'A';            
        } elseif (request()->has('option6B')) {
            $option6 = 'B';
        } elseif (request()->has('option6C')) {
            $option6 = 'C';
        } elseif (request()->has('option6D')) {
            $option6 = 'D';
        } else {
            $option6 = $a6;
        }
        //-7
        if (request()->has('option7A')) {
            $option7 = 'A';            
        } elseif (request()->has('option7B')) {
            $option7 = 'B';
        } elseif (request()->has('option7C')) {
            $option7 = 'C';
        } elseif (request()->has('option7D')) {
            $option7 = 'D';
        } else {
            $option7 = $a7;
        }
        //-8
        if (request()->has('option8A')) {
            $option8 = 'A';            
        } elseif (request()->has('option8B')) {
            $option8 = 'B';
        } elseif (request()->has('option8C')) {
            $option8 = 'C';
        } elseif (request()->has('option8D')) {
            $option8 = 'D';
        } else {
            $option8 = $a8;
        }
        //-9
        if (request()->has('option9A')) {
            $option9 = 'A';            
        } elseif (request()->has('option9B')) {
            $option9 = 'B';
        } elseif (request()->has('option9C')) {
            $option9 = 'C';
        } elseif (request()->has('option9D')) {
            $option9 = 'D';
        } else {
            $option9 = $a9;
        }
        //-10
        if (request()->has('option10A')) {
            $option10 = 'A';            
        } elseif (request()->has('option10B')) {
            $option10 = 'B';
        } elseif (request()->has('option10C')) {
            $option10 = 'C';
        } elseif (request()->has('option10D')) {
            $option10 = 'D';
        } else {
            $option10 = $a10;
        }

    }

    public function checkPage(Request $request , $id)
    {
        $pageNo = $request->get('pageNo');
        $q1 = $request->get('q1');
        session::put('q1', $q1);

        if ($pageNo == 1) {
            return $this->page1Answer($request, $id); // Pass the $request object to page1Answer
        } elseif ($pageNo == 2) {
            return $this->page2Answer($request, $id);
        } elseif ($pageNo == 3) {
            return $this->page3Answer($request, $id);
        } elseif ($pageNo == 4) {
            return $this->page4Answer($request, $id);
        } elseif ($pageNo == 5) {
            return $this->page5Answer($request, $id);
        } elseif ($pageNo == 6) {
            return $this->page2Answer($request, $id); // This should probably be page6Answer
        } elseif ($pageNo == 7) {
            return $this->page7Answer($request, $id);
        } elseif ($pageNo == 8) {
            return $this->page8Answer($request, $id);
        } elseif ($pageNo == 9) {
            return $this->page9Answer($request, $id);
        } elseif ($pageNo == 10) {
            return $this->page10Answer($request, $id);
        }
    }

    public function page1Answer(Request $request,$id)
    {
        $q1 = session::get('q1');
        $examSetting = ExamSetting::first(); 
        $studentData = StudentAdmission::where('id',$id)->first();

        //----get default answers        
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
        ->where('session1', $examSetting->session1)->where('department', $examSetting->department)
        ->where('level', $examSetting->level)->where('course', $examSetting->course)
        ->where('exam_mode', $examSetting->exam_mode)->where('exam_type', $examSetting->exam_type)
        ->where('exam_category', $examSetting->exam_category)->where('noofquestion' , $examSetting->no_of_qst)
        ->first();

        
        $a1FieldName = "OK" . $q1;
        $a1 = $studentAnswer->{$a1FieldName};
       
        //  //-1
        if (request()->has('option1A')) {
            $option1 = 'A';            
        } elseif (request()->has('option1B')) {
            $option1 = 'B';
        } elseif (request()->has('option1C')) {
            $option1 = 'C';
        } elseif (request()->has('option1D')) {
            $option1 = 'D';
        } else {
            $option1 = $a1;
        }

        //--update option   
        $a1FieldName = "OK" . $q1;     
        $studentAnswer->{$a1FieldName} = $option1;
        $studentAnswer->save();
            

        return $this->cbtPage1($id);
    }

    public function page2Answer(Request $request,$id)
    {
        $q2 = session::get('q2');
        $examSetting = ExamSetting::first(); 
        $studentData = StudentAdmission::where('id',$id)->first();

        //----get default answers        
        $studentAnswer = CbtEvaluation2::where('studentno', $studentData->admission_no)
        ->where('session1', $examSetting->session1)->where('department', $examSetting->department)
        ->where('level', $examSetting->level)->where('course', $examSetting->course)
        ->where('exam_mode', $examSetting->exam_mode)->where('exam_type', $examSetting->exam_type)
        ->where('exam_category', $examSetting->exam_category)->where('noofquestion' , $examSetting->no_of_qst)
        ->first();

        
        $a1FieldName = "OK" . $q2;
        $a2 = $studentAnswer->{$a1FieldName};
       
        //  //-1
        if (request()->has('option2A')) {
            $option2 = 'A';            
        } elseif (request()->has('option2B')) {
            $option2 = 'B';
        } elseif (request()->has('option2C')) {
            $option2 = 'C';
        } elseif (request()->has('option2D')) {
            $option2 = 'D';
        } else {
            $option2 = $a2;
        }

        //--update option   
        $a1FieldName = "OK" . $q2;     
        $studentAnswer->{$a1FieldName} = $option1;
        $studentAnswer->save();
            

        return $this->cbtPage1($id);
    }
}
