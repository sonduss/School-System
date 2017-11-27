<?php

namespace app\Http\Controllers;
use App\Http\Controllers\Controller;
use App\TeacherTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use Response;
use Validator;
use App\Teecher;


class TeecherController extends Controller
{
    public function addteacher(Request $request)
    {
        $rules = array(
            'name' => 'required|alpha_num',
        );

        $validator = Validator::make(Input::all(), $rules);

        if (Teecher::where('name', '=', Input::get('name'))->exists())
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
            $data = new Teecher();
            $data->name = $request->input('name');
            $data->idinti = $request->input('idinti');
            $data->specialize=$request->input('specialize');
            $data->phone=$request->input('phone');
            $data->address=$request->input('address');
            $data->email=$request->input('email');
            $data->gender=$request->input('gender');
            $password = $request->input('password');
            $data->password = Hash::make($password);
            $data->dateBirth=$request->input('dateBirth');
            $data->save();


            for ($i = 0; $i < 5; $i++) {
                for ($j = 0; $j < 7; $j++) {
                    $tt = new TeacherTable();
                    $tt->row = $i;
                    $tt->column = $j;
                    $tt->course_id = 0;

                    $tt->teacher_id = $data->id;
                    $tt->save();

                }
            }


        }



        return view('teecher',compact('data'));
    }

    public function readteacher(Request $req)
    {

        $data = Teecher::all();


        return view('teecher',compact('data'));
    }
    public function editteacher(Request $req)
    {

        $data = Teecher::find($req->id);

        $data->name = $req->name;
        $data->save();

        return response()->json($data);
    }
    public function deleteteacher(Request $req)
    {
        Teecher::find($req->id)->delete();

        //  T::where('class_id', '=', $req->id)->delete();

        return response()->json();
    }
}
