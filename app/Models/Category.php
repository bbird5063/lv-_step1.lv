<?php
	
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
		
		public function posts() {
			// hasMany => "имеет много"
			/**
			 * Мы будем вызывать этот метод из PostController,
			 * где установили эту модель($this) на определенный id(localKey): 
			 * Category::find(x)
			 * Аргументы метода hasMany($related, $foreignKey = null, $localKey = null)
			 * У нас:
			 * $related = Post::class
			 * $foreignKey = 'category_id' (можно посмотреть в миграции _posts)
			 * $localKey = 'id'
			 * Этот метод return массивы Post по условию Post->category_id = $this->id
			 */
			return $this->hasMany(Post::class, 'category_id', 'id');
		}
}
