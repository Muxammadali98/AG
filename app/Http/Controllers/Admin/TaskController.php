<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskEvent;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\Group;
use App\Models\Task;
use App\Models\Worker;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function index(){
        $tasks = Task::all();
        $companies = Company::all();
        $groups = Group::all();
        return view('admin.task.index',compact('tasks','companies', 'groups'));
    }

    function create() {
        $companies = Company::orderBy('come', 'DESC')->get();
        $groups = Group::all();
        return view('admin.task.create', compact('groups','companies'));
    }

    function store(Request $request) {
        $this->validate($request,[
            'company_id'=>'required| int | exists:companies,id',
            'group_id'=>'required| int | exists:groups,id',
            'date'=>'required'
        ],[
            "date.required"=>"Sana kiristish majburiy"
        ]);

        $task = Task::create($request->all());
        $data = [
            'id'=>$task->group_id,
            'company'=>$task->company,
            'date'=>$task->date
        ];
        event(new TaskEvent($data));
        return redirect()->route('task.index');
    }

    function show($id) {
        $task = Task::find($id);
        return view('admin.task.show',compact('task'));
    }

    function edit($id) {
        $task = Task::find($id);
        $companies = Company::all();
        $groups = Group::all();
        return view('admin.task.show',compact('task','companies','groups'));
    }

    function update(Request $request, $id) {
        $this->validate($request,[
            'company_id'=>'required| int | exists:companies,id',
            'group_id'=>'required| int | exists:groups,id',
            'date'=>'required'
        ]);

        $task = Task::find($id);
        $data = $request->all();


        if(empty($request->status)){
            $task->timestamps = false;
            $data['status'] = false;
        }else{
          Company::find($request->company_id)->update(['come'=>time()]);

        }
        $task->update($data);
        return redirect()->route('task.index');
    }

    function destroy($id) {
        Task::destroy($id);
        return redirect()->route('task.index');
    }
}
