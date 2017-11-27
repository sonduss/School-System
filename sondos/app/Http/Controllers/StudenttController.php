<?php

namespace App\Http\Controllers;
use App\ClassStudent;
use App\parennt;
use App\SectionStudent;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Studentt;
use App\ClassM;
use App\Section;

class StudenttController extends Controller
{
    public function addstudent(Request $request)
    {

        $student = new Studentt();
        $parentt=new parennt();
        $tit = new ClassStudent();
        $da = new SectionStudent();
        $titles = Section::all();
        $data = ClassM::all();

        if ($request->isMethod('post')) {

            $student->email = $request->input('email');
            $student->gender = $request->input('gender');
            $password = $request->input('password');
            $student->password = Hash::make($password);

            $file = Input::file('file');
            $filename = $file->getClientOriginalName();
            $student->image = url($filename);

            $student->nationality=$request->input('nationality');
            $student->phone=$request->input('phone');
            $student->religon=$request->input('religon');
            $student->fee_dis=$request->input('fee_dis');
            $student->address=$request->input('address');
            $student->dateofbirth=$request->input('dateofbirth');
            $student->fname=$request->input('fname');
            $student->lname=$request->input('lname');

            $student->father_id_card=$request->input('father_id_card');
            $student->father_name=$request->input('father_name');


            $student->father_occu=$request->input('father_occu');
            $student->father_phone=$request->input('father_phone');

            $student->mother_id_card=$request->input('mother_id_card');
            $student->mother_name=$request->input('mother_name');
            $student->prevschool=$request->input('prevschool');
            $student->mother_occu=$request->input('mother_occu');
            $student->mother_phone=$request->input('mother_phone');
            $student->gurd_name=$request->input('gurd_name');
            $student->gurd_relation=$request->input('gurd_relation');
            $student->gurd_phone=$request->input('gurd_phone');
            $student->gurd_address=$request->input('gurd_address');
            $student->gurd_id_card=$request->input('gurd_id_card');
            $student->gurd_ocuup=$request->input('gurd_ocuup');

            $student->guardian_is = $request->input('guardian_is');

            $student->save();
            $tit->classs_id = $request->input('classs_id');
            $da->section_id = $request->input('section_id');
            $tit->student_id = $student->id;
            $da->student_id = $student->id;
            $da->save();
            $tit->save();
        }

        return view('addStudent', compact('student', 'data', 'titles', 'tit', 'da'));

    }

}








