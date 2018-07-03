<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $path = $this->path;
        if(!filter_var($this->path, FILTER_VALIDATE_URL)){
            $path = url(Storage::url($this->path));
        }
        return [
            'id' => $this->id,
            'path' => $path,
            'album_id' => $this->album_id,
            'created_at' => $this->created_at
        ];
    }
}
