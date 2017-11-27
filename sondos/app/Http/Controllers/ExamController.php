<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamClasss;
use App\ExamSection;
use App\Section;
use App\ClassM;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function insertExam(Request $request){

        $exam = new Exam();
        $tit = new ExamSection();
        $da = new ExamClasss();
        $titles = Section::all();
        $data = ClassM::all();
        if ($request->isMethod('post')) {
            $exam->name = $request->input('name');
            $exam->datee = $request->input('datee');
            $exam->notes=$request->input('notes');
            $exam->save();
            $tit->section_id = $request->input('section_id');
            $da->classs_id = $request->input('classs_id');
            $tit->exam_id = $exam->id;
            $da->exam_id = $exam->id;
            $da->save();
            $tit->save();
        }

        return view('addExam', compact('exam', 'data', 'titles', 'tit', 'da'));

    }


    public function showExam(Request $req){
        $class=ClassM::all();
        $section = Section::all();
        return view('examList', compact('class', 'section'));


    }




}

