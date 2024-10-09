When testing an API locally, you need to use the Postman Desktop Agent. You currently have a different Agent selected, which can’t send requests to the Localhost.
--
При локальном тестировании API вам необходимо использовать Postman Desktop Agent. В настоящее время у вас выбран другой агент, который не может отправлять запросы на Localhost.


<?
"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3Mjg0OTEwMDEsImV4cCI6MTcyODQ5NDYwMSwibmJmIjoxNzI4NDkxMDAxLCJqdGkiOiJEbzFOOXhCbXM0OXVPejh5Iiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.mkoMt_qBCJ4zfuoyo06mq9YnNMcVnZ3enfX74YFcYI0"
STORE

http://127.0.0.1:8000/api/posts/1

{
	"title": "new post with transaction",
	"content": "some content",
	"image": "someimage.jpeg",
	"likes": 20,
	"category": {
    "id": 1,
		"title": "some new category"
	},
	"tags": [
		{
			"id": 20,
			"title": "some new
			update title"
		},
		{
			"title": "some new tag title"
		}
	]
}


UPDATE

При запросе в Постмане ОШИБКА: 
Добавьте [id] в заполняемое свойство, чтобы разрешить массовое назначение в [AppModelsTag]
"app\Models\Tag.php"
---
...
class Tag extends Model
{
	use HasFactory;
	protected $guarded = false; // нашел в комментариях: либо false, либо [], либо ['tag_id'] 
...
---

PATCH  http://127.0.0.1:8000/api/posts/1
{
	"title": "BB2 new post with transaction",
	"content": "some content",
	"image": "someimage.jpeg",
	"likes": 20,
	"category": {
        "id": 1,
		"title": "BB2 some new category"
	},
	"tags": [
		{
			"id": 63,
			"title": "BB2 some new update title"
		},
		{
			"title": "BB2 some new tag title"
		}
	]
}
  

==================
Postman


{
    "data": {
        "id": 1,
        "title": "BB2 new post with transaction",
        "content": "some content",
        "image": "someimage.jpeg"
    }
}
==================



В БД (`posts`(id=1),`categories`, `tags`) изменений нет.


When testing an API locally, you need to use the Postman Desktop Agent. You currently have a different Agent selected, which can’t send requests to the Localhost.



Для того, чтобы увидеть, кроме постов, категории, теги
можно 




"app\Http\Resources\Post\PostResource.php"
---
...
    public function toArray(Request $request): array
    {
			return [
					'id' => $this->id,
					'title' => $this->title,
					'content' => $this->content,
					'image' => $this->image,
					'category' => $this->category,
					'tags' => $this->tag

				];
						
    }

...
---

==================
Postman

{
    "data": {
        "id": 1,
        "title": "BB2 new post with transaction",
        "content": "some content",
        "image": "someimage.jpeg",
        "category": {
            "id": 1,
            "title": "BB2 some new category",
            "created_at": "2024-09-24T05:20:58.000000Z",
            "updated_at": "2024-10-09T14:27:00.000000Z"
        },
        "tags": null
    }
}
==================

Но так не делают.
Нужно сделать ресурсы:

php artisan make:resource Category/CategoryResource

php artisan make:resource Tag/TagResource

33:06


"app\Http\Resources\Category\CategoryResource.php" и 
"app\Http\Resources\Tag\TagResource.php"
---
...
	{
		return [
			'id' => $this->id,
			'title' => $this->title
		];
	}
...
---

"app\Http\Resources\Post\PostResource.php"
---
<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource; // добавил
use App\Http\Resources\Tag\TagResource; // добавил

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
			return [
					'id' => $this->id,
					'title' => $this->title,
					'content' => $this->content,
					'image' => $this->image,
					'category' => new CategoryResource($this->category), // добавил
					'tags' => TagResource::collection($this->tags) // добавил
				];
    }
}
---


""
---
...
...
---


""
---
...
...
---

==================
Postman
{
	"title": "BB6 new post with transaction",
	"content": "some content",
	"image": "someimage.jpeg",
	"likes": 20,
	"category": {
        "id": 1,
		"title": "BB6 some new category"
	},
	"tags": [
		{
			"id": 10,
			"title": "BB6 some new update title"
		},
		{
			"title": "BB6 some new tag title"
		}
	]
}

-----------------


{
    "data": {
        "id": 1,
        "title": "BB6 new post with transaction",
        "content": "some content",
        "image": "someimage.jpeg",
        "category": {
            "id": 1,
            "title": "BB6 some new category"
        },
        "tags": [
            {
                "id": 10,
                "title": "BB6 some new update title"
            },
            {
                "id": 89,
                "title": "BB6 some new tag title"
            }
        ]
    }
}
==================







""
---
...
...
---


""
---
...
...
---


""
---
...
...
---


""
---
...
...
---


""
---
...
...
---


""
---
...
...
---



