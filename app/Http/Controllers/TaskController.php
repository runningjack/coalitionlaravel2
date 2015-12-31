<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    //
    public function index()
    {
        //
        return View("taskmanager.index",['tasks'=>Task::all(),'title'=>'Task Listing']);
    }

    public function store(Request $request)
    {
        //


        $all_request = $request->all();
        array_forget($all_request,"_token");

        $task = new Task();
        foreach($all_request as $key=>$value){
            $task->$key = $value;
        }
        $task->save();
        $tasks = Task::all();
        if($request->ajax()){
            return response()->json("record saved successfully");

        }
        return View("taskmanager.index",['tasks'=>$tasks,'title'=>'Tasks']);
    }

    public function update(Request $request, $id)
    {


        array_forget($request,"_token");
        $all_request = $request->all();
        $task = Task::find($id);
        foreach($all_request as $key=>$value){
            /*
             * remove all underscore contained
             * in the edit form field
             */
            $key = preg_replace("/^_/","",$key);
            $task->$key = $value;
        }
        if($task->update()){
            \Session::flash("success_message","Task Successfully Updated");
        }else{
            \Session::flash("error_message","Unexpected Error Task could not be updated");
        }
        $tasks = Task::all();
        if($request->ajax()){

            response()->json("Task Successfully Updated");
            exit;
            // return \Redirect::back();
        }
        return View("taskmanager.index",['tasks'=>$tasks,'title'=>'Tasks']);
    }
}
