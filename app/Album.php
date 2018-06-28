<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['album_id', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
