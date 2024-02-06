<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'content' => $this->content,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'category' => CategoriesResource::collection($this->whenLoaded('categories'))
            ],
            'relationships' => [
                'id' => (string)$this->user->id,
                'user name' => $this->user->name,
                'user email' => $this->user->email,
            ]
        ];
    }
}
