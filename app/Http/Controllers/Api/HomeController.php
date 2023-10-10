<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponcer;
    function home() {
        $user = auth()->guard('api')->user();

        return $this->success($user->group,'test');

    }
}
