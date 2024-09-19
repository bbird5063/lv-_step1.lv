<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
	use HasFactory;

	/* МОДЕЛЬ ЗАЩИЩЕНА ОН ДОБАВЛЕНИЙ, ПОЭТОМУ: */
	//protected $guarded = []; // можно добавлять ЛЮБЫЕ массивы или false(откл. защита):
	protected $guarded = false;
	//protected $fillable = ['title', 'content',...]; // если с атрибутами

}
