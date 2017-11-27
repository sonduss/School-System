<?php

namespace app\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;
use App\Data;



class IndexController extends Controller
{
    public function addItem(Request $request)
    {
        $rules = array(
            'name' => 'required|alpha_num',
        );

        $validator = Validator::make(Input::all(), $rules);
        if (Data::where('subject_code', '=', Input::get('subject_code'))->where('name', '=', Input::get('name'))->exists() ) {
            return Response::json(array(

                'errors' => $validator->getMessageBag()->toArray(),
            ));
        }
        if (Data::where('subject_code', '=', Input::get('subject_code'))->exists())
        {
            return Response::json(array(

                'errors' => $validator->getMessageBag()->toArray(),
            ));
        }
        if (Data::where('name', '=', Input::get('name'))->exists())
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
            $data = new Data();
            $data->name = $request->name;
            $data->subject_code = $request->subject_code;
            $data->total_lecture = $request->total_lecture;

            $data->save();

            return response()->json($data);
        }
    }
    public function readItems(Request $req)
    {
        $data = Data::all();

        return view('welcome')->withData($data);
    }
    public function editItem(Request $req)
    {
        $data = Data::find($req->id);

        $data->name = $req->name;
        $data->subject_code = $req->subject_code;
        $data->total_lecture = $req->total_lecture;

        $data->save();

        return response()->json($data);
    }
    public function deleteItem(Request $req)
    {
        Data::find($req->id)->delete();

        return response()->json();
    }
}
