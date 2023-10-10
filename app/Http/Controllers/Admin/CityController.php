<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    function index(){
        $cities = City::all();
        return view('admin.city.index',compact('cities'));
    }

    function create() {
        return view('admin.city.create');
    }

    function store(Request $request) {
        $this->validate($request,[
            'name'=>'required|unique:cities,name'
        ],[
            'name.required'=>"Shahar nomini kiritish majburiy ",
            'name.unique'=>"Shahar nomi allaqachon kiritilgan "
        ]);

        $city = City::create($request->all());

        return redirect()->route('city.index');
    }

    function show($id) {
        $city = City::find($id);
        return view('admin.city.show',compact('city'));
    }

    function edit($id) {
        $city = City::find($id);
        return view('admin.city.show',compact('city'));
    }

    function update(Request $request, $id) {


        $city = City::find($id);
        $city->update($request->all());

        return redirect()->route('city.index');

    }

    function destroy($id) {
        City::destroy($id);

        return redirect()->route('city.index');
    }


}
