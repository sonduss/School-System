<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function statusTask()
    {
        $task = Task::find(Input::get('idTask'));
        if (Input::get('checkboxStatus') == 1)
        {
            $task->busy = true;
            $task->save();
        }
        else
        {
            $task->busy = false;
            $task->save();
        }
    }
}
