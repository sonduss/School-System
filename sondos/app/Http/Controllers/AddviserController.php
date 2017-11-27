<?php

namespace App\Http\Controllers;

use App\Addviser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Response;
use Validator;


class AddviserController extends Controller
{
    public function addadviser(Request $request)
    {

        $rules = array(
            'name' => 'required|alpha_num',
        );

        $validator = Validator::make(Input::all(), $rules);

        if (Addviser::where('name', '=', Input::get('name'))->exists()) {
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
            $data = new Addviser();
            $data->name = $request->input('name');
            $data->identity = $request->input('identity');
            $data->phone = $request->input('phone');
            $data->address = $request->input('address');
            $data->email = $request->input('email');
            $password = $request->input('password');
            $data->password = Hash::make($password);
            $data->gender = $request->input('gender');
            $data->dateofbirth = $request->input('dateofbirth');
            $data->save();
        }
        return view('addAdviser',compact('data'));

    }
    public function readadviser(Request $req)
    {

        $data = Addviser::all();


        return view('addAdviser',compact('data'));

    }
    public function editadviser(Request $req)
    {

        $data = Addviser::find($req->id);

        $data->name = $req->name;
        $data->save();

        return response()->json($data);
    }
    public function deleteadviser(Request $req)
    {
        Addviser::find($req->id)->delete();

        //  T::where('class_id', '=', $req->id)->delete();

        return response()->json();
    }
}









