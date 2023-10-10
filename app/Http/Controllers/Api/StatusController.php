<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    use ApiResponcer;


    function index() {
       
        $data =  Status::all();

        return $this->success($data,'location created');
    }
}
