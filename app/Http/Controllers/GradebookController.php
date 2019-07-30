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
        
        \Log::info($gradebooks);

        return $gradebooks;//view('gradebooks.index', compact('gradebooks'));
    }
}
