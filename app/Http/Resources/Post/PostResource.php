<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      //dd('toArray!');  
			return [
					'id' => $this->id,
					'title' => $this->title,
					'content' => $this->content,
					'image' => $this->image,
					'category_id' => $this->category_id,
				];
						
    }
}
