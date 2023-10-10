<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
        'chat_id'
        
    ];


    function chat() {
        return $this->belongsTo(Chat::class)->with('worker');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
