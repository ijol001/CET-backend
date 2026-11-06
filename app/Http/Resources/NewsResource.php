<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'image' => $this->image
                ? asset('storage/' . $this->image)
                : null,
            'external_url' => $this->external_url,
            'published_at' => $this->published_at,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}