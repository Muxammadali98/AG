<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Image;
use App\Models\Task;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    use ApiResponcer;



    function index() {
       
        $user = auth()->guard('api')->user();

        $data =  Task::with(['company'])->where('status',0)->where('group_id',$user->group_id)->get();


        return $this->success($data,'tasks');
    }


    function store(Request $request) {
        $this->validate($request,[
            'title'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
            'address'=>'required',

     
        ]);


        $company = Company::create($request->all());

        if(isset($request->images)){

            foreach($request->images as $base64Image){
        
                // $base64Image = "data:image/png;base64,".$base64Image; 
                // list($type, $base64Data) = explode(';', $base64Image);
                // list(, $base64Data) = explode(',', $base64Data);
                // $imageData = base64_decode($base64Data);
                // $filename = uniqid() . '.png';
                // file_put_contents(public_path('images'). '/'. $filename, $imageData);

                $imageName = time().'.'.$base64Image->getClientOriginalName();
                $base64Image->move(public_path('images'), $imageName);
                $data['image'] = $imageName;

                Image::create(['image'=>$imageName, 'company_id'=>$company->id]);
            }
    
        }
        $user = auth()->guard('api')->user();



        Task::create([
            'company_id'=>$company->id,
            'group_id'=>$user->group_id,
            'date'=>date('Y-m-d'),
        ]);



 

        
        $data = $user->group->tasks->where('status',null);
        
        return $this->success($data ,'client created', 201);;
    }
}
