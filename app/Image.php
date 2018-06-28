<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
