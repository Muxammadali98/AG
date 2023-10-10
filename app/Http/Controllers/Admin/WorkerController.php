<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Group;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    function index(){
        $workers = Worker::where('status','!=' ,0)->get();
        return view('admin.worker.index',compact('workers'));
    }
    function moderation(){
        $workers = Worker::where('status', 0)->get();
        return view('admin.worker.moderation',compact('workers'));
    }

    function create() {
        $workers = City::all();
        $cities = City::all();
        return view('admin.worker.create',compact('workers','cities'));
    }

    function store(Request $request) {
        $this->validate($request,[
            'name'=>'required',
            'username'=>'required | unique:workers,username',
            'surname'=>'required',
            'phone'=>"unique:workers,phone|digits:12|numeric",
            'address'=>'required',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
            'city_id'=>'required| int | exists:cities,id',
        ],[
            'name.required'=>"Ism mayronini to'ldirish majburiy",
            'username.required'=>"Foydalanuvchi ismi maydonini to'ldirish majburiy",
            'username.unique'=>"Foydalanuvchi ismi allaqachon yaratilgan",
            'surname.required'=>"Faminya maydonini to'ldirish majburiy",
            'phone.unique'=>"Telefon raqam maydonini to'ldirish majburiy",
            'phone.digits:12'=>"Telefon raqam maydoniniga 12 ta belgi kiritish kerak",
            'phone.numeric'=>"Telefon raqam maydoni raqamlardam tashkil topishi kerak",
            'address.required'=>"Manzil maydonini to'ldirish majburiy",
            'password.required'=>"Parol maydonini to'ldirish majburiy",
            'confirm_password.required'=>"Prolni tasdilqsh maydonini to'ldirish majburiy",
            'confirm_password.confirm_password'=>"Parol tasdiqlanmadi iltimos tekshirib ko'ring",
            'city_id.required'=>"Shaharni tanlash majburiy",
        ]);

        $data = $request->all();

        if(isset($request->image)){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;

        }

        $data['password'] = Hash::make($request->password);
        $data['status']=true;
        Worker::create($data);
        return redirect()->route('worker.index');
    }

    function show($id) {
        $worker = Worker::find($id);
        $groups = Group::all();
        $cities = City::all();
        return view('admin.worker.show',compact('worker', 'groups', 'cities'));
    }

    function edit($id) {
        $worker = Worker::find($id);
        return view('admin.worker.edit',compact('worker'));
    }

    function update(Request $request, $id) {
        $this->validate($request,[
            'name'=>'required',
            'username'=>'required | unique:workers,username,'.$id,
            'surname'=>'required',
            'address'=>'required',
            'phone'=>'digits:12|numeric',
            'city_id'=>'required| int | exists:cities,id',
        ],
        [
            'name.required'=>"Ism mayronini to'ldirish majburiy",
            'username.required'=>"Foydalanuvchi ismi maydonini to'ldirish majburiy",
            'username.unique'=>"Foydalanuvchi ismi allaqachon yaratilgan",
            'surname.required'=>"Faminya maydonini to'ldirish majburiy",
            'phone.unique'=>"Telefon raqam maydonini to'ldirish majburiy",
            'phone.digits:12'=>"Telefon raqam maydoniniga 12 ta belgi kiritish kerak",
            'phone.numeric'=>"Telefon raqam maydoni raqamlardam tashkil topishi kerak",
            'address.required'=>"Manzil maydonini to'ldirish majburiy",
            'city_id.required'=>"Shaharni tanlash majburiy",
        ]);
        $worker = Worker::find($id);

        $data = $request->all();

        if(isset($request->image)){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;

        }else{
            $data['image'] = $worker->image;
        }
        if(empty($request->password)){
            $data['password']=$worker->password;
        }

        $worker->update($data);
        return redirect()->route('worker.index');

    }

    function destroy($id) {
        Worker::destroy($id);
        return redirect()->route('worker.index');
    }
}
