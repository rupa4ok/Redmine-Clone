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

    public function scopeFilter($query, $data)
    {
        if (isset($data['executor_id'])) {
            $query->executor($data['executor_id']);
        }

        if (isset($data['status_id'])) {
            $query->status($data['status_id']);
        }

        if (isset($data['tags'])) {
            $query->tags($data['tags']);
        }

        if (isset($data['my'])) {
            $query->my();
        }
        return $query;
    }

    public function scopeExecutor($query, $executor_id)
    {
        return $query->where('executor_id', $executor_id);
    }

    public function scopeStatus($query, $status_id)
    {
        return $query->where('status_id', $status_id);
    }

    public function scopeMy($query)
    {
        return $query->where('executor_id', auth()->user()->id);
    }

    public function scopeTags($query, $tags)
    {
        return $query->whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('id', $tags);
        });
    }
}
