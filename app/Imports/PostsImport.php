<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // добавили WithHeadingRow
use App\Models\Post; // добавили

class PostsImport implements ToCollection, WithHeadingRow // добавили WithHeadingRow
{
	/**
	 * @param Collection $collection
	 */
	public function collection(Collection $collection)
	{
		foreach ($collection as $item) {
			//В ФАЙЛЕ УДЕЛИТЬ ПУСТЫЕ СТОЛБЦЫ(СПРАВА) И СТРОКИ(СНИЗУ)
			//if(isset($item['zagolovok']) && $item['zagolovok'] != null) {
			if (isset($item['zagolovok']) && !is_null($item['zagolovok'])) {
				//dump($item);
				Post::firstOrCreate([
					'title' => $item['zagolovok'], // 1 аргумент: массив уникальных полей
				], [
					'title' => $item['zagolovok'],
					'content' => $item['kontent'],
					'image' => $item['izobrazenie'],
					'likes' => $item['laiki'],
					'is_published' => $item['status_publikacii'],
					'category_id' => $item['kategoriia'],
				]);
			}
		}
	}
}
