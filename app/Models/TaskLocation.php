<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskLocation extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'longitude',
        'latitude',
        'address',
        'task_id',
        'worker_id'
    ];

    function worker() {
        return $this->belongsTo(Worker::class)->withTrashed();
    }

}
