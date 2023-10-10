<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Task;
use App\Models\Worker;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    function index(){
        $groups = Group::all();
        return view('admin.group.index',compact('groups'));
    }

    function create() {
        $workers = Worker::where('group_id', null)->get();
        return view('admin.group.create',compact('workers'));
    }

    function store(Request $request) {
        $this->validate($request,[
            'title'=>'required|unique:groups,title',
            'workers'=>'array'
        ],
        [
            'title.required'=>"Guruh nomini kiritish majburiy",
            'title.unique'=>"Ushbu guruh nomi allaqachon yaratilgan",
        ]);

        $group = Group::create($request->all());

        if(!empty($request->workers)){
            Worker::whereIn('id',$request->workers)->update(['group_id'=>$group->id]);
        }

        return redirect()->route('group.index');
    }

    function show($id) {
        $group = Group::find($id);
        return view('admin.group.show',compact('group'));
    }

    function edit($id) {
        $group = Group::with('workers')->find($id);
        $workers = Worker::where('group_id', null)->get();
        return view('admin.group.show',compact('group', 'workers'));
    }

    function update(Request $request, $id) {


        $group = Group::find($id);
        $group->update($request->all());
        Worker::where('group_id',$id)->update(['group_id'=>null]);
        if(!empty($request->workers)){
            Worker::whereIn('id',$request->workers)->update(['group_id'=>$id]);
        }
        return redirect()->route('group.index');

    }

    function destroy($id) {
        Worker::where('group_id',$id)->update(['group_id'=>null]);
        Task::where('group_id', $id)->delete();
        Group::destroy($id);

        return redirect()->route('group.index');
    }



}
