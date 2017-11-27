<?php

namespace App\Http\Controllers;

use App\ClassM;
use App\SecClass;
use App\Section;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;

class ClassController extends Controller
{
    public function addClasses(Request $request)
    {
         $rules = array(
             'name' => 'required|alpha_num',
         );

         $validator = Validator::make(Input::all(), $rules);

         if (ClassM::where('name', '=', Input::get('name'))->exists())
         {
             return Response::json(array(

                 'errors' => $validator->getMessageBag()->toArray(),
             ));
         }
         if ($validator->fails()) {
             return Response::json(array(

                 'errors' => $validator->getMessageBag()->toArray(),
             ));
         }
         else {
            $titles=Section::all();
             $myarray=$request->get('sections');

             $data = new ClassM();
             $data->name = $request->input('name');
             $data->save();
           for ($i=0;$i<count($myarray);$i++)
           {
               $secClass=new SecClass();
               $secClass->class_id=$data->id;
               $secClass->section_id = $myarray[$i];
               $secClass->save();
            }
             $sections=SecClass::all();
             }

        return view('addClass',compact('data', 'sections','titles'));
    }

    public function readClass(Request $req)
    {
        $titles=Section::all();
        $data=ClassM::all();
        $sections=SecClass::all();

    /*    $datana = DB::table('classss')
            ->leftJoin('sec_class', 'classss.id', '=', 'sec_class.class_id')
            ->get();*/

      //  $users = \App\ClassM::with('group')->get();
        return view('addClass',compact('data', 'sections','titles'));
    }
    public function editClass(Request $req)
    {
        $rules = array(
            'name' => 'required|alpha_num',
        );

        $validator = Validator::make(Input::all(), $rules);
        if (!Section::where('id', '=', Input::get('section'))->exists() || ClassM::where('name', '=', Input::get('name'))->exists() )
        {
            return Response::json(array(

                'errors' => $validator->getMessageBag()->toArray(),
            ));
        }
        $data = ClassM::find($req->id);
        $data->name = $req->name;

        $data->section_id = Input::get('section') ;
        $data->save();

        return response()->json($data);
    }
    public function deleteClass(Request $req)
    {
        ClassM::find($req->id)->delete();
        SecClass::where('class_id', '=', $req->id)->delete();
        return response()->json();
    }
}
