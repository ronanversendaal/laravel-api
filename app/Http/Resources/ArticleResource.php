<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id, // Make more 'API friendly'
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'body' => $this->body,
            'published_at' => $this->published_at
        ];
    }
}
