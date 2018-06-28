<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ImageCollection extends ResourceCollection
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
            'first' => new ImageResource($this->collection->sortBy('created_at')->values()->first()),
            'last' => new ImageResource($this->collection->sortByDesc('created_at')->values()->first()),
            'data' => ImageResource::collection($this->collection->take($this->_per_page))
        ];

        return $attributes;
    }
}
