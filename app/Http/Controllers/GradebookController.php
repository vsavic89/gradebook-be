<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gradebook;
use Illuminate\Support\Facades\DB;

class GradebookController extends Controller
{
    public function index()
    {
        // $gradebooks = GradeBook::with('professors')->orderBy('id', 'desc')->take(10)->get();
        
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
        ->orderBy('gradebooks.id', 'desc')->take(10)->get();

        return $gradebooks;
    }
    public function store(Request $request)
    {
        // dd($request);
        // \Log::info($request);
        $this->validate(request(), Gradebook::STORE_RULES);
        $gradebook = new Gradebook();
        $gradebook->name = $request['name'];
        $gradebook->professor_id = $request['professor_id'];
        $gradebook->save();

        return $gradebook; 
    }
    public function show($param)
    {
        // \Log::info(request());
        $gradebook = DB::table('gradebooks')
            ->select(
                'gradebooks.*',
                'professors.first_name',
                'professors.last_name'               
            )
            ->join(
               'professors',
               'professors.id','=','gradebooks.professor_id' 
            )
           ->where('professors.user_id','=',$param)
           ->get();
            
        return $gradebook;
    }
}
