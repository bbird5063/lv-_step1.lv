<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource; // добавил
use App\Http\Resources\Tag\TagResource; // добавил

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
		 * 
     * Преобразуйте ресурс в массив.
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
			return [
					'id' => $this->id,
					'title' => $this->title,
					'content' => $this->content,
					'image' => $this->image,
					'category' => new CategoryResource($this->category), // добавил
					'tags' => TagResource::collection($this->tags), // добавил
				];
    }
}
