<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\Group;
use App\Models\Status;
use App\Models\Task;
use App\Models\Worker;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function index(){
        $clients = Client::all();
        $tasks = Task::all();
        $companies = Company::all();
        $groups = Group::all();
        $statuses = Status::all();
        return view('admin.client.index',compact('statuses','clients','tasks', 'companies', 'groups'));
    }

    function create() {
        $statuses = Status::all();
        $workers = Worker::all();
        $tasks = Task::where('status', false)->get();
        return view('admin.client.create',compact('statuses',  'workers','tasks'));
    }

    function store(Request $request) {
        $this->validate($request,[
            'title'=>'required',
            'phone'=>'required|digits:12|numeric',
            'status_id'=>'required | int | exists:statuses,id',
            'comment'=>'required',
            'worker_id'=>'required | int | exists:workers,id',
            'task_id'=>'required | int | exists:tasks,id'
        ],
        [
            'title.required'=>"Mijoz nomini kiritish majburiy",
            'comment.required'=>"Mijozga izoh qoldirish majburiy",
            'status.required'=>"Holatni tanlash majburiy",
            'phone.required'=>"Telefon raqam kiritish majburiy",
            'worker_id.required'=>"Hodimni kiritish majburiy",
            'ttask_id.required'=>"Topshiriq kiritish majburiy",
            'phone.digits'=>"Telefon raqam 12 ta belgidan iborat bolishi majburiy",
        ]);

        $user = Worker::find($request->worker_id);
        $data = $request->all();
        $data['group_id']=$user->group_id;
        $client = Client::create($data);



        return redirect()->route('client.index');
    }

    function show($id) {
        $client = Client::find($id);
        return view('admin.client.show',compact('client'));
    }

    function edit($id) {
        $client = Client::find($id);
        $status = Status::all();
        $workers = Worker::all();
        return view('admin.client.show',compact('status','client', 'workers'));
    }

    function update(Request $request, $id) {


        $client = Client::find($id);
        $data = $request->all();
        $client->update($data);

        return redirect()->route('client.index');

    }

    function destroy($id) {
        Client::destroy($id);

        return redirect()->route('client.index');
    }
}
