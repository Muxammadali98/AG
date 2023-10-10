<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\Group;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    function filtertask(Request $request) {

        $companies = Company::all();
        $groups = Group::all();
        $tasks  =  Task::query();

        if(isset($request->status_id)){
           $tasks = $tasks->where('status',$request->status_id);
        }

        if(!empty($request->company_id)){
            $tasks = $tasks->where('company_id',$request->company_id);
        }

        if(!empty($request->group_id)){
            $tasks = $tasks->where('group_id',$request->group_id);
        }

        $tasks = $tasks->get();

        return view('admin.task.index', compact('tasks', 'companies','groups'));
    }

    function filterClient(Request $request) {

        $statuses = Status::all();
        $groups = Group::all();
        $clients  =  Client::query();
        


        if(isset($request->status_id)){
            $clients = $clients->where('status_id',$request->status_id);
         }
 
       
 
         if(!empty($request->group_id)){
             $clients = $clients->where('group_id',$request->group_id);
         }
 
         $clients = $clients->get();
 
         return view('admin.client.index', compact('clients', 'statuses','groups'));
     }
}

