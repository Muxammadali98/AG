<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use ApiResponcer;

    function store(Request $request) {

        $this->validate($request,[
            'title'=>'required',
            'phone'=>'required',
            'status_id'=>'required| int | exists:statuses,id',
            'task_id'=>'required| int | exists:tasks,id',
            'comment'=>'required',
        ]);
        $user = auth()->guard('api')->user();

        $data = $request->all();
        $data['worker_id'] = $user->id;
        $data['group_id'] = $user->group_id;
        $client = Client::create($data);

        return $this->success($client,'client created');

    }
}
