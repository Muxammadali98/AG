<?php   

namespace App\Http\Livewire;

use App\Events\MessageEvent;
use App\Events\NotifiAdminEvent;
use App\Models\Chat;
use App\Models\Message as ModelsMessage;
use Livewire\Component;

class Message extends Component
{

    public $chats;
    public $messages;
    public $chatId;
    public $text;
    public $user_id;

    public $chat;
    

    protected $listeners = [
        'eventCreated' => 'handleMessage',
        'eventChat' => 'changeChat',
        'notifiNull' => 'changeChat',
    ];



    public function getMessage($id) {

      
        $this->chatId = $id;
        $chat = $this->chats->where('id',$id)->first();
        if(isset($chat->message)){
            $chat->message = null;
            $chat->timestamps = false;
            $chat->save();
        } 
        $this->messages = ModelsMessage::where('chat_id', $id)->get();
        $this->emit('eventChat');
         event(new NotifiAdminEvent());
    }








    public function mount()
    {
        $this->chats = Chat::whereNull('user_id')->orWhere('user_id',auth()->id())->orderBy('updated_at', 'DESC')->get(); 
        if (isset($_GET['id'])) {

            $this->getMessage($_GET['id']);
        }
    }
    public function changeChat()
    {
        $this->chats = Chat::whereNull('user_id')->orWhere('user_id',auth()->id())->orderBy('updated_at', 'DESC')->get(); 
    }


    public function handleMessage($id)
    {   
        
        if($id['data'] == $this->chatId){
            Chat::where('id',$this->chatId)->update(['message'=>null]);
            
            $this->chats = Chat::whereNull('user_id')->orWhere('user_id',auth()->id())->orderBy('updated_at', 'DESC')->get(); 

            $this->messages = ModelsMessage::where('chat_id', $this->chatId)->with('chat')->get();
              
            $this->emit('eventChat');
        }else{

            $this->chats = Chat::whereNull('user_id')->orWhere('user_id',auth()->id())->orderBy('updated_at', 'DESC')->get(); 

        }
    }


    public function addMessage(){

        $text = $this->text;
        $user_id = auth()->user()->id; 

        $message =  ModelsMessage::create([
            'text' => $this->text,
            'user_id' => auth()->user()->id,
            'chat_id' => $this->chatId,
        ]);

        $this->messages = ModelsMessage::where('chat_id', $this->chatId)->with('chat')->get();

        Chat::where('id',$this->chatId)->update(['user_id'=>auth()->id()]);
        event(new MessageEvent($message));
        $this->emit('eventChat');
        $this->text = '';
    }


    public function render()
    {
        return view('livewire.message');
    }
    
}
