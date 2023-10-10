<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskLocationController extends Controller
{
    use ApiResponcer;
    function addlocation(Request $request) {
        $data = Validator::make($request->all(),[
            'longitude'=>'required',
            'latitude'=>'required',
            'address'=>'required',
            'worker_id'=>'required| int | exists:workers,id',
            'task_id'=>'required| int | exists:tasks,id'
        ]);

        if($data->fails()){
            return $this->error('validation', 400, $data->errors());
        }


        TaskLocation::create($request->all());


        $data =  Task::with(['company','images', 'locations', 'clients'])->find($request->task_id);


        return $this->success($data,'location created');
    }
}
