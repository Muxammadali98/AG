<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageEvent;
use App\Events\MyEvent;
use App\Events\NotifiAdminEvent;
use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    use ApiResponcer;

    function store(Request $request) {

        $error=Validator::make($request->all(), [
            'text'=>'required',
            'chat_id'=>'int | exists:chats,id'
        ]);

        if($error->fails()){
            return $this->error("", 400, $error->errors());
        }


        $data = $request->all();
        if(!isset($request->chat_id)){
            $user = auth()->guard('api')->user();
            $chat = Chat::where('worker_id',$user->id)->first();
            
            if(!isset($chat->id)){
                $chat = Chat::create(['worker_id'=>$user->id]);
            }
            $data['chat_id'] = $chat->id;
        }

        $chat->message = $chat->message + 1;
        $chat->save();
        
    


        $message = Message::create($data);


        $messages = Message::where('chat_id', $data['chat_id'])->orderBy('id', 'DESC')->get();

        event(new MyEvent($data['chat_id']));
        


        return $this->success($messages, 'add message', 201, );

    }


    function index() {
        
        $worker = auth()->guard('api')->user();

        // $chat = $chat->whereDate('created_at', '>=', now()->subDays(30));

        $data = $worker->chat->messages->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        

        return $this->success($data);
    }


    function destroy($id) {
        Message::destroy($id);
        return true;
    }



}
