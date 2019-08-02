<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gradebook;
use Illuminate\Support\Facades\DB;

class GradebookController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index', 'show']]);   
    }
    public function index()
    {         
        $currentPage = request()->input('current_page'); 
        $rowsPerPage = request()->input('rows_per_page');      
        $gradebooks = DB::table('gradebooks')
        ->select(
            'gradebooks.*',
            'professors.first_name',
            'professors.last_name'
        )
        ->leftjoin(
            'professors',
            'professors.id','=','gradebooks.professor_id'
        )
        ->orderBy('gradebooks.id', 'desc')->paginate($currentPage*$rowsPerPage);

        return $gradebooks;
    }
    public function store(Request $request)
    {        
        $this->validate(request(), Gradebook::STORE_RULES);
        $gradebook = new Gradebook();
        $gradebook->name = $request['name'];
        $gradebook->professor_id = $request['professor_id'];
        $gradebook->save();

        return $gradebook; 
    }
    public function show($id)
    {        
        $professorID = request()->input('professorID');        
        if($professorID){
            $gradebook = DB::table('gradebooks')
                ->select(
                    'gradebooks.*',
                    'professors.first_name',
                    'professors.last_name',
                    'students.first_name as studentFirstName',
                    'students.last_name as studentLastName',
                    'students.imageURL as studentImageURL'
                )
                ->leftjoin(
                    'professors',
                    'professors.id','=','gradebooks.professor_id' 
                )
                ->leftjoin(
                    'students_gradebooks',
                    'gradebooks.id','=','students_gradebooks.gradebook_id'
                )
                ->leftjoin(
                    'students',
                    'students.id','=','students_gradebooks.student_id'
                )
                ->where('gradebooks.professor_id','=',$professorID)
                ->get();                   
        }else{                   
            $gradebook = DB::table('gradebooks')
                ->select(
                    'gradebooks.*',
                    'professors.first_name',
                    'professors.last_name',
                    'students.first_name as studentFirstName',
                    'students.last_name as studentLastName',
                    'students.imageURL as studentImageURL'
                )
                ->leftjoin(
                    'professors',
                    'professors.id','=','gradebooks.professor_id' 
                )
                ->leftjoin(
                    'students_gradebooks',
                    'gradebooks.id','=','students_gradebooks.gradebook_id'
                )
                ->leftjoin(
                    'students',
                    'students.id','=','students_gradebooks.student_id'
                )
                ->where('gradebooks.id','=',$id)
                ->get();
        }     
        return $gradebook;
    }
    public function destroy($id)
    {
        $gradebook = Gradebook::findOrFail($id);
        $gradebook->delete();

        DB::table('comments_gradebooks')->where('gradebook_id', '=', $id)->delete();
        DB::table('students_gradebooks')->where('gradebook_id', '=', $id)->delete();
    }
}
