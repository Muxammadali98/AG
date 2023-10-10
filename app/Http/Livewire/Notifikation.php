<?php

namespace App\Http\Livewire;

use App\Events\NotifiAdminEvent;
use App\Models\Chat;
use Livewire\Component;

class Notifikation extends Component
{   
    public $notifi;
    public $count;

    


    
    protected $listeners = [
        'eventChat' => 'changeNotification',
        'notifiNull' => 'changeNotification'
    ];

    // public function sendEvent($id){
    //     event(new NotifiAdminEvent($id));
    // }

    public function mount(){
        
        $this->notifi = Chat::whereNull('user_id')->orWhere('user_id',auth()->id())->orderBy('updated_at', 'DESC')->get();
        $this->notifi =  $this->notifi->where('message','>=',1);
        $this->count = array_sum(array_column($this->notifi->toArray(),'message'));   
        
    }
    public function changeNotification(){
        
        $this->notifi = Chat::whereNull('user_id')->orWhere('user_id',auth()->id())->orderBy('updated_at', 'DESC')->get();
        $this->notifi = $this->notifi->where('message','>=',1);
        $this->count = array_sum(array_column($this->notifi->toArray(),'message'));   
        
    }

    public function render()
    {
        return view('livewire.notifikation');
    }
}