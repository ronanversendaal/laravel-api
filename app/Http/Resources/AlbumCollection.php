<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AlbumCollection extends ResourceCollection
{

    private $_per_page = 8;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $attributes = [
            'first' => new AlbumResource($this->collection->sortBy('created_at')->values()->first()),
            'last' => new AlbumResource($this->collection->sortByDesc('created_at')->values()->first()),
            'data' => AlbumResource::collection($this->collection->take($this->_per_page))
        ];

        return $attributes;
    }
}
