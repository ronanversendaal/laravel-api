<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['article_id', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
