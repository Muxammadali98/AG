<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    function index(){
        $statuses = Status::all();
        return view('admin.status.index',compact('statuses'));
    }

    function create() {
        return view('admin.status.create');
    }

    function store(Request $request) {
        $this->validate($request,[
            'title'=>'required|unique:statuses,title'
        ],[
            'title.required'=>'Status nomini kiritish majbuiy',
            'title.unique'=>'ushbu status nomi allaqachon yaratilgan'
        ]);

        $status = Status::create($request->all());


        return redirect()->route('status.index');
    }

    function show($id) {
        $status = Status::find($id);
        return view('admin.status.show',compact('status'));
    }

    function edit($id) {
        $status = Status::find($id);
        return view('admin.status.show',compact('status'));
    }

    function update(Request $request, $id) {


        $status = Status::find($id);
        $status->update($request->all());

        return redirect()->route('status.index');

    }

    function destroy($id) {
        Status::destroy($id);

        return redirect()->route('status.index');
    }
}
