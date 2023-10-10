<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Task;

class TaskController extends Controller
{
    use ApiResponcer;


    function index($id) {
       
        $data =  Task::with(['company','images', 'locations', 'clients'])->find($id);

        return $this->success($data,'tasks');
    }

    function changeStatus($id) {

        $task = Task::find($id);
        $task->status = true;
        $task->save();
        Company::find($task->company_id)->update(['come'=>time ()]);
        $user = auth()->guard('api')->user();

        return $this->success($user->group,'test');


    }
    
}
