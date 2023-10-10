<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiResponcer;
    function index(){
        $cities = City::all();
        return $this->success($cities,' regions)');
    }
}
