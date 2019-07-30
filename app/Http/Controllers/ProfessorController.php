<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Illuminate\Support\Facades\DB;

class ProfessorController extends Controller
{
    public function index()
    {
        $professors = DB::table('professors')
            ->select(
                'professors.*',
                'gradebooks.name as gradebook_name'                
            )
            ->leftjoin(
                'gradebooks',
                'gradebooks.professor_id','=','professors.id'
            )->get();
        
        return $professors;
    }
    public function show($id)
    {
        $professor = DB::table('professors')
        ->select(
            'professors.*',
            'gradebooks.name as gradebook_name'                
        )
        ->leftjoin(
            'gradebooks',
            'gradebooks.professor_id','=','professors.id'
        )->where('professors.id', '=', $id)->get();

        return $professor;
    }
    public function onlyUnsignedProfessors()
    {
        $professors = DB::table('professors')
            ->select(
                'professors.*'             
            )
            ->leftjoin(
                'gradebooks',
                'gradebooks.professor_id','=','professors.id'
            )->whereNull('gradebooks.professor_id')->get();
        
        return $professors;
    }
}
