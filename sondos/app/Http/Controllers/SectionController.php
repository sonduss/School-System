<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;

class SectionController extends Controller
{


    public function addSection(Request $request)
    {
        $rules = array(
            'name' => 'required|alpha_num',
        );

        $validator = Validator::make(Input::all(), $rules);

        if (Section::where('name', '=', Input::get('name'))->exists())
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
            $data = new Section();
            $data->name = $request->name;
            $data->save();

            return response()->json($data);
        }
    }
    public function readSection(Request $req)
    {
        $data = Section::all();

        return view('section')->withData($data);
    }
    public function editSection(Request $req)
    {
        $data = Section::find($req->id);

        $data->name = $req->name;
        $data->save();

        return response()->json($data);
    }
    public function deleteSection(Request $req)
    {
        Section::find($req->id)->delete();

        return response()->json();
    }

}
