<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Student;
use App\Mark;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $teachers = Teacher::all();
        $students = Student::join('teachers', 'teachers.id', 'students.teacher_id')
                    ->select('students.id', 'students.name', 'students.age', 'students.gender', 'teachers.name as teacher_name')
                    ->get();
        return view('home', compact('teachers', 'students'));
    }

    public function addStudent(Request $request)
    {
        $student = new Student();
        $student->name= $request->name;
        $student->age= $request->age;
        $student->gender= $request->gender;
        $student->teacher_id= $request->teacher_id;
        $student->save();
        return redirect()->route('home')->with('message', 'Successfully Added');
    }

    public function editStudent(Request $request)
    {
        $teachers = Teacher::all();
        $students = Student::join('teachers', 'teachers.id', 'students.teacher_id')
                    ->select('students.id', 'students.name', 'students.age', 'students.gender', 'teachers.name as teacher_name')
                    ->get();
        $studentsDetails = Student::find($request->id);
        return view('home', compact('teachers', 'students', 'studentsDetails'));
    }

    public function updateStudent(Request $request)
    {
        $student = Student::find($request->student_id);
        $student->name= $request->name;
        $student->age= $request->age;
        $student->gender= $request->gender;
        $student->teacher_id= $request->teacher_id;
        $student->save();
        return redirect()->route('home')->with('message', 'Successfully Updated');;
    }

    public function deleteStudent(Request $request)
    {
        $students = Student::find($request->id)->delete();
        return redirect()->route('home')->with('message', 'Successfully Deleted');;
    }

    public function addMarks()
    {
        $studentLists = Student::all();
        $students = Student::join('marks', 'marks.student_id', 'students.id')
                    ->select('students.id', 'marks.term', 'marks.maths', 'marks.science', 'marks.history', 'students.name', 'marks.id as mark_id', 'marks.created_at', 'marks.updated_at')
                    ->get();
        return view('add-marks', compact('students', 'studentLists'));
    }

    public function storeMarks(Request $request)
    {
        $mark = new Mark();
        $mark->student_id= $request->student_id;
        $mark->term= $request->term;
        $mark->maths= $request->maths;
        $mark->science= $request->science;
        $mark->history= $request->history;
        $mark->save();
        return redirect()->route('add-marks')->with('message', 'Successfully Added');;
    }

    public function editMarks(Request $request)
    {
        $students = Student::join('marks', 'marks.student_id', 'students.id')
                    ->select('students.id', 'marks.term', 'marks.maths', 'marks.science', 'marks.history', 'students.name', 'marks.id as mark_id', 'marks.created_at', 'marks.updated_at')
                    ->get();
        $markDetails = Mark::find($request->id);
        return view('add-marks', compact('students', 'markDetails'));
    }

    public function updateMarks(Request $request)
    {
        $mark = Mark::find($request->mark_id);
        $mark->student_id= $request->student_id;
        $mark->term= $request->term;
        $mark->maths= $request->maths;
        $mark->science= $request->science;
        $mark->history= $request->history;
        $mark->save();
        return redirect()->route('add-marks')->with('message', 'Successfully Updated');;
    }

    public function deleteMarks(Request $request)
    {
        $mark = Mark::find($request->id)->delete();
        return redirect()->route('add-marks')->with('message', 'Successfully Deleted');;
    }
}
