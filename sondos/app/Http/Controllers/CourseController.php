<?php

namespace App\Http\Controllers;

use App\ClassM;
use App\Course;
use App\Data;
use App\Section;
use App\Teacher;
use App\Teecher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;

class CourseController extends Controller
{

    public function findProductName(Request $request){

     $my_id=Input::get('id');
        $s_name=Data::where('id', '=', $my_id)->get();

     foreach ($s_name as $s){
         if($s->id == $my_id ){
             $nammm=$s->name;
         }
     }
       $data=DB::table('teechers')->select('name','id')->where('specialize',$nammm)->get();

      //  $data=DB::table('teachers')->select('name','id')->where('specialize',$s_name)->get();
        return response()->json($data);//then sent this data to ajax success
    }

/*
    public function findSection(Request $request){

        $my_id=Input::get('id');
           $s_name=ClassM::where('id', '=', $my_id)->get()->first();


        $data=DB::table('teachers')->select('name','id')->where('specialize',$nammm)->get();

        //  $data=DB::table('teachers')->select('name','id')->where('specialize',$s_name)->get();
        return response()->json($data);//then sent this data to ajax success
    }
*/
    public function addCourse(Request $request)
{
    $rules = array(
        'name' => 'required|alpha_num',
    );

    $validator = Validator::make(Input::all(), $rules);

 /*   if (Course::where('name', '=', Input::get('name'))->exists() )
    {
        return Response::json(array(

            'errors' => $validator->getMessageBag()->toArray(),
        ));
    }*/
    if ($validator->fails()) {
        return Response::json(array(

            'errors' => $validator->getMessageBag()->toArray(),
        ));
    }
    else {
        $data=new Course();
        $titles=ClassM::all();
        $insection=Section::all();
        $teacher=Teecher::all();
        $subjects=Data::all();
        $data->subject_id=Input::get('name');

        $data->class_id=Input::get('classs');
        $data->section_id=Input::get('section');
        $data->teacher_id=Input::get('teacher');

        $data->save();


    }
    return view('addCourse', compact('data','titles','insection','teacher','subjects'));

}

    public function readCourse(Request $req)
    {
        $data=Course::all();
        $titles=ClassM::all();
        $insection=Section::all();
        $teacher=Teecher::all();
        $subjects=Data::all();

       return View('addCourse',compact('data','titles','insection','teacher','subjects'));

    }


    public function deleteCourse(Request $req)
    {
        Course::find($req->id)->delete();

        return response()->json();
    }
}
