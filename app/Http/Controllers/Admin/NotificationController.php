<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotificationEvent;
use App\Events\NotifiGroup;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function index(){
        $notifications = Notification::all();
        return view('admin.notification.index',compact('notifications'));
    }

    function create() {

        return view('admin.notification.create');
    }
    function createGroup() {
        $groups = Group::all();

        return view('admin.notification.createGroups', compact('groups'));
    }

    function store(Request $request) {
        $this->validate($request,[
            'text'=>'required'
        ]);

        $notification = Notification::create($request->all());
        $data = [
            'text'=>$notification->text,
            'type'=>$notification->type,
            'date'=>$notification->created_at->format('Y-m-d'),
        ];

        event(new NotificationEvent($data));

        return redirect()->route('notification.index');
    }
    
    function storeGroup(Request $request) {
        
        $this->validate($request,[
            'text'=>'required',
            'group_id'=>'required',
        ]);

        $notification = Notification::create($request->all());

        $data = [
            'text'=>$notification->text,
            'type'=>$request->type,
            'id'=>$request->group_id,
            'date'=>$notification->created_at->format('Y-m-d'),
        ];

        event(new NotifiGroup($data));

        return redirect()->route('notification.index');
    }


    function show($id) {
        $notification = Notification::find($id);
        return view('admin.notification.show',compact('notification'));
    }
    
    function edit($id) {
        $notification = Notification::find($id);
        return view('admin.notification.show',compact('notification'));
    }

    function update(Request $request, $id) {
        $this->validate($request,[
            'title'=>'required',
        ]);

        $notification = Notification::find($id);
        $notification->update($request->all());
  
        return redirect()->route('notification.index');

    }

    function destroy($id) {
        Notification::destroy($id);

        return redirect()->route('notification.index');
    }
}
