<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class TaskImageController extends Controller
{

    use ApiResponcer;
    function addimages(Request $request) {

        $data = Validator::make($request->all(),[
            'images'=>'required',
            'worker_id'=>'required| int | exists:workers,id',
            'task_id'=>'required| int | exists:tasks,id'
        ]);

        if($data->fails()){
            return $this->error('validation', 400, $data->errors());
        }

        

        $data = $request->all();


       
   
        

        if(isset($request->images)){

            Log::info(count($request->images));

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

                
                $data['image']=$imageName;
                TaskImage::create($data);
            }
    
        }


        $data =  Task::with(['company','images', 'locations', 'clients'])->find($request->task_id);

        return $this->success($data,'image created');
    }
}
