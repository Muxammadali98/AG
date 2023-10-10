<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\PersonalAccessTokenResult;

class WorkerController extends Controller
{
    use ApiResponcer;


    public function login(Request $request)
    {
        $data=Validator::make($request->all(), [
            
            'password'=>'required',
            'username'=>'required',
        ]);
        
        if($data->fails()){
            return $this->error("", 400, $data->errors());
        }
     
        if(auth()->guard('user')->attempt(['username'=>$request->username, 'password'=>$request->password])){

            $user=auth()->guard('user')->user();
            
            
           $token = $user->createToken('Monitoring')->accessToken;
            return $this->success(['user'=>$user, 'token'=>$token], "", 201);  
        }else{
            return $this->error("" , 400, 'parol xato');
        }
    }

    public function register(Request $request)     
    {

        $data=Validator::make($request->all(), [
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
            'name'=>'required',
            'username'=>'required | unique:workers,username',
            'phone'=>'required | unique:workers,phone',
            'surname'=>'required',
            'address'=>'required',
            'city_id'=>'required| int | exists:cities,id',
        ]);
        
        if($data->fails()){
            return $this->error("", 400, $data->errors());
        }


        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        
        if(isset($request->image)){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
    
        }



        $user = Worker::create($data);

        $token = $user->createToken('CRM')->accessToken;

        return $this->success($token,'user created', 201);

    }

    function show(){

        $user = auth()->guard('api')->user();

        $user->tasks = Task::where('group_id',$user->group_id)->get();

        return $this->success($user,'your infos');
        
    }

    function update(Request $request, $id) {

        $worker = Worker::find($id);
        $data = $request->all();

        $error=Validator::make($request->all(), [
            'username'=>'unique:workers,username,'.$id,
            'phone'=>'unique:workers,phone,'.$id,
            'city_id'=>'int | exists:cities,id',
        ]);

        if(isset($request->password)){
            $error=Validator::make($request->all(), [
                'old_password' => 'required',
                'confirm_password' => 'required',
                'password' => 'same:confirm_password',
            ]);

            if($error->fails()){
                return $this->error("", 400, $error->errors());
            }

            if(Hash::check($request->old_password , $worker->password) ){
                $data['password'] = Hash::make($request->password);
            }else{
                return $this->error('parol xato', 401);
            }
            
        }
        
        if($error->fails()){
            return $this->error("", 400, $error->errors());
        }

        if(isset($request->image)){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }else{
            $data['image'] = $worker->image;
        }

        $data['status'] = $worker->status;
        $data['job_title'] = $worker->job_title;

        $worker->update($data);

        return $this->success($worker, '',200);

    }
}
