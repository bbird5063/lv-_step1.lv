<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

	public function posts()
	{
		/**
		 * Аргументы метода belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null)
		 * 
		 * $related = Post::class
		 * $table = 'post_tags'
		 * $foreignPivotKey = 'tag_id'
		 * $relatedPivotKey = 'post_id'
		 * $parentKey = null
		 * $relatedKey = null
		 * $relation = null
		 */
		return $this->belongsToMany(Post::class, 'post_tags', 'tag_id','post_id');
	}
}
