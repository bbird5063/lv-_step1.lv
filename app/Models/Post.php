<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // добавил

class Post extends Model
{
    use HasFactory;
		/* ВСЕ, ЧТО НИЖЕ Я ДОБАВИЛ */
		use SoftDeletes;


		protected $table = 'posts'; // добавили, явно указали, могли не добавлять, но так принято

		/* МОДЕЛЬ ЗАЩИЩЕНА ОН ДОБАВЛЕНИЙ, ПОЭТОМУ: */
		//protected $guarded = []; // можно добавлять ЛЮБЫЕ массивы или false(откл. защита):
		protected $guarded = false;
		//protected $fillable = ['title', 'content',...]; // если с атрибутами
}
