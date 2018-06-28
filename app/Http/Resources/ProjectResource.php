<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageCollection;
use App\Image;

class ProjectResource extends JsonResource
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
            'id' => $this->id, // Make more 'API friendly'
            'title' => $this->title,
            'head' => $this->head,
            'description' => $this->description,
            'demo_url' => $this->demo_url,
            'client' => $this->client,
            'client_url' => $this->client_url,
            'published_at' => $this->published_at
        ];

        if($this->album)
        {
            $attributes['images'] = new ImageCollection(Image::where('album_id', $this->album->id)->get());
        }

        return $attributes;
    }
}
