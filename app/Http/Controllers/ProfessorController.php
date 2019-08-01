<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\ProfessorImage;
use Illuminate\Support\Facades\DB;

class ProfessorController extends Controller
{
    public function index()
    {
        $onlyUnsignedProfessors = request()->input('onlyUnsignedProfessors');
        if($onlyUnsignedProfessors){
            $professors = DB::table('professors')
            ->select(
                'professors.*'             
            )
            ->leftjoin(
                'gradebooks',
                'gradebooks.professor_id','=','professors.id'
            )->whereNull('gradebooks.professor_id')->get(); 
        }else{
            $professors = DB::table('professors')
            ->select(
                'professors.*',
                'gradebooks.name as gradebook_name'                
            )
            ->leftjoin(
                'gradebooks',
                'gradebooks.professor_id','=','professors.id'
            )->get();
        }
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
    public function store(Request $request)
    {
        $this->validate(request(), Professor::STORE_RULES);
        $professor = new Professor();
        $professor->first_name = $request['first_name'];
        $professor->last_name = $request['last_name'];
        $professor->user_id = $request['user_id'];
        $professor->imageUrl = $request['imageURLs'][0];
        $professor->save();

        $imageURLs = $request['imageURLs'];
        
        foreach ($imageURLs as $p) {
            $professorImage = new ProfessorImage();
            $professorImage->professor_id = $professor->id;
            $professorImage->imageURL = $p;
            $professorImage->save(); 
        }

        return $professor;
    }
}
