<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;





class Worker extends  Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;
    

    protected $fillable = [
        'name',
        'username',
        'surname',
        'password',
        'city_id',
        'address',
        'group_id',
        'status',
        'phone',
        'image',
        'job_title',
    ];

    function group() {
        return $this->belongsTo(Group::class)->with(['tasks', 'workers'])->withTrashed();
    }
    
    function city() {
        return $this->belongsTo(City::class)->withTrashed();
    }

    function chat() {
        return $this->hasOne(Chat::class)->with('messages');
    }

    function images(){
        return $this->hasMany(TaskImage::class);
    }
    function clients()
    {
        return $this->hasMany(Client::class);
    }
    function location()
    {
        return $this->hasMany(TaskLocation::class);
    }
}
