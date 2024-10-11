<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use Illuminate\Console\Command;
use App\Models\Post;

class ImportJsonPlaceholderCommand extends Command
{
	protected $signature = 'import:placeholder'; // по этой команде вызывается метод handle() (было 'app:import-json-placeholder-command')

	protected $description = 'Get data from placeholder'; // то что в терминале справа белым текстом (было 'Command description')
	/**
	 * Теперь нашу команду в видно при 'php artisan':
	 * ...
	 *  import  
	 * 		import:placeholder      Get data from placeholder
	 * ...
	 * 
	 * Запускаем:
	 * php artisan import:placeholder
	 * "111111111111111" // app\Console\Commands\ImportJsonPlaceholderCommand.php:29
	 */

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		//dd('111111111111111');
		$import = new ImportDataClient();
		$response = $import->client->request('GET', 'posts'); // взяли из https://docs.guzzlephp.org/en/stable/quickstart.html (было 'test')
		//dd(json_decode($response->getBody()->getContents())); // без json_decode() получим одно строку(с '\n'), а нам нужен массив и его получаем. "+"id": 100': '+' - к нам пришел объект и это его свойство. И обращение к нему $item->id.

		$data = json_decode($response->getBody()->getContents());
		foreach ($data as $item) { // добавим в нашу БД
			Post::firstOrCreate([
				'title' => $item->title, // 1 аргумент: массив уникальных полей
				'content' => $item->body,
			], [
				'title' => $item->title,
				'content' => $item->body,
				'category_id' => 2,
			]);
		}
		dd('FINISH'); // Было 226, стало 326. Все Ок!
	}
}
