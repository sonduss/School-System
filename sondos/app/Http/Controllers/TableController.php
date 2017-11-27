<?php

namespace App\Http\Controllers;

use App\ClassM;
use App\Course;
use App\Data;
use App\Section;
use App\TableModel;
use App\TeacherTable;
use App\Teecher;
use Illuminate\Http\Request;
use Session;

class TableController extends Controller
{
    public function readTableM(Request $req)
    {
       $classs=ClassM::all();
        $sec=Section::all();

        return View('generate',compact('classs','sec'));


    }


    public function showTableM(Request $req)
    {
        $classs=ClassM::all();
        $sec=Section::all();

        return View('classTimetable',compact('classs','sec'));


    }

    public function readTable(Request $req)
    {

        $data=Course::where([['class_id','=',$req->input('class_id')],['section_id','=',$req->input('section_id')]])->get();
        $classs=ClassM::where('id','=',$req->input('class_id'))->get();

        $teacher=Teecher::all();
        $subjects=Data::all();

        return View('timeTable',compact('data','teacher','subjects','classs'));

    }

    public function addTable(Request $req)
    {

       $c_id=$req->input('r1c1');
       if($req->input('r1c1')==0){

           $data=Course::where([['class_id','=',$req->input('class_id')],['section_id','=',$req->input('section_id')]])->get();
           $classs=ClassM::where('id','=',$req->input('class_id'))->get();

           $teacher=Teecher::all();
           $subjects=Data::all();
           return View('timeTable',compact('data','teacher','subjects','classs'));
       }

        $mycourse =Course::where('id','=',$req->input('r1c1'))->get();
       // Session::flash('msg', 'Thanks for voting');

        foreach ($mycourse as $k) {
            if ($k->id==$c_id) {
                $c = $k->class_id;
            }
        }

       $myarray= array(
            array($req->input('r1c1'),$req->input('r1c2'),$req->input('r1c3'),$req->input('r1c4'),$req->input('r1c5'),$req->input('r1c6'),$req->input('r1c7')),
            array($req->input('r2c1'),$req->input('r2c2'),$req->input('r2c3'),$req->input('r2c4'),$req->input('r2c5'),$req->input('r2c6'),$req->input('r2c7')),
            array($req->input('r3c1'),$req->input('r3c2'),$req->input('r3c3'),$req->input('r3c4'),$req->input('r3c5'),$req->input('r3c6'),$req->input('r3c7')),
            array($req->input('r4c1'),$req->input('r4c2'),$req->input('r4c3'),$req->input('r4c4'),$req->input('r4c5'),$req->input('r4c6'),$req->input('r4c7')),
            array($req->input('r5c1'),$req->input('r5c2'),$req->input('r5c3'),$req->input('r5c4'),$req->input('r5c5'),$req->input('r5c6'),$req->input('r5c7'))
            );
        for($i=0;$i<5;$i++){
            for($j=0;$j<7;$j++){
                $t=new TableModel();
                $t->class_id=$c;
                $t->row=$i;
                $t->column=$j;
                $t->course_id=$myarray[$i][$j];
                $t->save();

                $myc =Course::where('id','=',$myarray[$i][$j])->get();
                foreach ($myc as $k) {
                        $cc = $k->teacher_id;
                }

$teacherTable=TeacherTable::where('teacher_id','=',$cc)->get();
                foreach($teacherTable as $tt1){
                    if($tt1->row == $i && $tt1->column== $j){
                        $tt1->course_id=$myarray[$i][$j];
                        $tt1->save();
                    }

                }

                    }
            }


        $classs=ClassM::all();
        $sec=Section::all();

        return View('generate',compact('classs','sec','msg'));

    }

    public function showMyTable(Request $req)
    {
        $array1=TableModel::orderBy('row')
            ->orderBy('column')->where([['class_id','=',$req->input('class_id')],['row','=',0]])->get();
        $array2=TableModel::orderBy('row')
            ->orderBy('column')->where([['class_id','=',$req->input('class_id')],['row','=',1]])->get();
        $array3=TableModel::orderBy('row')
            ->orderBy('column')->where([['class_id','=',$req->input('class_id')],['row','=',2]])->get();
        $array4=TableModel::orderBy('row')
            ->orderBy('column')->where([['class_id','=',$req->input('class_id')],['row','=',3]])->get();
        $array5=TableModel::orderBy('row')
            ->orderBy('column')->where([['class_id','=',$req->input('class_id')],['row','=',4]])->get();

        $classs=ClassM::where('id','=',$req->input('class_id'))->get();
        $data=Course::where([['class_id','=',$req->input('class_id')],['section_id','=',$req->input('section_id')]])->get();
        $subjects=Data::all();
        return View('showTable',compact('data','classs','subjects','array1','array2','array3','array4','array5'));

    }
    public function showTeacher(Request $req){

       $teacher=Teecher::all();
        return View('searchTeacher',compact('teacher'));


    }

    public function teacherTable(Request $req){

        $array1=TeacherTable::orderBy('row')
            ->orderBy('column')->where([['teacher_id','=',$req->input('class_id')],['row','=',0]])->get();
        $array2=TeacherTable::orderBy('row')
            ->orderBy('column')->where([['teacher_id','=',$req->input('class_id')],['row','=',1]])->get();
        $array3=TeacherTable::orderBy('row')
            ->orderBy('column')->where([['teacher_id','=',$req->input('class_id')],['row','=',2]])->get();
        $array4=TeacherTable::orderBy('row')
            ->orderBy('column')->where([['teacher_id','=',$req->input('class_id')],['row','=',3]])->get();
        $array5=TeacherTable::orderBy('row')
            ->orderBy('column')->where([['teacher_id','=',$req->input('class_id')],['row','=',4]])->get();



        $classs=ClassM::all();
        $data=Course::where([['teacher_id','=',$req->input('class_id')]])->get();

        $tt=Teecher::all();
        $teacher=Teecher::where('id','=',$req->input('class_id'))->get();
        return View('teacherTable',compact('data','classs','teacher','tt','array1','array2','array3','array4','array5'));


    }

}
