<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'body',
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
