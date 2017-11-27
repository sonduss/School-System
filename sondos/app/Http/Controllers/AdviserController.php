<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Addviser;
class AdviserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:adviser');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adviser');
    }
    public function readadviser(Request $req)
    {

    $data = Addviser::all();
$rr=array('data'=>$data);
return view('adviser',$rr );

    }

}
