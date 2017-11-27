<?php

namespace App\Http\Controllers;

use App\Addmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;


class AddminController extends Controller
{
    public function addadmin(Request $request)
    {


        $addmin = new Addmin();

        if ($request->isMethod('post')) {

            $addmin->name = $request->input('name');
            $addmin->email = $request->input('email');
            $password = $request->input('password');
            $addmin->password = Hash::make($password);
            $addmin->save();
        }

        return view('addAdmin', compact('addmin'));

    }

}
