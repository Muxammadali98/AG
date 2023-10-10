<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'type',
        'group_id'
    ];


    public function group(){
        return $this->belongsTo(Group::class)->withTrashed();
    }
}
