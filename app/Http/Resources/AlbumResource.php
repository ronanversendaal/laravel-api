<?php

namespace App\Http\Resources;

use App\Image;
use App\Http\Resources\ImageCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $attributes = [
            'id' => $this->id
        ];

        if($this->images)
        {
            $attributes['images'] = new ImageCollection(Image::where('album_id', $this->id)->get());
        }


        return $attributes;
    }
}
