<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['name', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return $this->belongsTo('App\TaskStatus', 'status_id');
    }

    public function executor()
    {
        return $this->belongsTo('App\User', 'executor_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function syncTags(array $tagNames)
    {
        $tagIds = array_map(function ($value) {
            $tag = Tag::firstOrCreate(['name' => $value]);
            return $tag->id;
        }, $tagNames);
        return $this->tags()->sync($tagIds);
    }
}
