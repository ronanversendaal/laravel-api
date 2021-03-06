<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'head',
        'description',
        'client',
        'published_at'
    ];

    protected $dates = [
        'published_at'
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
