<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title',
        'phone',
        'status_id',
        'comment',
        'worker_id',
        'group_id',
        'task_id',
    ];

    function status() {
        return $this->belongsTo(Status::class)->withTrashed();
    }

    function worker() {
        return $this->belongsTo(Worker::class)->withTrashed();
    }
    function group() {
        return $this->belongsTo(Group::class)->withTrashed();
    }

    function task() {
        return $this->belongsTo(Task::class)->withTrashed();
    }

}
