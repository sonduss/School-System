<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use App\Nablusschool;
use Illuminate\Http\Request;

class NablusschoolController extends Controller
{
    public  function schoolName(Request $req){
        $titles=Nablusschool::all();
        return View('loginn',compact('titles'));

    }
    public function findAdminName(Request $request){

        $my_id=Input::get('id');
        $s_name=Nablusschool::where('id', '=', $my_id)->first();

        foreach ($s_name as $s){
            if($s->id == $my_id ){
                $nammm=$s->admin_username;
            }
        }
        $data=DB::table('nablusschools')->select('name','id')->where('admin_username',$nammm)->get();

        //  $data=DB::table('teachers')->select('name','id')->where('specialize',$s_name)->get();
        return response()->json($data);//then sent this data to ajax success
    }
}
