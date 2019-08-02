<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\StudentsGradebook;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');   
    }
    public function store(Request $request)
    {                    
        $count = count(reset($request));        
        for($i=0; $i<$count;$i++){          
            $student = new Student();
            $student->first_name = $request[$i]['first_name'];
            $student->last_name = $request[$i]['last_name'];
            $student->imageURL = $request[$i]['imageURL'];
            $student->save();

            $studentsGradebook = new StudentsGradebook();
            $studentsGradebook->student_id = $student->id;
            $studentsGradebook->gradebook_id = $request[$i]['gradebook_id'];
            $studentsGradebook->save();
        }
    }
    public function show($id)
    {
        $gradebookID = $id;
        if($gradebookID){
            $student = DB::table('students_gradebooks')
            ->select(
                'students.*',
                'students_gradebooks.gradebook_id'
            )
            ->join(
                'students',
                'students_gradebooks.student_id','=','students.id'
            )
            ->where('students_gradebooks.gradebook_id','=', $gradebookID)
            ->get();        
        }        
        return $student;
    }
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        DB::table('students_gradebooks')->where('student_id', '=', $id)->delete(); 
    }
    public function update(Request $request, $id)
    {
        $this->validate(request(), Student::STORE_RULES);
        $student = Student::findOrFail($id);
        $student->first_name = $request['first_name'];
        $student->last_name = $request['last_name'];
        $student->imageURL = $request['imageURL'];       
        $student->save();

        return $student;
    }
}
