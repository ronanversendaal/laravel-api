<?php

namespace App\Http\Resources;

use App\Album;
use App\Image;
use App\Http\Resources\AlbumCollection;
use App\Http\Resources\ImageCollection;
use Illuminate\Http\Resources\Json\JsonResource;

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

        if($this->albums)
        {
            $albums = $this->albums;

            $attributes['albums'] = new AlbumCollection($albums);
        }

        return $attributes;
    }
}
