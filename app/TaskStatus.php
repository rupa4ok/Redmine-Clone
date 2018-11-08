<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $fillable = [ 'name' ];

    protected $table = 'task_statuses';

    public function task()
    {
        return $this->hasMany('App\Task');
    }

    public function scopeExcept($query, $id)
    {
        return $query->where('id', '<>', $id);
    }
}
