<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'user_id',
        'message'
    ];


    function worker() {
        return $this->belongsTo(Worker::class)->withTrashed();
    }


    function messages() {
        return $this->hasMany(Message::class)->with('user');
    }

    function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
